-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/10/2024 às 03:29
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
-- Banco de dados: `bytesquad`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrativo`
--

CREATE TABLE `administrativo` (
  `id_administrativo` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha_admin` varchar(500) NOT NULL,
  `permissoes_admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrativo`
--

INSERT INTO `administrativo` (`id_administrativo`, `usuario`, `senha_admin`, `permissoes_admin`) VALUES
(1, 'Eduardo Henrique Cioli Machado', '$2y$10$PdpcQaPKBp1XNZfmlNZmmuyRQ.whYnWHo5Jf0ebIeXk6D2zrfn6.6', 'Criar, editar, listar e excluir usuários.'),
(2, 'Eduardo Machado', '$2y$10$IBL39vlFi.lYkyQptnOes.f/.EZvLuTmcLIt5it3wGHWghnZfIPnW', 'Criar e editar usuários.'),
(3, 'Luis Camargo', '$2y$10$i2H7r/wtQk92zDVDt6zQeuuDUAMRW1l6RcJL37tFBIOPqcbtuBit6', 'Listar usuários.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `formapagamento` varchar(500) NOT NULL,
  `preco_compra` int(11) NOT NULL,
  `historico_compra` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracao`
--

CREATE TABLE `configuracao` (
  `id_configuracao` int(11) NOT NULL,
  `volume` int(11) NOT NULL,
  `notificacoes` tinyint(1) NOT NULL,
  `idioma` varchar(75) NOT NULL,
  `visual` tinyint(1) NOT NULL,
  `id_feedback` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dicas`
--

CREATE TABLE `dicas` (
  `id_dicas` int(11) NOT NULL,
  `pacote_dicas` int(11) NOT NULL,
  `preco_dicas` int(11) NOT NULL,
  `quantidade_dicas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `energia`
--

CREATE TABLE `energia` (
  `id_energia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `quantidade_energia` int(11) NOT NULL,
  `tempo_dica` int(11) NOT NULL,
  `preco_energia` int(11) NOT NULL,
  `pacote_energia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `caixatexto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel`
--

CREATE TABLE `nivel` (
  `id_nivel` int(11) NOT NULL,
  `nome_nivel` varchar(20) NOT NULL,
  `tempo_nivel` int(11) NOT NULL,
  `dificuldade` varchar(30) NOT NULL,
  `questoes` text NOT NULL,
  `respostas` varchar(300) NOT NULL,
  `id_administrativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `nome_nivel`, `tempo_nivel`, `dificuldade`, `questoes`, `respostas`, `id_administrativo`) VALUES
(1, 'Nivel 1', 210, 'Fácil', 'Qual seu nome?', 'Indiferente', 2),
(2, 'Nivel 2', 60, 'Dificil', 'Qual seu nome?', 'Indiferente', 0),
(3, 'Nivel 3', 60, 'Dificil', 'Qual a maior palavra do mundo?', 'Indiferente', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `outros_usuario`
--

CREATE TABLE `outros_usuario` (
  `permissoes_usuario` text NOT NULL,
  `ativo_usuario` tinyint(1) NOT NULL,
  `idOutros_usuario` int(11) NOT NULL,
  `url_foto` varchar(500) NOT NULL,
  `id_redesocial` int(11) NOT NULL,
  `telefone` varchar(40) NOT NULL,
  `id_administrativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `redesocial`
--

CREATE TABLE `redesocial` (
  `id_redesocial` int(11) NOT NULL,
  `credenciais_redesocial` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabelapontuacao`
--

CREATE TABLE `tabelapontuacao` (
  `id_tabelapontuacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `pontuacao_tabela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome_usuario` varchar(20) NOT NULL,
  `email_usuario` varchar(150) NOT NULL,
  `senha_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES
(10, 'djnegev', 'ig4m@gmail.com', '$2y$10$rbClDbrHV7setdbdMZii5O9Vd7NDSMUroaF83PpjJqY1yReFju0JW'),
(11, 'Machado Eduardo', 'machado@gmail.com', '$2y$10$Yuvn0MFn6s4nzxa8XnZrwOOS4ksOrdJvfQpkzqVh13tXtMrT9tRiu'),
(12, 'Fabio', 'fabio2023@gmail.com', '$2y$10$K9MMakm9olGj8DwphUUnK.1HBUJikPqnnU4NkJXx3oRQL6JxpD.Zi');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`id_administrativo`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Índices de tabela `configuracao`
--
ALTER TABLE `configuracao`
  ADD PRIMARY KEY (`id_configuracao`);

--
-- Índices de tabela `dicas`
--
ALTER TABLE `dicas`
  ADD PRIMARY KEY (`id_dicas`);

--
-- Índices de tabela `energia`
--
ALTER TABLE `energia`
  ADD PRIMARY KEY (`id_energia`);

--
-- Índices de tabela `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Índices de tabela `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`id_nivel`);

--
-- Índices de tabela `outros_usuario`
--
ALTER TABLE `outros_usuario`
  ADD PRIMARY KEY (`idOutros_usuario`);

--
-- Índices de tabela `redesocial`
--
ALTER TABLE `redesocial`
  ADD PRIMARY KEY (`id_redesocial`);

--
-- Índices de tabela `tabelapontuacao`
--
ALTER TABLE `tabelapontuacao`
  ADD PRIMARY KEY (`id_tabelapontuacao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrativo`
--
ALTER TABLE `administrativo`
  MODIFY `id_administrativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `configuracao`
--
ALTER TABLE `configuracao`
  MODIFY `id_configuracao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dicas`
--
ALTER TABLE `dicas`
  MODIFY `id_dicas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `energia`
--
ALTER TABLE `energia`
  MODIFY `id_energia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `outros_usuario`
--
ALTER TABLE `outros_usuario`
  MODIFY `idOutros_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redesocial`
--
ALTER TABLE `redesocial`
  MODIFY `id_redesocial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabelapontuacao`
--
ALTER TABLE `tabelapontuacao`
  MODIFY `id_tabelapontuacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
