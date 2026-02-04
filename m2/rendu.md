# Production et publication d’une page HTML5 culturelle sémantiquement enrichie à partir de données structurées
## Objectifs pédagogiques

L’exercice vise à évaluer la capacité à articuler des compétences techniques et documentaires dans une logique de publication web orientée données. Il s’agit de :

– Mettre en œuvre une chaîne de traitement de données culturelles (collecte, nettoyage, structuration).
– Concevoir une base de données relationnelle simple adaptée à un corpus culturel.
– Interroger une base **MySQL** via **PHP** (*MySQLi*) et produire un *affichage dynamique*.
– Générer du HTML5 sémantiquement structuré à l’aide des microdonnées schema.org.
– Rendre les données à la fois lisibles par les humains et interprétables par les machines (OSDS).
– Formaliser une démarche réflexive dans un court reporting méthodologique.
## Contexte et scénario

Vous êtes chargé.e.s de produire une page culturelle web (exposition, œuvre, artiste, événement, lieu patrimonial, collection, etc.) destinée à un site de médiation numérique.

Les contenus affichés ne sont pas codés “en dur” : ils proviennent d’une base de données alimentée à partir d’un jeu de données structuré et normalisé avec OpenRefine.
Corpus de données

Chaque groupe de 2-3 choisit un type d’objet culturel, par exemple :

    – Œuvres d’un musée
    – Expositions temporaires
    – Artistes contemporains ou personnes inspirantes (qui sont dans wikidata)
    – Festivals culturels
    – Lieux patrimoniaux

Le corpus doit comporter au minimum 10 entités culturelles et inclure des champs documentaires structurants (titre, description, date, lieu, auteur, URL, etc.).

## Chaîne de traitement attendue

### Collecte et préparation des données
    – Collecte depuis une source ouverte ou semi-ouverte (CSV, API, site institutionnel).
    – Nettoyage, normalisation, homogénéisation avec OpenRefine.
    – Alignement si pertinent (lieux, types, personnes).
    – Export final vers un format exploitable pour l’import en base de données.

### Modélisation et base de données
    – Conception d’une base MySQL (1 table).
    – Définition explicite des champs et types.
    – Import des données nettoyées.

### Chargement des données en PHP
    – Connexion à la base via MySQLi.
    – Requête SQL de sélection.
    – Chargement des résultats dans une structure PHP.
    – Parcours des données avec une boucle foreach.

### Génération d’une page HTML5 sémantique
    – Génération dynamique du HTML5 à partir des données.
    – Utilisation des microdonnées schema.org adaptées au type d’objet choisi
    (ex. Event, CreativeWork, Place, Person, ExhibitionEvent, etc.).
    – Respect d’une structure HTML5 valide et lisible.
    – Mise en forme minimale (lisibilité, hiérarchie visuelle).

### Accessibilité machine
    – Vérification de l’interoprétabilité des microdonnées à l’aide du plugin OSDS.
    – Cohérence entre structure documentaire, HTML et sémantique.

### Contraintes techniques obligatoires
    – HTML5 valide --> vue l'année dernière
    – PHP --> pas de panique vous aurez un gabarit ;) 
    – MySQLi --> connecteur de base de données
    – Boucle foreach pour l’affichage
    – Microdonnées schema.org ou JSON-LD
    – Données issues d’OpenRefine
    – Page unique (une seule page HTML/PHP)

### Livrables attendus

#### La page web fonctionnelle
    – Fichier .php opérationnel
    – Base de données fonctionnelle (exportée en SQL)
    – Microdonnées exploitables par OSDS (capture d'écran dans le reporting)
    
#### Mini reporting (≈ 3 pages)
    Le document doit expliciter clairement :
    – Le choix du corpus et des sources
    – Le travail réalisé dans OpenRefine (nettoyage, normalisation, choix structuraux)
    – Le modèle de données retenu
    – Les choix schema.org effectués
    – Les difficultés rencontrées (techniques, documentaires, sémantiques)
    – Les limites du dispositif et pistes d’amélioration

### Points de vigilance :

– Qualité documentaire et cohérence du corpus
– Pertinence de la modélisation des données
– Fonctionnalité du chargement PHP / MySQL
– Qualité et justesse des microdonnées schema.org
– Lisibilité humaine de la page
– Interprétabilité machine (OSDS)
– Clarté, rigueur et réflexivité du reporting

Documentation numérique, structuration de l’information, web sémantique, humanités numériques, publication orientée données, médiation culturelle numérique

## Livrable : 
Une archive avec l'export de la base de données en SQL, fichier php (HTML), reporting
