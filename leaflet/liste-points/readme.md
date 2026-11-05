# Concevoir un dispositif cartographique documentaire avec les technologies du Web
## Support d’apprentissage — Master 1 CTM

**Module :** structuration des données, publication Web et médiation numérique  
**Objet d’apprentissage :** concevoir une carte interactive alimentée par un jeu de données, enrichie de ressources documentaires et présentée dans une interface accessible et adaptable.

---

## Présentation du module

Une carte Web ne se réduit pas à l’affichage de points sur un fond géographique. Elle constitue un dispositif documentaire : chaque localisation peut être associée à des données descriptives, des images, des liens et des ressources externes. La carte organise ces informations, les rend consultables et propose un parcours de navigation.

Ce module présente une méthode de conception qui articule quatre composantes :

1. **les données**, qui décrivent les lieux et leurs caractéristiques ;
2. **la structure documentaire**, qui organise les contenus dans une page HTML ;
3. **les traitements et interactions**, assurés notamment par JavaScript et une bibliothèque cartographique ;
4. **la présentation**, définie par les feuilles de style CSS.

L’objectif est de comprendre l’architecture d’ensemble et de savoir spécifier, construire, contrôler et faire évoluer un dispositif de ce type. Il n’est pas nécessaire de devenir développeur spécialiste : il faut en revanche maîtriser les concepts, le vocabulaire et les points de contrôle qui permettent de dialoguer avec une équipe technique ou de piloter un projet numérique.

## Objectifs d’apprentissage

À l’issue du module, l’étudiant doit pouvoir :

- décrire l’architecture fonctionnelle d’une carte Web ;
- distinguer les rôles du HTML, du CSS, du JavaScript et des données ;
- construire un modèle de données tabulaire adapté à la représentation de lieux ;
- organiser un projet en séparant code, données et ressources numériques ;
- expliquer la différence entre partager un document et publier un jeu de données ;
- intégrer des images, des vidéos et des liens dans une page ;
- distinguer les URL absolues et relatives ;
- identifier les enjeux de provenance, de licence et d’hébergement des médias ;
- comprendre les principes des sélecteurs CSS et des règles responsive ;
- contrôler la qualité structurelle du HTML et tester le dispositif dans son environnement de publication.

## Prérequis et matériel de travail

Le module suppose une familiarité élémentaire avec la navigation Web, les fichiers et les dossiers, ainsi qu’avec les notions de page HTML et de tableur.

Un environnement de travail peut comprendre :

- un navigateur Web récent ;
- un éditeur de texte ou de code ;
- un tableur ;
- un espace de stockage ou un hébergement permettant de publier les fichiers ;
- une bibliothèque cartographique Web telle que Leaflet ;
- un fond cartographique tel qu’OpenStreetMap, dans le respect de ses conditions d’utilisation.

---

# 1. La carte Web comme dispositif documentaire

## 1.1. Localiser, décrire, relier

Une carte interactive associe une position géographique à une entité décrite. Un marqueur représente un lieu ; une fenêtre contextuelle (*popup*) peut en présenter le nom, une description, une image et un lien vers une ressource complémentaire.

La carte assure ainsi une fonction de médiation : elle relie une information géographique à des contenus documentaires et permet à l’utilisateur de passer de la vue d’ensemble à une information localisée.

| Information | Fonction documentaire | Exemple de champ |
|---|---|---|
| Nom du lieu | Identifier l’entité | `nom` |
| Localité | Situer le lieu dans son contexte | `ville` |
| Latitude et longitude | Localiser précisément l’entité | `latitude`, `longitude` |
| Description | Donner des éléments de compréhension | `description` |
| Image | Donner à voir ou illustrer | `image` |
| Lien | Orienter vers une ressource | `lien` |

La précision de la carte dépend de la qualité des données. Une coordonnée erronée produit un marqueur mal positionné ; un intitulé imprécis rend le lieu difficile à identifier ; une image inaccessible dégrade la consultation.

## 1.2. Fond cartographique et attribution

Une carte Leaflet peut afficher des tuiles cartographiques provenant d’OpenStreetMap. Leaflet assure la présentation et l’interaction ; les données cartographiques proviennent du service de tuiles utilisé.

Il faut donc distinguer la bibliothèque qui construit l’interface cartographique et le fournisseur du fond de carte. Les conditions d’utilisation et les obligations d’attribution du fond doivent être respectées. L’attribution rend visible la provenance de la ressource et participe à sa traçabilité.

## 1.3. Concevoir l’expérience de consultation

Le niveau de zoom, la densité des marqueurs et le contenu des fenêtres contextuelles déterminent la lisibilité de la carte. Le choix doit être adapté à la nature des lieux et à l’usage attendu.

Avant de développer, formuler les questions suivantes :

- Que doit permettre de comprendre la carte ?
- Quel territoire couvre-t-elle ?
- Quel niveau de précision géographique est nécessaire ?
- Quelles informations doivent être visibles immédiatement ?
- Quelles informations peuvent être proposées après un clic ?
- Quelles ressources complémentaires l’utilisateur doit-il pouvoir consulter ?

**À retenir.** Une carte documentaire se conçoit à partir d’un besoin de consultation et d’un modèle de données. L’interface cartographique vient donner forme à ces choix.

