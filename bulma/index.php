<!-- index.php -->
<?php
// Processamento do formulário
$nome = $email = $telefone = $mensagem = "";
if (isset($_POST["enviar"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $mensagem = $_POST["mensagem"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário com Bulma</title>
    <!-- Bulma CSS -->
    <link rel="stylesheet" href="css/bulma.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="has-background-light">

<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                
                <div class="box">
                    <h1 class="title has-text-centered has-text-primary">Formulário de Contato</h1>
                    
                    <form method="post" action="index.php">
                        
                        <div class="field">
                            <label class="label" for="nome">Nome</label>
                            <div class="control">
                                <input class="input" type="text" id="nome" name="nome" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="email">E-mail</label>
                            <div class="control">
                                <input class="input" type="email" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="telefone">Telefone</label>
                            <div class="control">
                                <input class="input" type="text" id="telefone" name="telefone" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="mensagem">Mensagem</label>
                            <div class="control">
                                <textarea class="textarea" id="mensagem" name="mensagem" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="field mt-5">
                            <div class="control">
                                <button type="submit" name="enviar" class="button is-primary is-fullwidth">Enviar</button>
                            </div>
                        </div>

                    </form>
                </div>

                <?php if (isset($_POST["enviar"])) { ?>
                    <div class="notification is-info mt-4">
                        <h5 class="title is-5">Dados Recebidos:</h5>
                        <p><strong>Nome:</strong> <?= $nome ?></p>
                        <p><strong>E-mail:</strong> <?= $email ?></p>
                        <p><strong>Telefone:</strong> <?= $telefone ?></p>
                        <p><strong>Mensagem:</strong> <?= $mensagem ?></p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</section>

</body>
</html>
