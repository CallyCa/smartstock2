<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Smart Stock</title>
    <link rel="stylesheet" href="../styles/stylecadastro.css">
</head>
<body>
    <main class="container">
        <?php
        require_once __DIR__ . '/../config/db_connect.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Verifica se todos os campos foram preenchidos
            if (
                isset($_POST["produto"], $_POST["quantidade_produto"], $_POST["tipo_caixa"], $_POST["tamanho_caixa"], 
                $_POST["quantidade_caixa"], $_POST["status_separacao"], $_POST["cliente"], $_POST["prazo"]) &&
                !empty($_POST["produto"]) && !empty($_POST["quantidade_produto"]) && !empty($_POST["tipo_caixa"]) && 
                !empty($_POST["tamanho_caixa"]) && !empty($_POST["quantidade_caixa"]) && !empty($_POST["status_separacao"]) && 
                !empty($_POST["cliente"]) && !empty($_POST["prazo"])
            ) {
                // Captura os dados do formulário
                $produto = $_POST["produto"];
                $quantidade_produto = (int) $_POST["quantidade_produto"];
                $tipo_caixa = $_POST["tipo_caixa"];
                $tamanho_caixa = $_POST["tamanho_caixa"];
                $quantidade_caixa = (int) $_POST["quantidade_caixa"];
                $status_separacao = $_POST["status_separacao"];
                $cliente = $_POST["cliente"];
                $prazo = $_POST["prazo"];

                // Insere os dados na tabela Solicitacoes_Pedidos
                $query = "INSERT INTO Solicitacoes_Pedidos (Produto, Quantidade_Produto, Tipo_caixa, Tamanho_Caixa, Quantidade_Caixa, Status_Separacao, Cliente, Prazo)
                          VALUES (:produto, :quantidade_produto, :tipo_caixa, :tamanho_caixa, :quantidade_caixa, :status_separacao, :cliente, :prazo)";
                $stmt = $pdo->prepare($query);
                $stmt->bindValue(':produto', $produto);
                $stmt->bindValue(':quantidade_produto', $quantidade_produto);
                $stmt->bindValue(':tipo_caixa', $tipo_caixa);
                $stmt->bindValue(':tamanho_caixa', $tamanho_caixa);
                $stmt->bindValue(':quantidade_caixa', $quantidade_caixa);
                $stmt->bindValue(':status_separacao', $status_separacao);
                $stmt->bindValue(':cliente', $cliente);
                $stmt->bindValue(':prazo', $prazo);

                echo $stmt->execute() ? 'Solicitação inserida com sucesso!' : 'Erro ao inserir solicitação.';
            } else {
                echo "Preencha todos os campos obrigatórios.";
            }
        } else {
            // Exibe o formulário
            echo '
            <div class="form-wrapper">
                <h3>Cadastro de Solicitação</h3>
                <form method="post" action="" class="form">
                    <label>Produto: <input type="text" name="produto" required></label><br>
                    <label>Quantidade do Produto: <input type="number" name="quantidade_produto" required></label><br>
                    <label>Tipo da Caixa: <input type="text" name="tipo_caixa" required></label><br>
                    <label>Tamanho da Caixa: <input type="text" name="tamanho_caixa" required></label><br>
                    <label>Quantidade de Caixas: <input type="number" name="quantidade_caixa" required></label><br>
                    <label>Status de Separação: <input type="text" name="status_separacao" required></label><br>
                    <label>Cliente: <input type="text" name="cliente" required></label><br>
                    <label>Prazo: <input type="date" name="prazo" required></label><br>
                    <input type="submit" value="Cadastrar Solicitação" class="submit-btn">
                </form>
            </div>';
        }
        ?>
    </main>
</body>
</html>
