-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2019 at 02:37 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poker`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartes`
--

CREATE TABLE `cartes` (
  `id_cartes` int(10) UNSIGNED NOT NULL,
  `couleur` tinyint(1) NOT NULL,
  `figure` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cartes`
--

INSERT INTO `cartes` (`id_cartes`, `couleur`, `figure`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 2, 1),
(14, 2, 2),
(15, 2, 3),
(16, 2, 4),
(17, 2, 5),
(18, 2, 6),
(19, 2, 7),
(20, 2, 8),
(21, 2, 9),
(22, 2, 10),
(23, 2, 11),
(24, 2, 12),
(25, 3, 1),
(26, 3, 2),
(27, 3, 3),
(28, 3, 4),
(29, 3, 5),
(30, 3, 6),
(31, 3, 7),
(32, 3, 8),
(33, 3, 9),
(34, 3, 10),
(35, 3, 11),
(36, 3, 12),
(37, 4, 1),
(38, 4, 2),
(39, 4, 3),
(40, 4, 4),
(41, 4, 5),
(42, 4, 6),
(43, 4, 7),
(44, 4, 8),
(45, 4, 9),
(46, 4, 10),
(47, 4, 11),
(48, 4, 12),
(49, 1, 13),
(50, 2, 13),
(51, 3, 13),
(52, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `donnes`
--

CREATE TABLE `donnes` (
  `id_utilisateurs` int(10) UNSIGNED NOT NULL,
  `id_parties` int(10) UNSIGNED NOT NULL,
  `mise` int(11) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `id_carte1` int(10) UNSIGNED NOT NULL,
  `id_carte2` int(10) UNSIGNED NOT NULL,
  `ordre` tinyint(4) DEFAULT NULL,
  `joueur_actif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id_parties` int(10) UNSIGNED NOT NULL,
  `phase` tinyint(1) NOT NULL,
  `pot` int(6) DEFAULT NULL,
  `id_carte_flop1` int(10) UNSIGNED NOT NULL,
  `id_carte_flop2` int(10) UNSIGNED NOT NULL,
  `id_carte_flop3` int(10) UNSIGNED NOT NULL,
  `id_carte_turn` int(10) UNSIGNED NOT NULL,
  `id_carte_river` int(10) UNSIGNED NOT NULL,
  `id_host` int(10) UNSIGNED NOT NULL,
  `fin_de_tour` tinyint(4) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateurs` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `derniere connexion` datetime NOT NULL,
  `jetons` int(6) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartes`
--
ALTER TABLE `cartes`
  ADD PRIMARY KEY (`id_cartes`);

--
-- Indexes for table `donnes`
--
ALTER TABLE `donnes`
  ADD PRIMARY KEY (`id_utilisateurs`,`id_parties`,`id_carte1`,`id_carte2`),
  ADD KEY `fk_utilisateurs_has_parties_parties1_idx` (`id_parties`),
  ADD KEY `fk_utilisateurs_has_parties_utilisateurs_idx` (`id_utilisateurs`),
  ADD KEY `fk_donnes_cartes1_idx` (`id_carte1`),
  ADD KEY `fk_donnes_cartes2_idx` (`id_carte2`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id_parties`,`id_carte_flop1`,`id_carte_flop2`,`id_carte_flop3`,`id_carte_turn`,`id_carte_river`,`id_host`),
  ADD KEY `fk_parties_cartes1_idx` (`id_carte_flop1`),
  ADD KEY `fk_parties_cartes2_idx` (`id_carte_flop2`),
  ADD KEY `fk_parties_cartes3_idx` (`id_carte_flop3`),
  ADD KEY `fk_parties_cartes4_idx` (`id_carte_turn`),
  ADD KEY `fk_parties_cartes5_idx` (`id_carte_river`),
  ADD KEY `fk_parties_utilisateurs1_idx` (`id_host`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartes`
--
ALTER TABLE `cartes`
  MODIFY `id_cartes` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id_parties` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateurs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `donnes`
--
ALTER TABLE `donnes`
  ADD CONSTRAINT `fk_donnes_cartes1` FOREIGN KEY (`id_carte1`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_donnes_cartes2` FOREIGN KEY (`id_carte2`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_has_parties_parties1` FOREIGN KEY (`id_parties`) REFERENCES `parties` (`id_parties`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_has_parties_utilisateurs` FOREIGN KEY (`id_utilisateurs`) REFERENCES `utilisateurs` (`id_utilisateurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `parties`
--
ALTER TABLE `parties`
  ADD CONSTRAINT `fk_parties_cartes1` FOREIGN KEY (`id_carte_flop1`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes2` FOREIGN KEY (`id_carte_flop2`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes3` FOREIGN KEY (`id_carte_flop3`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes4` FOREIGN KEY (`id_carte_turn`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes5` FOREIGN KEY (`id_carte_river`) REFERENCES `cartes` (`id_cartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_utilisateurs1` FOREIGN KEY (`id_host`) REFERENCES `utilisateurs` (`id_utilisateurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
