CREATE Database bibliotec;
use bibliotec;

CREATE TABLE USUARIO (
    id_usuario     INT PRIMARY KEY AUTO_INCREMENT,
    nome           VARCHAR(100),
    email          VARCHAR(100),
    cpf            VARCHAR(20),
    senha          VARCHAR(255) NOT NULL,
    tipo           ENUM('usuario', 'admin') DEFAULT 'usuario',
    telefone       VARCHAR(20),
    endereco       TEXT,
    data_cadastro  DATETIME DEFAULT CURRENT_TIMESTAMP,
    avatar_url     VARCHAR(255),
    biografia      TEXT
);


CREATE TABLE AUTORES 
( 
    id_autor INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    nacionalidade VARCHAR(50),
    biografia TEXT,
    data_nascimento DATE
); 

CREATE TABLE LIVROS 
( 
    id_livro INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200),
    genero VARCHAR(50),
    ano_publicado INT,
    editora VARCHAR(100),
    numero_paginas INT
); 

CREATE TABLE EMPRESTIMO 
( 
    id_emprestimo INT PRIMARY KEY AUTO_INCREMENT,
    data_emprestimo DATE,
    data_entrega_prevista DATE,
    id_usuario INT,
    id_livro INT,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro)
); 


CREATE TABLE ESCRITO 
( 
    id_edicao INT PRIMARY KEY AUTO_INCREMENT,
    categoria VARCHAR(100),
    multiplos_autores BOOLEAN,
    id_livro INT,
    id_autor INT,
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro),
    FOREIGN KEY (id_autor) REFERENCES AUTORES(id_autor)
); 

CREATE TABLE favoritos (
    id_favorito INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_livro INT,
    data_favoritado DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro),
    UNIQUE KEY unique_favorito (id_usuario, id_livro)
);

CREATE TABLE carrinho (
    id_item INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    id_livro INT,
    quantidade INT DEFAULT 1,
    data_adicionado DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES USUARIO(id_usuario),
    FOREIGN KEY (id_livro) REFERENCES LIVROS(id_livro)
);

INSERT INTO USUARIO (nome, email, senha, tipo, telefone) VALUES 
('Administrador', 'admin@bibliotec.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '(11) 9999-9999');