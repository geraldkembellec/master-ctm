# Web sémantique et ingénierie documentaire des contenus Web

## Support d'apprentissage - Master 1 CTM

### Séance du 18 novembre 2026 --- parties 1 et 2

---------------------------------------------------------
## Présentation et objectifs

Cette séance étudie la manière de concevoir une page Web comme un document structuré, interprétable par des personnes et par des agents logiciels : navigateurs, moteurs de recherche, plateformes de diffusion, outils de moissonnage et systèmes IA fondés sur les grands modèles de langage (LLM).

Le fil directeur est de **décrire explicitement la nature des contenus, leurs propriétés et leurs relations afin d'en faciliter l'identification, l'indexation, la circulation et la réutilisation**.

### À l'issue du module, l'étudiant doit pouvoir : 
- distinguer (1) structure HTML, (2) sémantique documentaire et (3) présentation graphique ; 
- expliquer l'intérêt des données structurées pour l'indexation et le moissonnage ; 
- distinguer formats technique de sémantique documentaire *Microdata*, *RDFa* et *JSON-LD* ; 
- comprendre la logique des types et propriétés sémantique documentaire du *Dublin Core* et de *Schema.org* ; 
- annoter une page HTML avec les microdonnées (*microdata*) ; 
- préparer la sémantique des métadonnées documentaires et sociales d'une page ; 
- contrôler la qualité HTML et sémantique d'un document ; 
- raisonner le chargement des ressources multimédias et planifier un projet.

# 1. La page Web comme document structuré

## 1.1. Du contenu à sa description

Une page Web contient des textes, images, dates, personnes, événements ou objets. Le lecteur humain déduit souvent leur signification de la mise en page et du contexte. Un agent logiciel a besoin d'indices explicites pour faciliter et accélérer la compréhension et l'identification ce qui est décrit sans passer par un couteux traitement informatique, potentiellement erroné. 

La structuration sémantique permet de passer d'une (1) succession de contenus à leur (2) description organisée : 
- **objet** : (sujet) recette, article, personne, événement, organisation ; 
- **propriétés** : (complément) nom, auteur, date, image, description ; 
- **relations** : (verbe) une recette est créée par une personne ; 

ex : un événement se déroule à une date et dans un lieu à l'aide de références qui désignent une entité et permettent de la relier à des référentiels externes : les **identifiants**. Un identifiant être utilisé comme **objet** ou **propriété**.

