<?php
require_once "conecta.php"; //conexão

// verifica se o formulário foi enviado 
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // formulario para deletar um item do estoque
    echo '<form method="post" action="delete_estoque.php">
            ID do item a deletar: <input type="text" name="id"><br>
            <input type="submit" value="Deletar">
          </form>';
    exit; 
}

// pega o valor do ID para deletar
$id = $_POST["id"];

// coemça a consulta para deletar o registro com o ID fornecido
$query = "DELETE FROM Estoque_Caixas WHERE Id=:id";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

// finaliza a consulta de exclusão
$stmt->execute();

echo 'Registro deletado com sucesso!';
?>
