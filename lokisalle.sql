-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 juin 2018 à 15:23
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lokisalle`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '0',
  `date_enregistrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@admin.fr', 'm', 1, '2018-06-07 09:58:45'),
(2, 'pseudo', 'pseudo', 'pseudo', 'pseudo', 'pseudo@pseudo.fr', 'm', 0, '2018-06-07 09:58:45'),
(3, 'john', '$2y$10$VCCVBQF8vTLEzlkuBKPaTef7uS71xxa4vTaa6l6i6lWPIezRU9Ouu', 'john', 'john', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:05:00'),
(5, 'maxa', '$2y$10$2KcyxfPSFxH769jQB/w3P.1mjfLYnIjFGevQjJHEuQ9YXY/rlm1Gm', 'joe', 'joe', 'joe@joe.fr', 'f', 0, '2018-06-07 14:12:54'),
(6, 'erezrez', '$2y$10$.l3Hoh1Ld5EoOZRowL47deHSMJor1HhsBrxjFAPhHzEX.P6DmpjUm', 'ezrezrez', 'ezrez', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:22:29'),
(7, 'pseudo1', '$2y$10$2LXjK2ng8vw2Uv/Xuqwwd.m2xbeWT/vYKjUcZjzrE8FVIi7E9BqAe', 'erezre', 'ezrezrez', 'ezre@gmail.fr', 'm', 1, '2018-06-07 14:26:20');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(3) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('réunion','séminaire','formation') NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Opéra', 'Cadre sublime dans un quartier prestigieux, cette salle incarne l\'excellence.', '1_opera.jpg', 'France', 'Paris', '4 boulevard Haussman', 75008, 30, 'réunion'),
(2, 'Diderot', 'Spacieuse et lumineuse, cette salle surplombe le campus de l\'Université Paris Diderot.', '2_diderot.jpg', 'France', 'Paris', '38 avenue de France', 75013, 12, 'réunion'),
(3, 'Nation', 'Face à la place de la Nation, cette salle met l\'accent sur la convivialité et la sérénité.', '3_nation.jpg', 'France', 'Paris', '3 avenue du Trône', 75020, 24, 'réunion'),
(4, 'République', 'Dotée d\'une très grande capacité d\'accueil, il est possible d\'y organiser un grand rassemblement.', '4_republique.jpg', 'France', 'Paris', '5 place de la République', 75010, 32, 'formation');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
