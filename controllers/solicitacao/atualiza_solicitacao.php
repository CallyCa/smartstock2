<?php
require_once "conecta.php"; // Conexão

// verifica se o formulário de atualização foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário de atualização
    echo '<form method="post" action="atualiza_solicitacao.php">
            ID da Solicitação: <input type="text" name="id"><br>
            Novo Produto: <input type="text" name="produto"><br>
            Nova Quantidade do Produto: <input type="number" name="quantidade_produto"><br>
            Novo Tipo da Caixa: <input type="text" name="tipo_caixa"><br>
            Novo Tamanho da Caixa: <input type="text" name="tamanho_caixa"><br>
            Nova Quantidade da Caixa: <input type="number" name="quantidade_caixa"><br>
            Novo Status de Separação: <input type="text" name="status_separacao"><br>
            Novo Cliente: <input type="text" name="cliente"><br>
            Novo Prazo: <input type="date" name="prazo"><br>
            <input type="submit" value="Atualizar Solicitação">
          </form>';
    exit; // Encerra o script após exibir o formulário
}

// Obtém os dados do formulário de atualização
$id = $_POST["id"];
$produto = $_POST["produto"];
$quantidade_produto = $_POST["quantidade_produto"];
$tipo_caixa = $_POST["tipo_caixa"];
$tamanho_caixa = $_POST["tamanho_caixa"];
$quantidade_caixa = $_POST["quantidade_caixa"];
$status_separacao = $_POST["status_separacao"];
$cliente = $_POST["cliente"];
$prazo = $_POST["prazo"];

// começa e finaliza a consulta de atualização
$query = "UPDATE Solicitacoes_Pedidos SET Produto=:produto, Quantidade_Produto=:quantidade_produto, Tipo_caixa=:tipo_caixa, Tamanho_Caixa=:tamanho_caixa, Quantidade_Caixa=:quantidade_caixa, Status_Separacao=:status_separacao, Cliente=:cliente, Prazo=:prazo WHERE Id_Solicitacao=:id";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':produto', $produto);
$stmt->bindValue(':quantidade_produto', $quantidade_produto);
$stmt->bindValue(':tipo_caixa', $tipo_caixa);
$stmt->bindValue(':tamanho_caixa', $tamanho_caixa);
$stmt->bindValue(':quantidade_caixa', $quantidade_caixa);
$stmt->bindValue(':status_separacao', $status_separacao);
$stmt->bindValue(':cliente', $cliente);
$stmt->bindValue(':prazo', $prazo);
$stmt->execute(); // Finaliza a consulta

echo 'Solicitação atualizada com sucesso!';
?>