On en revient, pour un premier niveau, à une base de langage descriptif répondant à un énoncé [analytique](https://fr.wikipedia.org/wiki/%C3%89nonc%C3%A9_analytique) si les informations sont portées par l'énoncé de manière ontologique, structurelle ou alors synthétique s'il y a un lien externe pour en décrire des valeurs.

ex 1 : proposition analytique, (relation de classification) on sait que "Les misérables" est le titre (`name`) d'un objet de type livre (`Book`), donc c'est un livre :

``` html
<div itemscope itemtype="https://schema.org/Book">
  <span itemprop="name">Les Misérables</span>
</div>
```

ex 2 : proposition synthétique, "Les Misérables" a été écrit par Victor Hugo (information sur le monde extérieur).
``` html
<div itemscope itemtype="https://schema.org/Book">
  <span itemprop="name">Les Misérables</span>
  <span itemprop="author">Victor Hugo</span>
</div>
```

ex 3 : Proposition hybride, "Les Misérables" est un objet de type livre `Book` (proposition analytique),  rédigé par un auteur qui est une personne (proposition analytique) et pas un organisme ou un collectif donc. Cette personne est nommée "Victor Hugo", identifiée et décrite dans une base de connaissances extérieure : l'ISNI. Cette deuxième relation est un proposition synthétique, ce n'est pas un élément structurel.

``` html
<div itemscope itemtype="https://schema.org/Book">
  <span itemprop="name">Les Misérables</span>
  <div itemprop="author"
       itemscope
       itemtype="https://schema.org/Person"
       itemid="https://isni.org/isni/0000000121200982">
    <span itemprop="name">Victor Hugo</span>
  </div>
</div>
```
La page est donc à la fois une _interface de lecture_ et un _document porteur d'une description structurée_.

## 1.2. Trois niveaux complémentaires

| Niveau              | Fonction                | Exemples                                      |
|---------------------|-------------------------|-----------------------------------------------|
| Structure (balises) | Organiser le document   | `header`, `main`, `article`, `section`, `footer`, `time`, `aside` |
| Sémantique (attributs) | Qualifier les contenus  | `Recipe`, `Person`, `author`, `datePublished` |
| Présentation (style : CSS)       | Définir l'apparence     |  couleurs, marges, typographie            |

Une page peut être __soignée graphiquement__ tout en étant __pauvre sémantiquement__. 
Inversement, une structure documentaire bien conçue peut recevoir plusieurs présentations grâce aux feuilles de style (CSS).

## 1.3. Les éléments HTML sémantiques

### Balises et schémas

Il est possible d'utiliser des balises, sémantiques ou non, pour servir de support à des schémas, de [schema.org](schema.org)

#### Par exemple utiliser un `<article>` pour décrire une recette

| Article | `Recipe` | Objet principal |
|---|---|---|
| Schéma | `schema.org/Recipe` | Recette de cuisine |   

| Élément| Propriété ou type | Fonction documentaire habituelle |
|---|---|---|
| Titre | `name` | Nom de la recette |
| Auteur | `author` et `Person` | Personne à l'origine de la recette |
| Date | `datePublished` | Date de publication |
| Image | `image` | Illustration |
| Présentation | `description` | Résumé éditorial |
| Préparation | `prepTime` | Durée de préparation |
| Cuisson | `cookTime` | Durée de cuisson |
| Quantité | `recipeYield` | Quantité produite |
| Nutrition | `NutritionInformation` | Informations nutritionnelles |
| Ingrédients | `recipeIngredient` | Liste des ingrédients |
| Instructions | `recipeInstructions` | Étapes de préparation |

Ne pas confondre `head` et `header` :
- `head` contient les métadonnées techniques et documentaires de la page (l'en tête invisible à l'écran);
- `header` appartient au contenu affiché et constitue un en-tête au sein du `body`.

### Exemple d'organisation :

``` html
<body>
  <header>
    <h1>Le carnet documentaire</h1>
    <nav aria-label="Navigation principale">
      <a href="index.html">Accueil</a>
      <a href="articles.html">Articles</a>
    </nav>
  </header>

  <main>
    <article>
      <header>
        <h2>Un article documentaire</h2>
        <p>Publié le <time datetime="2026-11-18">18 novembre 2026</time></p>
      </header>
      <section>
        <h3>Présentation</h3>
        <p>Présentation du sujet traité.</p>
      </section>
      <section>
        <h3>Développement</h3>
        <p>Contenu principal.</p>
      </section>
    </article>
    <aside>
      <h2>Pour aller plus loin</h2>
      <p>Informations complémentaires.</p>
    </aside>
  </main>

  <footer>
    <p>Mentions légales et informations éditoriales.</p>
  </footer>
</body>
```

### `time` : associer une date lisible à une valeur normalisée

``` html
<p>
  La séance a lieu le
  <time datetime="2026-11-18">18 novembre 2026</time>.
</p>
```

La personne lit sur écran une date _naturelle_ ; l'agent logiciel peut exploiter la valeur **normalisée** [selon la norme ISO-8601](https://fr.wikipedia.org/wiki/ISO_8601) de l'attribut `datetime` de la balise `time`.

### `details` et `summary` : un accordéon natif

``` html
<details>
  <summary>Afficher les informations complémentaires</summary>
  <p>Ce contenu apparaît lorsque le bloc est ouvert.</p>
</details>
```

Ce mécanisme produit une interaction simple en mode accordéon (afficher et cacher) sans nécessiter de *JavaScript*.

### La balise `span` : un conteneur générique

`span` est un conteneur en ligne. Il ne qualifie pas à lui seul la
nature du contenu ; il peut servir de support à une classe, un
identifiant ou une annotation.

``` html
<p>Auteur : <span class="auteur">Gérald Kembellec</span></p>
```

Les notices bibliographiques produites en HTML par **Zotero** le sont dans des ```<span>``` avec la méthode [COinS](https://en.wikipedia.org/wiki/COinS 'voir sur Wikipédia') de la norme [ANSI/NISO Z39.88](https://www.niso.org/publications/z3988-2004-r2010) .

``` html
<span class="Z3988" title="ctx_ver=Z39.88-2004&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Ajournal&amp;rft.issn=1045-4438">
Journal of Applied Aquaculture
</span> 
```

## 1.4. Les zones de la page et la scénographie de l'information


|  Zone | Balises | Rôle éditorial possible
|---|---|---|
|  En-tête   |   `<header>`  | Identité du site, titre
| Navigation |    `<nav>` |   Orientation dans le site, navigation
| Contenu principal   | `<main>`| Information attendue par le lecteur
| Article             | `<article>`| Unité éditoriale autonome
| Section             | `<article>` | Sous-ensemble thématique
| Aside               | `<article>` | Informations contextuelles, encadrés, pub
| Pied de page        | `<footer>`  | Mentions légales, droits, contacts

`aside` peut accueillir une information contextuelle proche de la *marginalia* : une information placée en marge, qui accompagne le texte principal sans constituer son fil directeur. La position et la visibilité des zones peuvent évoluer selon la feuille de style, tandis que leur rôle documentaire doit rester cohérent.

# 2. Le Web sémantique et la description des contenus

## 2.1. Pourquoi décrire les contenus ?

Une page consacrée à une personne peut contenir son nom, sa fonction,
son affiliation et des liens vers des ressources. Une page consacrée à
un événement peut exposer sa date, son lieu, son organisateur et son
programme.

La description structurée explicite ces informations et leurs relations.
Elle peut contribuer à : 

* faciliter l'indexation ; 
* améliorer la désambiguïsation des noms et des entités ; 
* rendre les informations réutilisables ; 
* faciliter le moissonnage par des applications tierces ; 
* soutenir la recherche d'information et le *Knowledge Management*.

Dans une organisation qui gère de nombreuses fiches (projets,
événements, dossiers juridiques, etc.), la cohérence des descriptions
facilite le repérage des informations et limite les confusions entre
entités.

## 2.2. Évolutions et traditions du Web sémantique

Le cours a rappelé le projet d'un Web dans lequel les informations
seraient davantage structurées et reliées, dans la continuité des
travaux associés à Tim Berners-Lee et au W3C. 
Il a également évoqué XHTML, qui rapprochait les documents HTML des règles de structuration XML. Cette logique demeure présente dans des formats éditoriaux comme EPUB (format des *ebooks* libres).

Deux orientations coexistent : 

- une tradition documentaire et institutionnelle, attentive à l'interopérabilité, aux référentiels, aux vocabulaires et au partage des connaissances ; 
- une tradition fortement orientée vers les usages industriels et commerciaux du Web, notamment l'indexation des produits, services et contenus par les grandes plateformes.

Cette distinction permet de situer les vocabulaires et formats abordés.
Elle invite à examiner les choix techniques, les usages et les formes de gouvernance qui accompagnent les standards.

## 2.3. Types, propriétés et hiérarchies

Un vocabulaire définit des termes utilisables pour décrire des ressources. Un schéma organise ces termes en types et propriétés.

Dans schema.org : 
- un **type** désigne la catégorie d'un objet :
`Person`, `Organization`, `Article`, `Recipe` ;
- une **propriété** désigne une caractéristique ou une relation : `name`, `author`, `datePublished`, `image` ; 
- un type peut hériter des propriétés d'un type plus général.

Représentation indicative :

``` text
Thing
├── CreativeWork
│   └── Article
├── Person
└── Recipe
```

La hiérarchie permet de comprendre pourquoi un objet spécialisé peut
disposer de propriétés générales et de propriétés qui lui sont propres.
Pour un travail réel, les relations exactes sont à consulter dans la
documentation du vocabulaire.

## 2.4. Entités et désambiguïsation

Un nom sous forme de texte ne suffit pas toujours à identifier une personne ou une organisation. Plusieurs entités peuvent porter le même nom.

Il faut distinguer : 
- une chaîne de caractères : « Christian Jacob » ; 
- une entité de type `Person` ; 
- une entité de type `Organization` ;
- un identifiant ou un lien vers un référentiel qui précise de quelle entité il s'agit (le philologue vs l'homme politique).

### Exemple conceptuel :

Une page consacrée à un chercheur peut déclarer qu'il s'agit d'une personne, préciser son nom et son prénom, puis fournir un identifiant d'autorité ou un lien vers une base de connaissances. L'identifiant doit être vérifié : une référence erronée propage l'ambiguïté au lieu de la réduire.

# 3. Trois approches d'annotation : Microdata, RDFa et JSON-LD

Le cours a présenté trois mécanismes permettant d'associer des informations structurées à un contenu Web. Ils peuvent décrire des objets comparables, mais leur intégration dans le document diffère.

## 3.1. Microdata

Microdata ajoute des attributs aux éléments HTML qui contiennent les informations décrites.
  
|   Attribut   | Fonction | 
| --- | --- |
|  `itemscope` |  Ouvre un objet décrit |
| `itemtype`   |  Indique le type de l'objet |
| `itemprop`   |  Nomme une propriété de l'objet |
|  `itemid`    |  Fournit un identifiant à l'objet |
|  `itemref`   |  Référence des propriétés situées ailleurs dans le document |
  -----------------------------------------------------------------------

``` html
<article itemscope itemtype="https://schema.org/Article">
  <h1 itemprop="headline">Titre de l'article</h1>
  <p itemprop="description">Présentation synthétique de l'article.</p>
</article>
```

Le bloc `article` constitue l'objet décrit. Son type est `Article`. Le titre et la description sont deux propriétés de cet objet. L'intérêt pédagogique de _Microdata_ tient à l'intégration directe de l'annotation dans le balisage qui porte le contenu.

## 3.2. RDFa

_RDFa_ permet d'exprimer des données RDF dans les attributs des éléments HTML ou xHTML. Il s'inscrit dans un environnement de description et de liaison des ressources.

### Attributs courants : 
- `vocab` : vocabulaire utilisé ;
- `typeof` : typede la ressource ; 
- `property` : propriété décrite ; 
- `resource` : ressource référencée ;
- `about` : sujet de la description.

``` html
<article vocab="https://schema.org/" typeof="Article">
  <h1 property="headline">Titre de l'article</h1>
  <p property="description">Présentation synthétique de l'article.</p>
</article>
```

RDFa est particulièrement intéressant lorsque le projet s'inscrit dans un environnement RDF, dans des démarches de données liées ou dans des projets institutionnels et patrimoniaux.

## 3.3. JSON-LD

JSON-LD exprime les données structurées sous forme d'un objet JSON, généralement inséré dans la page avec un élément `script` de type `application/ld+json`.

``` html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Titre de l'article",
  "description": "Présentation synthétique de l'article."
}
</script>
```

La description est séparée du balisage HTML qui présente visuellement le contenu. Cette séparation facilite souvent la génération des données structurées depuis une base de données ou un système de gestion de contenu.

## 3.4. Comparaison

| Critère          | Microdata                         | RDFa                              | JSON-LD                                      |
|------------------|-----------------------------------|-----------------------------------|----------------------------------------------|
| Forme             | Attributs HTML                    | Attributs HTML/XHTML              | Objet JSON                                   |
| Position          | Dans les éléments qui portent le contenu | Dans les éléments qui portent le contenu | Bloc `script`                                |
| Relation au texte affiché | Directe                  | Directe                           | Description séparée                          |
| Usages évoqués    | Annotation intégrée au HTML        | Projets RDF et documentaires      | Génération automatisée, indexation           |
| Vigilance         | Imbrication et portée              | Maîtrise du modèle RDFa           | Cohérence avec le contenu réel               |

Le choix dépend du contexte technique, des compétences de l'équipe, du système de publication, des exigences d'interopérabilité et des usages attendus. Le cours recommande de savoir réaliser une annotation manuellement pour en comprendre le mécanisme ; dans un projet réel, une génération automatisée depuis une base de données ou un CMS facilite la maintenance.

# 4. Métadonnées documentaires et diffusion sociale

## 4.1. Décrire la page dans son ensemble

Les métadonnées placées dans `head` décrivent la page et donnent des indications aux navigateurs, moteurs et plateformes. Elles peuvent porter sur le titre, la description, la langue, l'auteur ou l'organisation éditrice, l'image, les droits, l'identifiant, le sujet et la couverture temporelle ou spatiale.

## 4.2. Dublin Core

Dublin Core propose un ensemble de propriétés générales pour décrire une
ressource. Les quinze éléments historiques comprennent notamment :

| Élément       | Signification                      |
|---------------|------------------------------------|
| `title`       | Titre                              |
| `creator`     | Créateur ou auteur                 |
| `subject`     | Sujet                              |
| `description` | Description                        |
| `publisher`   | Éditeur                            |
| `contributor` | Contributeur                       |
| `date`        | Date                               |
| `type`        | Type de ressource                  |
| `format`      | Format                             |
| `identifier`  | Identifiant                        |
| `source`      | Source                             |
| `language`    | Langue                             |
| `relation`    | Relation                           |
| `coverage`    | Couverture spatiale ou temporelle  |
| `rights`      | Droits                             |

Exemple de description documentaire en _Dublin Core_ simple :
 - _title_ : Constance de Salm ; 
 - _creator : auteur de la page ;
 - date : date de publication ;
 - type : page Web ; 
 - format : `text/html` ; 
 - language : français ; 
 - subject : Constance de Salm ; 
 - identifier : identifiant pérenne ; 
 - rights : licence ou mention de droits ; 
 - coverage : période ou territoire concerné.

### Dublin Core et Schema.org peuvent coexister. 
- Dublin Core fournit des propriétés documentaires générales ; 
- Schema.org permet de décrire des objets plus spécialisés au moyen de types et propriétés.

## 4.3. Open Graph Protocol

Open Graph sert à contrôler l'aperçu d'une page lorsqu'elle est partagée
sur une plateforme compatible. Les informations concernent notamment le
titre, la description, l'image, l'URL canonique, le type de contenu et
le nom du site.

``` html
<meta property="og:type" content="website">
<meta property="og:title" content="Master CTM">
<meta property="og:description"
      content="Présentation du Master Communication, Technologies de la connaissance et Management de l'information.">
<meta property="og:url" content="https://exemple.fr/master-ctm/">
<meta property="og:image" content="https://exemple.fr/images/master-ctm.jpg">
<meta property="og:site_name" content="Master CTM">
```

Les valeurs sont des exemples à adapter. L'image doit être accessible
par une URL exploitable par les plateformes.

## 4.4. Twitter Cards

Les métadonnées Twitter Cards, désormais associées à X, précisent
également la présentation d'un lien partagé.

``` html
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Master CTM">
<meta name="twitter:description"
      content="Découvrez le Master Communication, Technologies de la connaissance et Management de l'information.">
<meta name="twitter:image" content="https://exemple.fr/images/master-ctm.jpg">
```

Les plateformes peuvent exploiter Open Graph et leurs propres
propriétés. Leur comportement dépend de leurs règles et de leurs
évolutions.

## 4.5. L'aperçu social comme dispositif de communication

Lorsqu'une URL est partagée dans un média social ou une messagerie, la
plateforme peut afficher un aperçu composé d'un titre, d'une image et
d'un résumé. Cet aperçu médiatise la ressource, apporte du contexte et
peut favoriser le clic.

Notions mobilisées : 
- **engagement** : interaction du public avec un contenu ; 
- **call to action** : incitation à accomplir une action ; 
- **copywriting** : rédaction orientée vers la mise en valeur d'une offre ou l'accomplissement d'une action ; 
- **accroche éditoriale** : titre et
résumé qui donnent une raison de consulter la ressource.

Un aperçu attractif doit rester fidèle au contenu réel de la page. Les
métadonnées sociales organisent sa présentation lorsqu'elle circule dans
d'autres environnements ; elles ne remplacent pas le contenu.

# 5. Indexation, GEO et RAG

## 5.1. Structuration et recherche d'information

La structuration explicite la nature des objets, leurs propriétés et leurs relations. Elle peut faciliter l'indexation, le moissonnage, la désambiguïsation et la réutilisation des informations.

Dans une organisation, des fiches cohérentes peuvent faciliter le repérage d'une information et réduire les confusions entre personnes, projets ou événements. La structuration donne aux systèmes des indications directement exploitables, plutôt que de leur faire reconstruire toutes les relations à partir du texte libre.

## 5.2. GEO --- _Generative Engine Optimization_

Le cours a introduit le GEO comme l'optimisation de contenus pour leur compréhension et leur mobilisation par des moteurs de réponse génératifs.

La structuration peut rendre explicites :
 - le sujet traité ; 
 - la nature des objets décrits ; 
 - les personnes et organisations concernées ; 
 - les dates et lieux ; 
 - les relations entre les objets ; 
 - les références vers des sources ou référentiels.

Le GEO est une pratique en évolution. Une annotation déclarative ne
garantit pas à elle seule la visibilité d'un contenu : les effets
dépendent des systèmes, de leurs mécanismes d'indexation et de leurs
politiques.


## 5.3. RAG (_Retrieval-Augmented Generation_)

Le RAG désigne une génération augmentée par la récupération de documents ou d'informations dans un corpus. Le modèle reçoit des éléments récupérés afin de contextualiser sa réponse.

La qualité du corpus et la précision de la récupération jouent un rôle
essentiel. Les identifiants, métadonnées et relations peuvent faciliter
la sélection du bon document et la désambiguïsation des entités.

Exemple : pour désigner un chercheur nommé Christian Jacob, on peut
préciser le contexte disciplinaire, l'affiliation et un identifiant
d'autorité. Le système dispose alors d'indices explicites pour
distinguer les homonymes.

Le RAG peut réduire certains risques en ancrant les réponses dans des
sources récupérées. Il ne garantit pas l'absence d'erreur ou
d'hallucination. La qualité des sources, la récupération, la
désambiguïsation et la vérification restent nécessaires.

# 6. Mise en pratique : décrire une recette avec Schema.org et Microdata

La seconde partie de la séance a été consacrée à la réalisation d'un
article présentant une recette : le *Banana bread*. L'exercice montre
comment transformer un contenu éditorial ordinaire en objet documentaire
structuré, susceptible d'être identifié et moissonné par des moteurs ou
des applications de recettes.

## 6.1. Pourquoi le type `Recipe` ?

Une recette possède des propriétés récurrentes : nom, auteur, date de
publication, image, description, temps de préparation, temps de cuisson,
quantité produite, informations nutritionnelles, ingrédients,
instructions, et éventuellement vidéo ou informations complémentaires.

Le type `Recipe` permet de regrouper ces informations sous une même
entité.

## 6.2. Les attributs Microdata

``` html
<article itemscope itemtype="https://schema.org/Recipe">
  <h1 itemprop="name">Banana bread</h1>
  <p itemprop="description">
    Un gâteau moelleux réalisé avec des bananes mûres.
  </p>
</article>
```

-   `itemscope` ouvre un objet décrit ;
-   `itemtype` indique que l'objet est une recette (`Recipe`) ;
-   `itemprop` associe un élément à une propriété de la recette.

L'élément `article` porte la description de l'objet principal. Les
propriétés placées dans sa portée lui sont rattachées, sauf lorsqu'un
nouvel objet est explicitement ouvert.

## 6.3. Imbrication : l'auteur comme objet `Person`

Une propriété peut être une valeur textuelle ou contenir un nouvel objet
décrit par son propre `itemscope`.

``` html
<div itemprop="author"
     itemscope
     itemtype="https://schema.org/Person">
  <span itemprop="name">Gérald Kembellec</span>
</div>
```

La propriété `author` de la recette contient un objet de type `Person`,
qui possède lui-même une propriété `name`. Le nom est ainsi rattaché à
une entité de type personne et non conservé comme simple chaîne de
caractères.

## 6.4. Exemple de page annotée

Les valeurs ci-dessous sont pédagogiques et doivent être adaptées à une
recette réelle. Elles illustrent les éléments travaillés pendant la
séance.

``` html
<article itemscope itemtype="https://schema.org/Recipe">

  <header>
    <h1 itemprop="name">Banana bread</h1>
    <p>
      Une recette de
      <span itemprop="author"
            itemscope
            itemtype="https://schema.org/Person">
        <span itemprop="name">Gérald Kembellec</span>
      </span>.
    </p>
    <p>
      Publiée le
      <time itemprop="datePublished" datetime="2026-05-08">
        8 mai 2026
      </time>.
    </p>
  </header>

  <figure>
    <img itemprop="image"
         src="images/banana-bread.jpg"
         alt="Banana bread présenté sur une planche en ardoise">
    <figcaption>Banana bread fait maison.</figcaption>
  </figure>

  <section aria-labelledby="presentation">
    <h2 id="presentation">Présentation</h2>
    <p itemprop="description">
      Le banana bread est un gâteau moelleux préparé avec des bananes mûres.
    </p>
    <p>
      Temps de préparation :
      <time itemprop="prepTime" datetime="PT15M">15 minutes</time>.
    </p>
    <p>
      Temps de cuisson :
      <time itemprop="cookTime" datetime="PT1H">1 heure</time>.
    </p>
    <p>Quantité : <span itemprop="recipeYield">1 miche</span>.</p>
  </section>

  <section aria-labelledby="nutrition">
    <h2 id="nutrition">Valeurs nutritionnelles</h2>
    <div itemprop="nutrition"
         itemscope
         itemtype="https://schema.org/NutritionInformation">
      <p>Énergie : <span itemprop="calories">240 calories</span>.</p>
      <p>Matières grasses : <span itemprop="fatContent">9 g</span>.</p>
    </div>
  </section>

  <section aria-labelledby="ingredients">
    <h2 id="ingredients">Ingrédients</h2>
    <ul>
      <li itemprop="recipeIngredient">3 ou 4 bananes mûres</li>
      <li itemprop="recipeIngredient">1 œuf</li>
      <li itemprop="recipeIngredient">3/4 de tasse de sucre</li>
      <li itemprop="recipeIngredient">Farine</li>
    </ul>
  </section>

  <section aria-labelledby="instructions">
    <h2 id="instructions">Instructions</h2>
    <ol>
      <li itemprop="recipeInstructions">Préchauffer le four à 175 °C.</li>
      <li itemprop="recipeInstructions">Mélanger les ingrédients dans un bol.</li>
      <li itemprop="recipeInstructions">Ajouter la farine en dernier.</li>
      <li itemprop="recipeInstructions">
        Verser dans un moule à pain et faire cuire pendant une heure.
      </li>
    </ol>
  </section>

</article>
```

| Partie | Propriété ou type | Information |
|---|---|---|
| **Article** | `Recipe` | Objet principal |
| **Titre** | `name` | Nom de la recette |
| **Auteur** | `author` et `Person` | Personne à l'origine de la recette |
| **Date** | `datePublished` | Date de publication |
| **Image** | `image` | Illustration |
| **Présentation** | `description` | Résumé éditorial |
| **Préparation** | `prepTime` | Durée de préparation |
| **Cuisson** | `cookTime` | Durée de cuisson |
| **Quantité** | `recipeYield` | Quantité produite |
| **Nutrition** | `NutritionInformation` | Informations nutritionnelles |
| **Ingrédients** | `recipeIngredient` | Liste des ingrédients |
| **Instructions** | `recipeInstructions` | Étapes de préparation |

## 6.5. Valeurs textuelles et valeurs normalisées

Une information peut être compréhensible en texte libre, mais plus
facile à exploiter si elle est typée et normalisée.

``` html
<time itemprop="prepTime" datetime="PT15M">15 minutes</time>
```

`PT15M` suit la notation de durée ISO 8601 : quinze minutes. De même, la
date affichée sous forme naturelle peut être associée à une valeur
normalisée :

``` html
<time itemprop="datePublished" datetime="2026-05-08">
  8 mai 2026
</time>
```

## 6.6. Les listes d'ingrédients

Une liste HTML (`ul`) composée d'éléments `li` exprime explicitement un
ensemble d'ingrédients.

``` html
<ul>
  <li itemprop="recipeIngredient">3 ou 4 bananes mûres</li>
  <li itemprop="recipeIngredient">1 œuf</li>
  <li itemprop="recipeIngredient">3/4 de tasse de sucre</li>
</ul>
```

Une liste HTML est préférable à une suite de tirets saisis manuellement
: sa structure indique que chaque élément appartient à une liste.

L'exercice a également montré l'intérêt de distinguer les quantités, les
unités et les ingrédients. « 3/4 de tasse » reste une formulation
textuelle si elle n'est pas décomposée. Une description plus fine peut
distinguer quantité, unité et ingrédient, à condition de respecter le
modèle de données prévu par le vocabulaire.

**Vigilance :** une propriété ne peut être utilisée que dans le contexte
d'un type qui l'admet. Il faut vérifier le domaine et la portée des
propriétés dans la documentation de Schema.org.

## 6.7. Les instructions

Les instructions sont rattachées à la recette avec `recipeInstructions`.
Une liste ordonnée (`ol`) convient à une suite d'opérations à réaliser
dans un ordre déterminé.

Pour une description plus détaillée, Schema.org propose notamment des
objets de type `HowToStep`, qui permettent de décrire chaque étape comme
un objet distinct.

## 6.8. Plusieurs langues

La séance a exploré la présence de contenus français et anglais dans une
même page. L'attribut HTML `lang` permet de préciser la langue d'un
passage.

``` html
<p lang="fr">Préchauffer le four à 175 °C.</p>
<p lang="en">Preheat the oven to 350 °F.</p>
```

Le cours a également montré le principe d'un contenu présent dans le
code mais masqué visuellement avec CSS. Cette technique demande du
discernement : la présence d'un texte masqué ne garantit pas son
exploitation par les moteurs ou les assistants, et elle peut créer des
incohérences entre ce qui est présenté à la personne et ce qui est
déclaré aux logiciels.

Pour un site multilingue, privilégier une stratégie éditoriale claire :
pages localisées, sélecteur de langue ou présentation explicite des
variantes. Les valeurs déclarées doivent correspondre à la langue réelle
des contenus.

# 7. Validation et contrôle de la qualité

L'annotation doit être contrôlée. Une page peut sembler correcte à
l'écran tout en comportant des erreurs de syntaxe, des propriétés mal
rattachées ou des informations mal typées.

## 7.1. Validation HTML

Le validateur HTML du W3C contrôle la conformité du balisage. Il peut
signaler : 
- des éléments mal imbriqués ; 
- des attributs incorrects ; 
- des valeurs invalides ; 
- des erreurs de structure ; 
- des problèmes liés à certains attributs de langue ou de présentation.

La validation HTML porte sur la syntaxe et la structure ; elle ne suffit
pas à prouver que la description sémantique est juste.

## 7.2. Validation des données structurées

Les outils de validation associés à Schema.org et à Google permettent
d'examiner les objets et propriétés détectés. Ils aident à vérifier : 

- le type détecté (`Recipe`, `Article`, etc.) ;
- les propriétés reconnues ; 
- les propriétés requises ou recommandées pour certains résultats
enrichis ;
- les valeurs manquantes ;
- les erreurs de rattachement ou de typage.

Un objet peut être reconnu alors que certaines propriétés facultatives
ou recommandées sont absentes. La reconnaissance d'un objet et son
éligibilité à un résultat enrichi sont deux questions distinctes.

## 7.3. Démarche de validation

 | Étape | Question | Contrôle |
|---|---|---|
| **Relecture humaine** | Le contenu est-il exact ? | Relecture éditoriale |
| **HTML** | Le document est-il correctement structuré ? | Validateur HTML, lecteur audio, mode immersif |
| **Vocabulaire** | Les types et propriétés sont-ils valides ? | Validateur Schema.org |
| **Moteur** | Quelles données sont détectées ? | Outil de résultats enrichis |
| **Rendu** | La page est-elle bien présentée ? | Navigateurs et appareils |
| **Interprétation** | Que peut-on comprendre à partir des seules données structurées ? | Analyse raisonnée ou test avec un LLM |

## 7.4. Diagnostiquer les erreurs

L'exercice du Banana bread a mis en évidence plusieurs difficultés : 
- une propriété utilisée dans un contexte qui ne la reconnaît pas ;
- une valeur insuffisamment typée ; 
- un auteur décrit comme une chaîne plutôt que comme une entité `Person` ; 
- des quantités et unités exprimées de façon hétérogène ; 
- des déclarations linguistiques à préciser ; 
- des erreurs de syntaxe ou d'identifiants.

Distinguer trois niveaux : 
1. **Erreur HTML** : balisage ou attribut incorrect. 
2. **Erreur de modélisation** : propriété mal choisie ou mal
rattachée. 
3. **Information insuffisante** : contenu compréhensible,
mais description trop peu précise pour une exploitation fiable.

Pour corriger, revenir au modèle : 
- quel objet décrit-on ? 
- Quelle est sa propriété ?  
- À quel objet cette propriété appartient-elle ? 
- Quelle valeur doit-elle porter ?

# 8. Qualité documentaire, accessibilité et présentation

Une structure sémantique contribue à la qualité de lecture. Des titres
hiérarchisés, des sections, des listes, des dates balisées et des images accompagnées de textes alternatifs facilitent le parcours du document.

Le cours a montré qu'une page structurée pouvait être mieux prise en
charge par des fonctions de lecture immersive ou de restitution vocale.
La qualité sémantique concerne donc aussi l'accessibilité et la
réutilisation.

## 8.1. Images et textes alternatifs

``` html
<img src="images/banana-bread.jpg"
     alt="Banana bread présenté sur une planche en ardoise">
```

Le texte alternatif doit décrire l'information utile portée par l'image.
« Image 2 » apporte peu d'information. `alt` et `title` remplissent des
fonctions différentes ; le texte alternatif est particulièrement
important pour les personnes qui ne voient pas l'image et lorsque
celle-ci ne peut pas être affichée.

## 8.2. Séparer structure et présentation

Les règles graphiques sont de préférence placées dans une feuille CSS
externe :

``` html
<link rel="stylesheet" href="styles.css">
```

``` css
body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
}

article {
  max-width: 70rem;
  margin: 0 auto;
  padding: 1.5rem;
}

section {
  margin-block: 2rem;
}
```

Cette séparation facilite la maintenance et permet de modifier la
présentation sans réécrire la structure documentaire. Les styles en
ligne peuvent servir à certains tests, mais une feuille externe convient mieux à un projet maintenu dans le temps.

# 9. Maîtriser le chargement des ressources multimédias

La fin de la séance a abordé le cas d'une page contenant plusieurs
vidéos à différents endroits. Le chargement simultané de toutes les
ressources peut augmenter la consommation de bande passante et ralentir
l'affichage, notamment sur mobile.

## 9.1. L'attribut `preload` de `video`

`preload` fournit au navigateur une indication sur le préchargement
souhaité.

| Valeur | Intention |
|---|---|
| `none` | Ne pas précharger les données vidéo |
| `metadata` | Récupérer les métadonnées, par exemple la durée |
| `auto` | Autoriser un préchargement plus important |

``` html
<video controls preload="none" poster="images/apercu-video.jpg">
  <source src="videos/presentation.mp4" type="video/mp4">
  Votre navigateur ne prend pas en charge la lecture vidéo.
</video>
```

`preload` est une indication destinée au navigateur, pas un contrôle
absolu du réseau. Le navigateur peut l'interpréter différemment ou
l'ignorer selon son environnement, ses règles internes et les
contraintes du terminal.

## 9.2. Chargement différé

Le *lazy loading* vise à reporter le chargement d'une ressource jusqu'au
moment où elle devient utile. Pour les images et les iframes,
`loading="lazy"` est largement utilisé :

``` html
<img src="images/document.jpg"
     alt="Document présenté dans l'exposition"
     loading="lazy">
```

Pour une vidéo, `preload="none"` limite le téléchargement anticipé.
L'attribut `poster` permet d'afficher une image d'aperçu avant le
lancement de la vidéo.

## 9.3. Plusieurs vidéos indépendantes

Pour une page contenant plusieurs vidéos : 
- éviter de demander le préchargement complet de toutes les vidéos ;
- utiliser `preload="none"` lorsque la lecture n'est pas immédiate ; 
- fournir une image d'aperçu avec `poster` ; 
- réserver le chargement aux vidéos qui intéressent effectivement l'utilisateur ; 
- tester sur plusieurs navigateurs et appareils.

``` html
<video controls preload="none" poster="images/video-01.jpg">
  <source src="videos/video-01.mp4" type="video/mp4">
</video>

<video controls preload="none" poster="images/video-02.jpg">
  <source src="videos/video-02.mp4" type="video/mp4">
</video>
```

Si le projet nécessite un chargement déclenché précisément à l'approche de la zone visible, une solution JavaScript fondée sur `IntersectionObserver` peut être envisagée. Elle demande une implémentation et des tests spécifiques.

**À distinguer :** 
- `preload` concerne le préchargement des données audio ou vidéo ; 
- `loading="lazy"` concerne notamment les images et les iframes ; 

Ces mécanismes sont complémentaires, mais ne sont pas interchangeables.

# 10. Organiser le travail collectif : du contenu à la publication

La réalisation d'un dispositif Web relève aussi de la gestion de projet.
Le code s'inscrit dans une succession de tâches qui dépendent les unes
des autres.

## 10.1. Phases d'un projet

| Phase | Activités | Résultat |
|---|---|---|
| **Cadrage** | Sujet, public, objectifs, périmètre | Cahier des charges |
| **Collecte** | Recherche de textes, images, données et références | Corpus de contenus |
| **Modélisation** | Objets, propriétés, relations | Modèle documentaire |
| **Structuration** | HTML et annotations sémantiques | Page structurée |
| **Présentation** | Feuille de style, adaptations d'affichage | Interface |
| **Validation** | Tests HTML, sémantiques et visuels | Rapport de tests |
| **Publication** | Mise en ligne et contrôle des URL | Version publiée |
| **Restitution** | Présentation des choix, résultats et limites | Bilan du projet |

L'ordre des tâches compte : il est préférable d'avoir identifié les
contenus avant de finaliser leur intégration et de concevoir la
présentation à partir d'une structure définie.

## 10.2. Le diagramme de Gantt

Le diagramme de Gantt représente les tâches d'un projet dans le temps.
Il précise les tâches, leur ordre, les responsables, les dates de début
et de fin, leur durée, leur avancement et les marges de sécurité.

| Tâche | Responsable | Début | Fin | Dépendance |
|---|---|---|---|---|
| **Collecte des contenus** | Groupe A | Semaine 1 | Semaine 2 | — |
| **Modélisation** | Groupe A | Semaine 2 | Semaine 3 | Collecte des contenus |
| **Intégration HTML** | Groupe B | Semaine 3 | Semaine 4 | Modélisation |
| **Feuille de style** | Groupe B | Semaine 4 | Semaine 5 | Structure HTML |
| **Tests et corrections** | Tous | Semaine 5 | Semaine 6 | Intégration HTML |
| **Présentation** | Tous | Semaine 6 | Semaine 6 | Tests et corrections |

Les dates sont fictives. Le rétroplanning consiste à partir de la date
de restitution pour remonter vers les étapes nécessaires et répartir des
marges de sécurité.

# 11. Méthode de travail : construire une page sémantique

1.  **Identifier l'objet documentaire.** Déterminer si la page décrit
    une personne, une organisation, un événement, un article, une œuvre,
    une recette ou un autre objet.
2.  **Identifier les propriétés utiles.** Lister les informations
    disponibles et nécessaires : titre, description, auteur, date,
    image, lieu, identifiant, catégorie et relations.
3.  **Consulter le vocabulaire.** Vérifier le nom exact du type et des
    propriétés, leur domaine et le type de valeur attendu.
4.  **Construire le HTML.** Organiser le document avec des éléments
    adaptés : `article`, `header`, `section`, titres, listes, `time`,
    `figure`.
5.  **Ajouter les annotations.** Définir le type principal et ajouter
    les propriétés. Envisager un objet imbriqué lorsque la valeur
    correspond à une autre entité.
6.  **Préparer la diffusion.** Ajouter les métadonnées générales et les
    métadonnées sociales adaptées.
7.  **Valider et corriger.** Contrôler HTML, types, propriétés, valeurs
    et portées.
8.  **Vérifier le rendu.** Tester navigateurs, tailles d'écran, images,
    textes alternatifs, langues et médias.
9.  **Publier et observer.** Tester l'URL réellement accessible et
    vérifier les aperçus produits par les plateformes.

# 12. Activités d'apprentissage

## Exercices filés
--- 
### 1 Identifier la structure sémantique

Choisir une page Web éditoriale et repérer son `header`, sa navigation,
son contenu principal, ses articles et sections, ses éventuels `aside`
et son `footer`. Pour chaque zone, préciser sa fonction documentaire et
éditoriale.

--- 
### 2 Choisir un type Schema.org

À partir d'un objet présent dans le projet de groupe, déterminer l'objet principal, le type Schema.org adapté, cinq propriétés pertinentes, les propriétés dont la valeur correspond à une autre entité et les identifiants ou référentiels possibles. Justifier les choix.

--- 
### 3 Annoter un contenu avec Microdata

Intégrer à une page HTML un `itemscope` principal, un `itemtype`
pertinent, plusieurs `itemprop` et au moins un objet imbriqué. Le contenu visible doit rester cohérent avec les données structurées.

--- 
### 4 Préparer les métadonnées de partage

Produire un titre, une description, une image, une URL, les métadonnées _Open Graph_ et les métadonnées _Twitter Cards_ utiles. Vérifier l'aperçu produit par les outils disponibles.

---
### 5 Auditer une page

Utiliser un validateur HTML, un outil de contrôle des données
structurées, un navigateur et, si possible, un outil de lecture ou d'accessibilité. Classer les problèmes : syntaxe, structure,
modélisation, information manquante, rendu ou accessibilité.

--- 
### 6 Planifier la réalisation

Établir un mini-rétroplanning : tâches, responsables, dépendances, dates et marge de sécurité avant la restitution.

# 13. Synthèse générale

| Couche | Question | Moyens |
|---|---|---|
| **Contenu** | Quelle information transmettre ? | Textes, images, médias, données |
| **Structure** | Comment organiser le document ? | HTML5, titres, sections, listes |
| **Description sémantique** | De quoi parle-t-on ? | Schema.org, Microdata, RDFa, JSON-LD |
| **Métadonnées documentaires** | Comment identifier et contextualiser la ressource ? | Dublin Core et autres vocabulaires |
| **Diffusion** | Comment présenter la ressource lorsqu'elle circule ? | Open Graph, Twitter Cards |
| **Validation** | Comment vérifier la qualité ? | Validateurs HTML et sémantiques |
| **Accessibilité** | Comment rendre le contenu exploitable ? | HTML sémantique, textes alternatifs, langues |
| **Performance** | Comment maîtriser le chargement ? | `preload`, `loading`, `poster`, chargement différé |
| **Gestion de projet** | Comment organiser la réalisation ? | Phases, responsabilités, diagramme de Gantt |

Le point central est la cohérence documentaire : **une page de qualité présente un contenu compréhensible, une structure explicite et une description sémantique exacte**.

Les métadonnées et les vocabulaires structurés constituent une
infrastructure de circulation de l'information. Ils rendent les objets documentaires plus faciles à identifier, relier, moissonner et réutiliser dans des environnements logiciels variés.

# 14. Glossaire

| Terme | Définition |
|---|---|
| **Annotation sémantique** | Association d'une information à un type et à une propriété d'un vocabulaire. |
| **Aside** | Élément HTML destiné à un contenu complémentaire ou contextuel. |
| **Call to action** | Incitation à réaliser une action. |
| **Copywriting** | Rédaction orientée vers la valorisation d'une offre ou l'engagement. |
| **CSS** | Langage de présentation des documents HTML. |
| **Donnée structurée** | Information organisée selon un modèle explicite. |
| **Dublin Core** | Vocabulaire de métadonnées documentaires générales. |
| **Entité** | Objet identifié et décrit : personne, organisation, lieu, œuvre ou événement. |
| **GEO** | *Generative Engine Optimization*. |
| **Gantt** | Représentation temporelle des tâches d'un projet. |
| **HTML sémantique** | Usage d'éléments HTML dont le nom exprime la fonction du contenu. |
| **Identifiant** | Référence permettant de désigner une ressource ou une entité. |
| **JSON-LD** | Format JSON pour exprimer des données liées. |
| **Knowledge Management** | Gestion et valorisation des connaissances dans une organisation. |
| **Microdata** | Mécanisme d'annotation sémantique intégré aux éléments HTML. |
| **Moissonnage** | Collecte automatisée de ressources ou de métadonnées. |
| **Open Graph** | Protocole de métadonnées destiné notamment aux aperçus de partage. |
| **Propriété** | Caractéristique ou relation associée à un objet. |
| **RAG** | *Retrieval-Augmented Generation* : génération augmentée par récupération. |
| **RDFa** | Mécanisme d'intégration de données RDF dans HTML. |
| **Référentiel** | Système organisé de termes, ressources ou identifiants. |
| **Rich result** | Présentation enrichie d'un résultat de recherche. |
| **Schema.org** | Vocabulaire partagé de types et propriétés. |
| **Type** | Catégorie à laquelle appartient un objet décrit. |
| **W3C** | Organisme de standardisation des technologies du Web. |
  -----------------------------------------------------------------------

# 15. Ressources de référence

Les ressources ci-dessous correspondent aux environnements et outilsmobilisés ou évoqués pendant la séance. 
Les interfaces et recommandations évoluent : consulter leur documentation à jour au moment de la mise en œuvre.

-   W3C --- https://www.w3.org/
-   MDN Web Docs --- https://developer.mozilla.org/
-   Schema.org --- https://schema.org/
-   Google Search Central ---
    https://developers.google.com/search/docs/appearance/structured-data
-   Validateur HTML du W3C --- https://validator.w3.org/
-   Dublin Core Metadata Initiative --- https://www.dublincore.org/
-   Open Graph Protocol --- https://ogp.me/
-   W3C --- RDFa --- https://www.w3.org/TR/rdfa-primer/

# Autoévaluation

1.  Quelle différence faites-vous entre structure HTML, annotation sémantique et présentation CSS ?
2.  À quoi servent `itemscope`, `itemtype` et `itemprop` ?
3.  Quelle différence existe-t-il entre Microdata, RDFa et JSON-LD ?
4.  Pourquoi décrire l'auteur comme un objet de type `Person` plutôt que comme une chaîne de caractères ?
5.  À quoi sert Schema.org et comment consulter les propriétés d'un type ?
6.  Quel est le rôle des métadonnées Open Graph dans le partage d'une URL ?
7.  Quelle différence faites-vous entre Dublin Core et Schema.org ?
8.  Pourquoi distinguer validation HTML et validation des données structurées ?
9.  Que permet de contrôler `preload` et quelles sont ses limites ?
10. Pourquoi un diagramme de Gantt est-il utile dans un projet documentaire ?

**Critère de réussite :** 
être capable de concevoir une page dont le contenu, le balisage HTML et les données structurées décrivent le même objet de manière cohérente, puis de vérifier le résultat avec des outils adaptés.
