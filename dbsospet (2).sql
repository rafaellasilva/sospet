-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2021 at 12:36 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsospet`
--
CREATE DATABASE IF NOT EXISTS `dbsospet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dbsospet`;

-- --------------------------------------------------------

--
-- Table structure for table `adocao_ong`
--

CREATE TABLE `adocao_ong` (
  `codigo_doacao_ong` int(11) NOT NULL,
  `nome_pet` varchar(40) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `observacoes` varchar(500) DEFAULT NULL,
  `fk_codigo_ong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `desaparecidos`
--

CREATE TABLE `desaparecidos` (
  `codigo_desaparecido` int(11) NOT NULL,
  `nome_desaparecido` varchar(40) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `observacoes` varchar(400) DEFAULT NULL,
  `fk_desaparecidos_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ong_doadores`
--

CREATE TABLE `ong_doadores` (
  `codigo_ong` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cpf` varchar(18) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `rua` varchar(80) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cep` varchar(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(64) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `codigo_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(80) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(64) DEFAULT NULL,
  `cpf` varchar(18) DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `rua` varchar(80) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cep` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_adota`
--

CREATE TABLE `usuario_adota` (
  `fk_codigo_ong` int(11) DEFAULT NULL,
  `fk_codigo_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adocao_ong`
--
ALTER TABLE `adocao_ong`
  ADD PRIMARY KEY (`codigo_doacao_ong`),
  ADD KEY `fk_cod_ong` (`fk_codigo_ong`);

--
-- Indexes for table `desaparecidos`
--
ALTER TABLE `desaparecidos`
  ADD PRIMARY KEY (`codigo_desaparecido`),
  ADD KEY `fk_desaparecidos_usuario` (`fk_desaparecidos_usuario`);

--
-- Indexes for table `ong_doadores`
--
ALTER TABLE `ong_doadores`
  ADD PRIMARY KEY (`codigo_ong`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `usuario_adota`
--
ALTER TABLE `usuario_adota`
  ADD KEY `fk_codigo_ong` (`fk_codigo_ong`),
  ADD KEY `fk_codigo_usuario` (`fk_codigo_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adocao_ong`
--
ALTER TABLE `adocao_ong`
  MODIFY `codigo_doacao_ong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desaparecidos`
--
ALTER TABLE `desaparecidos`
  MODIFY `codigo_desaparecido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ong_doadores`
--
ALTER TABLE `ong_doadores`
  MODIFY `codigo_ong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adocao_ong`
--
ALTER TABLE `adocao_ong`
  ADD CONSTRAINT `adocao_ong_ibfk_1` FOREIGN KEY (`fk_codigo_ong`) REFERENCES `ong_doadores` (`codigo_ong`);

--
-- Constraints for table `desaparecidos`
--
ALTER TABLE `desaparecidos`
  ADD CONSTRAINT `desaparecidos_ibfk_1` FOREIGN KEY (`fk_desaparecidos_usuario`) REFERENCES `usuario` (`codigo_usuario`);

--
-- Constraints for table `usuario_adota`
--
ALTER TABLE `usuario_adota`
  ADD CONSTRAINT `usuario_adota_ibfk_1` FOREIGN KEY (`fk_codigo_ong`) REFERENCES `ong_doadores` (`codigo_ong`),
  ADD CONSTRAINT `usuario_adota_ibfk_2` FOREIGN KEY (`fk_codigo_usuario`) REFERENCES `usuario` (`codigo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
