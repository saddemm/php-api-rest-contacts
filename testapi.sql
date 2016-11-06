-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 06 Novembre 2016 à 22:16
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `rue` varchar(255) DEFAULT NULL,
  `code_postal` varchar(20) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `adresses`
--

INSERT INTO `adresses` (`id`, `contact_id`, `rue`, `code_postal`, `ville`, `date_creation`, `date_modification`) VALUES
(1, 1, '24 Rue de la marsa', '1009', 'Tunis', '2016-11-06 20:48:25', '2016-11-06 20:48:25'),
(2, 2, 'Rue de la falaise', '75012', 'Paris', '2016-11-06 20:49:11', '2016-11-06 20:49:11'),
(3, 3, '93 cour julien', '13000', 'Marseille', '2016-11-06 20:50:59', '2016-11-06 20:50:59'),
(7, 2, '39 Rue du nord', '31000', 'Toulouse', '2016-11-06 20:54:20', '2016-11-06 20:54:20');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `civilite` varchar(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contacts`
--

INSERT INTO `contacts` (`id`, `civilite`, `nom`, `prenom`, `date_naissance`, `date_creation`, `date_modification`) VALUES
(1, 'Mr', 'Anene', 'Saddem', '1991-02-21', '2016-11-06 20:44:16', '2016-11-06 20:44:16'),
(2, 'Mme', 'Appartoo', 'Julie', '1985-05-12', '2016-11-06 20:44:53', '2016-11-06 20:44:53'),
(3, 'Mr', 'Kocht', 'Raphael', '1981-08-10', '2016-11-06 20:45:52', '2016-11-06 20:45:52'),
(7, 'TX', 'ZazaXX', 'TATAXXX', '1970-01-01', '2016-11-06 17:05:39', '2016-11-06 18:09:01'),
(8, 'T', 'Zaza', 'TATA', NULL, '2016-11-06 17:40:46', '2016-11-06 17:40:46'),
(9, 'Mr', 'Anene', 'Saddem', NULL, '2016-11-06 20:43:26', '2016-11-06 20:43:26'),
(10, 'Mr', 'Anene', 'Saddem', '1970-01-01', '2016-11-06 20:43:55', '2016-11-06 20:43:55');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
