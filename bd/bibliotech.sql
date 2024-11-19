-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/10/2024 às 22:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bibliotech`
--
CREATE DATABASE IF NOT EXISTS `bibliotech` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bibliotech`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `biografia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`id`, `nome`, `data_nascimento`, `nacionalidade`, `biografia`) VALUES
(1, 'J.K. Rowling', '1965-07-31', 'Britânica', 'J.K. Rowling é uma autora britânica, mais conhecida por sua série de livros Harry Potter.'),
(2, 'George R.R. Martin', '1948-09-20', 'Americana', 'George R.R. Martin é um autor americano de fantasia, conhecido por sua série As Crônicas de Gelo e Fogo.'),
(3, 'J.R.R. Tolkien', '1892-01-03', 'Britânica', 'J.R.R. Tolkien foi um escritor britânico, conhecido por suas obras O Hobbit e O Senhor dos Anéis.'),
(4, 'Akiva', '1661-09-01', 'Israel', 'Ele nasceu na Judeia no primeiro século e se tornou em um dos rabinos mais importantes da história!'),
(5, 'Peter Jandl Junior', '2016-02-25', 'Americano', 'Peter Jandl Junior é engenheiro eletricista pela Unicamp, mestre em Educação pela Universidade São Francisco e programador certificado pela Sun Microsystems para a plataforma Java 2.'),
(7, 'Barry Burd', '2024-09-11', 'Americano', 'Louco e sonhador'),
(8, 'Josh Lockhart', '2024-09-02', 'Americano', 'e');

-- --------------------------------------------------------

--
-- Estrutura para tabela `copia_livro`
--

CREATE TABLE `copia_livro` (
  `id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `status_id` int(10) UNSIGNED DEFAULT NULL,
  `data_aquisicao` date DEFAULT NULL,
  `edicao` varchar(50) DEFAULT NULL,
  `localizacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `copia_livro`
--

INSERT INTO `copia_livro` (`id`, `livro_id`, `status_id`, `data_aquisicao`, `edicao`, `localizacao`) VALUES
(22, 22, 3, '2024-09-26', '1', 'Seção A'),
(23, 23, 1, '2024-09-26', '1', NULL),
(24, 24, 2, '2024-09-26', '5', NULL),
(25, 25, 1, '2024-09-26', '1', NULL),
(26, 26, 1, '2024-09-27', '3', NULL),
(27, 26, 1, '2001-10-05', '4', 'Por ai');

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`id`, `nome`) VALUES
(1, 'Bloomsbury'),
(2, 'HarperCollins'),
(3, 'Penguin Random House'),
(4, 'Sefer'),
(5, 'Aleph'),
(6, 'Novatec Editora'),
(7, 'Alta Books'),
(8, '‎ LeYa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `emprestimoid` int(10) UNSIGNED NOT NULL,
  `inicio` date NOT NULL,
  `dataprevista` date NOT NULL,
  `datareal` date DEFAULT NULL,
  `status` enum('pendente','concluído','atrasado','concluidocomatraso') NOT NULL,
  `idlivro` int(11) DEFAULT NULL,
  `usuario` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`emprestimoid`, `inicio`, `dataprevista`, `datareal`, `status`, `idlivro`, `usuario`) VALUES
(1, '2024-09-26', '2024-10-03', '0000-00-00', 'concluído', 22, '123456'),
(2, '2024-09-26', '2024-09-26', '2024-09-26', 'concluído', 25, '654321'),
(3, '2024-09-17', '2024-09-27', '2024-09-27', 'concluído', 26, '123456'),
(4, '2024-09-23', '2024-09-30', '2024-09-30', 'concluído', 25, '654321'),
(5, '2024-09-30', '2024-09-30', '2024-09-30', 'concluído', 25, '654321'),
(6, '2024-09-30', '2024-10-08', '2024-10-16', 'concluído', 25, '654321'),
(7, '2024-09-23', '2024-10-08', '2024-10-09', 'concluído', 27, '654321'),
(10, '2024-09-23', '2024-09-30', NULL, 'atrasado', 24, '123456'),
(14, '2024-10-01', '2024-10-04', '2024-10-07', 'concluidocomatraso', 27, '324432'),
(18, '2024-10-02', '2024-10-03', '2024-10-03', 'concluído', 22, '654321'),
(19, '2024-10-02', '2024-10-04', '2024-10-04', 'concluído', 22, '654321');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL,
  `nomestado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`id`, `descricao`) VALUES
