-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2019 at 12:56 PM
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
  `id_carte` int(10) UNSIGNED NOT NULL,
  `couleur` tinyint(1) NOT NULL,
  `figure` smallint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cartes`
--

INSERT INTO `cartes` (`id_carte`, `couleur`, `figure`) VALUES
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
(52, 4, 13),
(53, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donnes`
--

CREATE TABLE `donnes` (
  `mise` int(11) DEFAULT '0',
  `statut` tinyint(1) DEFAULT '3',
  `ordre` tinyint(4) DEFAULT NULL,
  `id_carte1` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte2` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_partie` int(10) UNSIGNED DEFAULT NULL,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `mise_totale` int(11) DEFAULT '0',
  `score` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `donnes`
--

INSERT INTO `donnes` (`mise`, `statut`, `ordre`, `id_carte1`, `id_carte2`, `id_partie`, `id_utilisateur`, `mise_totale`, `score`) VALUES
(20, 2, 1, 14, 12, 1, 1, 0, 0),
(40, 2, 1, 31, 14, 2, 1, 0, 0),
(20, 2, 1, 31, 4, 3, 1, 0, 0),
(0, 0, 1, 46, 5, 5, 2, 0, 0),
(20, 2, 1, 37, 34, 6, 2, 0, 0),
(0, 1, 1, 24, 29, 7, 2, 0, 0),
(20, 2, 1, 36, 32, 8, 2, 0, 0),
(60, 2, 2, 24, 42, 1, 2, 0, 0),
(10, 0, 2, 11, 36, 2, 2, 0, 0),
(20, 2, 2, 13, 37, 3, 2, 0, 0),
(20, 2, 1, 43, 29, 9, 2, 0, 0),
(20, 2, 3, 31, 7, 1, 3, 0, 0),
(20, 2, 3, 1, 4, 2, 3, 0, 0),
(20, 2, 3, 15, 33, 3, 3, 0, 0),
(20, 2, 2, 13, 19, 5, 3, 0, 0),
(20, 2, 2, 7, 48, 6, 3, 0, 0),
(10, 2, 2, 5, 46, 7, 3, 0, 0),
(50, 2, 2, 4, 5, 8, 3, 0, 0),
(10, 1, 2, 17, 10, 9, 3, 0, 0),
(20, 2, 3, 44, 47, 5, 1, 0, 0),
(20, 2, 3, 52, 12, 6, 1, 0, 0),
(20, 2, 3, 31, 39, 7, 1, 0, 0),
(20, 2, 1, 10, 33, 10, 3, 0, 0),
(20, 2, 2, 14, 39, 10, 2, 0, 0),
(20, 2, 1, 51, 18, 11, 2, 0, 0),
(20, 2, 1, 10, 23, 12, 2, 0, 0),
(20, 2, 1, 37, 42, 13, 2, 0, 0),
(0, 1, 1, 31, 44, 14, 2, 0, 0),
(0, 1, 1, 17, 41, 15, 2, 0, 1),
(0, 1, 1, 22, 14, 16, 2, 0, 0),
(0, 1, 1, 34, 29, 17, 2, 0, 1),
(0, 1, 1, 9, 46, 18, 2, 0, 1),
(20, 2, 2, 31, 42, 11, 3, 0, 0),
(10, 1, 2, 12, 42, 12, 3, 0, 0),
(20, 2, 2, 20, 50, 13, 3, 0, 0),
(0, 2, 2, 10, 18, 14, 3, 0, 0),
(0, 2, 2, 33, 44, 15, 3, 0, 0),
(0, 2, 2, 8, 26, 16, 3, 0, 0),
(0, 2, 2, 9, 37, 17, 3, 0, 1),
(0, 2, 2, 49, 21, 18, 3, 0, 1),
(0, 1, 1, 49, 52, 19, 3, 0, 2),
(20, 1, 1, 27, 33, 20, 3, 0, 0),
(0, 2, 2, 28, 25, 19, 2, 0, 2),
(10, 1, 2, 37, 28, 20, 2, 0, 0),
(0, 1, 1, 25, 25, 21, 3, 0, 2),
(0, 1, 1, 16, 12, 22, 3, 0, 0),
(0, 4, 1, 23, 31, 23, 3, 0, 0),
(0, 1, 1, 34, 39, 24, 3, 0, 0),
(0, 4, 1, 14, 28, 25, 3, 0, 2),
(0, 4, 2, 44, 44, 21, 2, 0, 2),
(0, 4, 2, 24, 14, 22, 2, 0, 0),
(0, 4, 2, 5, 49, 23, 2, 0, 4),
(10, 3, 2, 23, 21, 24, 2, 0, 0),
(0, 3, 2, 52, 26, 25, 2, 0, 2),
(20, 3, 3, 1, 27, 24, 1, 0, 0),
(0, 4, 3, 11, 32, 25, 1, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id_partie` int(10) UNSIGNED NOT NULL,
  `phase` tinyint(1) NOT NULL DEFAULT '0',
  `pot` int(6) DEFAULT '0',
  `id_carte_turn` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte_flop1` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte_flop2` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte_flop3` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte_river` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_host` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id_partie`, `phase`, `pot`, `id_carte_turn`, `id_carte_flop1`, `id_carte_flop2`, `id_carte_flop3`, `id_carte_river`, `id_host`) VALUES
(1, 1, 0, 53, 53, 53, 53, 53, 1),
(2, 1, 0, 53, 53, 53, 53, 53, 1),
(3, 1, 0, 53, 53, 53, 53, 53, 1),
(5, 1, 0, 53, 53, 53, 53, 53, 2),
(6, 2, 0, 53, 45, 16, 40, 53, 2),
(7, 1, 0, 53, 53, 53, 53, 53, 2),
(8, 1, 0, 53, 53, 53, 53, 53, 2),
(9, 1, 0, 53, 53, 53, 53, 53, 2),
(10, 2, 0, 53, 19, 48, 15, 53, 3),
(11, 1, 0, 53, 53, 53, 53, 53, 2),
(12, 1, 0, 53, 53, 53, 53, 53, 2),
(13, 2, 40, 53, 38, 47, 27, 53, 2),
(14, 13, 80, 16, 37, 52, 32, 26, 2),
(15, 17, 40, 51, 42, 13, 48, 19, 2),
(16, 5, 40, 7, 51, 43, 31, 18, 2),
(17, 6, 40, 30, 39, 13, 46, 11, 2),
(18, 5, 40, 3, 27, 41, 4, 42, 2),
(19, 11, 40, 23, 9, 12, 4, 45, 3),
(20, 1, 0, 53, 53, 53, 53, 53, 3),
(21, 5, 40, 27, 39, 23, 43, 5, 3),
(22, 5, 40, 22, 27, 7, 18, 47, 3),
(23, 5, 40, 42, 3, 4, 32, 10, 3),
(24, 1, 0, 53, 53, 53, 53, 53, 3),
(25, 5, 240, 6, 24, 51, 24, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(45) COLLATE utf8_bin NOT NULL,
  `derniere_connexion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jetons` int(6) DEFAULT '1000',
  `statut` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `pseudo`, `password`, `derniere_connexion`, `jetons`, `statut`) VALUES
(1, 'joueur1', 'c39eb44d1cfa8a8e05bf223d34bdbb4c', '2019-05-22 09:15:26', 890, 0),
(2, 'joueur2', '08beb521f7e7dec9ed4808c9da5290cc', '2019-05-22 09:15:35', 810, 0),
(3, 'joueur3', 'ec6b3b83714435f724d662b250cecc4d', '2019-05-22 09:15:51', 900, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartes`
--
ALTER TABLE `cartes`
  ADD PRIMARY KEY (`id_carte`);

--
-- Indexes for table `donnes`
--
ALTER TABLE `donnes`
  ADD KEY `fk_donnes_cartes1_idx` (`id_carte1`),
  ADD KEY `fk_donnes_cartes2_idx` (`id_carte2`),
  ADD KEY `fk_donnes_parties1_idx` (`id_partie`),
  ADD KEY `fk_donnes_utilisateurs1_idx` (`id_utilisateur`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id_partie`),
  ADD KEY `fk_parties_cartes1_idx` (`id_carte_turn`),
  ADD KEY `fk_parties_cartes2_idx` (`id_carte_flop1`),
  ADD KEY `fk_parties_cartes3_idx` (`id_carte_flop2`),
  ADD KEY `fk_parties_cartes4_idx` (`id_carte_flop3`),
  ADD KEY `fk_parties_cartes5_idx` (`id_carte_river`),
  ADD KEY `fk_parties_utilisateurs1_idx` (`id_host`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartes`
--
ALTER TABLE `cartes`
  MODIFY `id_carte` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id_partie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `donnes`
--
ALTER TABLE `donnes`
  ADD CONSTRAINT `fk_donnes_cartes1` FOREIGN KEY (`id_carte1`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_donnes_cartes2` FOREIGN KEY (`id_carte2`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_donnes_parties1` FOREIGN KEY (`id_partie`) REFERENCES `parties` (`id_partie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_donnes_utilisateurs1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `parties`
--
ALTER TABLE `parties`
  ADD CONSTRAINT `fk_parties_cartes1` FOREIGN KEY (`id_carte_turn`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes2` FOREIGN KEY (`id_carte_flop1`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes3` FOREIGN KEY (`id_carte_flop2`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes4` FOREIGN KEY (`id_carte_flop3`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_cartes5` FOREIGN KEY (`id_carte_river`) REFERENCES `cartes` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_parties_utilisateurs1` FOREIGN KEY (`id_host`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
