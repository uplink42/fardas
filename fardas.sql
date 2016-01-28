-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2016 at 10:47 AM
-- Server version: 5.6.26-log
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fardas`
--

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `iddepartamentos` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `historico3`
--
CREATE TABLE IF NOT EXISTS `historico3` (
`pessoal` varchar(45)
,`farda` varchar(45)
,`movimento` enum('Entrada','Saida')
,`quantidade_mov` int(3)
,`data` datetime
,`notas` varchar(100)
,`departamento` varchar(45)
,`idlog` int(11)
,`idusers` int(11)
,`idroupa` int(11)
,`iddepartamentos` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `idlog` int(11) NOT NULL,
  `users_idusers` int(11) NOT NULL,
  `roupas_idroupa` int(11) NOT NULL,
  `movimento` enum('Entrada','Saida') NOT NULL,
  `quantidade_mov` int(3) NOT NULL,
  `data` datetime NOT NULL,
  `notas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roupas`
--

CREATE TABLE IF NOT EXISTS `roupas` (
  `idroupa` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `departamentos_iddepartamentos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `departamentos_iddepartamentos` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users_has_roupas`
--

CREATE TABLE IF NOT EXISTS `users_has_roupas` (
  `users_idusers` int(11) NOT NULL,
  `roupas_idroupa` int(11) NOT NULL,
  `quantidade` int(2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `historico3`
--
DROP TABLE IF EXISTS `historico3`;

CREATE ALGORITHM=UNDEFINED DEFINER=`uplink`@`localhost` SQL SECURITY DEFINER VIEW `historico3` AS select `users`.`nome` AS `pessoal`,`roupas`.`nome` AS `farda`,`log`.`movimento` AS `movimento`,`log`.`quantidade_mov` AS `quantidade_mov`,`log`.`data` AS `data`,`log`.`notas` AS `notas`,`departamentos`.`nome` AS `departamento`,`log`.`idlog` AS `idlog`,`users`.`idusers` AS `idusers`,`roupas`.`idroupa` AS `idroupa`,`departamentos`.`iddepartamentos` AS `iddepartamentos` from (((`users` join `roupas`) join `log`) join `departamentos`) where ((`log`.`users_idusers` = `users`.`idusers`) and (`log`.`roupas_idroupa` = `roupas`.`idroupa`) and (`users`.`departamentos_iddepartamentos` = `departamentos`.`iddepartamentos`)) order by `log`.`data` desc;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`iddepartamentos`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_log_roupas1_idx` (`roupas_idroupa`),
  ADD KEY `fk_log_users1_idx` (`users_idusers`);

--
-- Indexes for table `roupas`
--
ALTER TABLE `roupas`
  ADD PRIMARY KEY (`idroupa`),
  ADD KEY `fk_roupas_departamentos1_idx` (`departamentos_iddepartamentos`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`),
  ADD KEY `fk_users_departamentos1_idx` (`departamentos_iddepartamentos`);

--
-- Indexes for table `users_has_roupas`
--
ALTER TABLE `users_has_roupas`
  ADD PRIMARY KEY (`users_idusers`,`roupas_idroupa`),
  ADD KEY `fk_users_has_roupas_roupas1_idx` (`roupas_idroupa`),
  ADD KEY `fk_users_has_roupas_users1_idx` (`users_idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `iddepartamentos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `roupas`
--
ALTER TABLE `roupas`
  MODIFY `idroupa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=167;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_roupas1` FOREIGN KEY (`roupas_idroupa`) REFERENCES `roupas` (`idroupa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roupas`
--
ALTER TABLE `roupas`
  ADD CONSTRAINT `fk_roupas_departamentos1` FOREIGN KEY (`departamentos_iddepartamentos`) REFERENCES `departamentos` (`iddepartamentos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_departamentos1` FOREIGN KEY (`departamentos_iddepartamentos`) REFERENCES `departamentos` (`iddepartamentos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_has_roupas`
--
ALTER TABLE `users_has_roupas`
  ADD CONSTRAINT `fk_users_has_roupas_roupas1` FOREIGN KEY (`roupas_idroupa`) REFERENCES `roupas` (`idroupa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_roupas_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
