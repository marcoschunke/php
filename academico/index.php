<?php
session_start();
// Processamento do formulário
$usuario = $senha = "";
if (isset($_POST["enviar"])) {
    $usuario = $_POST["usuario"];
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
                    <p><strong>usuario:</strong> <?= $usuario ?></p> 
                    <p><strong>senha:</strong> <?= $senha ?></p>  
                </div> 
            <?php } ?>

            <?php
            require_once 'model/ClasseUsuario.php';
            
            if (isset($_POST["enviar"])) {

                // Cria um objeto da classe
                $usuario = new ClasseUsuario();

                // Chama o método para listar os usuários
                $usuario->autenticar($usuario, $senha);
                
            
            }

            ?>

        </div>
    </div>
</div>

<!-- Importando Materialize JS -->
<script src="js/materialize.min.js"></script>
</body>
</html>
