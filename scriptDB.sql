CREATE DATABASE IF NOT EXISTS sistema_vagas DEFAULT CHARACTER
SET
    utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sistema_vagas;

DROP TABLE IF EXISTS candidaturas;

DROP TABLE IF EXISTS vagas;

DROP TABLE IF EXISTS usuarios;

DROP TABLE IF EXISTS categorias;

DROP TABLE IF EXISTS administradores;

CREATE TABLE
    `administradores` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Deve ser sempre armazenada com hash (password_hash)',
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    `categorias` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `nome` (`nome`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    `usuarios` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Deve ser sempre armazenada com hash',
        `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Caminho para o arquivo da foto de perfil',
        `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    `vagas` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `id_categoria` int (11) NOT NULL,
        `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
        `empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `localizacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `salario` decimal(10, 2) DEFAULT NULL,
        `contato_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `imagem_empresa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Caminho para a imagem da vaga/empresa',
        `status` tinyint (1) NOT NULL DEFAULT 1 COMMENT '1 = Ativa, 0 = Desativada',
        `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
        `num_candidatos` int (11) DEFAULT 0 COMMENT 'Contador de candidaturas para esta vaga',
        PRIMARY KEY (`id`),
        KEY `id_categoria` (`id_categoria`),
        CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    `candidaturas` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `id_vaga` int (11) NOT NULL,
        `id_usuario` int (11) NOT NULL,
        `data_candidatura` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `vaga_usuario_unica` (`id_vaga`, `id_usuario`) COMMENT 'Impede que um usuário se candidate à mesma vaga mais de uma vez',
        KEY `id_usuario` (`id_usuario`),
        CONSTRAINT `candidaturas_ibfk_1` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`) ON DELETE CASCADE,
        CONSTRAINT `candidaturas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;