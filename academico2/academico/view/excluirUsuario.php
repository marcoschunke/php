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

// Se houver código válido e ainda não enviou o formulário
if ($codigo > 0 && !isset($_POST['excluir'])) {
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

// Se o formulário de exclusão for enviado
if (isset($_POST["excluir"]) && $codigo > 0) {
    $usuarioObj = new ClasseUsuario($codigo, $nome, $usuario, $senha, $permCreate, $permRead, $permUpdate, $permDelete);
    $usuarioObj->excluirUsuario();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Usuário</title>
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
                    <span class="card-title center blue-text">Excluir Usuário</span>
                    <form method="post" action="excluirUsuario.php?codigo=<?= $codigo ?>">

                        <!-- Nome -->
                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input id="nome" type="text" name="nome" required value="<?= htmlspecialchars($nome) ?>" readonly>
                            <label for="nome" class="active">Nome Completo</label>
                        </div>

                        <!-- Usuário -->
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" type="text" name="usuario" required value="<?= htmlspecialchars($usuario) ?>" readonly>
                            <label for="usuario" class="active">Usuário</label>
                        </div>

                        <!-- Senha -->
                        <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="senha" type="password" name="senha" required value="<?= htmlspecialchars($senha) ?>" readonly>
                            <label for="senha" class="active">Senha</label>
                        </div>

                        <!-- Permissões -->
                        <p>
                            <label>
                                <input type="checkbox" name="create" value="1" <?= $permCreate ? 'checked' : '' ?> disabled />
                                <span>Create</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="read" value="1" <?= $permRead ? 'checked' : '' ?> disabled />
                                <span>Read</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="update" value="1" <?= $permUpdate ? 'checked' : '' ?> disabled />
                                <span>Update</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="delete" value="1" <?= $permDelete ? 'checked' : '' ?> disabled />
                                <span>Delete</span>
                            </label>
                        </p>

                        <!-- Botão Excluir -->
                        <button type="submit" name="excluir" class="btn waves-effect waves-light red w-100"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                            Excluir
                            <i class="material-icons right">delete</i>
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