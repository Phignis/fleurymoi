-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2023 at 09:13 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `fleurymoi`;

--
-- Database: `fleurymoi`
--
CREATE DATABASE IF NOT EXISTS `fleurymoi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fleurymoi`;

-- --------------------------------------------------------

--
-- Table structure for table `plant_family_t`
--
-- Creation: Jan 14, 2023 at 10:11 AM
--

DROP TABLE IF EXISTS `plant_family_t`;
DROP TABLE IF EXISTS `posseded_plant_tj`;
DROP TABLE IF EXISTS `plant_t`;
DROP TABLE IF EXISTS `user_t`;

CREATE TABLE IF NOT EXISTS `plant_family_t` (
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'family name',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'description of family',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='store a plant family';

--
-- Dumping data for table `plant_family_t`
--

INSERT INTO `plant_family_t` (`name`, `description`) VALUES
('Agavacées', 'Les Agavacées (Agavaceae) sont une famille de plantes monocotylédones, invalide dans la classification phylogénétique APG III (2009).\r\n\r\nCe sont des plantes acaules ou encore des arbres à rosettes que l\'on retrouve dans les régions tropicales ou arides et particulièrement en Amérique. Dans cette famille, on trouve l\'agave, le yucca et la tubéreuse.'),
('Géraniacées', 'Les Geraniaceae sont les plantes herbacées ou parfois des arbustes, possédant des feuilles opposées ou alternes, lobées-palmées ou composées.\r\nLes inflorescences sont généralement des pseudo-ombelles ou bien les fleurs sont solitaires Les fleurs pentamères sont actinomorphes ou zygomorphes. Les 5 sépales et les 5 pétales sont généralement libres. Les étamines sont au nombre de 5, 10 ou 15, parfois avec certaines stériles. Le gynécée est formé par 5 carpelles et le style comporte 5 branches stigmatiques (sauf pour Hypeocharis).');

-- --------------------------------------------------------

--
-- Table structure for table `plant_t`
--
-- Creation: Jan 14, 2023 at 09:38 PM
-- Last update: Jan 17, 2023 at 01:16 PM
--


CREATE TABLE IF NOT EXISTS `plant_t` (
  `botanical_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'botanical name of plant',
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'family name, refer to plant_family_t',
  `insolation` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'insolation need of plant',
  `land` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'type of land needed',
  `watering` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'condition to water plant',
  `sowing_period` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'sowing period of plant, period delimited by two month',
  `planting_period` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'planting period of plant, period delimited by two month',
  `flowering_period` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'flowering period of plant, period delimited by two month',
  `heigth` float DEFAULT NULL COMMENT 'heigth of plant',
  `width` float DEFAULT NULL COMMENT 'width of plant',
  `path_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'path to picture',
  PRIMARY KEY (`botanical_name`),
  KEY `fk_plant_family_t` (`family_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='store a plant';

--
-- Dumping data for table `plant_t`
--

INSERT INTO `plant_t` (`botanical_name`, `name`, `family_name`, `insolation`, `land`, `watering`, `sowing_period`, `planting_period`, `flowering_period`, `heigth`, `width`, `path_picture`) VALUES
('Geranium spp.', 'Géranium Vivace', 'Géraniacées', 'Soleil à mi-ombre', 'Frais humifère', 'Oui en exposition soleil', 'Printemps février mars sous abri', 'Avril – mai', 'd’avril à octobre en 2 fois.', 1.5, 0.8, 'ressources/images/plant_images/geranium_spp.jpg'),
('Pelargonium spp.', 'Pélargonium (géranium des balcons)', 'Géraniacées', 'Soleil à mi-ombre', 'Riche léger drainé', 'Oui en exposition soleil et chaleur', 'difficile,bouture d’été.', 'Mars-Avril – mai', 'Mai – Septembre', 0.3, 0.4, 'ressources/images/plant_images/pelargonium_spp.png'),
('Yucca spp.', 'Yucca', 'Agavacées', 'Soleil', 'Sol drainant', 'Surtout l’été', 'Division des rejets au printemps', 'Printemps', 'Mai à juin parfois septembre selon les variétés et le climat.', 5, 1, 'ressources/images/plant_images/yucca_spp.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posseded_plant_tj`
--
-- Creation: Jan 14, 2023 at 05:54 PM
-- Last update: Jan 17, 2023 at 08:51 PM
--


CREATE TABLE IF NOT EXISTS `posseded_plant_tj` (
  `email_possessor` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'email of possessor of plant',
  `botanical_name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'botanical name of plant possessed',
  `quantity` int(11) DEFAULT NULL COMMENT 'how many plant is posseded',
  PRIMARY KEY (`email_possessor`,`botanical_name`),
  KEY `botanical_name` (`botanical_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posseded_plant_tj`
--

INSERT INTO `posseded_plant_tj` (`email_possessor`, `botanical_name`, `quantity`) VALUES
('bap@gmail.com', 'Geranium spp.', 4),
('bap@gmail.com', 'Pelargonium spp.', 4),
('bap@gmail.com', 'Yucca spp.', 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_t`
--
-- Creation: Jan 10, 2023 at 11:00 PM
--

CREATE TABLE IF NOT EXISTS `user_t` (
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'email of account',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name of user',
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'password to log in',
  `birthdate` date DEFAULT NULL COMMENT 'birthdate to event',
  `path_profile_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'profile picture of user account',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='store a user account';

--
-- Dumping data for table `user_t`
--

INSERT INTO `user_t` (`email`, `name`, `password`, `birthdate`, `path_profile_picture`) VALUES
('bap@gmail.com', 'bap', '$2y$10$6lMZc6s3JyGvNYee4qMbtunaGrnFNUBus6znIKck1Q95UbBgMhBKK', '2002-10-27', 'ressources/images/user_profile_picture/bap_gmail_com_pp.png'),
('tata@gmail.com', 'tata', '$2y$10$.hxrIAaj7YVelNzQvnYzGue4A/HQVcyLsPCNocywNaKoCD/TqXHFe', NULL, NULL),
('test@gmail.com', 'test', '$2y$10$UMRwOgH7oYwHSa8yFkJZuegEaV6pNnJfH7KMFGFM0bH63lbhAVGQ.', '2023-01-06', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plant_t`
--
ALTER TABLE `plant_t`
  ADD CONSTRAINT `plant_t_ibfk_1` FOREIGN KEY (`family_name`) REFERENCES `plant_family_t` (`name`);

--
-- Constraints for table `posseded_plant_tj`
--
ALTER TABLE `posseded_plant_tj`
  ADD CONSTRAINT `posseded_plant_tj_ibfk_1` FOREIGN KEY (`email_possessor`) REFERENCES `user_t` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posseded_plant_tj_ibfk_2` FOREIGN KEY (`botanical_name`) REFERENCES `plant_t` (`botanical_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Add necessary user
--
CREATE USER 'access_fleurYmoi'@'%' IDENTIFIED WITH mysql_native_password BY 'fleurYmoi63&';
GRANT ALL PRIVILEGES ON `fleurymoi`.* TO 'access_fleurYmoi'@'%';
