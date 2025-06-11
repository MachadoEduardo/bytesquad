-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/06/2025 às 00:59
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

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AtualizarUsuario` (IN `p_id` INT, IN `p_nome` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_senha` VARCHAR(255), IN `p_permissoes_usuario` VARCHAR(50), IN `p_ativo_usuario` TINYINT, IN `p_url_foto` VARCHAR(255), IN `p_telefone` VARCHAR(20), IN `p_id_redesocial` INT)   BEGIN
    -- Atualiza os dados do usuário na tabela
    UPDATE usuario
    SET 
        nome_usuario = p_nome,
        email_usuario = p_email,
        senha_usuario = p_senha,
        permissoes_usuario = p_permissoes_usuario,
        ativo_usuario = p_ativo_usuario,
        url_foto = p_url_foto,
        telefone = p_telefone,
        id_redesocial = p_id_redesocial
    WHERE id = p_id;
    
    -- Opcionalmente, você pode adicionar algum tipo de verificação ou mensagem
    -- Caso você queira garantir que o usuário foi atualizado corretamente
    -- Por exemplo, verificando se a atualização afetou alguma linha:
    
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Erro: Nenhum usuário encontrado com o ID fornecido';
    END IF;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarUsuario` (IN `p_id` INT)   BEGIN
    SELECT * FROM usuario WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ExcluirUsuario` (IN `p_id` INT)   BEGIN
    DELETE FROM usuario WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InserirUsuario` (IN `p_nome_usuario` VARCHAR(255), IN `p_email_usuario` VARCHAR(255), IN `p_senha_usuario` VARCHAR(255), IN `p_permissoes_usuario` VARCHAR(255), IN `p_ativo_usuario` TINYINT, IN `p_url_foto` VARCHAR(255), IN `p_telefone` VARCHAR(20), IN `p_id_redesocial` INT)   BEGIN
    INSERT INTO usuario (
        nome_usuario, 
        email_usuario, 
        senha_usuario, 
        permissoes_usuario, 
        ativo_usuario, 
        url_foto, 
        telefone, 
        id_redesocial
    )
    VALUES (
        p_nome_usuario, 
        p_email_usuario, 
        p_senha_usuario, 
        p_permissoes_usuario, 
        p_ativo_usuario, 
        p_url_foto, 
        p_telefone, 
        p_id_redesocial
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarJoinRedeSocial` ()   SELECT redesocial.id_redesocial FROM usuario JOIN redesocial ON usuario.id = redesocial.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarUsuario` ()   SELECT * FROM usuario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrativo`
--