---

# 2. Architecture d’un dispositif cartographique Web

## 2.1. Séparer les responsabilités

Une architecture simple repose sur plusieurs composants qui remplissent des fonctions distinctes.

| Composant | Responsabilité | Exemple |
|---|---|---|
| HTML | Structure et sémantique du document | En-tête, navigation, article, zone cartographique |
| CSS | Présentation et mise en page | Couleurs, dimensions, typographie, adaptation aux écrans |
| JavaScript | Traitements et interactions | Initialisation de la carte, lecture des données, création des marqueurs |
| CSV | Conservation des données | Liste des lieux et de leurs coordonnées |
| Répertoire `assets` | Conservation des ressources numériques | Images, vidéos, fichiers audio, documents |

Cette séparation rend le projet plus lisible, facilite les corrections et permet à plusieurs personnes de travailler sur des parties différentes.

### HTML : structurer le document

HTML (*HyperText Markup Language*) décrit la structure du contenu. Les balises indiquent la nature des éléments : titre, paragraphe, navigation, article, image, vidéo ou pied de page.

### CSS : définir la présentation

CSS (*Cascading Style Sheets*) décrit la manière dont les éléments sont présentés. Une même structure HTML peut recevoir plusieurs habillages sans que son contenu change.

### JavaScript : gérer les traitements et les interactions

JavaScript permet de manipuler le document, de charger des données et de réagir aux actions de l’utilisateur. Dans une carte, il initialise la bibliothèque cartographique, récupère les données et construit les marqueurs et leurs fenêtres contextuelles.

### CSV : conserver les données

Le fichier CSV constitue une source de données indépendante du code. Il peut être mis à jour sans réécrire le mécanisme de visualisation, à condition de conserver la structure attendue par le programme.

## 2.2. Organiser les fichiers

Une organisation possible du projet est la suivante :

```text
projet_cartographique/
├── index.html
├── css/
│   └── style.css
├── js/
│   └── carte.js
├── data/
│   └── lieux.csv
└── assets/
    ├── images/
    ├── videos/
    ├── audio/
    └── documents/
```

Cette arborescence est un modèle de travail. Elle peut être adaptée au projet, mais les noms de fichiers et les chemins référencés dans le code doivent rester cohérents.

Une convention de nommage stable facilite le repérage. On peut, par exemple, utiliser des noms explicites en minuscules, sans espaces, et séparer les mots par des tirets ou des caractères de soulignement. L’essentiel est de choisir une règle et de l’appliquer de manière homogène.

## 2.3. Documenter le code

Les commentaires expliquent l’intention d’un bloc de code, le rôle d’une variable ou une décision de conception. Ils ne remplacent pas des noms explicites et une organisation lisible, mais facilitent la reprise du projet.

La qualité structurelle du code concerne aussi les personnes et les outils qui le lisent : navigateur, validateur, moteur d’indexation ou système automatisé. Une structure régulière améliore la maintenabilité et l’interopérabilité.

---

# 3. Modéliser les lieux dans un fichier CSV

## 3.1. Pourquoi externaliser les données ?

Lorsque les informations sont écrites directement dans le JavaScript, chaque ajout ou modification oblige à intervenir dans le code. Cette méthode peut convenir à une démonstration limitée, mais elle devient peu commode lorsque le nombre de lieux augmente ou que plusieurs personnes contribuent au contenu.

En externalisant les données dans un CSV, on distingue :

- le **jeu de données**, qui décrit les lieux ;
- le **programme**, qui transforme ces données en marqueurs ;
- la **page**, qui accueille et présente la carte.

Le CSV devient ainsi le modèle de données exploité par le dispositif.

## 3.2. Comprendre le format CSV

CSV signifie *Comma-Separated Values*. Il s’agit d’un format textuel dans lequel chaque ligne représente un enregistrement et chaque colonne une propriété. Les valeurs sont séparées par un délimiteur, souvent une virgule ou un point-virgule selon les conventions retenues.

Exemple de structure :

```csv
nom,ville,latitude,longitude,description,image,lien
Château de Chantilly,Chantilly,49.193,2.485,Château et domaine,https://exemple.org/chantilly.jpg,https://exemple.org
```

Les données de cet exemple sont illustratives. Les coordonnées et les URL doivent être vérifiées avant toute publication.

## 3.3. Définir un schéma de données

Un schéma explicite les champs attendus, leur signification et les règles de saisie. Pour le projet cartographique, on peut retenir le modèle suivant :

| Champ | Type attendu | Règle de qualité |
|---|---|---|
| `nom` | Texte | Nom explicite et stable |
| `ville` | Texte | Commune ou localité correctement orthographiée |
| `latitude` | Nombre décimal | Valeur comprise entre -90 et 90 |
| `longitude` | Nombre décimal | Valeur comprise entre -180 et 180 |
| `description` | Texte | Information concise et compréhensible |
| `image` | URL | Adresse accessible vers une image |
| `lien` | URL | Adresse d’une ressource pertinente |

Les noms des colonnes doivent correspondre à ceux utilisés par le programme. Si le code attend `latitude` et que le fichier contient `lat`, le champ ne sera pas retrouvé sans adaptation du script.

