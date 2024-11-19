<?php
require_once "conecta.php"; // Conexão

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // formulario para atualizar itens no estoque
    echo '<form method="post" action="atualiza_estoque.php">
            ID do item: <input type="text" name="id"><br>
            Novo Tipo de Caixa: <input type="text" name="tipo_caixa"><br>
            Novo Tamanho: <input type="text" name="tamanho"><br>
            Nova Quantidade: <input type="number" name="quantidade"><br>
            Nova Prateleira: <input type="text" name="prateleira"><br>
            Nova Parte da Prateleira: <input type="text" name="parte_prateleira"><br>
            <input type="submit" value="Atualizar">
          </form>';
    exit; 
}

// captura os valores do formulário
$id = $_POST["id"];
$tipo_caixa = $_POST["tipo_caixa"];
$tamanho = $_POST["tamanho"];
$quantidade = $_POST["quantidade"];
$prateleira = $_POST["prateleira"];
$parte_prateleira = $_POST["parte_prateleira"];

// consulta de atualização
$query = "UPDATE Estoque_Caixas 
          SET Tipo_Caixa=:tipo_caixa, Tamanho=:tamanho, Quantidade=:quantidade, Prateleira=:prateleira, Parte_Prateleira=:parte_prateleira 
          WHERE Id=:id";
$stmt = $pdo->prepare($query);

// associa os valores da consulta
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':tipo_caixa', $tipo_caixa);
$stmt->bindValue(':tamanho', $tamanho);
$stmt->bindValue(':quantidade', $quantidade);
$stmt->bindValue(':prateleira', $prateleira);
$stmt->bindValue(':parte_prateleira', $parte_prateleira);

// finaliza a consulta e atualiza o registro
$stmt->execute();

echo 'Registro atualizado com sucesso!';
?>
