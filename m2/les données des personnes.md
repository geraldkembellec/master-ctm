Les données travaillées de manière collaboratives via Gsheet puis enrichies avec OpenRefine sont ici :  https://docs.google.com/spreadsheets/d/e/2PACX-1vTm50gmXyXgIYkU9uRxy8y9BhNTzLq8cH9VrODf-UQRK-BUnEJNDiStTHv-_IC13lrxRwUgummQHBQN/pub?gid=221157170&single=true&output=csv

Elles sont prêtes à étre intégrées dans une base MySQL une fois intallé MAMP, via PHPmyAdmin : Voici le code SQLla structure de la table  :

  `
  -- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 04 fév. 2026 à 10:00
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `GLAM`
--

-- --------------------------------------------------------

--
-- Structure de la table `Personnes`
--

CREATE TABLE `Personnes` (
  `idPerson` int NOT NULL COMMENT 'Clé primaire unique',
  `nom` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `métier` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LieuN` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `LieuM` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Picture` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `Info` tinytext COLLATE utf8mb3_unicode_ci,
  `dateN` date DEFAULT NULL,
  `dateM` date DEFAULT NULL,
  `ISNI` varchar(16) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `idWikidata` varchar(8) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Personnes`
--
ALTER TABLE `Personnes`
  ADD PRIMARY KEY (`idPerson`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Personnes`
--
ALTER TABLE `Personnes`
  MODIFY `idPerson` int NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire unique';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
`