Il faut également choisir une convention cohérente pour les nombres décimaux et le séparateur CSV. Les virgules présentes dans une description peuvent nécessiter un encadrement correct des champs selon les règles du format.

## 3.4. Contrôler les coordonnées

La latitude indique la position nord-sud ; la longitude indique la position est-ouest. Leur ordre doit être respecté dans le fichier et dans le code.

Quelques contrôles simples :

- vérifier que les deux coordonnées sont renseignées ;
- vérifier que les valeurs sont numériques ;
- vérifier leurs plages de validité ;
- comparer la position affichée avec une carte de référence ;
- contrôler les lieux qui apparaissent très éloignés du territoire étudié.

Une coordonnée valide au sens numérique peut malgré tout être erronée pour le lieu décrit. Le contrôle cartographique reste donc nécessaire.

## 3.5. Faire évoluer le jeu de données

Le versionnement permet d’identifier les états successifs d’un fichier. Une version telle que `lieux_v2.csv` peut être utile lorsqu’une structure ou un contenu change de manière significative.

Il convient de conserver une convention stable et de mettre à jour la référence appelée par le programme. Le nom du fichier, son emplacement et le chemin inscrit dans le code doivent correspondre.

**À retenir.** Le CSV n’est pas une simple liste improvisée : c’est un jeu de données qui doit posséder une structure explicite, des règles de saisie et des contrôles de qualité.

---

# 4. Partager, publier et consommer les données

## 4.1. Le partage collaboratif

Un tableur partagé permet à plusieurs contributeurs de consulter ou de modifier un même document. Le partage repose sur un périmètre d’accès et des autorisations.

On distingue généralement :

- la consultation : lire le contenu ;
- la modification : ajouter ou corriger des informations ;
- la gestion du partage : définir qui peut accéder au document et avec quels droits.

Dans un environnement de travail, il faut attribuer les droits nécessaires sans ouvrir plus largement le document que ne l’exige le projet.

Les droits techniques d’un système de fichiers — lecture, écriture, exécution — ne se confondent pas avec les niveaux d’autorisation proposés par une application de partage. Ils ne se confondent pas non plus avec les droits juridiques de réutilisation.

## 4.2. Partager un document et publier un jeu de données : deux opérations différentes

Le document partagé est un espace de production. Il peut contenir des données en cours de saisie et être réservé aux contributeurs.

La publication d’un CSV expose au contraire une représentation des données destinée à être consultée ou consommée par une autre application.

| Espace de travail partagé | Jeu de données publié |
|---|---|
| Sert à contribuer et corriger les données | Sert à diffuser les données |
| Accès généralement contrôlé | Accès défini par les paramètres de publication |
| Peut contenir des éléments de travail | Doit être préparé pour la consultation |
| Interface conçue pour les contributeurs | Ressource destinée à être consommée par un outil ou un site |

La publication doit être réfléchie : un document qui contient des informations personnelles, confidentielles ou non destinées au public ne doit pas être rendu accessible sans vérification.

## 4.3. Le principe du flux de données

Un service de tableur peut permettre de publier un onglet sous forme de CSV. L’application cartographique peut alors récupérer ce fichier à partir de son URL.

Le circuit fonctionnel est le suivant :

```text
Tableur partagé
      │
      │ publication d’un onglet au format CSV
      ▼
URL du jeu de données publié
      │
      │ récupération par le navigateur
      ▼
Script JavaScript
      │
      │ interprétation des lignes et des champs
      ▼
Marqueurs et fenêtres contextuelles
      │
      ▼
Carte consultable
```

Le principe est de dissocier l’interface de saisie des données et leur mode de diffusion. Une modification du jeu de données peut être répercutée dans la carte si le service republie la version actualisée et si le script récupère bien cette ressource.

## 4.4. Tester la ressource publiée

Avant de connecter le CSV à la carte, ouvrir son URL dans un navigateur. Vérifier que le résultat correspond bien à un contenu CSV et non à une page HTML de présentation ou à un téléchargement inattendu.

Si le chargement échoue, examiner successivement :

1. l’URL utilisée ;
2. les droits et paramètres de publication ;
3. le format réellement retourné ;
4. le nom et la structure des colonnes ;
5. les éventuelles restrictions du navigateur ou du serveur ;
6. la correspondance entre les champs du CSV et ceux attendus par le script.

Un fichier téléchargé localement peut servir à tester le projet, mais une page publiée ne pourra pas charger un fichier qui reste uniquement sur l’ordinateur du concepteur. Les ressources nécessaires à la consultation doivent être hébergées à une adresse accessible.

## 4.5. URL lisible et QR code

Une URL longue peut être difficile à communiquer ou à saisir. Un service de redirection peut produire une adresse plus courte ; un QR code peut faciliter l’accès depuis un téléphone.

Ces outils ne changent pas la ressource elle-même : ils proposent un moyen plus pratique d’y accéder. Il faut vérifier que l’URL courte redirige vers la bonne destination et qu’elle restera disponible dans le temps.

---

# 5. Intégrer des ressources documentaires et multimédias

Une carte peut associer aux lieux des images, des vidéos, des fichiers audio et des liens. Ces ressources enrichissent l’expérience de consultation, mais elles introduisent des questions d’accessibilité, de provenance, de droits et d’hébergement.

## 5.1. Liens et images en HTML

