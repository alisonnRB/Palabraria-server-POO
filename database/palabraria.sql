-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/03/2024 às 19:23
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
(1, 'admin', '$2y$10$Irck7KvY0JjfIkuxrm92Q.0O4s9QXx9HtV7W56qJusBQOnlxPMufC', 'admin', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `palavras_mod`
--
ALTER TABLE `palavras_mod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
