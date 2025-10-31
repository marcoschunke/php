<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_codigo'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../model/ClasseContato.php';
require_once '../model/Conexao.php';

$pdo = getConexao();

// Carrega usuários para o <select>
$usuarios = [];
try {
    $stmt = $pdo->prepare("SELECT codigo, nome, usuario FROM usuario ORDER BY nome ASC");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $usuarios = [];
}

// Processamento do formulário
$usuario_codigo = $email = $telefone = "";
if (isset($_POST["enviar"])) {
    $usuario_codigo = $_POST["usuario_codigo"] ?? "";
    $email          = $_POST["email"] ?? "";
    $telefone       = $_POST["telefone"] ?? "";

    // Salva usando a classe de modelo
    $contato = new ClasseContato(null, $usuario_codigo, $email, $telefone);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Contato</title>
    <!-- Materialize CSS -->
    <link href="../css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">

            <div class="card z-depth-3">
                <div class="card-content">
                    <span class="card-title center blue-text">Cadastrar Contato</span>

                    <form method="post" action="cadastrarContato.php">
                        <!-- Usuário (select) -->
                        <div class="input-field">
                            <i class="material-icons prefix">person_search</i>
                            <select id="usuario_codigo" name="usuario_codigo" required>
                                <option value="" disabled selected>Escolha um usuário</option>
                                <?php foreach ($usuarios as $u): ?>
                                    <option value="<?= htmlspecialchars($u['codigo']) ?>"
                                        <?= (isset($usuario_codigo) && $usuario_codigo == $u['codigo']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($u['nome'] ?: $u['usuario']) ?> (cód. <?= htmlspecialchars($u['codigo']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="usuario_codigo">Usuário</label>
                        </div>

                        <!-- Email -->
                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                            <label for="email">E-mail</label>
                        </div>

                        <!-- Telefone -->
                        <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefone" type="text" name="telefone" value="<?= htmlspecialchars($telefone) ?>" required>
                            <label for="telefone">Telefone</label>
                        </div>

                        <!-- Botão -->
                        <button type="submit" name="enviar" class="btn waves-effect waves-light blue w-100">
                            Cadastrar
                            <i class="material-icons right">contact_mail</i>
                        </button>

                        <!-- Voltar ao menu -->
                        <div class="center-align" style="margin-top: 20px;">
                            <a href="../menu.php" class="btn waves-effect waves-light grey">
                                <i class="material-icons left">arrow_back</i> Voltar para o Menu
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            // Feedback e gravação após submit
            if (isset($_POST["enviar"])) {
                if (!$usuario_codigo || !$email || !$telefone) {
                    echo '<div class="card-panel red lighten-4 red-text text-darken-4">
                            <i class="material-icons left">error</i>
                            Preencha todos os campos.
                          </div>';
                } else {
                    // Grava no banco
                    $contato->cadastrarContato();

                    // Painel de dados recebidos
                    echo '<div class="card-panel teal lighten-4">
                            <h6 class="teal-text">Dados Recebidos:</h6>
                            <p><strong>Usuário (código):</strong> ' . htmlspecialchars($usuario_codigo) . '</p>
                            <p><strong>E-mail:</strong> ' . htmlspecialchars($email) . '</p>
                            <p><strong>Telefone:</strong> ' . htmlspecialchars($telefone) . '</p>
                          </div>';
                }
            }
            ?>

        </div>
    </div>
</div>

<!-- Materialize JS -->
<script src="../js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var selects = document.querySelectorAll('select');
    M.FormSelect.init(selects);
});
</script>
</body>
</html>
