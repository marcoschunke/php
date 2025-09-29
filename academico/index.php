<?php
session_start();

// Processamento do formulário
$login = $senha = "";
if (isset($_POST["enviar"])) {
    $login = $_POST["usuario"];
    $senha = $_POST["senha"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário com Materialize</title>
    <!-- Importando Materialize CSS -->
    <link href="css/materialize.min.css" rel="stylesheet">
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
                    <span class="card-title center blue-text">Formulário de Autenticação</span>
                    <form method="post" action="index.php">
                        
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" type="text" name="usuario" required>
                            <label for="usuario">Usuário</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="senha" type="password" name="senha" required>
                            <label for="senha">Senha</label>
                        </div>

                        <button type="submit" name="enviar" class="btn waves-effect waves-light blue w-100">
                        Autenticar
                        <i class="material-icons right">login</i>
                        </button>
                    </form>
                </div>
            </div>

            <?php if (isset($_POST["enviar"])) { ?> 
                <div class="card-panel teal lighten-4"> 
                    <h6 class="teal-text">Dados Recebidos:</h6> 
                    <p><strong>usuario:</strong> <?= htmlspecialchars($login) ?></p> 
                    <p><strong>senha:</strong> <?= htmlspecialchars($senha) ?></p>  
                </div> 
            <?php } ?>

            <?php
            require_once 'model/ClasseUsuario.php';
            
            if (isset($_POST["enviar"])) {
                // Cria um objeto da classe
                $codigo = 0;
                $nome = "";
                $usuario = $_POST["usuario"];
                $senha = $_POST["senha"];
                $permCreate = 0;
                $permRead = 0;
                $permUpdate = 0;
                $permDelete = 0;
                $usuarioObj = new ClasseUsuario($codigo, $nome, $usuario, $senha, $permCreate, $permRead, $permUpdate, $permDelete);
                $usuarioObj->setUsuario($login);
                $usuarioObj->setSenha($senha);

                if ($usuarioObj->autenticar()) {
                    header("Location: menu.php");
                    echo '<div class="card-panel green lighten-4">';
                    echo '<h6 class="green-text">Bem-vindo, ' . $_SESSION['usuario_nome'] . '!</h6>';
                    echo '</div>';
                } else {
                    echo '<div class="card-panel red lighten-4">';
                    echo '<h6 class="red-text">Usuário ou senha inválidos!</h6>';
                    echo '</div>';
                }
            }            
            ?>

        </div>
    </div>
</div>

<!-- Importando Materialize JS -->
<script src="js/materialize.min.js"></script>
</body>
</html>