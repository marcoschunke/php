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
    <title>Formulário com Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Formulário de Contato</h2>

            <form method="post" action="index.php" class="space-y-4">
                <div>
                    <label for="nome" class="block text-gray-700 font-semibold mb-2">Nome</label>
                    <input type="text" id="nome" name="nome" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="telefone" class="block text-gray-700 font-semibold mb-2">Telefone</label>
                    <input type="text" id="telefone" name="telefone" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label for="mensagem" class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                    <textarea id="mensagem" name="mensagem" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                <button type="submit" name="enviar" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition-colors">Enviar</button>
            </form>

            <?php if (isset($_POST["enviar"])) { ?>
                <div class="mt-6 p-4 bg-blue-100 border-l-4 border-blue-600 text-blue-800 rounded-lg">
                    <h5 class="font-semibold">Dados Recebidos:</h5>
                    <p><strong>Nome:</strong> <?= $nome ?></p>
                    <p><strong>E-mail:</strong> <?= $email ?></p>
                    <p><strong>Telefone:</strong> <?= $telefone ?></p>
                    <p><strong>Mensagem:</strong> <?= $mensagem ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
