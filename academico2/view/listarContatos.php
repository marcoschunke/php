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
    <title>Listar Contatos</title>
    <!-- Materialize CSS -->
    <link href="../css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<div class="container">
    <div class="row">

    <?php
        require_once '../model/ClasseContato.php';

        // Cria o objeto da classe contato
        $contato = new ClasseContato();

        // Lista contatos com ações (editar/excluir)
        $contato->listarContatosAcoes();
    ?>

    </div>
</div>

<!-- Botão para voltar ao menu -->
<div class="center-align" style="margin-top: 20px;">
    <a href="../menu.php" class="btn waves-effect waves-light grey">
        <i class="material-icons left">arrow_back</i> Voltar para o Menu
    </a>
</div>

<!-- Materialize JS -->
<script src="../js/materialize.min.js"></script>
</body>
</html>
