-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Out-2018 às 09:15
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thefixt`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `desenvolvedor`
--

CREATE TABLE `desenvolvedor` (
  `idDev` bigint(20) NOT NULL,
  `nomedev` varchar(50) NOT NULL,
  `projetodev` varchar(50) NOT NULL,
  `salariodev` float NOT NULL,
  `idadedev` int(11) NOT NULL,
  `emaildev` varchar(100) NOT NULL,
  `tipodev` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `gerente`
--

CREATE TABLE `gerente` (
  `idGerente` bigint(20) NOT NULL,
  `nomege` varchar(50) NOT NULL,
  `idadege` int(11) NOT NULL,
  `projresp` varchar(50) NOT NULL,
  `salarioge` float NOT NULL,
  `telefonege` int(11) NOT NULL,
  `emailge` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `gerente`
--

INSERT INTO `gerente` (`idGerente`, `nomege`, `idadege`, `projresp`, `salarioge`, `telefonege`, `emailge`) VALUES
(8, 'Aaaaaaa', 33, 'Aaaaaaaa', 33, 332323, 'aa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `idProj` bigint(20) NOT NULL,
  `nomeproj` varchar(50) NOT NULL,
  `responsavel` varchar(50) NOT NULL,
  `duracao` float NOT NULL,
  `tipoproj` varchar(50) NOT NULL,
  `devproj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` bigint(20) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `login`, `senha`, `tipo`) VALUES
(1, 'gabriel', 'gabriel', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `desenvolvedor`
--
ALTER TABLE `desenvolvedor`
  ADD PRIMARY KEY (`idDev`);

--
-- Indexes for table `gerente`
--
ALTER TABLE `gerente`
  ADD PRIMARY KEY (`idGerente`);

--
-- Indexes for table `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`idProj`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `desenvolvedor`
--
ALTER TABLE `desenvolvedor`
  MODIFY `idDev` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gerente`
--
ALTER TABLE `gerente`
  MODIFY `idGerente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `idProj` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
