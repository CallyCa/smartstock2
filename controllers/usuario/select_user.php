//validação de dados
<?php
session_start(); // inicia a sessão

// verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php'); // redireciona para o login se não estiver logado
    exit;
}

require_once "conecta.php"; //conexão // conecta.php???? o arquivo de coneção é o db_connect.php! Isso foi intencional? 

//consulta para selecionar todos os registros "Usuarios"
$query = "SELECT * FROM Usuarios";
$stmt = $pdo->prepare($query); // Mesma coisas com essa variavel pdo, a variavel pra acessar o banco de dados é a $db
$stmt->execute(); 

// loop para exibir cada registro
while ($result = $stmt->fetch()) { // busca cada linha do resultado
    // mostra os dados do registro
    echo 'ID: ' . htmlspecialchars($result['Id']) . '<br>'; // ID do usuário
    echo 'Nome: ' . htmlspecialchars($result['Nome']) . '<br>'; // nome do usuário
    echo 'Email: ' . htmlspecialchars($result['Email']) . '<br>'; // email do usuário
    echo 'Senha: ' . htmlspecialchars($result['Senha']) . '<br>'; // senha do usuário 
    echo '<hr>';
}
?>
