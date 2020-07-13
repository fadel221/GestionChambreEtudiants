-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 13 juil. 2020 à 18:22
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionchambreetudiants`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_bourse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `chambre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_717E22E39B177F54` (`chambre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `matricule`, `prenom`, `nom`, `email`, `telephone`, `type_bourse`, `adresse`, `date_naissance`, `chambre_id`) VALUES
(1, '2020-ND-ta-0001', 'Asta', 'NDIAYE', 'asta26@gmail.com', '773548953', 'Bourse Entiere', NULL, '2015-01-01', 1),
(2, '2020-ND-da-0002', 'Penda', 'NDIAYE', 'pendish232@gmail.com', '775346434', 'Demi Bourse', NULL, '2015-01-01', 1),
(3, '2020-Nd-ye-0003', 'Abdoulaye', 'Ndao', 'ndao32@gmail.com', '776541232', 'Bourse Entiere', 'Sicap Foire', '2015-01-01', 3),
(4, '2020-DI-da-0004', 'Daouda', 'DIOUF', 'david22@gmail.com', '776354123', 'Bourse Entiere', 'Parcelles Assainies', '2015-01-01', 3),
(5, '2020-FA-ye-0005', 'Nogaye', 'FALL', 'nogaye45@gmaim.com', '765431234', 'Bourse Entiere', NULL, '2015-01-01', 4),
(6, '2020-DI-ma-0006', 'Ibrahima', 'DIOP', 'diop\'s66@yahoo.com', '778981123', 'Bourse Entiere', 'Ouest-Foire', '2015-01-01', 4),
(7, '2020-NI-ly-0007', 'Aly', 'NIANG', 'alyniang22@gmail.com', '3548953893', 'Bourse Entiere', 'Darabis', '2015-01-01', NULL),
(8, '2020-SA-ou-0008', 'Abdou', 'SARR', 'saliou43@hotmail.fr', '773457621', 'Bourse Entiere', 'Sahm', '2015-01-01', NULL),
(9, '2020-SA-na-0009', 'Sokhna', 'SARR', 'sokhnasarr32@gmail.com', '776543210', 'Bourse Entiere', 'Kaolack', '2015-01-01', NULL),
(10, '2020-FA-ya-0010', 'Rokhaya', 'FALL', 'rokhidaba22@gmail.com', '765431289', 'Demi Bourse', 'Almadies', '2015-01-01', NULL),
(11, '2020-NI-ed-0011', 'Mouhamaed', 'NIANG', 'niangballo@65gmail.com', '765432109', 'Bourse Entiere', 'Pikine', '2015-01-01', NULL),
(12, '2020-TH-ta-0012', 'Aminata', 'THIAM', 'ami98@gmail.com', '785432190', 'Demi Bourse', NULL, '2015-01-01', NULL),
(13, '2020-GU-el-0013', 'Fadel', 'GUEYE', 'gueyefadel22@gmail.com', '779349340', 'Bourse Entiere', 'Ouest-Foire', '2015-01-01', NULL),
(14, '2020-Lo-im-0014', 'Khadim', 'Lo', 'khadimlo265@gmail.com', '776543212', NULL, 'Parcelles Assainies', '2015-01-01', NULL),
(15, '2020-Mo-th-0015', 'Edith', 'Monteiro', 'edith@gmail.com', '776532123', NULL, 'Almadies', '2015-01-01', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_717E22E39B177F54` FOREIGN KEY (`chambre_id`) REFERENCES `chambre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
