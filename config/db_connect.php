<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'smartstock2'); // Nome do banco de dados
define('DB_USER', 'root');        // Usuário
define('DB_PASS', 'password');    // Senha

try {
    // Conexão inicial sem especificar o banco de dados para criar o banco, se necessário
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criação do banco de dados caso ele não exista
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    
    // Conecta ao banco de dados específico após garantir que ele existe
    $pdo->exec("USE " . DB_NAME);

} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
    exit();
}
