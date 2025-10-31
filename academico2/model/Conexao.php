<?php

function getConexao()
{
    try {        
        $pdo = new PDO('mysql:host=localhost;dbname=academico', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('<div class="alert alert-danger">Erro ao conectar ao banco de dados: ' . $e->getMessage() . '</div>');
    }
}
?>