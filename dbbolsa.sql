-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Generation Time: 23-Jul-2024 às 14:29
-- Versão do servidor: 5.6.36-82.0-log
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE dbbolsa;
USE dbbolsa;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbolsa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbacoes`
--

CREATE TABLE `tbacoes` (
  `idacao` int(11) NOT NULL,
  `nome` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `ticker` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `valor` float NOT NULL,
  `situacao` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `logo` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tbacoes`
--

INSERT INTO `tbacoes` (`idacao`, `nome`, `ticker`, `valor`, `situacao`, `logo`) VALUES
(1, 'BLUE STORM', 'BLUE7', 10, 'Estável', 'BlueStorm.jpg'),
(2, 'OLCIC', 'OLCI5', 10, 'Estável', 'Olcic.jpg'),
(3, 'PRIN ACADEMY', 'PRIN7', 10, 'Estável', 'Prin.jpg'),
(4, 'RENEW', 'RENW9', 10, 'Estável', 'Renew.jpg'),
(6, 'SPORTPLACE', 'STPL7', 10, 'Estável', 'SportPlace.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbbolsa`
--

CREATE TABLE `tbbolsa` (
  `idbolsa` int(11) NOT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `dinheiro` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tbbolsa`
--

INSERT INTO `tbbolsa` (`idbolsa`, `email`, `dinheiro`) VALUES
(249, 'zzbrenozz9@gmail.com', 500),
(250, 'notzeu@gmail.com', 500),
(251, 'gabrielsouzasantana2@gmail.com', 500),
(252, 'Guigomesan@gmail.com', 500),
(253, 'jvdbraganca@gmail.com', 500),
(254, 'juoli482@gmail.com', 500),
(255, 'matheus.limajunger@gmail.com', 500),
(256, 'natanalmeida817@gmail.com', 500),
(257, 'menezesnathan61@gmail.com', 500),
(258, 'pedrohneg@gmail.com', 500),
(259, 'samuelseguins@gmail.com', 500),
(260, 'sophia.c.sodre@hotmail.com', 500),
(261, 'tc6445770@gmail.com', 500),
(262, 'moreiravinicius116@gmail.com', 500),
(263, 'vitorsenna13@gmail.com', 500),
(264, 'walssimon123@gmail.com', 500),
(265, 'yasminmartinsibra@gmail.com', 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbnegociacao`
--

CREATE TABLE `tbnegociacao` (
  `idnegociacao` int(11) NOT NULL,
  `iduser` int(7) NOT NULL,
  `idacao` int(3) NOT NULL,
  `valor` float NOT NULL,
  `acoes` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operacao` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbposse`
--

CREATE TABLE `tbposse` (
  `idposse` int(11) NOT NULL,
  `iduser` int(7) NOT NULL,
  `idacao` int(3) NOT NULL,
  `qtd` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpregao`
--

CREATE TABLE `tbpregao` (
  `idpregao` int(11) NOT NULL,
  `situacao` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tbpregao`
--

INSERT INTO `tbpregao` (`idpregao`, `situacao`) VALUES
(1, 'ABERTO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbacoes`
--
ALTER TABLE `tbacoes`
  ADD PRIMARY KEY (`idacao`);

--
-- Indexes for table `tbbolsa`
--
ALTER TABLE `tbbolsa`
  ADD PRIMARY KEY (`idbolsa`);

--
-- Indexes for table `tbnegociacao`
--
ALTER TABLE `tbnegociacao`
  ADD PRIMARY KEY (`idnegociacao`);

--
-- Indexes for table `tbposse`
--
ALTER TABLE `tbposse`
  ADD PRIMARY KEY (`idposse`);

--
-- Indexes for table `tbpregao`
--
ALTER TABLE `tbpregao`
  ADD PRIMARY KEY (`idpregao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbacoes`
--
ALTER TABLE `tbacoes`
  MODIFY `idacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbbolsa`
--
ALTER TABLE `tbbolsa`
  MODIFY `idbolsa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `tbnegociacao`
--
ALTER TABLE `tbnegociacao`
  MODIFY `idnegociacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2479;

--
-- AUTO_INCREMENT for table `tbposse`
--
ALTER TABLE `tbposse`
  MODIFY `idposse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=670;

--
-- AUTO_INCREMENT for table `tbpregao`
--
ALTER TABLE `tbpregao`
  MODIFY `idpregao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
