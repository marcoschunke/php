<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu - Materialize</title>
    <!-- Materialize CSS -->
    <link href="css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<!-- Navbar -->
<nav class="blue">
    <div class="nav-wrapper container">
        <a href="#" class="brand-logo">Sistema Usuários</a>
        <a href="#" data-target="mobile-menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="view/cadastrarUsuario.php"><i class="material-icons left">person_add</i>Cadastrar Usuário</a></li>
            <li><a href="view/listarUsuarios.php"><i class="material-icons left">list</i>Listar Usuários</a></li>
        </ul>
    </div>
</nav>

<!-- Sidenav para mobile -->
<ul class="sidenav" id="mobile-menu">
    <li><a href="view/cadastrarUsuario.php"><i class="material-icons">person_add</i>Cadastrar Usuário</a></li>
    <li><a href="view/listarUsuarios.php"><i class="material-icons">list</i>Listar Usuários</a></li>
</ul>

<!-- Conteúdo -->
<div class="container section">
    <h4 class="center-align blue-text">Bem-vindo ao Sistema de Usuários</h4>
    <p class="center-align">Use o menu acima para navegar entre as telas de cadastro e listagem de usuários.</p>
</div>

<!-- Materialize JS -->
<script src="js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elems);
});
</script>

</body>
</html>
