-- Remover tabelas existentes
DROP TABLE IF EXISTS Resumo_Pedidos;
DROP TABLE IF EXISTS RegistrosLogin;
DROP TABLE IF EXISTS Estoque_Caixas;
DROP TABLE IF EXISTS Solicitacoes_Pedidos;
DROP TABLE IF EXISTS Usuarios;

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS smartstock2;
USE smartstock2;

-- Tabela Usuarios
CREATE TABLE IF NOT EXISTS Usuarios (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    Data DATE DEFAULT NULL
);

-- Inserção de registros iniciais em Usuarios
INSERT INTO Usuarios (Nome, Email, Senha) 
VALUES 
    ('Clarice', 'clariice@gmail.com', 'senha1'),
    ('Carmen', 'carmeen@outlook.com', 'senha2'),
    ('Carlos', 'carlos@gmail.com', 'senha3')
ON DUPLICATE KEY UPDATE Nome = VALUES(Nome);

-- Tabela Solicitacoes_Pedidos
CREATE TABLE IF NOT EXISTS Solicitacoes_Pedidos (
    Id_Solicitacao INT AUTO_INCREMENT PRIMARY KEY,
    Id_Usuario INT,
    Produto VARCHAR(100) NOT NULL,
    Quantidade_Produto INT NOT NULL,
    Tipo_caixa VARCHAR(100) NOT NULL,
    Tamanho_Caixa VARCHAR(100) NOT NULL,
    Quantidade_Caixa INT NOT NULL,
    Status_Separacao VARCHAR(100) NOT NULL,
    Cliente VARCHAR(100) NOT NULL,
    Prazo DATE NOT NULL,
    FOREIGN KEY (Id_Usuario) REFERENCES Usuarios(Id) ON DELETE CASCADE
);

-- Inserção de registros iniciais em Solicitacoes_Pedidos
INSERT INTO Solicitacoes_Pedidos (Id_Usuario, Produto, Quantidade_Produto, Tipo_caixa, Tamanho_Caixa, Quantidade_Caixa, Status_Separacao, Cliente, Prazo)
VALUES 
    ((SELECT Id FROM Usuarios WHERE Nome = 'Clarice'), 'Vidros', 10, 'Papelão', 'G', 15, 'Em andamento', 'Transp. EUA', '2024-11-15'),
    ((SELECT Id FROM Usuarios WHERE Nome = 'Carmen'), 'Garrafa', 15, 'Papelão', 'Média', 20, 'Em andamento', 'Transportadora', '2024-12-12'),
    ((SELECT Id FROM Usuarios WHERE Nome = 'Carlos'), 'Caixa de Plástico', 5, 'Plástico', 'Pequena', 10, 'Entregue', 'Cliente XYZ', '2024-11-30');

-- Tabela Estoque_Caixas
CREATE TABLE IF NOT EXISTS Estoque_Caixas (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Tipo_Caixa VARCHAR(100) NOT NULL,
    Tamanho VARCHAR(100) NOT NULL,
    Quantidade INT NOT NULL,
    Prateleira CHAR(3) NOT NULL,
    Parte_Prateleira CHAR(4) NOT NULL
);

-- Inserção de registros iniciais em Estoque_Caixas
INSERT INTO Estoque_Caixas (Tipo_Caixa, Tamanho, Quantidade, Prateleira, Parte_Prateleira)
VALUES 
    ('Caixa de Papelão', 'Pequena', 3, 'PT1', 'A'), 
    ('Caixa de Plástico', 'Média', 4, 'PT2', 'B');

-- Tabela RegistrosLogin
CREATE TABLE IF NOT EXISTS RegistrosLogin (
    UsuarioId INT,
    Transportadora VARCHAR(100) NOT NULL,
    DataHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    IpAddress VARCHAR(45) NOT NULL,
    FOREIGN KEY (UsuarioId) REFERENCES Usuarios(Id)
);

-- Tabela Resumo_Pedidos
CREATE TABLE IF NOT EXISTS Resumo_Pedidos (
    Total_Pedidos_Abertos INT NOT NULL,
    Total_Pedidos_Concluidos INT NOT NULL,
    DataAtualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Inserção inicial de dados em Resumo_Pedidos
INSERT INTO Resumo_Pedidos (Total_Pedidos_Abertos, Total_Pedidos_Concluidos)
SELECT
    SUM(CASE WHEN Status_Separacao IN ('Em andamento') THEN 1 ELSE 0 END) AS Total_Abertos,
    SUM(CASE WHEN Status_Separacao = 'Entregue' THEN 1 ELSE 0 END) AS Total_Concluidos
FROM Solicitacoes_Pedidos
ON DUPLICATE KEY UPDATE
    Total_Pedidos_Abertos = VALUES(Total_Pedidos_Abertos),
    Total_Pedidos_Concluidos = VALUES(Total_Pedidos_Concluidos);
