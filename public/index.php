<?php
include_once __DIR__ . '/../config/db_connect.php';

session_start(); // Inicia a sessão no início

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];

    if (!$email) {
        $erro = "Preencha um e-mail válido";
    } elseif (empty($senha)) {
        $erro = "Preencha sua senha";
    } else {
        // Consulta para verificar o usuário
        $sql_code = "SELECT * FROM Usuarios WHERE Email = :email";
        $stmt = $pdo->prepare($sql_code);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $usuario['Senha'])) {
                $_SESSION['user'] = $usuario['Nome'];
                header("Location: /estoque"); // Redireciona para a página de estoque
                exit;
            } else {
                $erro = "Falha ao logar! Email ou senha incorretos";
            }
        } else {
            $erro = "Falha ao logar! Email ou senha incorretos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Smart Stock</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <main class="container">
        <div class="container-left">
            <div class="logo">
                <img src="../assets/imagens/Logo-Login.png" alt="Logo Login" />
            </div>
            <div class="login">
                <h1 class="login-title">Login</h1>
                <?php if (isset($erro)): ?>
                    <p class="error-message"><?php echo $erro; ?></p>
                <?php endif; ?>
                <form action="" class="login-form" method="POST">
                    <input name="email" type="text" placeholder="E-mail" required />
                    <input name="senha" type="password" placeholder="Senha" required />
                    <a href="#">Esqueceu a Senha</a>
                    <div class="login-actions">
                        <button type="submit" name="login">Entrar</button>
                        <a href="/cadastrar" class="btn-link">Cadastrar</a> <!-- Link de cadastro correto -->
                    </div>
                </form>
            </div>
        </div>
        <div class="container-right">
            <img src="../assets/imagens/Caixa-login.png" alt="Caixa login" />
        </div>
    </main>
</body>
</html>