CREATE TABLE `administrativo` (
  `id_administrativo` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha_admin` varchar(500) NOT NULL,
  `permissoes_admin` text NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrativo`
--

INSERT INTO `administrativo` (`id_administrativo`, `usuario`, `senha_admin`, `permissoes_admin`, `email`) VALUES
(1, 'Machado', '$2y$10$V18ZXYVHEIIVxNxEJRHC9u1mxgEoRm9kXYwoafZtOT7xpzzDePEmG', 'ADD, EDIT, DELETE, READ, SUPER', 'testedev@gmail.com'),
(3, 'Luis Camargo', '$2y$10$Rspu9.SWBU5klEdzzgTHAeVuSdMTX5131JJB1hsTQdeD9pY6dZG9O', 'SUPER, READ', NULL),
(4, 'Vinicios Vaz', '$2y$10$KCFUGxqVOtUzlFwwbZ2ESOJXDeUhKeb7Leguog.0XTA4wUyxZRnAW', 'DELETE', NULL),
(5, 'Alysson Gabriel', '$2y$10$qn1MGxPvWNhUyNM8RRPts.ZSWnoMbI.UZ.rXCgPPrzIMquOA.CQyi', 'CREATE', NULL),
(6, 'Luiz Cezar', '$2y$10$XKxwvMm0dKpPxeIReqegv.HM/EYGHjTZsV.PB0OHnfkZNPnmjDAeq', 'ADD, EDIT', NULL);

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
(1, 'Boleto', 239, '01/02/2023', 2),
(2, 'Cartão de débito', 79.9, '23/06/2022', 4),
(3, 'Cartão de crédito', 14.9, '26/05/2024', 1),
(4, 'Dinheiro', 32.9, '31/08/2024', 3),
(6, 'Pix', 480.5, '10/10/2024', 1);

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
(1, 'Pacote SUPER', 29.99, 40, 5),
(3, 'Pacote MINI', 5.99, 5, 2),
(4, 'Pacote STANDART', 17.9, 18, 4),
(5, 'Pacote POOR', 2.9, 2, 1),
(6, 'Pacote ELON MUSK', 99.9, 130, 1);

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
(1, 3, 40, 30, 29.9, 'Pacote STANDART'),
(2, 5, 80, 30, 59.9, 'Pacote SUPER'),
(3, 2, 20, 30, 14.9, 'Pacote SMALL'),
(4, 4, 10, 30, 7.9, 'Pacote MINI'),
(5, 1, 160, 30, 119.9, 'Pacote OMEGA');

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
  `id_administrativo` int(11) DEFAULT NULL,
  `xp_necessario` int(11) DEFAULT NULL,
  `nivel_requerido` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `nivel`
--

INSERT INTO `nivel` (`id_nivel`, `nome_nivel`, `tempo_nivel`, `dificuldade`, `id_administrativo`, `xp_necessario`, `nivel_requerido`) VALUES
(1, 'Nivel 1', 10, 'Fácil', 1, NULL, 1),
(2, 'Nivel 2', 20, 'Médio', 6, NULL, 1),
(3, 'Nivel 3', 30, 'Dificil', 4, NULL, 1),
(4, 'Nível 4', 20, 'Média', 5, NULL, 1),
(5, 'Nível 5', 45, 'Extrema', 3, NULL, 1),
(6, 'Introdução', 0, 'iniciante', NULL, 100, 1),
(7, 'Variáveis', 0, 'iniciante', NULL, 200, 1),
(8, 'POO Básico', 0, 'intermediario', NULL, 500, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `id_pergunta` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `texto_pergunta` text NOT NULL,
  `tipo_pergunta` varchar(50) DEFAULT 'multipla_escolha',
  `ordem` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pergunta`
--

INSERT INTO `pergunta` (`id_pergunta`, `id_nivel`, `texto_pergunta`, `tipo_pergunta`, `ordem`) VALUES
(1, 1, 'Quantas horas tem um dia?', 'multipla_escolha', 1),
(2, 1, 'Qual é a capital do Brasil?', 'multipla_escolha', 2),
(3, 2, 'De quem é a famosa frase “Penso, logo existo”?', 'multipla_escolha', 1),
(4, 2, 'Qual o maior planeta do sistema solar?', 'multipla_escolha', 2),
(5, 3, 'Atualmente, quantos elementos químicos a tabela periódica possui?', 'multipla_escolha', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `redesocial`
--

CREATE TABLE `redesocial` (
  `id_redesocial` int(11) NOT NULL,
  `credenciais_redesocial` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `redesocial`
--

INSERT INTO `redesocial` (`id_redesocial`, `credenciais_redesocial`, `id`) VALUES
(1, '{\r\n 	\"id\": 1,\r\n    \"user\": \"Morpheush\",\r\n    \"email\": \"anyuser@gmail.com\",\r\n    \"password\": \"4jh43gvf9g722lhbd2otd\",\r\n    \"createdAt\": \"2020-02-20T11:00:28.107Z\"\r\n}', 1),
(2, '{\r\n 	\"id\": 2,\r\n    \"user\": \"Chris\",\r\n    \"email\": \"otheruser@gmail.com\",\r\n    \"password\": \"no32o83vrub87r73g9\",\r\n    \"createdAt\": \"2023-09-10T01:00:58.107Z\"\r\n}', 2),
(3, '{ \"id\": 3, \"user\": \"Bob\", \"email\": \"bob@example.com\", \"password\": \"securepass\", \"createdAt\": \"2023-09-15T08:30:00.000Z\" }', 3),
(4, '{ \"id\": 4, \"user\": \"Diana\", \"email\": \"diana@example.com\", \"password\": \"mypassword\", \"createdAt\": \"2023-09-20T14:45:00.000Z\" }', 4),
(5, '{ \"id\": 5, \"user\": \"Eve\", \"email\": \"eve@example.com\", \"password\": \"eve12345\", \"createdAt\": \"2023-09-25T19:15:00.000Z\" }', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `resposta`
--

CREATE TABLE `resposta` (
  `id_resposta` int(11) NOT NULL,
  `id_pergunta` int(11) NOT NULL,
  `texto_resposta` varchar(300) NOT NULL,
  `correta` tinyint(1) DEFAULT 0,
  `ordem` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `resposta`
--

INSERT INTO `resposta` (`id_resposta`, `id_pergunta`, `texto_resposta`, `correta`, `ordem`) VALUES
(1, 1, '24', 1, 1),
(2, 1, '12', 0, 2),
(3, 1, '48', 0, 3),
(4, 1, '36', 0, 4),
(5, 2, 'Brasília', 1, 1),
(6, 2, 'Rio de Janeiro', 0, 2),
(7, 2, 'São Paulo', 0, 3),
(8, 2, 'Salvador', 0, 4),
(9, 3, 'Descartes', 1, 1),
(10, 3, 'Sócrates', 0, 2),
(11, 3, 'Platão', 0, 3),
(12, 3, 'Aristóteles', 0, 4),
(13, 4, 'Júpiter', 1, 1),
(14, 4, 'Saturno', 0, 2),
(15, 4, 'Terra', 0, 3),
(16, 4, 'Marte', 0, 4),
(17, 5, '118', 1, 1),
(18, 5, '102', 0, 2),
(19, 5, '120', 0, 3),
(20, 5, '110', 0, 4);

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
  `senha_usuario` varchar(150) NOT NULL,
  `permissoes_usuario` text NOT NULL,
  `ativo_usuario` tinyint(1) NOT NULL,
  `url_foto` varchar(500) DEFAULT NULL,
  `telefone` varchar(40) DEFAULT NULL,
  `id_redesocial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome_usuario`, `email_usuario`, `senha_usuario`, `permissoes_usuario`, `ativo_usuario`, `url_foto`, `telefone`, `id_redesocial`) VALUES
(1, 'Yuri Brita', 'yuri22@gmail.com', '$2y$10$KsDWrepwO0yIVD7XRsaZwuZI5bw.TOzvp9pdMej5V7OrB1HMNPZ72', 'EDIT, READ', 0, 'uploads/foto_681a9442e1b61.jpg', '(57) 91291-3112', 1),
(2, 'Alan Ferreira', 'scardior@gmail.com', '13423', 'EDIT, READ', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7J8JxBrOo56MG1Aoz0ZW_dO782sGYtfO39w&s', '(11) 93285-2431', 1),
(3, 'Casimiro Miguel', 'docase@gmail.com', '32213', 'EDIT, READ', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9jQrqZLS9U0UI9HSHUo4HItFpqZXXFgKBqQ&s', '(41) 99913-0193', 1),
(4, 'Felipe Hayashii', 'kekefefe@gmail.com', '$2y$10$/iMXJh7sUS6CXTK0UMvRce95.NRv9uZdIihXdL.ZuyRXIDZ5KyfoK', 'EDIT, READ', 0, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBafgQHYnWMux_75gtV7XVO3mq3xtHw2xJWw&s', '(41) 91453-0190', 1),
(5, 'Darren Jason', 'ishowmeat@gmail.com', '$2y$10$b52oveb3evDsxHNHrt9FkeVGveU78.Tih96xYSgSqpWZuo5MOr4vK', 'EDIT, READ', 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxnQDYNCDEiKODD95rm0ynBFO4kCaUBegSJA&s', '(00) 99999-9999', 1),
(15, 'Machado', 'xandaottwtv@gmail.com', '123', 'EDIT, READ', 1, 'avatar', '(42) 42919-1293', 1),
(18, 'Narutoooo1', 'uzumaki@gmail.com', '$2y$10$IdY8sDJAMIhNYOFCAAQKhebJ6CORksWSQzxtYk/Mki/J7BAuHyRQe', 'EDIT, READ', 0, '', '(42) 99229-1293', 1),
(20, 'Alyssongamer', 'gamer@gmail.com', '$2y$10$KNFL0/X2EMWRQ7G0i/7gguUg/eLSjusW689UELBSRS36d5CPRO4sy', 'usuario', 1, NULL, NULL, NULL),
(21, 'aly', 'alysson@gmail.com', '$2y$10$L12TCC.J531Kdy1AMKKrLO34qAAxTSqSmcLz1Y8zBqzRQM2uWgQ0G', 'usuario', 1, NULL, NULL, NULL),
(22, 'jogador', 'jogador@gmail.com', '$2y$10$3nbYp0jREqV7sYzv5AfEwuMgnxJkn48sXoo6q.QH4D8DPxa8u.D0u', 'usuario', 1, 'https://media.licdn.com/dms/image/v2/D4D03AQHAwkesFzxCIQ/profile-displayphoto-shrink_800_800/B4DZZf9ZEpGsAc-/0/1745366652448?e=1751500800&v=beta&t=dQpqFFy-yAX7nRrXkUqidbF7SzawIEj_05OIZ4gTeVE', '', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrativo`
--
ALTER TABLE `administrativo`
  ADD PRIMARY KEY (`id_administrativo`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD PRIMARY KEY (`id_nivel`),
  ADD KEY `fk_nivel_administrativo` (`id_administrativo`);

--
-- Índices de tabela `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`id_pergunta`),
  ADD KEY `id_nivel` (`id_nivel`);

--
-- Índices de tabela `redesocial`
--
ALTER TABLE `redesocial`
  ADD PRIMARY KEY (`id_redesocial`);

--
-- Índices de tabela `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`id_resposta`),
  ADD KEY `id_pergunta` (`id_pergunta`);

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
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `id_pergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `redesocial`
--
ALTER TABLE `redesocial`
  MODIFY `id_redesocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `resposta`
--
ALTER TABLE `resposta`
  MODIFY `id_resposta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tabelapontuacao`
--
ALTER TABLE `tabelapontuacao`
  MODIFY `id_tabelapontuacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `nivel`
--
ALTER TABLE `nivel`
  ADD CONSTRAINT `fk_nivel_administrativo` FOREIGN KEY (`id_administrativo`) REFERENCES `administrativo` (`id_administrativo`) ON DELETE SET NULL;

--
-- Restrições para tabelas `pergunta`
--
ALTER TABLE `pergunta`
  ADD CONSTRAINT `pergunta_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id_nivel`) ON DELETE CASCADE;

--
-- Restrições para tabelas `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`id_pergunta`) REFERENCES `pergunta` (`id_pergunta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
