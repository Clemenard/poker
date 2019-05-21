-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2019 at 02:10 PM
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
  `statut` tinyint(1) DEFAULT '1',
  `ordre` tinyint(4) DEFAULT NULL,
  `id_carte1` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_carte2` int(10) UNSIGNED NOT NULL DEFAULT '53',
  `id_partie` int(10) UNSIGNED DEFAULT NULL,
  `id_utilisateur` int(10) UNSIGNED NOT NULL,
  `mise_totale` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  MODIFY `id_partie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
