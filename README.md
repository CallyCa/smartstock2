## Estrutura de Pastas

```plaintext
.
├── assets
│   ├── imagens
│   │   ├── Caixa-login.png
│   │   └── Logo-Login.png
│   └── js
├── config
│   └── db_connect.php
├── controllers
│   ├── estoque
│   │   ├── atualiza_estoque.php
│   │   ├── delete_estoque.php
│   │   ├── insere_estoque.php
│   │   └── select_estoque.php
│   ├── solicitacao
│   │   ├── atualiza_solicitacao.php
│   │   ├── delete_solicitacao.php
│   │   ├── insere_solicitacao.php
│   │   └── select_solicitacao.php
│   └── usuario
│       ├── atualiza_user.php
│       ├── delete_user.php
│       ├── insere_user.php
│       └── select_user.php
├── database
│   ├── cria_tabela.php
│   └── database.sql
├── logs
│   ├── replit_zip_error_log (1).txt
│   └── replit_zip_error_log.txt
├── public
│   ├── cadastrar_solicitacao.php
│   ├── cadastrar_usuario.php
│   ├── estoque.php
│   ├── index.php
│   └── pedidos.php
├── replit
│   └── replit.nix
├── router.php
├── README.md
└── styles
    ├── stylecadastro.css
    ├── style.css
    ├── styleestoque.css
    └── stylepedidos.css
```

## Instalação e Configuração

1. No seu ambiente local.
   ```bash
   cd smartstock2
   ```
2.  Inicie o Banco de Dados.
   ```bash
    php database/cria_tabela.php
   ```

3. Navegue até a pasta raiz do projeto e inicie o servidor PHP.
   ```bash
   php -S localhost:8000 router.php
   ```

3. Abra o navegador e acesse o endereço:
   ```
   http://localhost:8000
   ```