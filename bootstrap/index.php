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
    <title>Formulário com Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Formulário de Contato</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                        </div>
                        <button type="submit" name="enviar" class="btn btn-success w-100">Enviar</button>
                    </form>
                </div>
            </div>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <div class="alert alert-info mt-4">
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

<!-- Bootstrap JS -->
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>