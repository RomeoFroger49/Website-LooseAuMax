-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 04 déc. 2022 à 22:48
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LooseAuMax`
--

-- --------------------------------------------------------

--
-- Structure de la table `Ligue1`
--

CREATE TABLE `Ligue1` (
  `EquipeID` int(11) NOT NULL,
  `Equipe` varchar(20) NOT NULL,
  `Diminutif` varchar(4) NOT NULL,
  `Logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Ligue1`
--

INSERT INTO `Ligue1` (`EquipeID`, `Equipe`, `Diminutif`, `Logo`) VALUES
(1, 'Paris', 'PSG', NULL),
(2, 'Angers', 'SCO', NULL),
(3, 'Marseille', 'OM', NULL),
(4, 'Lyon', 'OL', NULL),
(5, 'Lille', 'LOSC', NULL),
(8, 'Lens', 'LSC', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Matchs`
--

CREATE TABLE `Matchs` (
  `MatchID` int(11) NOT NULL,
  `Score1` int(3) DEFAULT NULL,
  `Score2` int(3) DEFAULT NULL,
  `CoteV1` float NOT NULL DEFAULT '1',
  `CoteV2` float NOT NULL DEFAULT '1',
  `CoteN` float NOT NULL DEFAULT '1',
  `Equipe1` int(11) DEFAULT NULL,
  `Equipe2` int(11) DEFAULT NULL,
  `ParisID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Matchs`
--

INSERT INTO `Matchs` (`MatchID`, `Score1`, `Score2`, `CoteV1`, `CoteV2`, `CoteN`, `Equipe1`, `Equipe2`, `ParisID`) VALUES
(6, 4, 1, 4, 4, 2, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Paris`
--

CREATE TABLE `Paris` (
  `ParisID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `MatchID` int(11) DEFAULT NULL,
  `Etat` int(11) NOT NULL DEFAULT '0',
  `Somme` float NOT NULL,
  `Gain` float DEFAULT NULL,
  `Verif` int(11) DEFAULT NULL,
  `ArgentEnAttente` float NOT NULL DEFAULT '0',
  `EquipeMise` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Paris`
--

INSERT INTO `Paris` (`ParisID`, `UserID`, `MatchID`, `Etat`, `Somme`, `Gain`, `Verif`, `ArgentEnAttente`, `EquipeMise`) VALUES
(62, 1, 6, 1, 100, 400, 1, 400, 'V1');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Mot_de_passe` varchar(20) NOT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `Prenom` varchar(20) DEFAULT NULL,
  `Argent` float NOT NULL DEFAULT '0',
  `AdresseMail` varchar(100) DEFAULT NULL,
  `Admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `Username`, `Mot_de_passe`, `Nom`, `Prenom`, `Argent`, `AdresseMail`, `Admin`) VALUES
(1, 'Admin', 'admin', '', '', 1250, '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Ligue1`
--
ALTER TABLE `Ligue1`
  ADD PRIMARY KEY (`EquipeID`);

--
-- Index pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`MatchID`),
  ADD KEY `Equipe1` (`Equipe1`),
  ADD KEY `Equipe2` (`Equipe2`),
  ADD KEY `ParisID` (`ParisID`);

--
-- Index pour la table `Paris`
--
ALTER TABLE `Paris`
  ADD PRIMARY KEY (`ParisID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `MatchID` (`MatchID`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Ligue1`
--
ALTER TABLE `Ligue1`
  MODIFY `EquipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Paris`
--
ALTER TABLE `Paris`
  MODIFY `ParisID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Matchs`
--
ALTER TABLE `Matchs`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`Equipe1`) REFERENCES `Ligue1` (`EquipeID`),
  ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`Equipe2`) REFERENCES `Ligue1` (`EquipeID`),
  ADD CONSTRAINT `matchs_ibfk_3` FOREIGN KEY (`ParisID`) REFERENCES `Paris` (`ParisID`);

--
-- Contraintes pour la table `Paris`
--
ALTER TABLE `Paris`
  ADD CONSTRAINT `paris_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Utilisateur` (`id`),
  ADD CONSTRAINT `paris_ibfk_2` FOREIGN KEY (`MatchID`) REFERENCES `Matchs` (`MatchID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
