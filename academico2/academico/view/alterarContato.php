<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_codigo'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../model/Conexao.php';
require_once '../model/ClasseContato.php';

// Pega o ID do contato via GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Conexão
$pdo = getConexao();

// Carrega lista de usuários para o <select>
$usuarios = [];
try {
    $stmtU = $pdo->prepare("SELECT codigo, nome, usuario FROM usuario ORDER BY nome ASC");
    $stmtU->execute();
    $usuarios = $stmtU->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $usuarios = [];
}

// Inicializa variáveis do contato
$usuario_codigo = $email = $telefone = "";

// Se houver id válido e NÃO for submissão, busca os dados do contato
if ($id > 0 && !isset($_POST['alterar'])) {
    try {
        $stmt = $pdo->prepare("SELECT id, usuario_codigo, email, telefone FROM contato WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha) {
            $usuario_codigo = $linha['usuario_codigo'];
            $email          = $linha['email'];
            $telefone       = $linha['telefone'];
        } else {
            echo '<div class="card-panel red lighten-4">Contato não encontrado!</div>';
        }
    } catch (PDOException $e) {
        echo '<div class="card-panel red lighten-4">Erro ao buscar contato: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

// Se o formulário for enviado
if (isset($_POST["alterar"])) {
    $usuario_codigo = $_POST["usuario_codigo"] ?? "";
    $email          = $_POST["email"] ?? "";
    $telefone       = $_POST["telefone"] ?? "";

    // Atualiza o contato
    $contato = new ClasseContato($id, $usuario_codigo, $email, $telefone);
    $contato->atualizarContato();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Contato</title>
    <link href="../css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">

            <div class="card z-depth-3">
                <div class="card-content">
                    <span class="card-title center blue-text">Alterar Contato</span>

                    <form method="post" action="alterarContato.php?id=<?= htmlspecialchars($id) ?>">

                        <!-- Usuário (select - usuario_codigo) -->
                        <div class="input-field">
                            <i class="material-icons prefix">person_search</i>
                            <select id="usuario_codigo" name="usuario_codigo" required>
                                <option value="" disabled <?= $usuario_codigo === "" ? 'selected' : '' ?>>Escolha um usuário</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <?php
                                        $cod = $u['codigo'];
                                        $rotulo = $u['nome'] ?: $u['usuario'];
                                    ?>
                                    <option value="<?= htmlspecialchars($cod) ?>" <?= ($usuario_codigo == $cod) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($rotulo) ?> (cód. <?= htmlspecialchars($cod) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="usuario_codigo">Usuário</label>
                        </div>

                        <!-- Email -->
                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" required value="<?= htmlspecialchars($email) ?>">
                            <label for="email" class="active">E-mail</label>
                        </div>

                        <!-- Telefone -->
                        <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefone" type="text" name="telefone" required value="<?= htmlspecialchars($telefone) ?>">
                            <label for="telefone" class="active">Telefone</label>
                        </div>

                        <!-- Botão Alterar -->
                        <button type="submit" name="alterar" class="btn waves-effect waves-light orange w-100">
                            Alterar
                            <i class="material-icons right">edit</i>
                        </button>

                        <!-- Voltar -->
                        <div class="center-align" style="margin-top: 20px;">
                            <a href="../view/listarContatos.php" class="btn waves-effect waves-light grey">
                                <i class="material-icons left">arrow_back</i> Voltar para Listagem
                            </a>
                            <a href="../menu.php" class="btn waves-effect waves-light grey darken-1">
                                <i class="material-icons left">home</i> Menu
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="../js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var selects = document.querySelectorAll('select');
    M.FormSelect.init(selects);
});
</script>
</body>
</html>
