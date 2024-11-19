<?php
require_once "conecta.php"; //conexão

// verifica se o formulário de exclusão foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário de exclusão
    echo '<form method="post" action="delete_solicitacao.php">
            ID da Solicitação: <input type="text" name="id"><br>
            <input type="submit" value="Deletar Solicitação">
          </form>';
    exit;
}

// obtém o ID da solicitação a ser deletada
$id = $_POST["id"]; // pega o ID da solicitação

// começa e finaliza a consulta de exclusão
$query = "DELETE FROM Solicitacoes_Pedidos WHERE Id_Solicitacao=:id";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute(); // finaliza a consulta

echo 'Solicitação deletada com sucesso!';
?>
