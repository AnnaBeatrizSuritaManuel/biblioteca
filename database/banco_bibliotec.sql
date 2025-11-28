-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2025 às 03:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

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
-- Estrutura para tabela `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nacionalidade` varchar(50) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autores`
--

INSERT INTO `autores` (`id_autor`, `nome`, `nacionalidade`, `biografia`, `data_nascimento`) VALUES
(2, 'afonso', 'brasileiro', '', '2025-11-17'),
(3, 'H.P Lovecraft', 'brasileiro', 'contandor de historias com foco em horror cosmico', '1890-07-20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_item` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 1,
  `data_adicionado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios_livros`
--

CREATE TABLE `comentarios_livros` (
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `data_comentario` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_emprestimo` int(11) NOT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `data_entrega_prevista` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_devolucao_real` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_emprestimo`, `data_emprestimo`, `data_entrega_prevista`, `id_usuario`, `id_livro`, `data_devolucao_real`) VALUES
(1, NULL, '2025-11-23', 4, 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `escrito`
--

CREATE TABLE `escrito` (
  `id_edicao` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `multiplos_autores` tinyint(1) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_livro` int(11) DEFAULT NULL,
  `data_favoritado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id_livro`, `titulo`, `autor`, `genero`, `ano_publicado`, `editora`, `numero_paginas`, `imagem_url`) VALUES
(1, 'A Cor que Caiu do Espaço', 'H.P Lovecraft', 'Horror Cósmico', 1927, 'Editora Arkham', 150, 'url_imagem1.jpg'),
(2, 'O Chamado de Cthulhu', 'H.P Lovecraft', 'Horror Cósmico', 1928, 'Editora Miskatonic', 120, 'url_imagem2.jpg');
-- Inserindo livros de FANTASIA
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('O Senhor dos Anéis: A Sociedade do Anel', 'J.R.R. Tolkien', 'fantasia', 1954, 'Martins Fontes', 423);

-- Inserindo livros de TERROR
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('It: A Coisa', 'Stephen King', 'terror', 1986, 'Suma', 1104);

-- Inserindo livros de COMÉDIA
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('O Guia do Mochileiro das Galáxias', 'Douglas Adams', 'comedia', 1979, 'Arqueiro', 208);

-- Inserindo livros de SUSPENSE
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('O Silêncio dos Inocentes', 'Thomas Harris', 'suspence', 1988, 'Record', 367);

-- Inserindo livros de ROMANCE
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('Orgulho e Preconceito', 'Jane Austen', 'romance', 1813, 'Martin Claret', 424);

-- Inserindo livros de FICÇÃO CIENTÍFICA
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('Duna', 'Frank Herbert', 'ficcao', 1965, 'Aleph', 680);

-- Inserindo livros de DRAMA
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('O Sol é para Todos', 'Harper Lee', 'drama', 1960, 'José Olympio', 349);

-- Inserindo livros de AVENTURA
INSERT INTO livros (titulo, autor, genero, ano_publicado, editora, numero_paginas) VALUES
('A Ilha do Tesouro', 'Robert Louis Stevenson', 'aventura', 1883, 'Penguin', 304);

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_atividades`
--

CREATE TABLE `log_atividades` (
  `id_log` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acao` varchar(100) DEFAULT NULL,
  `detalhes` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `data_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `cpf`, `senha`, `tipo`, `telefone`, `endereco`, `data_cadastro`, `avatar_url`, `biografia`, `etec_estudante`) VALUES
(1, 'Administrador', 'admin@bibliotec.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '(11) 9999-9999', NULL, '2025-11-19 00:59:07', NULL, '', 0),
(4, 'DAYANA ALMEIDA DE OLIVEIRA', 'angelo.ivon05@gmail.com', NULL, '$2y$10$v8xfZbwBtDwmWsPHqjYPROn9LKZRv2ouWM9BQ7PtyqtFEg28MEW8W', 'usuario', '11960377677', NULL, '2025-11-23 15:26:19', NULL, NULL, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices de tabela `comentarios_livros`
--
ALTER TABLE `comentarios_livros`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices de tabela `escrito`
--
ALTER TABLE `escrito`
  ADD PRIMARY KEY (`id_edicao`),
  ADD KEY `id_livro` (`id_livro`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD UNIQUE KEY `unique_favorito` (`id_usuario`,`id_livro`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`);

--
-- Índices de tabela `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `log_atividades`
--
ALTER TABLE `log_atividades`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Restrições para tabelas `comentarios_livros`
--
ALTER TABLE `comentarios_livros`
  ADD CONSTRAINT `comentarios_livros_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `comentarios_livros_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Restrições para tabelas `escrito`
--
ALTER TABLE `escrito`
  ADD CONSTRAINT `escrito_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`),
  ADD CONSTRAINT `escrito_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_livro`) REFERENCES `livros` (`id_livro`);

--
-- Restrições para tabelas `log_atividades`
--
ALTER TABLE `log_atividades`
  ADD CONSTRAINT `log_atividades_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;