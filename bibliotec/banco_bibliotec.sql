CREATE DATABASE bibliotec;
USE bibliotec;

-- Usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    localizacao VARCHAR(100),
    biografia TEXT,
    tipo ENUM('admin','usuario') DEFAULT 'usuario',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    cor_primaria VARCHAR(7),
    cor_secundaria VARCHAR(7)
);

-- Livros
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    descricao TEXT,
    imagem_capa VARCHAR(255),
    categoria_id INT,
    preco DECIMAL(10,2),
    ano_publicacao INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Livros lidos
CREATE TABLE livros_lidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    livro_id INT,
    data_leitura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avaliacao INT CHECK (avaliacao >= 1 AND avaliacao <= 5),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

-- Criar administrador
INSERT INTO usuarios (nome, email, senha, tipo)
VALUES ('Administrador', 'admin@bibliotec.com', MD5('1234'), 'admin');