Un lien hypertexte utilise la balise `<a>` et l’attribut `href` :

```html
<a href="https://www.exemple.org/lieu">
  Consulter la présentation du lieu
</a>
```

Le texte du lien doit être explicite et permettre d’anticiper la destination.

Une image utilise la balise `<img>` :

```html
<img
  src="assets/images/lieu.jpg"
  alt="Façade principale du bâtiment">
```

L’attribut `src` indique l’adresse de l’image. L’attribut `alt` fournit une alternative textuelle utile lorsque l’image ne peut pas être affichée ou lorsque le contenu est consulté avec une technologie d’assistance. Le texte alternatif doit décrire la fonction ou l’information apportée par l’image dans son contexte.

La balise `<abbr>` peut servir à développer une abréviation :

```html
<abbr title="Pierre Mendès France">PMF</abbr>
```

## 5.2. Images distantes et hotlinking

Le *hotlinking* consiste à afficher dans une page une image hébergée sur un autre serveur, en réutilisant directement son URL.

Cette méthode est simple, mais le serveur d’origine peut refuser l’affichage depuis un autre domaine. Il peut notamment limiter l’utilisation de sa bande passante par des sites tiers. Une image visible sur son site d’origine n’est donc pas nécessairement intégrable dans une page externe.

Il faut distinguer trois questions :

1. **Accessibilité technique :** le navigateur peut-il récupérer le fichier ?
2. **Conditions d’utilisation :** le serveur autorise-t-il l’intégration distante ?
3. **Droits de réutilisation :** la licence ou l’autorisation permet-elle l’usage envisagé ?

Ces questions sont liées, mais elles ne sont pas équivalentes. Une image techniquement accessible n’est pas automatiquement libre de droits ; une image réutilisable peut être hébergée sur un serveur qui bloque le hotlinking.

Lorsque c’est possible et autorisé, on peut héberger les médias dans un espace maîtrisé par le projet. Il faut toutefois conserver les informations de provenance et respecter les licences.

## 5.3. Provenance, licences et attribution

Pour chaque image ou média, documenter autant que possible :

- le titre ou la description de la ressource ;
- son auteur ou son organisme producteur ;
- sa source ;
- sa licence ou les conditions de réutilisation ;
- la date de consultation ou de récupération, lorsque cela est utile.

Les ressources issues de communs numériques peuvent être réutilisables sous certaines conditions. Il faut lire et respecter la licence applicable, notamment les obligations d’attribution ou les restrictions éventuelles.

La provenance doit être conservée dans le projet, et pas seulement dans la mémoire du contributeur.

## 5.4. Intégrer une vidéo hébergée sur une plateforme

Pour intégrer une vidéo YouTube, la méthode usuelle consiste à utiliser le code d’intégration fourni par la plateforme. Celui-ci repose généralement sur une balise `<iframe>`.

```html
<iframe
  src="https://www.youtube-nocookie.com/embed/IDENTIFIANT_VIDEO"
  title="Présentation du lieu"
  width="560"
  height="315"
  allowfullscreen>
</iframe>
```

L’identifiant doit être remplacé par celui de la vidéo concernée. Certaines vidéos ne peuvent pas être intégrées, selon les choix de leur propriétaire ou les restrictions de la plateforme.

Une `iframe` incorpore un lecteur distant dans la page ; elle ne signifie pas que le fichier vidéo est téléchargé et hébergé dans le projet.

Les balises `<embed>` et `<object>` existent également pour intégrer des ressources externes. Pour une vidéo hébergée sur une plateforme, il est préférable d’utiliser le mécanisme d’intégration qu’elle fournit.

## 5.5. Intégrer ses propres fichiers vidéo avec HTML5

La balise `<video>` permet d’intégrer un fichier vidéo hébergé avec les ressources du projet ou sur un serveur accessible.

```html
<video controls width="560">
  <source src="assets/videos/presentation.mp4" type="video/mp4">
  Votre navigateur ne peut pas lire cette vidéo.
</video>
```

Les principaux attributs sont :

| Attribut | Fonction |
|---|---|
| `controls` | Afficher les commandes de lecture |
| `autoplay` | Demander le démarrage automatique |
| `muted` | Couper le son |
| `loop` | Relancer la vidéo à la fin |
| `poster` | Afficher une image avant la lecture |

Le démarrage automatique avec le son est souvent limité par les navigateurs. Il est préférable de laisser à l’utilisateur le contrôle de la lecture et d’éviter les sons inattendus.

### Proposer plusieurs formats

Plusieurs éléments `<source>` peuvent être proposés. Le navigateur choisit une source qu’il est capable de lire.

```html
<video controls width="560">
  <source src="assets/videos/presentation.webm" type="video/webm">
  <source src="assets/videos/presentation.mp4" type="video/mp4">
  Votre navigateur ne peut pas lire cette vidéo.
</video>
```

| Format | Caractéristique générale | Point d’attention |
|---|---|---|
| MP4 | Conteneur très répandu, souvent associé au codec H.264 | Choix courant pour la diffusion Web |
| WebM | Format ouvert conçu pour le Web | Vérifier la compatibilité des navigateurs et des codecs |
| Ogg / OGV | Formats ouverts de l’écosystème Ogg | Prise en charge moins uniforme |
| AVI | Conteneur historique | Peu adapté comme format de diffusion Web par défaut |
| MKV | Conteneur polyvalent souvent utilisé pour l’archivage | Compatibilité HTML5 non universelle |

