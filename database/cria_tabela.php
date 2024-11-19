<?php
require_once __DIR__ . '/../config/db_connect.php';

try {
    // Lê o arquivo SQL
    $sql = file_get_contents(__DIR__ . '/database.sql');
    
    // Executa o script SQL
    $pdo->exec($sql);
    
    echo "Tabelas criadas e dados inseridos com sucesso!";
} catch (PDOException $e) {
    die('Erro ao criar tabelas ou inserir dados: ' . $e->getMessage());
} finally {
    $pdo = null;
}
?>
