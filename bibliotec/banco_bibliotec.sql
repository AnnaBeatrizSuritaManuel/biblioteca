-- banco_bibliotec.sql
CREATE DATABASE bibliotec;
USE bibliotec;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    localizacao VARCHAR(100),
    biografia TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao TEXT,
    cor_primaria VARCHAR(7),
    cor_secundaria VARCHAR(7)
);

-- Tabela de livros
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

-- Tabela de livros lidos pelos usuários
CREATE TABLE livros_lidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    livro_id INT,
    data_leitura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avaliacao INT CHECK (avaliacao >= 1 AND avaliacao <= 5),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

-- Inserir categorias
INSERT INTO categorias (nome, descricao, cor_primaria, cor_secundaria) VALUES
('Terror', 'Livros que provocam medo e suspense', '#2C3E50', '#34495E'),
('Suspense', 'Narrativas cheias de tensão e mistério', '#2C3E50', '#34495E'),
('Fantasia', 'Mundos mágicos e aventuras épicas', '#2C3E50', '#34495E');

-- Inserir alguns livros de exemplo
INSERT INTO livros (titulo, autor, descricao, imagem_capa, categoria_id, preco, ano_publicacao) VALUES
('O Exorcista', 'William Peter Blatty', 'Inspirado em um caso real, o livro conta a história de uma menina possuída por uma entidade demoníaca.', 'img/o_exorcista.jpg', 1, 39.90, 1971),
('It: A Coisa', 'Stephen King', 'Uma história que alterna entre passado e presente, acompanhando um grupo de amigos que enfrenta uma entidade maléfica.', 'img/it_a_coisa.jpg', 1, 49.90, 1986),
('A Garota no Trem', 'Paula Hawkins', 'Rachel pega o trem todos os dias passando por casas e observa um casal aparentemente perfeito.', 'img/a_garota_no_trem.jpg', 2, 34.90, 2015),
('O Senhor dos Anéis', 'J.R.R. Tolkien', 'Uma das obras mais influentes da fantasia. Conta a jornada de Frodo Bolseiro para destruir o Um Anel.', 'img/senhor_dos_aneis.jpg', 3, 59.90, 1954);