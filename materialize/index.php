<!-- index.php -->
<?php
// Processamento do formulário
$nome = $email = $telefone = $mensagem = "";
if (isset($_POST["enviar"])) {
    $nome = htmlspecialchars($_POST["nome"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefone = htmlspecialchars($_POST["telefone"]);
    $mensagem = htmlspecialchars($_POST["mensagem"]);
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
                    <span class="card-title center blue-text">Formulário de Contato</span>
                    <form method="post" action="index.php">
                        
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="nome" type="text" name="nome" required>
                            <label for="nome">Nome</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" required>
                            <label for="email">E-mail</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                            <input id="telefone" type="text" name="telefone" required>
                            <label for="telefone">Telefone</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">message</i>
                            <textarea id="mensagem" class="materialize-textarea" name="mensagem" required></textarea>
                            <label for="mensagem">Mensagem</label>
                        </div>

                        <button type="submit" name="enviar" class="btn waves-effect waves-light blue w-100">
                            Enviar <i class="material-icons right">send</i>
                        </button>
                    </form>
                </div>
            </div>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="card-panel teal lighten-4">
                    <h6 class="teal-text">Dados Recebidos:</h6>
                    <p><strong>Nome:</strong> <?= $nome ?></p>
                    <p><strong>E-mail:</strong> <?= $email ?></p>
                    <p><strong>Telefone:</strong> <?= $telefone ?></p>
                    <p><strong>Mensagem:</strong> <?= $mensagem ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Importando Materialize JS -->
<script src="js/materialize.min.js"></script>
</body>
</html>