La compatibilité dépend du conteneur, du codec et du navigateur. L’extension seule ne garantit pas la lecture.

## 5.6. Audio et sous-titres

Le principe d’intégration s’applique également à l’audio avec la balise `<audio>`.

```html
<audio controls>
  <source src="assets/audio/temoignage.mp3" type="audio/mpeg">
  Votre navigateur ne peut pas lire ce fichier audio.
</audio>
```

Les sous-titres d’une vidéo peuvent être associés au moyen de la balise `<track>`, généralement avec un fichier WebVTT :

```html
<video controls>
  <source src="assets/videos/presentation.mp4" type="video/mp4">
  <track
    kind="captions"
    src="assets/subtitles/presentation.fr.vtt"
    srclang="fr"
    label="Français"
    default>
</video>
```

Le fichier de sous-titres associe des repères temporels aux segments de texte. Les sous-titres contribuent à l’accessibilité et à la compréhension des contenus audiovisuels.

## 5.7. URL absolues et URL relatives

Une URL absolue indique l’adresse complète d’une ressource, avec le protocole et le domaine :

```html
<img src="https://www.exemple.org/images/lieu.jpg" alt="Vue du lieu">
```

Une URL relative indique le chemin de la ressource par rapport à l’emplacement du document courant :

```html
<img src="../assets/images/lieu.jpg" alt="Vue du lieu">
```

Dans un chemin relatif, `..` signifie que l’on remonte d’un niveau dans l’arborescence.

| Type d’URL | Avantage | Limite |
|---|---|---|
| Absolue | Adresse explicite et indépendante de la position de la page | Peut devenir invalide si le domaine ou le chemin change |
| Relative | Facilite le déplacement d’un ensemble de fichiers organisé de manière cohérente | Dépend de la position du document qui contient le lien |

Le choix doit être testé dans l’environnement réel de publication. Un chemin qui fonctionne en local peut être incorrect une fois le site déployé.

## 5.8. Gérer les ressources numériques

Le répertoire `assets` rassemble les ressources nécessaires au dispositif : images, vidéos, sons, documents et sous-titres. Dans les organisations, ces ressources peuvent être gérées par un système de *Digital Asset Management* (DAM).

La conversion ou le transcodage peut être utile pour adapter un média à différents usages. Des outils tels que VLC permettent notamment de lire de nombreux formats et de convertir des fichiers.

**Précaution :** un convertisseur en ligne reçoit le fichier qui lui est transmis. Il faut éviter d’y déposer des contenus confidentiels ou sensibles. Pour ces contenus, utiliser un outil local ou un service institutionnel dont les garanties sont connues.

---

# 6. Construire la présentation avec CSS

## 6.1. Structure et présentation : deux couches distinctes

CSS (*Cascading Style Sheets*) décrit la présentation des documents HTML. Il peut également être associé à des documents XML afin d’en proposer un rendu visuel.

La distinction est fondamentale : HTML décrit la structure et le sens des éléments ; CSS définit leur apparence. Une même page HTML peut ainsi recevoir plusieurs habillages.

Cette séparation permet de faire évoluer le design sans réécrire la structure documentaire. Elle facilite aussi la cohérence graphique entre plusieurs pages.

## 6.2. Trois manières d’appliquer des styles

| Méthode | Emplacement | Usage |
|---|---|---|
| Style en ligne | Attribut `style` d’une balise | Modification ponctuelle, à éviter pour structurer un projet |
| Feuille interne | Élément `<style>` dans l’en-tête HTML | Exemple simple ou document isolé |
| Feuille externe | Fichier `.css` relié par `<link>` | Méthode recommandée pour un projet maintenable |

### Style en ligne

```html
<h1 style="color: navy; font-size: 1.5rem;">
  Titre de la page
</h1>
```

### Feuille interne

```html
<head>
  <style>
    h1 {
      color: navy;
      font-size: 1.5rem;
    }
  </style>
</head>
```

### Feuille externe

Dans le document HTML :

```html
<link rel="stylesheet" href="css/style.css">
```

Dans le fichier `css/style.css` :

```css
h1 {
  color: navy;
  font-size: 1.5rem;
}
```

La feuille externe permet de regrouper les règles de présentation dans un fichier dédié et de les réutiliser sur plusieurs pages.

## 6.3. Lire une règle CSS

Une règle CSS comprend un sélecteur et un bloc de déclarations.

```css
article {
  color: #243247;
  font-size: 1rem;
  text-align: justify;
}
```

| Élément | Rôle |
|---|---|
| `article` | Sélecteur : désigne les éléments concernés |
| `color` | Propriété : définit la couleur du texte |
| `#243247` | Valeur de la propriété |
| `font-size` | Propriété : définit la taille du texte |
| `;` | Sépare les déclarations |
| `{ }` | Délimitent le bloc de règles |

Une déclaration associe donc une propriété à une valeur. Les déclarations sont séparées par des points-virgules. Les écrire sur des lignes distinctes facilite la lecture et la maintenance.

## 6.4. Les trois sélecteurs fondamentaux

