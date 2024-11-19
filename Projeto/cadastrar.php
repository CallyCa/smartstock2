<?php
session_start(); // inicia a sessão

// verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php'); // redireciona para o login se não estiver logado
    exit; 
}

require_once "conecta.php"; // conexão

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // pega os dados do formulário
    $produto = $_POST["produto"];
    $quantidade_produto = $_POST["quantidade_produto"];
    // Continua pegando outros campos conforme necessário

    // começa e finalizaa consulta de inserção
    $query = "INSERT INTO Solicitacoes_Pedidos (Produto, Quantidade_Produto) VALUES (:produto, :quantidade_produto)";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':produto', $produto);
    $stmt->bindValue(':quantidade_produto', $quantidade_produto);

    if ($stmt->execute()) {
        echo 'Solicitação inserida com sucesso!';
    } else {
        echo 'Erro ao inserir solicitação.';
    }
} else {
    // mostra o formulário para inserção, caso necessário
}
?>


<?php
require_once "conecta.php";// conexão

// verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário caso não haja dados enviados
    echo '<form method="post" action="insere.php">
            Login: <input type="text" name="login"><br>
            Senha: <input type="password" name="senha"><br>
            Data: <input type="date" name="data"><br>
            <input type="submit" value="Cadastrar">
          </form>';
    exit;
}

// pega os dados enviados do formulário
$login = $_POST["login"]; // captura o login
$senha = md5($_POST["senha"]); // criptografa a senha para segurança
$data = $_POST["data"]; // captura a data

// começa e finaliza a consulta de inserção no banco de dados
$query = "INSERT INTO Usuarios (login, senha, data) VALUES (:login, :senha, :data)";
$stmt = $pdo->prepare($query); // começa a consulta
$stmt->bindValue(':login', $login); // vincula o valor do login
$stmt->bindValue(':senha', $senha); // vincula o valor da senha criptografada
$stmt->bindValue(':data', $data); // vincula o valor da data
$stmt->execute(); // finaliza a consulta

echo 'Registro inserido com sucesso!';
?>