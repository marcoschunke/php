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
    <title>Formulário com UIkit</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="css/uikit.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="uk-background-muted">

<div class="uk-container uk-margin-top uk-margin-large-bottom">
    <div class="uk-grid-match uk-child-width-1-2@m uk-margin-auto" uk-grid>
        <div class="uk-width-1-2@m uk-margin-auto">
            
            <div class="uk-card uk-card-default uk-card-body uk-box-shadow-medium">
                <h3 class="uk-card-title uk-text-center">Formulário de Contato</h3>
                
                <form method="post" action="index.php" class="uk-form-stacked">
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="nome">Nome</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" id="nome" name="nome" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="email">E-mail</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="email" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="telefone">Telefone</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" type="text" id="telefone" name="telefone" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="mensagem">Mensagem</label>
                        <div class="uk-form-controls">
                            <textarea class="uk-textarea" id="mensagem" name="mensagem" rows="4" required></textarea>
                        </div>
                    </div>

                    <button type="submit" name="enviar" class="uk-button uk-button-primary uk-width-1-1">Enviar</button>
                </form>
            </div>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="uk-card uk-card-secondary uk-card-body uk-margin-top">
                    <h5>Dados Recebidos:</h5>
                    <p><strong>Nome:</strong> <?= $nome ?></p>
                    <p><strong>E-mail:</strong> <?= $email ?></p>
                    <p><strong>Telefone:</strong> <?= $telefone ?></p>
                    <p><strong>Mensagem:</strong> <?= $mensagem ?></p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- UIkit JS -->
<script src="js/uikit.min.js"></script>
<script src="js/uikit-icons.min.js"></script>
</body>
</html>
