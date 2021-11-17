-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 17-Nov-2021 às 06:37
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `diario_bordo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `name`, `description`, `create_date`, `modify_date`) VALUES
(1, 'categoria 1', 'Test description categoria 1', '2021-11-08 04:30:44', '2021-11-15 21:43:52'),
(2, 'categoria 2', 'teste categoria 2', '2021-11-15 21:12:52', '2021-11-15 22:12:23'),
(3, 'categoria 3', 'description teste categoria 3', '2021-11-15 21:42:46', '2021-11-15 22:42:21'),
(4, 'categoria 4', 'description teste categoria 4', '2021-11-15 21:43:09', '2021-11-15 22:42:21'),
(5, 'categoria 5', 'description da categoria 5', '2021-11-15 21:44:29', '2021-11-15 22:44:16'),
(6, 'categoria 6', 'description categoria 6', '2021-11-15 21:45:10', '2021-11-15 22:44:57'),
(7, 'outra categoria', 'this is a test', '2021-11-16 03:24:45', '2021-11-16 04:24:11'),
(8, 'test cat', 'other test', '2021-11-16 03:24:45', '2021-11-16 04:24:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `picture`
--

CREATE TABLE `picture` (
  `picture_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `post`
--

CREATE TABLE `post` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` longtext DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modify_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `categoria_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `create_date`, `modify_date`, `categoria_id`) VALUES
(1, 'test post 1', 'this is a test', '2021-11-16 03:11:01', '2021-11-16 03:11:18', 1),
(2, 'post test 1', 'description post', '2021-11-16 03:13:16', '2021-11-16 04:12:21', 1),
(3, 'other post', 'description post', '2021-11-16 03:13:16', '2021-11-16 04:12:21', 1),
(4, 'other post lorem', 'description post lorem', '2021-11-16 03:14:09', '2021-11-16 04:13:20', 2),
(5, 'more posts', 'description post', '2021-11-16 03:14:09', '2021-11-16 04:13:20', 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Índices para tabela `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picture_id`),
  ADD KEY `FK_post_picture` (`post_id`);

--
-- Índices para tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `FK_post_picture` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Limitadores para a tabela `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `categoria_id` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
