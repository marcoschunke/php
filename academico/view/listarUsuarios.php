<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_codigo'])) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário com Materialize</title>
    <!-- Importando Materialize CSS -->
    <link href="../css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<div class="container">
    <div class="row"> 
    
    <?php
    require_once '../model/ClasseUsuario.php';

    // Cria um objeto da classe
    $codigo = 0;
    $nome = "";
    $usuario = "";
    $senha = "";
    $permCreate = 0;
    $permRead = 0;
    $permUpdate = 0;
    $permDelete = 0;
    $usuario = new ClasseUsuario($codigo = 0, $nome, $usuario, $senha, $permCreate, $permRead, $permUpdate, $permDelete);

    // Chama o método para listar os usuários
    $usuario->listarUsuariosAcoes();
    ?>
                        
        </div> 
    </div> 

    <!-- Botão para voltar ao menu -->
    <div class="center-align" style="margin-top: 20px;">
        <a href="../menu.php" class="btn waves-effect waves-light grey">
            <i class="material-icons left">arrow_back</i> Voltar para o Menu
        </a>
    </div>

<!-- Importando Materialize JS -->
<script src="../js/materialize.min.js"></script>
</body>
</html>