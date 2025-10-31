<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_codigo'])) {
    header("Location: ../index.php");
    exit;
}

require_once '../model/ClasseUsuario.php';
require_once '../model/Conexao.php';

// Pega o código do usuário via GET
$codigo = isset($_GET['codigo']) ? (int)$_GET['codigo'] : 0;

// Inicializa variáveis
$nome = $usuario = $senha = "";
$permCreate = $permRead = $permUpdate = $permDelete = 0;

// Se houver código válido, busca os dados do usuário
if ($codigo > 0 && !isset($_POST['alterar'])) {
    try {
        $pdo = getConexao();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE codigo = :codigo");
        $stmt->execute([':codigo' => $codigo]);
        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($linha) {
            $nome       = $linha['nome'];
            $usuario    = $linha['usuario'];
            $senha      = $linha['senha'];
            $permCreate = $linha['create'];
            $permRead   = $linha['read'];
            $permUpdate = $linha['update'];
            $permDelete = $linha['delete'];
        } else {
            echo '<div class="card-panel red lighten-4">Usuário não encontrado!</div>';
        }

    } catch (PDOException $e) {
        echo '<div class="card-panel red lighten-4">Erro ao buscar usuário: ' . $e->getMessage() . '</div>';
    }
}

// Se o formulário for enviado
if (isset($_POST["alterar"])) {
    $nome       = $_POST["nome"];
    $usuario    = $_POST["usuario"];
    $senha      = $_POST["senha"];
    $permCreate = isset($_POST["create"]) ? 1 : 0;
    $permRead   = isset($_POST["read"]) ? 1 : 0;
    $permUpdate = isset($_POST["update"]) ? 1 : 0;
    $permDelete = isset($_POST["delete"]) ? 1 : 0;

    // Atualiza o usuário
    $usuarioObj = new ClasseUsuario($codigo, $nome, $usuario, $senha, $permCreate, $permRead, $permUpdate, $permDelete);
    $usuarioObj->atualizarUsuario();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Usuário</title>
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
                    <span class="card-title center blue-text">Alterar Usuário</span>
                    <form method="post" action="alterarUsuario.php?codigo=<?= $codigo ?>">

                        <!-- Nome -->
                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input id="nome" type="text" name="nome" required value="<?= htmlspecialchars($nome) ?>">
                            <label for="nome" class="active">Nome Completo</label>
                        </div>

                        <!-- Usuário -->
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" type="text" name="usuario" required value="<?= htmlspecialchars($usuario) ?>">
                            <label for="usuario" class="active">Usuário</label>
                        </div>

                        <!-- Senha -->
                        <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="senha" type="password" name="senha" required value="<?= htmlspecialchars($senha) ?>">
                            <label for="senha" class="active">Senha</label>
                        </div>

                        <!-- Permissões -->
                        <p>
                            <label>
                                <input type="checkbox" name="create" value="1" <?= $permCreate ? 'checked' : '' ?> />
                                <span>Create</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="read" value="1" <?= $permRead ? 'checked' : '' ?> />
                                <span>Read</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="update" value="1" <?= $permUpdate ? 'checked' : '' ?> />
                                <span>Update</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="delete" value="1" <?= $permDelete ? 'checked' : '' ?> />
                                <span>Delete</span>
                            </label>
                        </p>

                        <!-- Botão Alterar -->
                        <button type="submit" name="alterar" class="btn waves-effect waves-light orange w-100">
                            Alterar
                            <i class="material-icons right">edit</i>
                        </button>

                        <!-- Botão para voltar ao menu -->
                        <div class="center-align" style="margin-top: 20px;">
                            <a href="../menu.php" class="btn waves-effect waves-light grey">
                                <i class="material-icons left">arrow_back</i> Voltar para o Menu
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