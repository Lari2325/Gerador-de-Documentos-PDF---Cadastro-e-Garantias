-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/07/2024 às 19:05
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
-- Banco de dados: `originalpiscinas_certificado`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nome`, `usuario`, `senha`) VALUES
(1, 'Admin 1', 'admin1', 'senha123'),
(2, 'Admin 2', 'admin2', 'senha456'),
(3, 'Admin 3', 'admin3', 'senha789');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` char(2) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `celular_telefone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dt_nascimento` date NOT NULL,
  `estado_civil` varchar(20) NOT NULL,
  `numero_casa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id_cliente`, `nome_completo`, `cpf`, `rg`, `endereco`, `cidade`, `uf`, `cep`, `celular_telefone`, `email`, `dt_nascimento`, `estado_civil`, `numero_casa`) VALUES
(1, 'Cliente 1', '12345678901', 'MG123456', 'Rua 1, 123', 'Cidade A', 'MG', '12345678', '31987654321', 'cliente1@example.com', '1990-01-01', 'Solteiro', '10'),
(2, 'Cliente 2', '23456789012', 'MG234567', 'Rua 2, 234', 'Cidade B', 'SP', '23456789', '31987654322', 'cliente2@example.com', '1991-02-02', 'Casado', '20'),
(3, 'Cliente 3', '34567890123', 'MG345678', 'Rua 3, 345', 'Cidade C', 'RJ', '34567890', '31987654323', 'cliente3@example.com', '1992-03-03', 'Divorciado', '30'),
(4, 'Cliente 4', '45678901234', 'MG456789', 'Rua 4, 456', 'Cidade D', 'BA', '45678901', '31987654324', 'cliente4@example.com', '1993-04-04', 'Viúvo', '40'),
(5, 'Cliente 5', '56789012345', 'MG567890', 'Rua 5, 567', 'Cidade E', 'PR', '56789012', '31987654325', 'cliente5@example.com', '1994-05-05', 'Solteiro', '50'),
(6, 'Cliente 6', '67890123456', 'MG678901', 'Rua 6, 678', 'Cidade F', 'RS', '67890123', '31987654326', 'cliente6@example.com', '1995-06-06', 'Casado', '60'),
(7, 'Cliente 7', '78901234567', 'MG789012', 'Rua 7, 789', 'Cidade G', 'SC', '78901234', '31987654327', 'cliente7@example.com', '1996-07-07', 'Divorciado', '70'),
(8, 'Cliente 8', '89012345678', 'MG890123', 'Rua 8, 890', 'Cidade H', 'GO', '89012345', '31987654328', 'cliente8@example.com', '1997-08-08', 'Viúvo', '80'),
(9, 'Cliente 9', '90123456789', 'MG901234', 'Rua 9, 901', 'Cidade I', 'DF', '90123456', '31987654329', 'cliente9@example.com', '1998-09-09', 'Solteiro', '90'),
(10, 'Cliente 10', '01234567890', 'MG012345', 'Rua 10, 012', 'Cidade J', 'AM', '01234567', '31987654330', 'cliente10@example.com', '1999-10-10', 'Casado', '100');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_documento`
--

CREATE TABLE `tb_documento` (
  `id_documento` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  `data_instalacao` date NOT NULL,
  `numero_garantia` varchar(50) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_revendedor` int(11) NOT NULL,
  `id_piscina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_documento`
--

INSERT INTO `tb_documento` (`id_documento`, `data_compra`, `data_instalacao`, `numero_garantia`, `id_cliente`, `id_revendedor`, `id_piscina`) VALUES
(1, '2024-01-01', '2024-01-05', 'G123456', 1, 1, 1),
(2, '2024-02-01', '2024-02-05', 'G234567', 2, 2, 2),
(3, '2024-03-01', '2024-03-05', 'G345678', 3, 3, 3),
(4, '2024-04-01', '2024-04-05', 'G456789', 4, 4, 4),
(5, '2024-05-01', '2024-05-05', 'G567890', 5, 5, 5),
(6, '2024-06-01', '2024-06-05', 'G678901', 6, 6, 6),
(7, '2024-07-01', '2024-07-05', 'G789012', 7, 7, 7),
(8, '2024-08-01', '2024-08-05', 'G890123', 8, 8, 8),
(9, '2024-09-01', '2024-09-05', 'G901234', 9, 9, 9),
(10, '2024-10-01', '2024-10-05', 'G012345', 10, 10, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_piscina`
--

CREATE TABLE `tb_piscina` (
  `id_piscina` int(11) NOT NULL,
  `modelo_piscina` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_piscina`
--

INSERT INTO `tb_piscina` (`id_piscina`, `modelo_piscina`) VALUES
(1, 'Modelo A'),
(2, 'Modelo B'),
(3, 'Modelo C'),
(4, 'Modelo D'),
(5, 'Modelo E'),
(6, 'Modelo F'),
(7, 'Modelo G'),
(8, 'Modelo H'),
(9, 'Modelo I'),
(10, 'Modelo J');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_revendedor`
--

CREATE TABLE `tb_revendedor` (
  `id_revendedor` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_revendedor`
--

INSERT INTO `tb_revendedor` (`id_revendedor`, `nome`) VALUES
(1, 'Revendedor A'),
(2, 'Revendedor B'),
(3, 'Revendedor C'),
(4, 'Revendedor D'),
(5, 'Revendedor E'),
(6, 'Revendedor F'),
(7, 'Revendedor G'),
(8, 'Revendedor H'),
(9, 'Revendedor I'),
(10, 'Revendedor J');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `rg` (`rg`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `tb_documento`
--
ALTER TABLE `tb_documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_revendedor` (`id_revendedor`),
  ADD KEY `id_piscina` (`id_piscina`);

--
-- Índices de tabela `tb_piscina`
--
ALTER TABLE `tb_piscina`
  ADD PRIMARY KEY (`id_piscina`);

--
-- Índices de tabela `tb_revendedor`
--
ALTER TABLE `tb_revendedor`
  ADD PRIMARY KEY (`id_revendedor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_documento`
--
ALTER TABLE `tb_documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_piscina`
--
ALTER TABLE `tb_piscina`
  MODIFY `id_piscina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_revendedor`
--
ALTER TABLE `tb_revendedor`
  MODIFY `id_revendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_documento`
--
ALTER TABLE `tb_documento`
  ADD CONSTRAINT `tb_documento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_cliente` (`id_cliente`),
  ADD CONSTRAINT `tb_documento_ibfk_2` FOREIGN KEY (`id_revendedor`) REFERENCES `tb_revendedor` (`id_revendedor`),
  ADD CONSTRAINT `tb_documento_ibfk_3` FOREIGN KEY (`id_piscina`) REFERENCES `tb_piscina` (`id_piscina`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
