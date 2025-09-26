<?php
// Processamento do formulário
$nome = $usuario = $senha = "";
$permCreate = $permRead = $permUpdate = $permDelete = 0;

if (isset($_POST["enviar"])) {
    $nome       = $_POST["nome"];
    $usuario    = $_POST["usuario"];
    $senha      = $_POST["senha"];
    $permCreate = isset($_POST["create"]) ? 1 : 0;
    $permRead   = isset($_POST["read"]) ? 1 : 0;
    $permUpdate = isset($_POST["update"]) ? 1 : 0;
    $permDelete = isset($_POST["delete"]) ? 1 : 0;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <!-- Importando Materialize CSS -->
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
                    <span class="card-title center blue-text">Cadastrar Usuário</span>
                    <form method="post" action="cadastrarUsuario.php">

                        <!-- Nome -->
                        <div class="input-field">
                            <i class="material-icons prefix">person</i>
                            <input id="nome" type="text" name="nome" required>
                            <label for="nome">Nome Completo</label>
                        </div>

                        <!-- Usuário -->
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" type="text" name="usuario" required>
                            <label for="usuario">Usuário</label>
                        </div>

                        <!-- Senha -->
                        <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="senha" type="password" name="senha" required>
                            <label for="senha">Senha</label>
                        </div>

                        <!-- Permissões -->
                        <p>
                            <label>
                                <input type="checkbox" name="create" value="1" />
                                <span>Create</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="read" value="1" />
                                <span>Read</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="update" value="1" />
                                <span>Update</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" name="delete" value="1" />
                                <span>Delete</span>
                            </label>
                        </p>

                        <!-- Botão -->
                        <button type="submit" name="enviar" class="btn waves-effect waves-light blue w-100">
                            Cadastrar
                            <i class="material-icons right">person_add</i>
                        </button>
                    </form>
                </div>
            </div>

            <?php if (isset($_POST["enviar"])) { ?> 
                <div class="card-panel teal lighten-4"> 
                    <h6 class="teal-text">Dados Recebidos:</h6> 
                    <p><strong>Nome:</strong> <?= $nome ?></p> 
                    <p><strong>Usuário:</strong> <?= $usuario ?></p> 
                    <p><strong>Senha:</strong> <?= $senha ?></p> 
                    <p><strong>Create:</strong> <?= $permCreate ?></p> 
                    <p><strong>Read:</strong> <?= $permRead ?></p> 
                    <p><strong>Update:</strong> <?= $permUpdate ?></p> 
                    <p><strong>Delete:</strong> <?= $permDelete ?></p> 
                </div> 
            <?php } ?>

        </div>
    </div>
</div>

<!-- Importando Materialize JS -->
<script src="js/materialize.min.js"></script>
</body>
</html>
