SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Base de données : `GLAM` à créer d'abord
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
  `idWikidata` varchar(32) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Index pour la table `Personnes`
--
ALTER TABLE `Personnes`
  ADD PRIMARY KEY (`idPerson`);

--
-- AUTO_INCREMENT pour la table `Personnes`
--
ALTER TABLE `Personnes`
  MODIFY `idPerson` int NOT NULL AUTO_INCREMENT COMMENT 'Clé primaire unique';
COMMIT;

--
-- Il n'y a plus qu'à remplir
-- 
