<!DOCTYPE html>
<html lang="pt-br">
<head>    
    <title>Formulário de Contato</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-section {
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .form-section:last-child {
            border-bottom: none;
        }
        h2 {
            color: #555;
            font-size: 18px;
            margin-bottom: 15px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .address-line {
            display: flex;
            gap: 10px;
        }
        .address-line input {
            flex: 1;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            padding: 12px;
            border: none;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Formulário de Contato</h1>
        
        <form action="processar.php" method="post">
            <div class="form-section">
                <h2>Nome</h2>
				<div class="address-line">
                    <input type="text" name="nome" placeholder="Nome" required>
					<input type="text" name="sobrenome" placeholder="Sobrenome" required>
                </div>               
            </div>

            <div class="form-section">
                <h2>E-mail</h2>
                <input type="email" name="email" placeholder="exemplo@dominio.com" required>
            </div>

            <div class="form-section">
                <h2>Número de Telefone</h2>
				<div class="address-line">
                    <input type="tel" name="codigo_area" placeholder="Código de área">
					<input type="tel" name="telefone" placeholder="Número de Telefone">
                </div>                
            </div>

            <div class="form-section">
                <h2>Endereço</h2>
                <input type="text" name="endereco" placeholder="Endereço Principal">
                <input type="text" name="complemento" placeholder="Complemento">
                <div class="address-line">
                    <input type="text" name="cidade" placeholder="Cidade">
                    <input type="text" name="estado" placeholder="Estado">
                </div>
                <input type="text" name="cep" placeholder="Código Postal/CEP">
            </div>

            <input type="submit" name="enviar" value="Enviar">
        </form>
    </div>
</body>
</html>

<?php

if (isset($_POST['enviar'])) {

	// Coletando os dados do formulário
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$codigo_area = $_POST['codigo_area'];
	$telefone = $_POST['telefone'];
	$endereco = $_POST['endereco'];
	$complemento = $_POST['complemento'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$cep = $_POST['cep'];

	// Aqui você pode processar os dados como quiser:
	// - Salvar em um banco de dados
	// - Enviar por email
	// - Armazenar em um arquivo

	// Exemplo de exibição dos dados (apenas para teste)
	echo "<h1>Dados Recebidos</h1>";
	echo "<p><strong>Nome:</strong> $nome $sobrenome</p>";
	echo "<p><strong>E-mail:</strong> $email</p>";
	echo "<p><strong>Telefone:</strong> ($codigo_area) $telefone</p>";
	echo "<p><strong>Endereço:</strong> $endereco, $complemento</p>";
	echo "<p><strong>Cidade/Estado:</strong> $cidade/$estado</p>";
	echo "<p><strong>CEP:</strong> $cep</p>";

}

?>