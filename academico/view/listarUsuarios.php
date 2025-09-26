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
    $usuario = new ClasseUsuario();

    // Chama o método para listar os usuários
    $usuario->listarUsuariosAcoes();
    ?>
                        
        </div> 
    </div> 

<!-- Importando Materialize JS -->
<script src="../js/materialize.min.js"></script>
</body>
</html>