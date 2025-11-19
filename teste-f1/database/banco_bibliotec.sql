CREATE DATABASE IF NOT EXISTS bibliotec
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE bibliotec;

-- ============================
-- TABELA USUARIO
-- ============================
CREATE TABLE USUARIO (
    id_usuario     INT PRIMARY KEY AUTO_INCREMENT,
    nome           VARCHAR(100) NOT NULL,
    email          VARCHAR(100) NOT NULL UNIQUE,
    cpf            VARCHAR(20),
    senha          VARCHAR(255) NOT NULL,
    tipo           ENUM('usuario', 'admin') DEFAULT 'usuario',
    telefone       VARCHAR(20),
    endereco       TEXT,
    data_cadastro  DATETIME DEFAULT CURRENT_TIMESTAMP,
    avatar_url     VARCHAR(255),
    biografia      TEXT
);

-- ============================
-- TABELA AUTORES
-- ============================
CREATE TABLE AUTORES (
    id_autor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50),
    biografia TEXT,
    data_nascimento DATE
);

-- ============================
-- TABELA LIVROS
-- ============================
CREATE TABLE LIVROS (
    id_livro INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    genero VARCHAR(50),
    ano_publicado INT,
    editora VARCHAR(100),
    numero_paginas INT
);

-- ============================
-- TABELA EMPRESTIMO
-- ============================
CREATE TABLE EMPRESTIMO (
    id_emprestimo INT PRIMARY KEY AUTO_INCREMENT,
    data_emprestimo DATE NOT NULL,
    data_entrega_prevista DATE NOT NULL,
    id_usuario INT NOT NULL,
    id_livro INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro) ON DELETE CASCADE
);

-- ============================
-- TABELA ESCRITO (LIVRO–AUTOR)
-- ============================
CREATE TABLE ESCRITO (
    id_edicao INT PRIMARY KEY AUTO_INCREMENT,
    categoria VARCHAR(100),
    multiplos_autores BOOLEAN DEFAULT 0,
    id_livro INT NOT NULL,
    id_autor INT NOT NULL,
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro) ON DELETE CASCADE,
    FOREIGN KEY (id_autor) REFERENCES AUTORES(id_autor) ON DELETE CASCADE
);

-- ============================
-- TABELA FAVORITOS
-- ============================

CREATE TABLE LIVROS (
    id_livro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100) NOT NULL,
    ano_publicacao INT,
    quantidade INT DEFAULT 1,
    cor VARCHAR(20) DEFAULT '#000000'
);

-- ============================
-- TABELA CARRINHO
-- ============================
CREATE TABLE carrinho (
    id_item INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_livro INT NOT NULL,
    quantidade INT DEFAULT 1,
    data_adicionado DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro) ON DELETE CASCADE
);

-- ============================
-- ADMIN COM SENHA BCRYPT
-- senha original: "123"
-- ============================
INSERT INTO USUARIO (nome, email, senha, tipo, telefone)
VALUES (
    'Admin',
    'admin@bibliotec.com',
    '$2y$10$eBqBvYlCYwH30BJsSLtCeOZqBfcz9XoLrZyl7Xz0h1cItgkfrh0hK',
    'admin',
    '(11) 9999-9999'
);