### Sélecteur de balise

Le nom de la balise cible tous les éléments de ce type :

```css
header {
  background-color: #244f68;
  color: white;
}

article {
  text-align: justify;
}

footer {
  font-size: 0.85rem;
}
```

### Sélecteur d’identifiant

Un identifiant est déclaré avec l’attribut `id` dans le HTML et ciblé par `#` en CSS :

```html
<header id="bandeau">
  <h1>Mon site</h1>
</header>
```

```css
#bandeau {
  background-color: #244f68;
  color: white;
}
```

Un identifiant doit être unique dans un document HTML. Il convient lorsqu’on veut cibler un élément particulier.

### Sélecteur de classe

Une classe est déclarée avec l’attribut `class` et ciblée par un point en CSS :

```html
<footer class="pied_de_page">
  Mentions légales
</footer>
```

```css
.pied_de_page {
  color: #5c6878;
  font-size: 0.85rem;
}
```

Une classe peut être réutilisée sur plusieurs éléments, y compris sur des balises de types différents. Elle permet de définir un ensemble de règles de présentation réutilisables.

| Type de sélecteur | Syntaxe | Portée |
|---|---|---|
| Balise | `article { ... }` | Tous les éléments `article` |
| Identifiant | `#bandeau { ... }` | L’élément portant cet identifiant |
| Classe | `.pied_de_page { ... }` | Tous les éléments portant cette classe |

## 6.5. S’appuyer sur les éléments sémantiques HTML

Une structure de page peut utiliser les éléments suivants :

| Élément | Fonction |
|---|---|
| `<header>` | En-tête d’une page ou d’une section |
| `<nav>` | Zone de navigation |
| `<main>` | Contenu principal du document |
| `<article>` | Contenu autonome |
| `<section>` | Regroupement thématique de contenu |
| `<aside>` | Contenu complémentaire associé au contenu principal |
| `<footer>` | Pied de page d’une page ou d’une section |

Ces éléments expriment la fonction du contenu. Le CSS permet ensuite de définir leur présentation sans modifier leur rôle sémantique.

## 6.6. Positionner un élément complémentaire

La balise `<aside>` peut accueillir un contenu secondaire : encadré, menu complémentaire ou information contextuelle.

La propriété `position: fixed` permet de maintenir un élément à une position donnée dans la fenêtre du navigateur, même lorsque l’utilisateur fait défiler la page.

```css
.aside_fixe {
  position: fixed;
  top: 70px;
  left: 8px;
  width: 180px;
  min-height: 200px;
  background-color: #e7edf1;
}
```

Un élément fixe doit être utilisé avec discernement. Il peut masquer le contenu principal, réduire l’espace de lecture ou gêner la consultation sur un petit écran. Il faut contrôler les dimensions, les marges et les comportements responsive.

---

# 7. Adapter l’affichage aux contextes de consultation

## 7.1. Responsive design et Media Queries

Le *responsive design* consiste à adapter la présentation d’un site aux différentes conditions de consultation : largeur d’écran, orientation, type de média et usages.

Les *Media Queries* permettent d’appliquer des règles CSS lorsque certaines conditions sont réunies.

```css
@media screen and (max-width: 1024px) {
  article {
    width: 100%;
  }

  aside {
    display: none;
  }
}
```

Dans cet exemple, les règles s’appliquent aux écrans dont la largeur ne dépasse pas 1024 pixels. L’article occupe toute la largeur disponible et le contenu latéral est masqué.

Il ne suffit pas de réduire les dimensions d’une page : il faut adapter la hiérarchie des informations et la disposition des éléments aux conditions de consultation.

## 7.2. Prévoir un rendu imprimable

Une feuille de style peut être prévue pour l’impression ou l’enregistrement d’une page au format PDF.

```css
@media print {
  header,
  nav,
  aside,
  footer {
    display: none;
  }

  article {
    width: 100%;
    margin: 10px;
    color: black;
  }
}
```

L’objectif est de privilégier le contenu principal et de retirer les éléments qui n’ont pas d’utilité sur papier : navigation, menus ou zones latérales.

## 7.3. Types de médias

| Média | Usage |
|---|---|
| `all` | Règles applicables à tous les médias |
| `screen` | Affichage sur écran |
| `print` | Impression |
| `speech` | Présentation destinée à une restitution vocale |

Les adaptations d’accessibilité peuvent également porter sur le contraste, la taille des caractères, la lisibilité et la réduction des éléments qui perturbent la consultation. Une feuille de style ne remplace toutefois pas une démarche complète d’accessibilité : la structure sémantique, les alternatives textuelles, la navigation au clavier et les tests avec des technologies d’assistance restent nécessaires.

---

# 8. Contrôler la qualité du dispositif

## 8.1. Valider le HTML

Le validateur du W3C permet de contrôler la conformité structurelle d’un document HTML. Il peut être utilisé à partir d’une URL ou d’un code source.

La démarche est itérative :

1. soumettre le document ;
2. examiner les erreurs et avertissements ;
3. repérer l’élément concerné ;
4. corriger le code ;
5. relancer la validation ;
6. vérifier que la correction n’a pas introduit un nouveau problème.

Une erreur indique un problème de conformité à corriger. Un avertissement signale un point à examiner, sans avoir nécessairement le même statut qu’une erreur bloquante.

