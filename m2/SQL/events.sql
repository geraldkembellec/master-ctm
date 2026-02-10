-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 10 fév. 2026 à 15:37
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

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
-- Structure de la table `Events`
--

CREATE TABLE `Events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `location_city` varchar(100) DEFAULT NULL,
  `location_country` varchar(100) DEFAULT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `event_status` varchar(100) DEFAULT NULL,
  `event_mode` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `identifiant-wikidata-organizer` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `name`, `description`, `start_date`, `end_date`, `location_name`, `location_city`, `location_country`, `organizer`, `event_status`, `event_mode`, `url`, `image`, `identifiant-wikidata-organizer`) VALUES
(1, 'Manga. Tout un art !', 'Cet hiver, une vague manga déferle sur le musée Guimet !\r\n\r\nQuel que soit votre âge, quelle que soit votre génération, retrouvez vos héros préférés dans une exposition-événement exceptionnelle, déployée pour la première fois sur les trois étages du musée.\r\n', '2025-11-19 16:04:09', '2026-03-09 16:04:09', 'Musée Guimet', 'Paris', 'France', 'Musée Guimet', 'En cours', 'Exposition temporaire', 'https://www.guimet.fr/fr/expositions/manga-tout-un-art', 'https://www.guimet.fr/sites/default/files/styles/image_content/public/2025-10/manga_guimet_20mn_40x60_rvb-pour-diffusion-web_6.jpg', 'Q860994');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
