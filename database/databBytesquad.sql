-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/10/2024 às 02:42
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
(3, 'Luis Camargo', '$2y$10$i2H7r/wtQk92zDVDt6zQeuuDUAMRW1l6RcJL37tFBIOPqcbtuBit6', 'Listar usuários.'),
(4, 'Vinicios Vaz', '$2y$10$qXo4FMMdcjnLmPnaCblcsulbXAgvfAZ8YetmvypEqQTHBnkV6a4Gy', 'Listar usuários.'),
(5, 'Alysson Gabriel', '$2y$10$6FgqTeZM6fYDcGz4q8xrHeh4NQWYIAQoKdtFCYirdMZ2DNbgM0zOq', 'Criar usuários.'),
(6, 'Luiz Cezar', '$2y$10$rpzMf4VH1tqhudBDiFhL6uAPA8WRTZ.F8caTNtch14Rq4ABacZOeW', 'Editar usuários.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `formapagamento` varchar(500) NOT NULL,
  `preco_compra` float NOT NULL,
  `historico_compra` varchar(400) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `compra`
--

INSERT INTO `compra` (`id_compra`, `formapagamento`, `preco_compra`, `historico_compra`, `id`) VALUES
(1, 'Boleto', 239, '01/02/2023', 10),
(2, 'Cartão de débito', 79.9, '23/06/2022', 13),
(3, 'Cartão de crédito', 14.9, '26/05/2024', 11),
(4, 'Dinheiro', 32.9, '31/08/2024', 10);

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
  `pacote_dicas` varchar(100) NOT NULL,
  `preco_dicas` float NOT NULL,
  `quantidade_dicas` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dicas`
--

INSERT INTO `dicas` (`id_dicas`, `pacote_dicas`, `preco_dicas`, `quantidade_dicas`, `id`) VALUES
(1, 'Pacote SUPER', 29.99, 40, 14),
(3, 'Pacote MINI', 5.99, 5, 14),
(4, 'Pacote STANDART', 17.9, 18, 12),
(5, 'Pacote POOR', 2, 2, 10),
(6, 'Pacote ELON MUSK', 99, 130, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `energia`
--

CREATE TABLE `energia` (
  `id_energia` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantidade_energia` int(11) NOT NULL,
  `tempo_energia` int(11) NOT NULL,
  `preco_energia` float NOT NULL,
  `pacote_energia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `energia`
--

INSERT INTO `energia` (`id_energia`, `id`, `quantidade_energia`, `tempo_energia`, `preco_energia`, `pacote_energia`) VALUES
(3, 12, 40, 30, 29.9, 'Pacote STANDART'),
(4, 10, 80, 30, 59.9, 'Pacote SUPER'),
(5, 10, 20, 30, 14.9, 'Pacote SMALL'),
(6, 10, 10, 30, 7.9, 'Pacote MINI'),
(7, 10, 160, 30, 119.9, 'Pacote OMEGA');

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
(1, 'Nivel 1', 10, 'Fácil', 'Quantas horas tem um dia?', '24', 1),
(2, 'Nivel 2', 20, 'Médio', 'De quem é a famosa frase “Penso, logo existo”?', 'Descartes', 6),
(3, 'Nivel 3', 30, 'Dificil', 'Atualmente, quantos elementos químicos a tabela periódica possui?', '118', 4),
(4, 'Nível 4', 20, 'Média', 'O que a palavra legend significa em português?', 'Lenda', 5),
(5, 'Nível 5', 45, 'Extrema', 'Quem foi a mulher negra que se recusou a ceder o lugar num ônibus para um homem branco e marcou a luta pelos direitos civis dos negros dos Estados Unidos em 1955?', 'Rosa Parks', 3);

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

--
-- Despejando dados para a tabela `redesocial`
--

INSERT INTO `redesocial` (`id_redesocial`, `credenciais_redesocial`) VALUES
(1, '{\r\n 	\"id\": 1,\r\n    \"user\": \"Morpheush\",\r\n    \"email\": \"anyuser@gmail.com\",\r\n    \"password\": \"4jh43gvf9g722lhbd2otd\",\r\n    \"createdAt\": \"2020-02-20T11:00:28.107Z\"\r\n}'),
(2, '{\r\n 	\"id\": 2,\r\n    \"user\": \"Chris\",\r\n    \"email\": \"otheruser@gmail.com\",\r\n    \"password\": \"no32o83vrub87r73g9\",\r\n    \"createdAt\": \"2023-09-10T01:00:58.107Z\"\r\n}'),
(3, '{ \"id\": 3, \"user\": \"Bob\", \"email\": \"bob@example.com\", \"password\": \"securepass\", \"createdAt\": \"2023-09-15T08:30:00.000Z\" }'),
(4, '{ \"id\": 4, \"user\": \"Diana\", \"email\": \"diana@example.com\", \"password\": \"mypassword\", \"createdAt\": \"2023-09-20T14:45:00.000Z\" }'),
(5, '{ \"id\": 5, \"user\": \"Eve\", \"email\": \"eve@example.com\", \"password\": \"eve12345\", \"createdAt\": \"2023-09-25T19:15:00.000Z\" }');

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

--
-- Despejando dados para a tabela `tabelapontuacao`
--

INSERT INTO `tabelapontuacao` (`id_tabelapontuacao`, `id_usuario`, `id_nivel`, `pontuacao_tabela`) VALUES
(1, 1, 1, 15000),
(2, 2, 2, 20000),
(3, 3, 3, 25650),
(4, 4, 4, 18000),
(5, 5, 5, 30000);

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
(12, 'Fabio', 'fabio2023@gmail.com', '$2y$10$K9MMakm9olGj8DwphUUnK.1HBUJikPqnnU4NkJXx3oRQL6JxpD.Zi'),
(13, 'Usuario 13', 'petista@gmail.com', '$2y$10$vBBybbw5nRZs30yTVpNBYeBeBDgyWorKLmpM1su6GkePeJ29GeE22'),
(14, 'Last User', 'theultimateofus2001gamer@gmail.com', '$2y$10$uZwH4imowPA8Xem0LgUJ4eODFUZlOgPkqU6OvWZTbAKloAdhgHlRi');

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
  MODIFY `id_administrativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `configuracao`
--
ALTER TABLE `configuracao`
  MODIFY `id_configuracao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dicas`
--
ALTER TABLE `dicas`
  MODIFY `id_dicas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `energia`
--
ALTER TABLE `energia`
  MODIFY `id_energia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `nivel`
--
ALTER TABLE `nivel`
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `outros_usuario`
--
ALTER TABLE `outros_usuario`
  MODIFY `idOutros_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redesocial`
--
ALTER TABLE `redesocial`
  MODIFY `id_redesocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tabelapontuacao`
--
ALTER TABLE `tabelapontuacao`
  MODIFY `id_tabelapontuacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
