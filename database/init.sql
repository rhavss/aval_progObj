-- banco de dados do painel valorant
-- esse arquivo cria o banco e as tabelas usadas no projeto
-- e ja deixa um usuario admin cadastrado pra poder testar o login

CREATE DATABASE IF NOT EXISTS valorant_admin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE valorant_admin;

-- tabela de usuarios (login do painel)
-- segue o padrao que o laravel ja espera (name, email, password)
CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- tabela de agentes
CREATE TABLE IF NOT EXISTS agentes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    funcao ENUM('Duelista', 'Sentinela', 'Controlador', 'Iniciador') NOT NULL,
    nacionalidade VARCHAR(100) NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- tabela de armas
CREATE TABLE IF NOT EXISTS armas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    classe ENUM('Pistola', 'Submetralhadora', 'Fuzil', 'Escopeta', 'Precisao', 'Metralhadora') NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- tabela de ultimates
-- cada ultimate pertence a um agente (chave estrangeira)
CREATE TABLE IF NOT EXISTS ultimates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    agente_id BIGINT UNSIGNED NOT NULL,
    preco_orbes INT NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_ultimates_agente FOREIGN KEY (agente_id) REFERENCES agentes(id) ON DELETE CASCADE
);

-- usuario admin pra testar o login
-- email: admin@valorant.com
-- senha: 123456
-- (a senha ja esta criptografada com bcrypt, igual o laravel faz)
INSERT INTO users (name, email, password, created_at, updated_at)
VALUES (
    'Administrador',
    'admin@valorant.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    NOW(),
    NOW()
);

-- alguns agentes ja cadastrados pra nao deixar o painel vazio
INSERT INTO agentes (nome, funcao, nacionalidade, descricao, created_at, updated_at) VALUES
('Jett', 'Duelista', 'Coreia do Sul', 'Jett se movimenta pelo campo de batalha com agilidade que ninguem mais tem.', NOW(), NOW()),
('Sage', 'Sentinela', 'China', 'Sage cria seguranca pra ela e pro time, podendo curar e ressuscitar aliados.', NOW(), NOW()),
('Omen', 'Controlador', 'Desconhecida', 'Omen cria as sombras que ele mesmo teme, caçando os inimigos de dentro da escuridao.', NOW(), NOW()),
('Sova', 'Iniciador', 'Russia', 'Sova rastreia, encontra e elimina os inimigos com seu arco e suas flechas de reconhecimento.', NOW(), NOW());

-- algumas armas ja cadastradas
INSERT INTO armas (nome, classe, preco, created_at, updated_at) VALUES
('Classic', 'Pistola', 0.00, NOW(), NOW()),
('Vandal', 'Fuzil', 2900.00, NOW(), NOW()),
('Phantom', 'Fuzil', 2900.00, NOW(), NOW()),
('Operator', 'Precisao', 4700.00, NOW(), NOW()),
('Spectre', 'Submetralhadora', 1600.00, NOW(), NOW());

-- algumas ultimates ja cadastradas, ligadas aos agentes acima
INSERT INTO ultimates (agente_id, preco_orbes, descricao, created_at, updated_at) VALUES
(1, 6, 'Bladestorm: Jett invoca um conjunto de adagas que causam morte instantanea.', NOW(), NOW()),
(2, 8, 'Ressuscitar: Sage traz um aliado morto de volta a vida, com vida plena.', NOW(), NOW()),
(3, 8, 'De Dentro das Sombras: Omen se teleporta pra qualquer lugar do mapa que ele ja tenha visto.', NOW(), NOW()),
(4, 8, 'Fúria Implacavel: Sova solta tres flechas explosivas no ar que cobrem uma area enorme.', NOW(), NOW());
