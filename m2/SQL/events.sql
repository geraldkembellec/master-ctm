
--
-- Structure de la table `Events`
--

CREATE TABLE `Events` (
  `id` int NOT NULL,
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
  `id_wikidata_organizer` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `Events`
--

INSERT INTO `Events` (`id`, `name`, `description`, `start_date`, `end_date`, `location_name`, `location_city`, `location_country`, `organizer`, `event_status`, `event_mode`, `url`, `image`, `id_wikidata_organizer`) VALUES
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
