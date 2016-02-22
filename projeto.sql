-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22-Fev-2016 às 19:08
-- Versão do servidor: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `codCliente` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `dtNascimento` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `celular` varchar(11) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `codEndereco` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codCliente`, `nome`, `dtNascimento`, `email`, `telefone`, `celular`, `matricula`, `codEndereco`, `codUsuario`) VALUES
(1, 'Leonardo Moreira Leite de Almeida', '1991-06-17', 'leo_m_l@hotmail.com', '2433220429', '24999924391', '430909', 1, 1),
(2, 'Alexandre dos Santos Pinheiro Jr', '1990-01-16', 'pinalex@icloud.com', '2433234543', '24993457698', '4354909', 2, 2),
(3, 'Magda Moreira Leite', '1958-02-17', 'mmoreiraleite@uol.com.br', '2433234161', '24999031727', '345687', 3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `codEndereco` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(6) NOT NULL,
  `complemento` varchar(10) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cep` varchar(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`codEndereco`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(1, 'Rua Barão de Guapi', '200', 'Apt 302', 'Centro', 'Barra Mansa', 'RJ', '27345040'),
(2, 'Rua Ildefonso Cunha', '220', 'Apt 101', 'Verbo Divino', 'Barra Mansa', 'RJ', '27345340'),
(3, 'Avenida Joaquim Leite', '605', '', 'Centro', 'Barra Mansa', 'RJ', '27345391');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codUsuario` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `senha` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codUsuario`, `login`, `senha`) VALUES
(1, 'leo_almeida', 'leonard0'),
(2, 'pinalex', 'ale02'),
(3, 'mmoreiraleite', 'alicia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codEndereco`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `codEndereco` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
