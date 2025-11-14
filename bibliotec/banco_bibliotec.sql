CREATE Database bibliotec;
use bibliotec;

CREATE TABLE USUARIO (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco VARCHAR(200),
    cpf VARCHAR(20)
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
