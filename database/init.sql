CREATE DATABASE IF NOT EXISTS valorant_admin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE valorant_admin;

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

CREATE TABLE IF NOT EXISTS agentes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    funcao ENUM('Duelista', 'Sentinela', 'Controlador', 'Iniciador') NOT NULL,
    nacionalidade VARCHAR(100) NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS armas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    classe ENUM('Pistola', 'Submetralhadora', 'Fuzil', 'Escopeta', 'Precisao', 'Metralhadora') NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS ultimates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    agente_id BIGINT UNSIGNED NOT NULL,
    preco_orbes INT NOT NULL,
    descricao TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_ultimates_agente FOREIGN KEY (agente_id) REFERENCES agentes(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password, created_at, updated_at)
VALUES (
    'Administrador',
    'admin@valorant.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    NOW(),
    NOW()
);
