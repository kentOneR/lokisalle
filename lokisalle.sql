-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 13 juin 2018 à 15:11
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
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `note` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(5, 7, 19, 'La salle est bien et dispo rapidement!!', 4, '2018-06-12 09:44:42'),
(6, 1, 4, 'Parfait!! Je recommande Lokisalle', 5, '2018-06-12 09:44:42'),
(7, 7, 3, 'Salle nickel, avec bon équipement pour présentation', 5, '2018-06-12 10:53:40'),
(8, 7, 13, 'Equipement dernier cri!!! Au top!!', 5, '2018-06-12 10:57:16'),
(9, 5, 3, 'Pas mal', 4, '2018-06-12 16:02:33'),
(10, 4, 3, 'parfait', 5, '2018-06-12 16:02:33'),
(11, 8, 21, 'La salle est top', 5, '2018-06-12 16:07:14'),
(12, 9, 20, 'Bien, sauf le projecteur', 4, '2018-06-12 16:07:14'),
(13, 7, 14, 'Salle parfaite pour nos besoins', 5, '2018-06-13 15:01:31');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(3) NOT NULL AUTO_INCREMENT,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` date NOT NULL,
  `date_depart` date NOT NULL,
  `date_enristrement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_salle`, `date_arrivee`, `date_depart`, `date_enristrement`) VALUES
(3, 7, 1, '2018-06-15', '2018-06-17', '2018-06-09 17:07:00'),
(4, 7, 3, '2018-06-19', '2018-06-21', '2018-06-11 09:59:42'),
(5, 7, 3, '2018-06-22', '2018-06-23', '2018-06-11 10:01:36'),
(6, 7, 10, '2018-06-28', '2018-06-30', '2018-06-11 16:50:21'),
(7, 7, 18, '2018-06-20', '2018-06-22', '2018-06-11 16:51:47'),
(10, 7, 18, '2018-06-27', '2018-06-29', '2018-06-11 17:12:57'),
(11, 7, 23, '2018-06-14', '2018-06-16', '2018-06-11 17:26:35'),
(12, 7, 13, '2018-06-20', '2018-06-22', '2018-06-11 17:28:25'),
(13, 7, 23, '2018-06-19', '2018-06-21', '2018-06-11 17:41:21'),
(14, 7, 21, '2018-06-28', '2018-06-30', '2018-06-11 17:42:30'),
(15, 7, 10, '2018-06-13', '2018-06-16', '2018-06-12 13:00:18'),
(16, 3, 9, '2018-06-20', '2018-06-22', '2018-06-12 16:26:10'),
(17, 8, 24, '2018-06-27', '2018-06-29', '2018-06-12 16:26:10');

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
  `ville` varchar(25) NOT NULL,
  `cp` int(5) NOT NULL,
  `adresse` varchar(80) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`, `ville`, `cp`, `adresse`) VALUES
