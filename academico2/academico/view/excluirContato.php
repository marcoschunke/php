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

// Inicializa variáveis
$usuario_codigo = $email = $telefone = "";

// Se houver id válido e ainda não enviou o formulário, busca os dados do contato
if ($id > 0 && !isset($_POST['excluir'])) {
    try {
        $pdo = getConexao();
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

// Se o formulário de exclusão for enviado
if (isset($_POST["excluir"]) && $id > 0) {
    $contatoObj = new ClasseContato($id, $usuario_codigo, $email, $telefone);
    $contatoObj->excluirContato();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Contato</title>
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
                    <span class="card-title center blue-text">Excluir Contato</span>
                    <form method="post" action="excluirContato.php?id=<?= htmlspecialchars($id) ?>">

                        <!-- ID -->
                        <div class="input-field">
                            <i class="material-icons prefix">fingerprint</i>
                            <input id="id" type="text" value="<?= htmlspecialchars($id) ?>" readonly>
                            <label for="id" class="active">ID do Contato</label>
                        </div>

                        <!-- Usuário (código) -->
                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input id="usuario_codigo" type="text" value="<?= htmlspecialchars($usuario_codigo) ?>" readonly>
                            <label for="usuario_codigo" class="active">Código do Usuário</label>
                        </div>

                        <!-- E-mail -->
                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="text" value="<?= htmlspecialchars($email) ?>" readonly>
                            <label for="email" class="active">E-mail</label>
                        </div>

                        <!-- Telefone -->
                        <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefone" type="text" value="<?= htmlspecialchars($telefone) ?>" readonly>
                            <label for="telefone" class="active">Telefone</label>
                        </div>

                        <!-- Botão Excluir -->
                        <button type="submit" name="excluir" class="btn waves-effect waves-light red w-100"
                                onclick="return confirm('Tem certeza que deseja excluir este contato?');">
                            Excluir
                            <i class="material-icons right">delete</i>
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
</body>
</html>
