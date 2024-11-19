//validação
<?php
session_start(); // inicia a sessão

// verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php'); // redireciona para o login se não estiver logado
    exit; // encerra o script
}

require_once "conecta.php"; // conexão

// verifica se o formulário de atualização foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // mostra o formulário de atualização
    echo '<form method="post" action="atualiza.php">
            ID do usuário: <input type="text" name="id"><br>
            Novo Login: <input type="text" name="login"><br>
            Nova Senha: <input type="password" name="senha"><br>
            Nova Data: <input type="date" name="data"><br>
            <input type="submit" value="Atualizar">
          </form>';
    exit; // finaliza o script após mostrar o formulário
}

// obtem dados do formulário de atualização
$id = $_POST["id"]; // captura o ID do usuário que vai ser atualizado
$login = $_POST["login"]; // captura o novo login
$senha = md5($_POST["senha"]); // criptografa a nova senha
$data = $_POST["data"]; // captura a nova data

// começa e finaliza a consulta de atualização no banco de dados
$query = "UPDATE Usuarios SET login=:login, senha=:senha, data=:data WHERE Id=:id";
$stmt = $pdo->prepare($query); // prepara a consulta
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // vinculka o ID do usuário
$stmt->bindValue(':login', $login); // vincula o novo login
$stmt->bindValue(':senha', $senha); // vincula a nova senha criptografada
$stmt->bindValue(':data', $data); // vincula a nova data
$stmt->execute(); // finaliza a consulta


echo 'Registro atualizado com sucesso!';
?>