(2, 'pseudo', 'pseudo', 'pseudo', 'pseudo', 'pseudo@pseudo.fr', 'm', 0, '2018-06-07 09:58:45', '', 0, ''),
(3, 'john', '$2y$10$VCCVBQF8vTLEzlkuBKPaTef7uS71xxa4vTaa6l6i6lWPIezRU9Ouu', 'john', 'john', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:05:00', '', 0, ''),
(5, 'maxa', '$2y$10$2KcyxfPSFxH769jQB/w3P.1mjfLYnIjFGevQjJHEuQ9YXY/rlm1Gm', 'joe', 'joe', 'joe@joe.fr', 'f', 0, '2018-06-07 14:12:54', '', 0, ''),
(6, 'nanard', '$2y$10$.l3Hoh1Ld5EoOZRowL47deHSMJor1HhsBrxjFAPhHzEX.P6DmpjUm', 'Jean', 'Bernard', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:22:29', 'Paris', 75010, '10 rue d\'Hauteville'),
(7, 'pseudo1', '$2y$10$2LXjK2ng8vw2Uv/Xuqwwd.m2xbeWT/vYKjUcZjzrE8FVIi7E9BqAe', 'erezre', 'ezrezrez', 'ezre@gmail.fr', 'm', 1, '2018-06-07 14:26:20', 'Nantes', 44000, '10 rue Rousseau'),
(8, 'pseudo2', '$2y$10$TkieC3Y6vE9fRpQys2j38Oy3aWvU9FvbD7uwHlVotdqPkvRJKHGlG', 'test', 'test', 'admin@admin.com', 'f', 0, '2018-06-10 17:39:48', 'Rennes', 35000, '3 rue du four'),
(9, 'pseudo3', '$2y$10$Ka.GMgPsPQIppWjAQQJ5ReaO3ujFXso.LbzqaN1NIbRR3r7umS1Va', 'test', 'test', 'admin@admin.com', 'f', 0, '2018-06-10 17:44:46', 'Rennes', 35000, '3 rue du four');

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
  `prix` int(3) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`, `prix`) VALUES
(1, 'Opéra', 'Cadre sublime dans un quartier prestigieux, cette salle incarne l\'excellence.', '1_opera.jpg', 'France', 'Paris', '4 boulevard Haussman', 75008, 30, 'réunion', 80),
(2, 'Diderot', 'Spacieuse et lumineuse, cette salle surplombe le campus de l\'Universit&eacute; Paris Diderot.', '2_diderot.jpg', 'France', 'Paris', '38 avenue de France', 75013, 14, 'réunion', 65),
(3, 'Nation', 'Face à la place de la Nation, cette salle met l\'accent sur la convivialité et la sérénité.', '3_nation.jpg', 'France', 'Paris', '3 avenue du Trône', 75020, 24, 'réunion', 78),
(4, 'République', 'Dotée d\'une très grande capacité d\'accueil, il est possible d\'y organiser un grand rassemblement.', '4_republique.jpg', 'France', 'Paris', '5 place de la République', 75010, 32, 'formation', 90),
(9, 'Reaumur', 'Nous disposons d\'une salle de r&eacute;union &eacute;quip&eacute;e pouvant accueillir jusqu\'&agrave; 4 personnes pour des rendez-vous d\'affaires.', '9_reaumur.jpg', 'France', 'Paris', 'Rue R&eacute;aumur', 75002, 6, 'réunion', 102),
(10, 'Trevise', 'Nous disposons d\'une salle pouvant accueillir de 1 à 80 personnes. Notre salle est modulable en focntion des besoins.', '10_trevise.jpg', 'Fance', 'Lyon', 'Rue de Trévise', 75009, 55, 'réunion', 78),
(13, 'Poissonnière ', 'Start-up, petite entreprise, vous cherchez des bureaux dans un environnement dynamique et convivial ? Nous avons actuellement plusieurs postes de travail disponibles.', '13_poissonniere.jpg', 'France', 'Paris', 'Rue Poissonnière', 75002, 12, 'formation', 82),
(14, 'Clery', 'Localisation centrale! 12 postes disponibles immédiatement dans un espace réservé et lumineux.', '14_clery.jpg', 'France', 'Lyon', 'Rue de Cléry', 75002, 10, 'formation', 90),
(15, 'République 1', 'Un ilôt un peu à l\'écart de 5 postes disponible dans un open space avec une ambiance studieuse et conviviale entre start-ups.', '15_republique1.jpg\r\n', 'France', 'Paris', 'Avenue de la République', 75011, 5, 'formation', 75),
(16, 'Saint Marc', 'Le studio est situé entre les metros Grands Boulevards et Bourse, a coté du passage des Panoramas, super central, facile access. Immeuble avec gardien.', '16_saintmarc.jpg', 'France', 'Paris', 'Rue Saint-Marc', 75002, 12, 'formation', 55),
(17, 'Charenton', 'En plein coeur de Paris, proximité immédiate de la place de la Bastille, nos espaces sont très lumineux. L\'ambiance est jeune est dynamique.\r\n\r\n', '17_charenton.jpg', 'France', 'Paris', 'Rue de Charenton', 75012, 4, 'formation', 44),
(18, 'Chemin vert', 'Situé dans le 11ème arrondissement de Paris, nous ouvrons nos portes à toutes personnes désirant vivre une expérience de travail unique.', '18_cheminvert.jpg', 'France', 'Paris', 'Rue du Chemin Vert', 75011, 50, 'formation', 80),
(19, 'Le Galion', 'Le Galion est une péniche restaurant de style XVème siècle - 3 mâts - 170 pieds (50 mètres).', '19_legalion.jpg', 'France', 'Marseille', 'Quai Blanchard', 75002, 40, 'séminaire', 94),
(20, 'Espace 109', 'Situé dans le 2e arrondissement, plus de 550 m2 d’espaces modulables et connectés pour tous vos évenements professionnels de 50 À 100 personnes.', '20_espace109.jpg', 'France', 'Paris', '15 Boulevard Sébastopol', 75009, 100, 'séminaire', 120),
(21, 'Cour saint Nicolas', 'Claire, calme et de style contemporain, la Cour Saint Nicolas offre un lieu unique à tous ceux qui souhaitent organiser séminaires et événements.', '21_courssaintnicolas.jpg', 'France', 'Paris', 'Rue de Cahrenton', 75008, 40, 'séminaire', 110),
(22, 'Ideal Artist House', 'Situé au cœur du 10éme arrondissement de Paris au bord du canal Saint-Martin et de son écluse, il bénéficie d\'une situation idéale pour vos événements professionnels.', '22_idealartisthouse.jpg', 'France', 'Paris', 'Rue de Lobeau', 75002, 40, 'séminaire', 130),
(23, 'Bensai', 'Fort de ses deux chefs, thaï d\'un côté et japonais de l\'autre, nous vous proposons de donner une touche d\'originalité et d\'exotisme asiatique à vos événements.', '23_bensai.jpg', 'France', 'Marseilles', 'Rue du faubourg saint Honoré', 75001, 50, 'séminaire', 140),
(24, 'St Paul', 'Nous proposons à la location 2 salles de réunion \"Charlemagne\" (40 places)  et \"Prévôt\" (20 places). Ces salles sont équipées de vidéo projecteur, écran et paper board.', '24_saintpaul.jpg', 'France', 'Paris', 'rue de Fourcy', 75001, 80, 'séminaire', 120);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
