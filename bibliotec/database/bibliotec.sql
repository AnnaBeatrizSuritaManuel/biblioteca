-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2025 às 21:54
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bibliotec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nacionalidade` varchar(50) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `autores`
--

INSERT INTO `autores` (`id_autor`, `nome`, `nacionalidade`, `biografia`, `data_nascimento`) VALUES
(2, 'afonso', 'brasileiro', '', '2025-11-17'),
(3, 'H.P Lovecraft', 'brasileiro', 'contandor de historias com foco em horror cosmico', '1890-07-20'),
(4, 'J.R.R. Tolkien', 'britânico', 'Escritor, professor e filólogo, criador do Senhor dos Anéis', '1892-01-03'),
(5, 'Stephen King', 'norte-americano', 'Mestre do terror e autor best-seller', '1947-09-21'),
(6, 'Douglas Adams', 'britânico', 'Escritor e humorista, criador da série O Guia do Mochileiro', '1952-03-11'),
(7, 'Thomas Harris', 'norte-americano', 'Escritor de thrillers e criador de Hannibal Lecter', '1940-09-22'),
(8, 'Jane Austen', 'britânica', 'Romancista clássica da literatura inglesa', '1775-12-16'),
(9, 'Frank Herbert', 'norte-americano', 'Escritor de ficção científica, autor de Duna', '1920-10-08'),
(10, 'Harper Lee', 'norte-americana', 'Romancista vencedora do Pulitzer por O Sol é para Todos', '1926-04-28'),
(11, 'Robert Louis Stevenson', 'britânico', 'Escritor escocês, autor de A Ilha do Tesouro', '1850-11-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_item` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 1,
  `data_adicionado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_livros`
--

CREATE TABLE `comentarios_livros` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `data_comentario` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_emprestimo` int(11) NOT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `data_entrega_prevista` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_devolucao_real` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_emprestimo`, `data_emprestimo`, `data_entrega_prevista`, `id_usuario`, `id_livro`, `data_devolucao_real`) VALUES
(1, NULL, '2025-11-23', 4, 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escrito`
--

CREATE TABLE `escrito` (
  `id_edicao` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `multiplos_autores` tinyint(1) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_favoritado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id_livro` int(11) NOT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `ano_publicado` int(11) DEFAULT NULL,
  `editora` varchar(100) DEFAULT NULL,
  `numero_paginas` int(11) DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id_livro`, `titulo`, `autor`, `genero`, `ano_publicado`, `editora`, `numero_paginas`, `imagem_url`) VALUES
(1, 'A Cor que Caiu do Espaço', 'H.P Lovecraft', 'Horror Cósmico', 1927, 'Editora Arkham', 150, 'url_imagem1.jpg'),
(2, 'O Chamado de Cthulhu', 'H.P Lovecraft', 'Horror Cósmico', 1928, 'Editora Miskatonic', 120, 'url_imagem2.jpg'),
(3, 'O Senhor dos Anéis: A Sociedade do Anel', 'J.R.R. Tolkien', 'fantasia', 1954, 'Martins Fontes', 423, NULL),
(4, 'It: A Coisa', 'Stephen King', 'terror', 1986, 'Suma', 1104, NULL),
(5, 'O Guia do Mochileiro das Galáxias', 'Douglas Adams', 'comedia', 1979, 'Arqueiro', 208, NULL),
(6, 'O Silêncio dos Inocentes', 'Thomas Harris', 'suspence', 1988, 'Record', 367, NULL),
(7, 'Orgulho e Preconceito', 'Jane Austen', 'romance', 1813, 'Martin Claret', 424, NULL),
(8, 'Duna', 'Frank Herbert', 'ficcao', 1965, 'Aleph', 680, NULL),
(9, 'O Sol é para Todos', 'Harper Lee', 'drama', 1960, 'José Olympio', 349, NULL),
(10, 'A Ilha do Tesouro', 'Robert Louis Stevenson', 'aventura', 1883, 'Penguin', 304, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_atividades`
--

CREATE TABLE `log_atividades` (
  `id_log` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acao` varchar(100) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `data_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('usuario','admin') DEFAULT 'usuario',
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `avatar_url` varchar(255) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `etec_estudante` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `cpf`, `senha`, `tipo`, `telefone`, `endereco`, `data_cadastro`, `avatar_url`, `biografia`, `etec_estudante`) VALUES
(1, 'Administrador', 'admin@bibliotec.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '(11) 9999-9999', NULL, '2025-11-19 00:59:07', NULL, '', 0),
(4, 'DAYANA ALMEIDA DE OLIVEIRA', 'angelo.ivon05@gmail.com', NULL, '$2y$10$v8xfZbwBtDwmWsPHqjYPROn9LKZRv2ouWM9BQ7PtyqtFEg28MEW8W', 'usuario', '11960377677', NULL, '2025-11-23 15:26:19', NULL, NULL, 0),
(5, 'angelo', 'angelo.ivon@gmail.com', NULL, '$2y$10$mBznoPpcNqfn9bFwj2lzV.q6O.xWWw2GqfumkmRzDMJhQ0GdcA0B.', 'usuario', '(11) 96037-7677', NULL, '2025-11-28 17:26:04', NULL, NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices para tabela `comentarios_livros`
--
ALTER TABLE `comentarios_livros`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices para tabela `escrito`
--
ALTER TABLE `escrito`
  ADD PRIMARY KEY (`id_edicao`),
  ADD KEY `id_livro` (`id_livro`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD UNIQUE KEY `unique_favorito` (`id_usuario`,`id_livro`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`);

--
-- Índices para tabela `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios_livros`
--
ALTER TABLE `comentarios_livros`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `escrito`
--
ALTER TABLE `escrito`
  MODIFY `id_edicao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `log_atividades`
--
ALTER TABLE `log_atividades`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Limitadores para a tabela `comentarios_livros`
--
ALTER TABLE `comentarios_livros`
  ADD CONSTRAINT `comentarios_livros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `comentarios_livros_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Limitadores para a tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Limitadores para a tabela `escrito`
--
ALTER TABLE `escrito`
  ADD CONSTRAINT `escrito_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`),
  ADD CONSTRAINT `escrito_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Limitadores para a tabela `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD CONSTRAINT `log_atividades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
