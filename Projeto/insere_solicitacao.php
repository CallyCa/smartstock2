<?php
require_once "conecta.php"; // coenxão

// veririfica se o formulário de inserção foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário de inserção
    echo '<form method="post" action="insere_solicitacao.php">
            Produto: <input type="text" name="produto"><br>
            Quantidade do Produto: <input type="number" name="quantidade_produto"><br>
            Tipo da Caixa: <input type="text" name="tipo_caixa"><br>
            Tamanho da Caixa: <input type="text" name="tamanho_caixa"><br>
            Quantidade da Caixa: <input type="number" name="quantidade_caixa"><br>
            Status de Separação: <input type="text" name="status_separacao"><br>
            Cliente: <input type="text" name="cliente"><br>
            Prazo: <input type="date" name="prazo"><br>
            <input type="submit" value="Cadastrar Solicitação">
          </form>';
    exit; 
}

// pega os dados enviados do formulário
$produto = $_POST["produto"];
$quantidade_produto = $_POST["quantidade_produto"];
$tipo_caixa = $_POST["tipo_caixa"];
$tamanho_caixa = $_POST["tamanho_caixa"];
$quantidade_caixa = $_POST["quantidade_caixa"];
$status_separacao = $_POST["status_separacao"];
$cliente = $_POST["cliente"];
$prazo = $_POST["prazo"];

// começa e finaliza a consulta de inserção
$query = "INSERT INTO Solicitacoes_Pedidos (Produto, Quantidade_Produto, Tipo_caixa, Tamanho_Caixa, Quantidade_Caixa, Status_Separacao, Cliente, Prazo) VALUES (:produto, :quantidade_produto, :tipo_caixa, :tamanho_caixa, :quantidade_caixa, :status_separacao, :cliente, :prazo)";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':produto', $produto);
$stmt->bindValue(':quantidade_produto', $quantidade_produto);
$stmt->bindValue(':tipo_caixa', $tipo_caixa);
$stmt->bindValue(':tamanho_caixa', $tamanho_caixa);
$stmt->bindValue(':quantidade_caixa', $quantidade_caixa);
$stmt->bindValue(':status_separacao', $status_separacao);
$stmt->bindValue(':cliente', $cliente);
$stmt->bindValue(':prazo', $prazo);
$stmt->execute(); 

echo 'Solicitação cadastrada com sucesso!';
?>
