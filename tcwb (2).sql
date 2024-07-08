-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/06/2024 às 23:48
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
-- Banco de dados: `tcwb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id_arquivo` int(5) NOT NULL,
  `id_evento` int(5) NOT NULL,
  `nm_titulo` varchar(150) NOT NULL,
  `ds_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `arquivos`
--

INSERT INTO `arquivos` (`id_arquivo`, `id_evento`, `nm_titulo`, `ds_url`) VALUES
(3, 9, 'Teste', 'arquivos/banner_jao.png'),
(4, 10, 'RED HOT CHILI PEPPERS', 'arquivos/banner_redhot.png'),
(5, 7, 'Evanescence', 'arquivos/banner_evanescence.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(4) NOT NULL,
  `nm_evento` varchar(150) NOT NULL,
  `dt_evento` datetime NOT NULL,
  `ds_evento` varchar(500) NOT NULL,
  `nr_cep` char(8) NOT NULL,
  `nm_rua` varchar(30) NOT NULL,
  `ds_numero` varchar(10) NOT NULL,
  `nm_cidade` varchar(30) NOT NULL,
  `nm_bairro` varchar(30) NOT NULL,
  `nm_estado` varchar(30) NOT NULL,
  `nm_estabelecimento` varchar(100) NOT NULL,
  `ds_complemento` varchar(100) NOT NULL,
  `id_organizador` int(4) NOT NULL,
  `ds_status_evt` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `eventos`
--

INSERT INTO `eventos` (`id_evento`, `nm_evento`, `dt_evento`, `ds_evento`, `nr_cep`, `nm_rua`, `ds_numero`, `nm_cidade`, `nm_bairro`, `nm_estado`, `nm_estabelecimento`, `ds_complemento`, `id_organizador`, `ds_status_evt`) VALUES
(7, 'Evanescence', '2024-06-30 21:00:00', 'EVANESCENCE NO BRASIL!', '83411-61', 'Rua da Bromélia', '150', 'Colombo', 'São Dimas', 'PR', 'Estadio', 'Estadio', 4, 1),
(9, 'JÃO', '2024-06-27 21:00:00', 'JÃO EM CURITIBA!', ' 81050-0', 'R. Itajubá', '143', 'Curitiba', 'Novo Mundo', 'Paraná', 'Live Curitiba', '', 4, 1),
(10, 'RED HOT CHILI PEPPERS', '2024-07-01 18:41:41', 'RED HOT CHILI PEPPERS TRAZ SUA UNLIMITED LOVE TOUR PARA CINCO CIDADES DO BRASIL EM 2024', '80060-19', 'Rua Ubaldino do Amaral', '37', 'Curitiba', 'Alto da Glória', 'PR', 'Estádio Couto Pereira ', '', 4, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `financeiros`
--

CREATE TABLE `financeiros` (
  `id_financeiro` int(3) NOT NULL,
  `nr_conta` varchar(30) NOT NULL,
  `nr_digito` varchar(5) NOT NULL,
  `nr_agencia` varchar(10) NOT NULL,
  `nr_cnpj` char(14) NOT NULL,
  `nm_titular` varchar(50) NOT NULL,
  `id_organizador` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `financeiros`
--

INSERT INTO `financeiros` (`id_financeiro`, `nr_conta`, `nr_digito`, `nr_agencia`, `nr_cnpj`, `nm_titular`, `id_organizador`) VALUES
(1, '', '8', '2035', '58159595000103', 'Associação de Eventos LTDA', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingressos`
--

