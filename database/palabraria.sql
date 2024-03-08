-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/03/2024 às 01:24
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `palabraria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `palavras`
--

CREATE TABLE `palavras` (
  `id` int(11) NOT NULL,
  `palavra` varchar(200) NOT NULL,
  `traducao` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `imagem1` varchar(200) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `imagem3` varchar(200) DEFAULT NULL,
  `imagem4` varchar(200) DEFAULT NULL,
  `imagem5` varchar(200) DEFAULT NULL,
  `imagem6` varchar(200) DEFAULT NULL,
  `classificacao1` varchar(200) NOT NULL,
  `classificacao2` varchar(200) DEFAULT NULL,
  `transcricao` varchar(200) DEFAULT NULL,
  `expressao1` varchar(2000) DEFAULT NULL,
  `expressao2` varchar(2000) DEFAULT NULL,
  `expressao3` varchar(2000) DEFAULT NULL,
  `expressao4` varchar(2000) DEFAULT NULL,
  `cadastrante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `palavras`
--

INSERT INTO `palavras` (`id`, `palavra`, `traducao`, `descricao`, `imagem1`, `imagem2`, `imagem3`, `imagem4`, `imagem5`, `imagem6`, `classificacao1`, `classificacao2`, `transcricao`, `expressao1`, `expressao2`, `expressao3`, `expressao4`, `cadastrante`) VALUES
(1, 'mimi', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2a802b1bd08.46268200.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2a8d4d22618.08812848.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(4, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2a955f081b0.76221519.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(5, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2a99c3a1166.12228764.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(6, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2a9a5d469d3.52213207.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(7, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2af04ea48e2.10224758.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(8, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2af2511f715.55082163.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', NULL, NULL, NULL, NULL, NULL, 1),
(9, 'Sandia', 'melancia', 'fruta vermelha', 'image_65c2b11c7d8bc1.70328267.jpg', NULL, NULL, NULL, NULL, NULL, 'ala', 'ili', 'sjkksjd', 'mi', 'mkm', 'mk', 'moon', 1),
(10, 'as', 'asas', 'dadada', 'image_65c2b125b3fc12.95565428.jpg', NULL, NULL, NULL, NULL, NULL, 'sas', 'sdad', 'yu', 'uyy', 'uyu', ',k,k,', ',k,', 1),
(11, 'mima', 'asa', 'asasasas', 'image_65d2d4ae4f34b6.63464485.jpeg', NULL, NULL, NULL, NULL, NULL, 'sas', 'sass', 'bn', NULL, NULL, NULL, NULL, 1),
(12, 'mimafd', 'fdff', 'dfdfdfd', 'image_65d2d90c04ba43.46310057.png', 'image_65d2d90c0505f7.93809618.jpg', NULL, NULL, NULL, NULL, 'fdfd', 'fdfdf', 'fdfdf', 'fdfdf', 'dfdfdf', 'dfdffdf', 'dfdfdf', 1),
(13, 'dfdfd', 'fdfdf', 'ffdfdf', 'image_65d2eb9e94c5e4.88983780.jpg', NULL, NULL, NULL, NULL, NULL, 'dfdfd', 'dfdfdf', 'kokok', NULL, NULL, NULL, NULL, 1),
(14, 'dfdfd', 'fdfdf', 'ffdfdf', 'image_65d2eb9f358862.96176879.jpg', NULL, NULL, NULL, NULL, NULL, 'dfdfd', 'dfdfdf', 'kokok', NULL, NULL, NULL, NULL, 1),
(15, 'dfdfd', 'fdfdf', 'ffdfdf', 'image_65d2eda23b59b1.06579965.png', NULL, NULL, NULL, NULL, NULL, 'dfdfd', 'dfdfdf', 'kokok', 'fgfg', 'fgfg', 'gfgfg', 'gfgf', 1),
(16, 'asasasa', 'asas', 'asasas', NULL, NULL, NULL, NULL, NULL, NULL, 'asas', 'asasas', 'asasas', 'sas', 'sas', 'asasa', 'asas', 1),
(17, 'mimids', 'fdfd', 'dfdf', NULL, NULL, NULL, NULL, NULL, NULL, 'sss', 'svvvvvvvvv', 'fffff', NULL, 'bb', 'ee', 'nn', 1),
(18, 'mimids', 'fdfd', 'dfdf', NULL, NULL, NULL, NULL, NULL, NULL, 'sss', 'svvvvvvvvv', 'fffff', 'm', 'bb', 'ee', 'nn', 1),
(19, 'mimids', 'fdfd', 'dfdf', 'image_65d76e7d6a18a1.36970107.jpeg', NULL, NULL, NULL, NULL, NULL, 'sss', 'svvvvvvvvv', 'fffff', 'm', 'bb', 'ee', 'nn', 1),
(20, 'sssssss', 'aaaaaaa', 'sssssssssd', NULL, NULL, NULL, NULL, NULL, NULL, 'ssss', 'dddddddd', 'a', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', 1),
(21, 'sssssss', 'aaaaaaa', 'sssssssssd', NULL, NULL, NULL, NULL, NULL, NULL, 'ssss', 'dddddddd', 'a', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', 1),
(22, 'sssssss', 'aaaaaaa', 'sssssssssd', NULL, NULL, NULL, NULL, NULL, NULL, 'ssss', 'dddddddd', 'a', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', 1),
(23, 'sssssss', 'aaaaaaa', 'sssssssssd', NULL, NULL, NULL, NULL, NULL, NULL, 'ssss', 'dddddddd', 'a', 'aaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', 1),
(24, 'ddd', 'dsdsds', 'dsdsd', NULL, NULL, NULL, NULL, NULL, NULL, 'sdsds', 'dsds', 'ddddd', 'ddddddddddddd', 'dddddd', 'dddddddddddddddd', 'dddddddddddddd', 1),
(25, 'aaaas', 'asa', 'sasa', 'image_65d770dfd96122.41604840.png', NULL, NULL, NULL, NULL, NULL, 'ssas', 'sass', 'vcv', 'vcvc', 'ds', 'cvsd', 'g', 1),
(26, 'ass77', 'asasad', 'sdsf', NULL, NULL, NULL, NULL, NULL, NULL, 'dssd', 'ff', 'vcv', 'vvvvv', NULL, NULL, NULL, 26),
(27, 'Sandías', 'melancia', 'Suculenta, doce e refrescante, a melancia é uma verdadeira fonte de sais minerais como cálcio, fósforo, magnésio, sódio e potássio, além de vitaminas importantes para o organismo, como as vitaminas A, do complexo B e C. E não é só isso!', 'image_65e4575272b234.85446767.jpg', 'image_65e45752731aa7.66213543.jpg', 'image_65e457527365a2.70133438.jpg', 'image_65e4575273af46.63797382.jpg', 'image_65e4575273fd54.41400263.jpg', 'image_65e457527447a9.09933881.jpg', 'comida', '', 'sə̃.dˈa.ljə', 'Estar más fresco que una sandía: Significa estar muito fresco, especialmente em relação à temperatura ou atitude.', 'Ser la sandía de la fiesta: Usado para descrever alguém que é o centro das atenções em uma festa ou evento.', 'Hacerse el sueco con la sandía: Significa ignorar deliberadamente algo que é óbvio ou evidente.', 'Meter la sandía en el baúl: Expressão usada para falar sobre alguém que está fora de lugar, como tentar fazer algo que não é apropriado para a situação.', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `palavras_mod`
--

CREATE TABLE `palavras_mod` (
  `id` int(11) NOT NULL,
  `palavra` varchar(200) NOT NULL,
  `traducao` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `imagem1` varchar(200) DEFAULT NULL,
  `imagem2` varchar(200) DEFAULT NULL,
  `imagem3` varchar(200) DEFAULT NULL,
  `imagem4` varchar(200) DEFAULT NULL,
  `imagem5` varchar(200) DEFAULT NULL,
  `imagem6` varchar(200) DEFAULT NULL,
  `classificacao1` varchar(200) NOT NULL,
  `classificacao2` varchar(200) DEFAULT NULL,
  `transcricao` varchar(200) DEFAULT NULL,
  `expressao1` varchar(2000) DEFAULT NULL,
  `expressao2` varchar(2000) DEFAULT NULL,
  `expressao3` varchar(2000) DEFAULT NULL,
  `expressao4` varchar(2000) DEFAULT NULL,
  `cadastrante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `palavras_mod`
--

INSERT INTO `palavras_mod` (`id`, `palavra`, `traducao`, `descricao`, `imagem1`, `imagem2`, `imagem3`, `imagem4`, `imagem5`, `imagem6`, `classificacao1`, `classificacao2`, `transcricao`, `expressao1`, `expressao2`, `expressao3`, `expressao4`, `cadastrante`) VALUES
(12, 'zazaz', 'zazaz', 'zaza', 'image_65dbdbfb122102.43333337.jpg', NULL, NULL, NULL, NULL, NULL, 'azazaz', 'zaza', 'zazaza', NULL, NULL, NULL, 'zazaza', 27);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `tipo` varchar(100) NOT NULL DEFAULT 'instituicao',
  `cadastrante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `senha`, `tipo`, `cadastrante`) VALUES
(1, 'admin', '$2y$10$Irck7KvY0JjfIkuxrm92Q.0O4s9QXx9HtV7W56qJusBQOnlxPMufC', 'admin', 0),
(26, 'if', '$2y$10$U7xZk1AXhRXdG27S3yaqxeQDbNp1GPMq2AiNufXfY9vsfTq5Z5Fc.', 'moderador', 1),
(28, 'silence', '$2y$10$WgykIg4/fqd9q39kF57wh.HIGutUq20LqIapdkddleTnmCFNykuoS', 'instituicao', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `palavras`
--
ALTER TABLE `palavras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `palavras_mod`
--
ALTER TABLE `palavras_mod`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `palavras`
--
ALTER TABLE `palavras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `palavras_mod`
--
ALTER TABLE `palavras_mod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
