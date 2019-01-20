-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 13 jan. 2019 à 19:44
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projettutore`
--

-- --------------------------------------------------------

--
-- Structure de la table `actif`
--

DROP TABLE IF EXISTS `actif`;
CREATE TABLE IF NOT EXISTS `actif` (
  `id_Actif` int(5) NOT NULL AUTO_INCREMENT,
  `id_Membre` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_Actif`),
  KEY `cleEtrActif` (`id_Membre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actif`
--

INSERT INTO `actif` (`id_Actif`, `id_Membre`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `affilier`
--

DROP TABLE IF EXISTS `affilier`;
CREATE TABLE IF NOT EXISTS `affilier` (
  `id_Liste` int(5) NOT NULL,
  `id_Groupe` int(5) NOT NULL,
  PRIMARY KEY (`id_Liste`,`id_Groupe`),
  KEY `cleEtrAffiliert` (`id_Groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `affilier`
--

INSERT INTO `affilier` (`id_Liste`, `id_Groupe`) VALUES
(1, 1),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

DROP TABLE IF EXISTS `appartenir`;
CREATE TABLE IF NOT EXISTS `appartenir` (
  `id_Membre` int(5) NOT NULL,
  `id_Groupe` int(5) NOT NULL,
  PRIMARY KEY (`id_Membre`,`id_Groupe`),
  KEY `cleEtrAppartenir02` (`id_Groupe`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`id_Membre`, `id_Groupe`) VALUES
(1, 1),
(1, 3),
(1, 7),
(2, 1),
(3, 1),
(3, 8),
(7, 4),
(7, 6);

-- --------------------------------------------------------

--
-- Structure de la table `cadeaux`
--

DROP TABLE IF EXISTS `cadeaux`;
CREATE TABLE IF NOT EXISTS `cadeaux` (
  `id_Cadeau` int(5) NOT NULL AUTO_INCREMENT,
  `nomCadeau` varchar(50) DEFAULT NULL,
  `lienCadeau` varchar(256) DEFAULT NULL,
  `descCadeau` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id_Cadeau`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cadeaux`
--

INSERT INTO `cadeaux` (`id_Cadeau`, `nomCadeau`, `lienCadeau`, `descCadeau`) VALUES
(1, 'Nintendo Switch', 'https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwi7xqLEj4LfAhVFOBoKHcKaBu8QjRx6BAgBEAU&url=https%3A%2F%2Fwww.amazon.fr%2FConsoleNintendo-Switch-avec-Joy%2Fdp%2FB01N5OPMJW&psig=AOvVaw1ReEcLMYrg1h4sgdDHiIUw&ust=1543873611070017', 'Cadeau pour les passionnés du jeu vidéo'),
(2, 'Apple Watch', 'https://www.google.com/aclksa=l&ai=DChcSEwju04LNkILfAhWCiNUKHVr6B9UYABABGgJ3cw&sig=AOD64_3dRNvoyRTxLe6CqX6FloM1ZCEuvg&ctype=5&q=&ved=0ahUKEwi9gPzMkILfAhUry4UKHZYLBvgQwg8IPg&adurl=', 'Un smart watch pour les intelligents'),
(3, 'Camera Canon', 'https://www.googleadservices.com/pagead/aclk?sa=L&ai=DChcSEwjs1MzekYLfAhWEse0KHV8EBBQYABADGgJkZw&ohost=www.google.com&cid=CAESEeD2ppvUFJVPrZ4iF0fYO4-k&sig=AOD64_1Dv4QgbKyt3xclIPYTJZSm_zCbxg&ctype=5&q=&ved=0ahUKEwiSicbekYLfAhWEBsAKHcopDPEQ9aACCEI&adurl=', 'Camera parfait pour ceux qui veulent collectionner leur moment de vie'),
(15, 'telephone', 'lien.cadeau', 'description'),
(16, 'cadeau', 'cadeau', 'cadeau'),
(21, 'Super', 'cadeau', 'desc'),
(19, 'Ordianteur', 'liens', 'super ordi'),
(20, 'ordinateur ', 'ordi', 'desc'),
(22, 'SuperCadeau', 'cadeau', 'desc'),
(23, 'deuxieme cadea', 'test', 'test'),
(24, 'cadeau', 'cadeau', 'cadeau');

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id_Cadeau` int(5) NOT NULL,
  `id_Liste` int(5) NOT NULL,
  `id_MembreAcheteur` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_Cadeau`,`id_Liste`),
  KEY `cleEtrContient01` (`id_Liste`),
  KEY `cleEtrContient02` (`id_MembreAcheteur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`id_Cadeau`, `id_Liste`, `id_MembreAcheteur`) VALUES
(1, 1, 2),
(2, 1, 3),
(16, 1, NULL),
(21, 3, NULL),
(19, 9, NULL),
(20, 10, NULL),
(16, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `gerer`
--

DROP TABLE IF EXISTS `gerer`;
CREATE TABLE IF NOT EXISTS `gerer` (
  `id_Actif` int(5) NOT NULL,
  `id_Inactif` int(5) NOT NULL,
  PRIMARY KEY (`id_Actif`,`id_Inactif`),
  KEY `cleEtrGerer02` (`id_Inactif`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gerer`
--

INSERT INTO `gerer` (`id_Actif`, `id_Inactif`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_Groupe` int(5) NOT NULL AUTO_INCREMENT,
  `nomGroupe` varchar(50) DEFAULT NULL,
  `id_CreateurGroupe` int(5) NOT NULL,
  PRIMARY KEY (`id_Groupe`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_Groupe`, `nomGroupe`, `id_CreateurGroupe`) VALUES
(1, 'Groupe 3D', 1),
(2, 'LOL', 1),
(3, 'test', 1),
(4, 'Groupe_Dorian', 7),
(6, 'Cousin', 7),
(7, 'Rush', 1),
(9, 'Groupe a supprimer', 3);

-- --------------------------------------------------------

--
-- Structure de la table `inactif`
--

DROP TABLE IF EXISTS `inactif`;
CREATE TABLE IF NOT EXISTS `inactif` (
  `id_Inactif` int(5) NOT NULL AUTO_INCREMENT,
  `id_Membre` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_Inactif`),
  KEY `cleEtrInactif` (`id_Membre`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inactif`
--

INSERT INTO `inactif` (`id_Inactif`, `id_Membre`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `id_Liste` int(5) NOT NULL AUTO_INCREMENT,
  `nomListe` varchar(50) DEFAULT NULL,
  `id_Membre` int(11) NOT NULL,
  PRIMARY KEY (`id_Liste`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`id_Liste`, `nomListe`, `id_Membre`) VALUES
(1, 'Liste de Tristan', 1),
(2, 'Liste de Hee Eon', 2),
(3, 'Liste de Kel', 3),
(10, 'anniversaire', 7),
(9, 'Anniversaire', 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `nomMembre` varchar(50) DEFAULT NULL,
  `id_Membre` int(5) NOT NULL AUTO_INCREMENT,
  `prenomMembre` varchar(50) DEFAULT NULL,
  `mailMembre` varchar(50) DEFAULT NULL,
  `etatMembre` varchar(50) DEFAULT NULL,
  `loginMembre` varchar(250) NOT NULL,
  `mdpMembre` varchar(11) NOT NULL,
  PRIMARY KEY (`id_Membre`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`nomMembre`, `id_Membre`, `prenomMembre`, `mailMembre`, `etatMembre`, `loginMembre`, `mdpMembre`) VALUES
('KWON', 2, 'Hee Eon', 'hee-eon.kwon@u-psud.fr', 'Actif', 'hee-eon.kwon', 'hee-eon'),
('CLEMENCEAU', 1, 'Tristan', 'tristan.clemenceau@', 'Actif', 'tristan.cl', 'tristan'),
('CAIN', 3, 'Kel', 'kel.cain@gmail.com', 'Inactif', 'kel.cain', 'kel'),
(NULL, 6, NULL, 'remi.decouty@u-psud.fr', 'Actif', 'remi.de', 'remi'),
('CLEMENCEAU', 7, 'dorian', 'dorian.cl@gmail.fr', 'Actif', 'dorian', 'dorian');

-- --------------------------------------------------------

--
-- Structure de la table `vouloir`
--

DROP TABLE IF EXISTS `vouloir`;
CREATE TABLE IF NOT EXISTS `vouloir` (
  `id_Membre` int(5) NOT NULL,
  `id_Cadeau` int(5) NOT NULL,
  PRIMARY KEY (`id_Membre`,`id_Cadeau`),
  KEY `cleEtrVouloir02` (`id_Cadeau`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vouloir`
--

INSERT INTO `vouloir` (`id_Membre`, `id_Cadeau`) VALUES
(2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