(1, 'Fantasia'),
(2, 'Ficção Científica'),
(3, 'Mistério'),
(4, 'Ação'),
(5, 'Educativo'),
(6, 'Drama'),
(7, 'Suspense');

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `idlivro` int(11) NOT NULL,
  `isbn` char(13) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `paginas` int(11) DEFAULT NULL,
  `editora_id` int(11) DEFAULT NULL,
  `ano_publicacao` varchar(4) DEFAULT NULL,
  `idioma` varchar(50) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 0,
  `disponibilidade` enum('Disponível','Indisponível') DEFAULT 'Indisponível',
  `imagem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`idlivro`, `isbn`, `titulo`, `genero_id`, `autor_id`, `paginas`, `editora_id`, `ano_publicacao`, `idioma`, `quantidade`, `disponibilidade`, `imagem`) VALUES
(22, '8532530788', 'Harry Potter e a Pedra Filosofal', 2, 1, 208, 1, '1997', 'Portugues', 0, 'Indisponível', 'caminho/para/salvar/capa/2534503008_1.webp'),
(23, '9788544102961', 'A Dança dos Dragões. As Crônicas de Gelo e Fogo', 1, 2, 832, 8, '2011', 'Portugues', 1, 'Disponível', 'capa/danca.jfif'),
(24, '8576088010', 'Java para Leigos', 5, 7, 424, 7, '2017', 'Portugues', 0, 'Indisponível', 'capa/java.jfif'),
(25, '6555112069', 'A Natureza da Terra-Média', 1, 3, 512, 2, '2020', 'Portugues', 1, 'Disponível', 'capa/terra.jpg'),
(26, '8575225340', 'Desenvolvendo Websites com PHP', 5, 7, 320, 6, '2016', 'Portugues', 2, 'Disponível', 'capa/php.jpg'),
(27, '857522428', 'PHP Moderno', 5, 8, 296, 6, '2015', 'Portugues', 0, 'Indisponível', 'capa/php2.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_livro`
--

CREATE TABLE `status_livro` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status_livro`
--

INSERT INTO `status_livro` (`id`, `descricao`) VALUES
(1, 'Disponível'),
(2, 'Emprestado'),
(3, 'Desativado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo` int(10) UNSIGNED NOT NULL,
  `nome_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo`, `nome_usuario`) VALUES
(1, 'Administrador'),
(2, 'Aluno'),
(3, 'Professor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(45) NOT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nasc` date DEFAULT NULL,
  `telefone` char(11) DEFAULT NULL,
  `imagem` varchar(50) NOT NULL,
  `tipo_usuario` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('ativado','desativado') NOT NULL DEFAULT 'ativado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `sobrenome`, `cpf`, `email`, `senha`, `data_nasc`, `telefone`, `imagem`, `tipo_usuario`, `status`) VALUES
(52, 'Rayssa', 'Pessoa', '123456', 'rayssa@gmail.com', '$2y$10$xNkQmpu2WgL469h.P4Vq5uSt2cCuPPfTaTj7WQIuCuEUgUYMGOS7u', '2019-02-26', '99999999', 'foto/ray.jpg', 2, 'ativado'),
(53, 'Teste', '', '654321', 'teste@gmail.com', '$2y$10$Gd2yCe.q6JD7zHjj1H5Y/O7gD3x80M42VRnUPER1tHiu58W6m7372', '2024-09-06', '88888888', 'foto/manoel.jpg', 2, 'ativado'),
(55, 'Henrique', 'Lima', '786543', 'henrique@gmail.com', '$2y$10$q8vMzCQN8HFq6HrO6GnMouUJTQ6nJSYXviDSQj2125GNSlPZ094hK', '2024-09-04', '77777777', 'foto/shrek.jfif', 1, 'ativado'),
(58, 'Davi', 'Teles', '324432', 'daviteles4@gmail.com', '$2y$10$STrv2C879e0ERB0elToF7.4KfOVSAD7jTkr8gIR6.bJmEQiOMtLta', '2024-09-16', '76767676', 'foto/cf8bd4a012048ac94a372ad27470245e.jpg', 1, 'ativado'),
(59, 'Francisco', 'Kenison', '43434343', 'kenison@gmail.com', '$2y$10$5G.ykiogtpfLtQk8sdqpV.WIUk8NA5MOFE7LaStWWonjZ7ZEAW43S', '2024-09-09', '65473821', 'foto/gato.png', 3, 'ativado'),
(60, 'Maria', 'Aparecida', '334.344.433', 'maria.silva@example.com', '$2y$10$4t5dSYGgFGQ9pW8T5fnYmubl237qIqQ1f0ar5KfU19tiQLLdY3mui', '2024-10-30', '9298828373', 'foto/', 1, 'ativado'),
(61, 'Silvio', 'Santos', '12393948585', 'senorabaravanel@gmail.com', '$2y$10$J6hC3niQd1IJJXt0Dwfnfe3nnMMgrHSThG8cSP4xtZ/CJkvBkbaoW', '2024-10-03', '87637485762', 'foto/', 1, 'ativado'),
(63, 'Tester', '', '75488848383', 't@gmail.com', '$2y$10$fJqD5SVWRL4D.jYuxXz0Q.mtTUMxHvQvwlR2Y/sdeRz7qXB.txGma', '2024-10-03', '45343323343', 'foto/', 1, 'ativado');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `copia_livro`
--
ALTER TABLE `copia_livro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livro_id` (`livro_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`emprestimoid`),
  ADD KEY `idlivro` (`idlivro`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`idlivro`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `genero_id` (`genero_id`),
  ADD KEY `autor_id` (`autor_id`),
  ADD KEY `editora_id` (`editora_id`);

--
-- Índices de tabela `status_livro`
--
ALTER TABLE `status_livro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `tipo_usuario` (`tipo_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `copia_livro`
--
ALTER TABLE `copia_livro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `emprestimoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `idlivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `status_livro`
--
ALTER TABLE `status_livro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `copia_livro`
--
ALTER TABLE `copia_livro`
  ADD CONSTRAINT `copia_livro_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livro` (`idlivro`),
  ADD CONSTRAINT `copia_livro_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status_livro` (`id`);

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`idlivro`) REFERENCES `copia_livro` (`id`),
  ADD CONSTRAINT `emprestimo_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`cpf`);

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`),
  ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`),
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`editora_id`) REFERENCES `editora` (`id`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
