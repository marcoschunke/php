<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario_codigo'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu - Sistema Usuários e Contatos</title>
    <!-- Materialize CSS -->
    <link href="css/materialize.min.css" rel="stylesheet">
    <!-- Ícones do Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="grey lighten-4">

<!-- Dropdowns -->
<ul id="dropdown-cadastro" class="dropdown-content">
    <li><a href="view/cadastrarUsuario.php"><i class="material-icons left">person_add</i>Usuário</a></li>
    <li><a href="view/cadastrarContato.php"><i class="material-icons left">contact_mail</i>Contato</a></li>
</ul>

<ul id="dropdown-listagem" class="dropdown-content">
    <li><a href="view/listarUsuarios.php"><i class="material-icons left">list</i>Usuários</a></li>
    <li><a href="view/listarContatos.php"><i class="material-icons left">contacts</i>Contatos</a></li>
</ul>

<!-- Navbar -->
<nav class="blue">
    <div class="nav-wrapper container">
        <a href="#" class="brand-logo">Sistema Usuários e Contatos</a>
        <a href="#" data-target="mobile-menu" class="sidenav-trigger">
            <i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">
            <!-- Agrupamentos -->
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown-cadastro">
                    <i class="material-icons left">add_circle</i>Cadastros<i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>
            <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown-listagem">
                    <i class="material-icons left">assignment</i>Listagens<i class="material-icons right">arrow_drop_down</i>
                </a>
            </li>
            <!-- Logout -->
            <li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Sair</a></li>
        </ul>
    </div>
</nav>

<!-- Menu lateral (mobile) -->
<ul class="sidenav" id="mobile-menu">
    <li><div class="divider"></div></li>
    <li class="subheader">Cadastros</li>
    <li><a href="view/cadastrarUsuario.php"><i class="material-icons">person_add</i>Usuário</a></li>
    <li><a href="view/cadastrarContato.php"><i class="material-icons">contact_mail</i>Contato</a></li>

    <li><div class="divider"></div></li>
    <li class="subheader">Listagens</li>
    <li><a href="view/listarUsuarios.php"><i class="material-icons">list</i>Usuários</a></li>
    <li><a href="view/listarContatos.php"><i class="material-icons">contacts</i>Contatos</a></li>

    <li><div class="divider"></div></li>
    <li><a href="logout.php"><i class="material-icons">exit_to_app</i>Sair</a></li>
</ul>

<!-- Conteúdo principal -->
<div class="container section">
    <h4 class="center-align blue-text">
        Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']); ?>!
    </h4>
    <p class="center-align">
        Utilize o menu acima para acessar as áreas de cadastro e listagem de usuários e contatos.
    </p>
</div>

<!-- Materialize JS -->
<script src="js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elemsSidenav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(elemsSidenav);

    var elemsDropdown = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(elemsDropdown, {
        coverTrigger: false,
        constrainWidth: false
    });
});
</script>

</body>
</html>
