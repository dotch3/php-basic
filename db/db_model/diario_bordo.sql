-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 19-Nov-2021 às 02:56
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
(1, 'categoria 1 edited', 'Test description categoria 1 test', '2021-11-08 04:30:44', '2021-11-18 03:41:23'),
(2, 'Cinema', 'teste categoria 2 editing 2', '2021-11-15 21:12:52', '2021-11-18 02:22:14'),
(3, 'categoria 3', 'description teste categoria 3 editing', '2021-11-15 21:42:46', '2021-11-18 02:10:00'),
(4, 'Arte', 'description for arte. \r\n\"editing\" 2', '2021-11-15 21:43:09', '2021-11-18 01:52:59'),
(5, 'categoria 5', 'description da categoria 5', '2021-11-15 21:44:29', '2021-11-15 22:44:16'),
(8, 'test cat edited', 'other test edited', '2021-11-16 03:24:45', '2021-11-24 04:24:11'),
(9, 'test 20211117', 'Test description 20211117', '2021-11-17 11:45:06', '2021-11-18 01:16:45'),
(11, 'test from web', 'from web', '2021-11-17 12:49:36', NULL),
(14, 'outra categoria', 'testing editing', '2021-11-18 03:22:46', '2021-11-18 03:23:08'),
(15, 'test new cat', 'cat', '2021-11-18 03:40:19', NULL),
(16, 'testing', 'categoria teste', '2021-11-19 01:35:28', NULL);

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
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `image_path` text CHARACTER SET armscii8 COLLATE armscii8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `create_date`, `modify_date`, `categoria_id`, `image_path`) VALUES
(1, 'test post 1', 'this is a test', '2021-11-16 03:11:01', '2021-11-19 00:27:35', 1, 'dollybot-capanga.png'),
(2, 'test from php editing it', 'Lorem Ipsum, lorem ipsum sum sum', '2021-11-16 03:13:16', '2021-11-19 00:27:26', 2, 'capanga.png'),
(6, 'from admin', 'testing from admin', '2021-11-26 00:00:00', '2021-11-19 00:32:22', 4, 'factory.png'),
(7, 'from admin', 'from admin', '2021-11-27 00:00:00', '2021-11-19 01:35:55', 3, 'post_1637280400_robot_logo2.png'),
(8, 'test', 'test', '2021-11-19 00:00:00', '2021-11-19 00:27:58', 3, 'test.png'),
(9, 'testing', 'testing', '2021-11-27 00:00:00', NULL, 3, 'post_1637280805_robot_logo2.png'),
(10, 'post com imagem', 'valendo!!', '2021-11-27 00:00:00', NULL, 9, 'post_1637285781_robot_logo5.png');

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
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `picture`
--
ALTER TABLE `picture`
  MODIFY `picture_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
