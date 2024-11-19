<?php
require_once "conecta.php"; //conexão

// começa a consulta para selecionar todos os registros
$query = "SELECT * FROM Estoque_Caixas";
$stmt = $pdo->prepare($query);
$stmt->execute(); 

//exibir todos os registros
while ($result = $stmt->fetch()) {
    echo 'ID: ' . htmlspecialchars($result['Id']) . '<br>';
    echo 'Tipo de Caixa: ' . htmlspecialchars($result['Tipo_Caixa']) . '<br>';
    echo 'Tamanho: ' . htmlspecialchars($result['Tamanho']) . '<br>';
    echo 'Quantidade: ' . htmlspecialchars($result['Quantidade']) . '<br>';
    echo 'Prateleira: ' . htmlspecialchars($result['Prateleira']) . '<br>';
    echo 'Parte da Prateleira: ' . htmlspecialchars($result['Parte_Prateleira']) . '<br><hr>';
}
?>
