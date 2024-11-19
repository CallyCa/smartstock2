//validação de dados
<?php
session_start(); // inicia a sessão

// verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php'); // redirecionaa para o login se não estiver logado
    exit; 
}


require_once "conecta.php"; //conexão

// verifica se o formulário de exclusão foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário de exclusão
    echo '<form method="post" action="delete.php">
            ID do usuário: <input type="text" name="id"><br>
            <input type="submit" value="Deletar">
          </form>';
    exit; 
}

// pega o ID do usuário a ser deletado
$id = $_POST["id"]; // pega o ID do usuário

// começa e finaliza a consulta de exclusão no banco de dados
$query = "DELETE FROM Usuarios WHERE Id=:id";
$stmt = $pdo->prepare($query); // começa a consulta
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // vincula o ID do usuário
$stmt->execute(); 

echo 'Registro deletado com sucesso!';
?>
