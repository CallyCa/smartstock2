<?php
require_once __DIR__ . '/../config/db_connect.php'; // Inclui a conexão com o banco de dados

// Variável para armazenar a mensagem de status
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $nome = $_POST['login'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $data = $_POST['data'];

    // Verifica se o email já está cadastrado
    $checkQuery = "SELECT COUNT(*) FROM Usuarios WHERE Email = :email";
    $checkStmt = $pdo->prepare($checkQuery);
    $checkStmt->bindValue(':email', $email);
    $checkStmt->execute();
    $emailExists = $checkStmt->fetchColumn() > 0;

    if ($emailExists) {
        $message = 'Esse email já está cadastrado. Por favor, use um email diferente.';
    } else {
        // Insere o novo usuário
        $query = "INSERT INTO Usuarios (Nome, Email, Senha, Data) VALUES (:nome, :email, :senha, :data)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':data', $data);

        if ($stmt->execute()) {
            $message = 'Registro de usuário inserido com sucesso!';
            header("Location: cadastrar_solicitacao");
            exit;
        } else {
            $message = 'Erro ao inserir registro de usuário.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário - Smart Stock</title>
    <link rel="stylesheet" href="../styles/stylecadastro.css">
</head>
<body>
    <main class="container">
        <div class="form-wrapper">
            <h3>Cadastro de Usuário</h3>

            <!-- Exibe a mensagem de status, se existir -->
            <?php if ($message): ?>
                <div class="status-message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="post" action="" class="form">
                <label>Nome: <input type="text" name="login" required></label><br>
                <label>Email: <input type="email" name="email" required></label><br>
                <label>Senha: <input type="password" name="senha" required></label><br>
                <label>Data: <input type="date" name="data" required></label><br>
                <input type="submit" value="Cadastrar Usuário" class="submit-btn">
            </form>
        </div>

        <!-- Paginador para indicar as telas -->
        <div class="pagination">
            <div class="circle active"></div>
            <div class="circle"></div>
        </div>
    </main>
</body>
</html>