CREATE TABLE `ingressos` (
  `id_ingresso` int(4) NOT NULL,
  `dt_liberacao` date NOT NULL,
  `dt_encerramento` date NOT NULL,
  `ds_tipo` varchar(30) NOT NULL,
  `vl_ingresso` int(10) NOT NULL,
  `qt_ingresso` int(10) NOT NULL,
  `vl_meia` int(10) NOT NULL,
  `qt_meia` int(10) NOT NULL,
  `id_evento` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ingressos`
--

INSERT INTO `ingressos` (`id_ingresso`, `dt_liberacao`, `dt_encerramento`, `ds_tipo`, `vl_ingresso`, `qt_ingresso`, `vl_meia`, `qt_meia`, `id_evento`) VALUES
(8, '2024-12-01', '2025-03-01', 'PISTA', 226, 100, 113, 50, 10),
(9, '2024-12-01', '2025-03-01', 'PISTA PREMIUM', 450, 100, 225, 500, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `organizadores`
--

CREATE TABLE `organizadores` (
  `id_organizador` int(4) NOT NULL,
  `nm_organizador` varchar(30) NOT NULL,
  `ds_email` varchar(50) NOT NULL,
  `ds_senha` varchar(50) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `nr_telefone` char(11) NOT NULL,
  `nr_cnpj` char(14) NOT NULL,
  `nr_cep` char(8) NOT NULL,
  `nm_estado` varchar(30) NOT NULL,
  `nm_cidade` varchar(30) NOT NULL,
  `nm_rua` varchar(30) NOT NULL,
  `ds_numero` varchar(10) NOT NULL,
  `nm_bairro` varchar(30) NOT NULL,
  `ds_status_cad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `organizadores`
--

INSERT INTO `organizadores` (`id_organizador`, `nm_organizador`, `ds_email`, `ds_senha`, `dt_nascimento`, `nr_telefone`, `nr_cnpj`, `nr_cep`, `nm_estado`, `nm_cidade`, `nm_rua`, `ds_numero`, `nm_bairro`, `ds_status_cad`) VALUES
(3, 'teste', 'teste@teste.com.br', 'e10adc3949ba59abbe56', '2000-01-01', '44444444444', '1112200012', '80230-03', 'PR', 'Curitiba', 'Avenida Presidente Getúlio Var', '20', 'Rebouças', 1),
(4, 'Laura da Silva', 'organizador@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1980-02-12', '41984475248', '', '82820150', 'PR', 'Curitiba', 'Rua Coronel Domingos Soares', '100', 'Bairro Alto', 1),
(7, 'Sandro Drumom', 'eventos@hotmail.com', '094519c5ca6face260bf6c656bba0622', '1955-02-01', '41966552233', '86126810000104', '83703-33', 'PR', 'Araucária', 'Rodovia BR-476', '863', 'Fazenda Velha', 1),
(9, 'Adm', 'adm@adm.com', 'e10adc3949ba59abbe56e057f20f883e', '1999-11-09', '4198888888', '00000000000', '00000000', '000000000', '0000000000', '000000000', '0000000', '0000000', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id_pagamento` int(4) NOT NULL,
  `ds_forma_pgto` varchar(30) NOT NULL,
  `vl_pgto` int(4) NOT NULL,
  `dt_pgto` date NOT NULL,
  `ds_status_pgto` varchar(50) NOT NULL,
  `id_pedidos` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedidos` int(4) NOT NULL,
  `dt_pedido` date NOT NULL,
  `ds_status` varchar(50) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `id_ingresso` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(4) NOT NULL,
  `nm_usuario` varchar(100) NOT NULL,
  `ds_email` varchar(60) NOT NULL,
  `ds_senha` varchar(50) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `nr_telefone` char(11) NOT NULL,
  `nr_cpf` char(11) NOT NULL,
  `nr_cep` char(8) NOT NULL,
  `nm_estado` varchar(30) NOT NULL,
  `nm_cidade` varchar(30) NOT NULL,
  `nm_bairro` varchar(30) NOT NULL,
  `nm_rua` varchar(30) NOT NULL,
  `ds_numero` varchar(10) NOT NULL,
  `ds_status_cad` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nm_usuario`, `ds_email`, `ds_senha`, `dt_nascimento`, `nr_telefone`, `nr_cpf`, `nr_cep`, `nm_estado`, `nm_cidade`, `nm_bairro`, `nm_rua`, `ds_numero`, `ds_status_cad`) VALUES
(8, 'Pamela Maria', 'pamela@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1999-11-01', '4198888888', '1115557778', '83304150', 'PR', 'Piraquara', 'Vila Susi', 'Rua Alexandre Brasil', '110', 1),
(9, 'Pamela Maria dos Santos Cataruti', 'pamelacantaruti@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1999-11-22', '41999999999', 'Pamela Mari', '83304150', 'PR', 'Piraquara', 'Vila Susi', 'Rua Alexandre Brasil', '100', 1),
(10, 'Lena Helena', 'lena@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1988-05-13', '41996562352', '15728365498', '80230-01', 'PR', 'Curitiba', 'Rebouças', 'Avenida Sete de Setembro', '110', 1),
(11, 'Renan da Silca', 'renan@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2003-06-24', '41988662352', '14796325866', '82810-78', 'PR', 'Curitiba', 'Capão da Imbuia', 'Rua Antonina Brasil dos Reis', '03', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id_arquivo`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_organizador` (`id_organizador`);

--
-- Índices de tabela `financeiros`
--
ALTER TABLE `financeiros`
  ADD PRIMARY KEY (`id_financeiro`),
  ADD KEY `id_organizador` (`id_organizador`);

--
-- Índices de tabela `ingressos`
--
ALTER TABLE `ingressos`
  ADD PRIMARY KEY (`id_ingresso`),
  ADD KEY `id_eventos` (`id_evento`);

--
-- Índices de tabela `organizadores`
--
ALTER TABLE `organizadores`
  ADD PRIMARY KEY (`id_organizador`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id_pagamento`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedidos`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_ingresso` (`id_ingresso`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id_arquivo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `financeiros`
--
ALTER TABLE `financeiros`
  MODIFY `id_financeiro` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ingressos`
--
ALTER TABLE `ingressos`
  MODIFY `id_ingresso` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `organizadores`
--
ALTER TABLE `organizadores`
  MODIFY `id_organizador` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id_pagamento` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedidos` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `arquivos`
--
ALTER TABLE `arquivos`
  ADD CONSTRAINT `arquivos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_organizador`) REFERENCES `organizadores` (`id_organizador`);

--
-- Restrições para tabelas `financeiros`
--
ALTER TABLE `financeiros`
  ADD CONSTRAINT `id_organizador` FOREIGN KEY (`id_organizador`) REFERENCES `organizadores` (`id_organizador`);

--
-- Restrições para tabelas `ingressos`
--
ALTER TABLE `ingressos`
  ADD CONSTRAINT `ingressos_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_ingresso`) REFERENCES `ingressos` (`id_ingresso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
