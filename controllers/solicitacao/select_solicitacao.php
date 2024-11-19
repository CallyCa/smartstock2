<?php
require_once "conecta.php"; // conexão

// consulta para selecionar todas as solicitações
$query = "SELECT * FROM Solicitacoes_Pedidos";
$stmt = $pdo->prepare($query);
$stmt->execute(); // finaliza a consulta

// loop para exibir cada solicitação
while ($result = $stmt->fetch()) {
    //mostra os dados da solicitação
    echo 'ID: ' . htmlspecialchars($result['Id_Solicitacao']) . '<br>';
    echo 'Produto: ' . htmlspecialchars($result['Produto']) . '<br>';
    echo 'Quantidade do Produto: ' . htmlspecialchars($result['Quantidade_Produto']) . '<br>';
    echo 'Tipo da Caixa: ' . htmlspecialchars($result['Tipo_caixa']) . '<br>';
    echo 'Tamanho da Caixa: ' . htmlspecialchars($result['Tamanho_Caixa']) . '<br>';
    echo 'Quantidade da Caixa: ' . htmlspecialchars($result['Quantidade_Caixa']) . '<br>';
    echo 'Status de Separação: ' . htmlspecialchars($result['Status_Separacao']) . '<br>';
    echo 'Cliente: ' . htmlspecialchars($result['Cliente']) . '<br>';
    echo 'Prazo: ' . htmlspecialchars($result['Prazo']) . '<br><hr>';
}
?>