La validation structurelle ne garantit pas à elle seule l’accessibilité, la sécurité, la pertinence éditoriale ou le bon fonctionnement de toutes les interactions. Elle constitue néanmoins un contrôle technique indispensable.

## 8.2. Tester dans l’environnement réel

Un dispositif peut fonctionner sur l’ordinateur de son auteur et échouer une fois publié. Les différences peuvent venir des chemins de fichiers, des droits d’accès, du chargement des ressources ou des restrictions du serveur.

Les tests doivent donc être effectués dans les conditions réelles de consultation :

- ouvrir la page depuis son adresse publiée ;
- vérifier le chargement du CSV ;
- contrôler les marqueurs et les fenêtres contextuelles ;
- tester les images, les vidéos et les liens ;
- vérifier l’affichage sur plusieurs tailles d’écran ;
- contrôler le rendu imprimé si cette fonction est attendue ;
- examiner les messages d’erreur éventuels du navigateur.

## 8.3. Sécurité des contenus injectés

Lorsque JavaScript insère du contenu dans une page, il faut distinguer les données de confiance et les contenus provenant d’une source externe. L’injection directe d’une chaîne HTML avec `innerHTML` peut interpréter du code fourni dans les données.

Pour des contenus externes, il est préférable de créer les éléments DOM de manière contrôlée et d’insérer les textes avec des propriétés adaptées, telles que `textContent`, plutôt que de concaténer sans précaution du HTML. La validation des URL et la maîtrise des sources font également partie du contrôle.

---

# 9. Méthode de réalisation d’un projet

La conception peut être conduite par étapes. Cette méthode permet de passer d’une intention éditoriale à un dispositif testable.

## Étape 1 — Définir le besoin

Préciser le sujet, le territoire, les publics et les usages attendus. Déterminer ce que l’utilisateur doit pouvoir repérer, comprendre et consulter.

**Livrable :** une courte note de cadrage décrivant l’objectif et le périmètre.

## Étape 2 — Définir le modèle de données

Identifier les entités à représenter et les propriétés nécessaires. Définir les champs, les types de valeurs et les règles de saisie.

**Livrable :** un schéma de données et un fichier CSV d’exemple.

## Étape 3 — Constituer et contrôler les données

Rassembler les lieux, vérifier les coordonnées, harmoniser les intitulés et contrôler les liens et les images.

**Livrable :** un jeu de données documenté et cohérent.

## Étape 4 — Organiser le projet

Créer les répertoires, nommer les fichiers et séparer structure HTML, styles CSS, scripts JavaScript, données et ressources médias.

**Livrable :** une arborescence de projet intelligible.

## Étape 5 — Construire la carte

Initialiser la carte, charger les données, créer les marqueurs et organiser les fenêtres contextuelles.

**Livrable :** une carte fonctionnelle alimentée par le jeu de données.

## Étape 6 — Enrichir les contenus

Ajouter des descriptions, des liens et des médias. Vérifier l’accessibilité technique et les conditions de réutilisation.

**Livrable :** des fenêtres contextuelles documentées et correctement attribuées.

## Étape 7 — Concevoir la présentation

Créer une feuille de style, définir la hiérarchie visuelle et adapter l’affichage aux différentes tailles d’écran.

**Livrable :** une interface cohérente et responsive.

## Étape 8 — Valider et tester

Contrôler le HTML, vérifier les chemins, tester les ressources et examiner le fonctionnement depuis l’hébergement final.

**Livrable :** une version testée, corrigée et publiable.

## Étape 9 — Documenter et transmettre

Fournir les informations nécessaires à la reprise du projet : arborescence, sources des données, licences, consignes de mise à jour et limites connues.

**Livrable :** une documentation courte permettant à une autre personne de comprendre et de maintenir le dispositif.

---

# 10. Mise en pratique

## Activité 1 — Construire un jeu de données géolocalisées

**Consigne :** constituer un fichier CSV comportant au moins cinq lieux appartenant à un même thème ou territoire.

Pour chaque lieu, renseigner le nom, la localité, la latitude, la longitude, une description, une URL d’image et un lien complémentaire.

**Points de contrôle :**

- les colonnes sont nommées de manière cohérente ;
- les coordonnées sont numériques et correctement ordonnées ;
- les descriptions sont compréhensibles ;
- les liens et les images sont accessibles ;
- les sources et conditions de réutilisation sont documentées.

## Activité 2 — Décrire l’architecture du dispositif

À partir d’un projet cartographique, identifier le rôle de chaque composant : HTML, CSS, JavaScript, CSV et répertoire des ressources.

**Question de synthèse :** que faudrait-il modifier pour changer le style de la carte sans toucher aux données ? Et pour ajouter un lieu sans réécrire le script ?

## Activité 3 — Intégrer un média

Ajouter une image et une vidéo à une page HTML. Pour chaque média, préciser son mode d’hébergement, son URL, sa provenance et ses conditions de réutilisation.

**Points de contrôle :**

- l’image possède un texte alternatif pertinent ;
- la vidéo dispose de contrôles de lecture ;
- le chemin fonctionne depuis la page publiée ;
- la ressource peut être utilisée dans le contexte du projet.

