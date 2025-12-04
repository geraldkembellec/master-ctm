# Intégration de Leaflet
Ce projet présente un exemple minimaliste d’intégration de *Leaflet*, une bibliothèque JavaScript open source permettant d’afficher des cartes interactives.
L’objectif est d’afficher une carte centrée sur la localisation d’une faculté, en utilisant une fonction JavaScript personnalisée.

## Structure du projet

`
  .
  ├── index.html
  ├── style.css
  └── mespetitesfonctions.js
`

- index.html : page principale contenant l’intégration de Leaflet et l’appel à la fonction loadLeafletMap().
- style.css : fichier de styles personnalisé (dimensions de la carte, mise en page, etc.).
- mespetitesfonctions.js : fichier JavaScript contenant la fonction chargée de créer et configurer la carte Leaflet.

## Fonctionnement
  ### 1. Chargement de Leaflet
    Le fichier HTML inclut :
      - la feuille de style Leaflet
      - la bibliothèque JavaScript Leaflet
    ```html  
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    ```
  Cela permet d’utiliser directement les composants et fonctions fournis par Leaflet.

  ### 2. Chargement des styles et scripts personnalisés
     
    Le fichier HTML charge :
      - style.css pour ajuster l’apparence de la carte
      - mespetitesfonctions.js pour contenir la logique métier, notamment la fonction loadLeafletMap()
        
    <link rel="stylesheet" href="style.css">
    <script src="mespetitesfonctions.js"></script>
