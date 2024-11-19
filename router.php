<?php
require_once __DIR__ . '/config/db_connect.php'; // Conecta ao banco de dados

// Define as rotas e os arquivos de destino
$routes = [
    '/' => '/public/index.php',
    '/estoque' => '/public/estoque.php',
    '/pedidos' => '/public/pedidos.php',
    '/cadastrar' => '/public/cadastrar_usuario.php',
    '/cadastrar_solicitacao' => '/public/cadastrar_solicitacao.php',

    // Rota para controllers de estoque
    '/estoque/atualizar' => '/controllers/estoque/atualiza_estoque.php',
    '/estoque/deletar' => '/controllers/estoque/delete_estoque.php',
    '/estoque/inserir' => '/controllers/estoque/insere_estoque.php',
    '/estoque/selecionar' => '/controllers/estoque/select_estoque.php',

    // Rota para controllers de solicitacao
    '/solicitacao/atualizar' => '/controllers/solicitacao/atualiza_solicitacao.php',
    '/solicitacao/deletar' => '/controllers/solicitacao/delete_solicitacao.php',
    '/solicitacao/inserir' => '/controllers/solicitacao/insere_solicitacao.php',
    '/solicitacao/selecionar' => '/controllers/solicitacao/select_solicitacao.php',

    // Rota para controllers de usuario
    '/usuario/atualizar' => '/controllers/usuario/atualiza_user.php',
    '/usuario/deletar' => '/controllers/usuario/delete_user.php',
    '/usuario/inserir' => '/controllers/usuario/insere_user.php',
    '/usuario/selecionar' => '/controllers/usuario/select_user.php',
];

// Obtém o caminho solicitado pelo usuário
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Verifica se o caminho solicitado é um arquivo de recurso estático (CSS, JS, PNG, etc.)
if (preg_match('/\.(?:css|js|png|jpg|jpeg|gif|ico)$/', $requestPath)) {
    return false; // Permite que o servidor sirva o arquivo diretamente
}

// Verifica se a rota existe no array de rotas
if (array_key_exists($requestPath, $routes)) {
    require_once __DIR__ . $routes[$requestPath];
} else {
    // Página não encontrada (404)
    http_response_code(404);
    echo "Página não encontrada: $requestPath.";
}
?>