## Activité 4 — Créer une feuille de style

Créer une feuille CSS externe et appliquer :

- un style à un élément de type `header` ;
- un style à un élément portant un identifiant ;
- une classe réutilisable sur plusieurs éléments ;
- une règle responsive ;
- une règle spécifique à l’impression.

**Question de synthèse :** pourquoi la classe est-elle plus réutilisable qu’un identifiant ?

## Activité 5 — Réaliser un contrôle qualité

Valider le HTML et tester le dispositif publié. Consigner les problèmes identifiés, les corrections apportées et les résultats du nouveau test.

**Livrable :** une courte fiche de recette présentant les contrôles réalisés.

---

# 11. Synthèse : ce qu’il faut savoir expliquer

| Notion | Capacité attendue |
|---|---|
| Carte Web | Expliquer le rôle de la carte comme interface de consultation documentaire |
| Leaflet | Identifier sa fonction dans la construction d’une carte interactive |
| HTML | Décrire la structure et la sémantique d’une page |
| CSS | Expliquer la séparation entre structure et présentation |
| JavaScript | Décrire le rôle des traitements et des interactions |
| CSV | Définir un jeu de données tabulaire exploitable |
| Schéma de données | Définir les champs et les règles de saisie |
| Partage | Distinguer les droits d’accès à un document |
| Publication | Expliquer comment un jeu de données devient accessible à une application |
| Hotlinking | Expliquer pourquoi une image distante peut être bloquée |
| Licence | Distinguer accessibilité technique et droit de réutilisation |
| `iframe` | Expliquer l’intégration d’un contenu externe |
| `video` et `source` | Intégrer un média et proposer plusieurs formats |
| URL absolue | Identifier une adresse complète |
| URL relative | Calculer un chemin depuis l’emplacement du document |
| Sélecteur CSS | Distinguer balise, identifiant et classe |
| Media Query | Adapter les règles de présentation à un contexte |
| Validation W3C | Contrôler la conformité structurelle du HTML |
| Test de publication | Vérifier le fonctionnement depuis l’environnement réel |

## Autoévaluation

1. Pourquoi est-il utile de séparer le jeu de données du code JavaScript ?
2. Quelle différence existe-t-il entre le partage d’un tableur et la publication d’un CSV ?
3. Pourquoi une image visible sur un site peut-elle ne pas s’afficher lorsqu’elle est appelée depuis un autre domaine ?
4. Pourquoi l’accessibilité technique d’une image ne suffit-elle pas à établir le droit de la réutiliser ?
5. Quelle différence existe-t-il entre une URL absolue et une URL relative ?
6. Quel est le rôle respectif des balises HTML, des classes et des identifiants dans la mise en forme CSS ?
7. À quoi sert une Media Query ?
8. Pourquoi faut-il tester une page depuis son adresse publiée ?
9. Quel risque présente l’injection directe de données externes avec `innerHTML` ?
10. Que garantit — et que ne garantit pas — la validation HTML ?

## Glossaire

**Attribut** — Information ajoutée à une balise HTML pour préciser une propriété ou un comportement.

**CSS** — Langage de feuilles de style utilisé pour décrire la présentation des documents.

**CSV** — Format textuel tabulaire dans lequel les valeurs sont séparées par un délimiteur.

**DAM (Digital Asset Management)** — Dispositif ou système de gestion des ressources numériques d’une organisation.

**DOM (Document Object Model)** — Représentation structurée d’un document HTML que les scripts peuvent consulter et modifier.

**Hotlinking** — Intégration dans une page d’une ressource directement appelée depuis le serveur d’un autre site.

**HTML** — Langage de balisage qui structure les contenus d’une page Web.

**JavaScript** — Langage de programmation utilisé notamment pour les traitements et les interactions dans le navigateur.

**Leaflet** — Bibliothèque JavaScript destinée à la création de cartes interactives.

**Media Query** — Règle CSS qui conditionne l’application de styles à certaines caractéristiques du média ou de l’écran.

**OpenStreetMap** — Projet collaboratif de production d’une base de données géographiques ouverte.

**Popup** — Fenêtre contextuelle présentant des informations associées à un marqueur ou à un élément de l’interface.

**Responsive design** — Approche de conception qui adapte la présentation aux différents contextes de consultation.

**Sélecteur CSS** — Expression qui désigne les éléments HTML auxquels une règle de style s’applique.

**URL absolue** — Adresse complète d’une ressource, comprenant notamment le protocole et le domaine.

**URL relative** — Chemin d’accès défini à partir de l’emplacement du document courant.

**W3C** — Organisme de standardisation qui développe des recommandations pour le Web.

---

## Repères documentaires et techniques

Ce support formalise les notions travaillées dans le module autour de la cartographie Web, de la structuration des données, de l’intégration de ressources multimédias, du HTML et des CSS. Les exemples de code et les jeux de données présentés sont des exemples pédagogiques à adapter et à tester dans le contexte du projet.

Pour réaliser un dispositif, se reporter aux documentations techniques des outils effectivement retenus, aux conditions d’utilisation des fonds cartographiques et aux licences des ressources mobilisées. Les choix de formats, les possibilités de publication et les comportements des navigateurs peuvent évoluer : ils doivent être vérifiés au moment de la mise en œuvre.
