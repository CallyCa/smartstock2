<?php
require_once "conecta.php"; //  conexão

// verific se o formulário foi enviado 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // formulario de entrada para inserir novos itens no estoque
    echo '<form method="post" action="insere_estoque.php">
            Tipo da Caixa: <input type="text" name="tipo_caixa"><br>
            Tamanho: <input type="text" name="tamanho"><br>
            Quantidade: <input type="number" name="quantidade"><br>
            Prateleira: <input type="text" name="prateleira"><br>
            Parte Prateleira: <input type="text" name="parte_prateleira"><br>
            <input type="submit" value="Cadastrar">
          </form>';
    exit; 
}

// pega os valores do formulário
$tipo_caixa = $_POST["tipo_caixa"];
$tamanho = $_POST["tamanho"];
$quantidade = $_POST["quantidade"];
$prateleira = $_POST["prateleira"];
$parte_prateleira = $_POST["parte_prateleira"];

// começa a consulta de inserção
$query = "INSERT INTO Estoque_Caixas (Tipo_Caixa, Tamanho, Quantidade, Prateleira, Parte_Prateleira) 
          VALUES (:tipo_caixa, :tamanho, :quantidade, :prateleira, :parte_prateleira)";
$stmt = $pdo->prepare($query);

// associa os valores aos parâmetros da consulta
$stmt->bindValue(':tipo_caixa', $tipo_caixa);
$stmt->bindValue(':tamanho', $tamanho);
$stmt->bindValue(':quantidade', $quantidade);
$stmt->bindValue(':prateleira', $prateleira);
$stmt->bindValue(':parte_prateleira', $parte_prateleira);

$stmt->execute();

echo 'Registro inserido com sucesso!';
?>
