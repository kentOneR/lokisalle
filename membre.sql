-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 10 Juin 2018 à 15:52
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
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
  `pays` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`, `ville`, `cp`, `adresse`, `pays`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@admin.fr', 'm', 1, '2018-06-07 09:58:45', '', 0, '', ''),
(2, 'pseudo', 'pseudo', 'pseudo', 'pseudo', 'pseudo@pseudo.fr', 'm', 0, '2018-06-07 09:58:45', '', 0, '', ''),
(3, 'john', '$2y$10$VCCVBQF8vTLEzlkuBKPaTef7uS71xxa4vTaa6l6i6lWPIezRU9Ouu', 'john', 'john', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:05:00', '', 0, '', ''),
(5, 'maxa', '$2y$10$2KcyxfPSFxH769jQB/w3P.1mjfLYnIjFGevQjJHEuQ9YXY/rlm1Gm', 'joe', 'joe', 'joe@joe.fr', 'f', 0, '2018-06-07 14:12:54', '', 0, '', ''),
(6, 'erezrez', '$2y$10$.l3Hoh1Ld5EoOZRowL47deHSMJor1HhsBrxjFAPhHzEX.P6DmpjUm', 'ezrezrez', 'ezrez', 'ezre@gmail.fr', 'f', 0, '2018-06-07 14:22:29', 'Paris', 75010, '10 rue d\'Hauteville', 'France'),
(7, 'pseudo1', '$2y$10$2LXjK2ng8vw2Uv/Xuqwwd.m2xbeWT/vYKjUcZjzrE8FVIi7E9BqAe', 'erezre', 'ezrezrez', 'ezre@gmail.fr', 'm', 1, '2018-06-07 14:26:20', 'Nantes', 44000, '10 rue Rousseau', 'France'),
(8, 'pseudo2', '$2y$10$TkieC3Y6vE9fRpQys2j38Oy3aWvU9FvbD7uwHlVotdqPkvRJKHGlG', 'test', 'test', 'admin@admin.com', 'f', 0, '2018-06-10 17:39:48', 'Rennes', 35000, '3 rue du four', ''),
(9, 'pseudo3', '$2y$10$Ka.GMgPsPQIppWjAQQJ5ReaO3ujFXso.LbzqaN1NIbRR3r7umS1Va', 'test', 'test', 'admin@admin.com', 'f', 0, '2018-06-10 17:44:46', 'Rennes', 35000, '3 rue du four', 'France');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
