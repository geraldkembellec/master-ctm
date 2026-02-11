<?php
/* connexion a la base "GLAM", sur la machine "localhost", user "root", password "root" */
$mysqli = new mysqli("localhost", "root", "root", "GLAM");
if ($mysqli->connect_error) {
    die("Erreur de connexion");
}
/* fonction qui "calcule" l'URL d'une image Wikidata a partire de son nom */
function wikimediaImageUrl(?string $filename): ?string
{
    if (empty($filename)) {
        return null;
    }
    $filename = str_replace(' ', '_', $filename);
    $encodedFilename = rawurlencode($filename);
    $hash = md5($filename);

    return "https://upload.wikimedia.org/wikipedia/commons/"
         . substr($hash, 0, 1) . "/"
         . substr($hash, 0, 2) . "/"
         . $encodedFilename;
}

/* Requete SQL envoyée */
$result = $mysqli->query("SELECT * FROM visual_artwork");
/* création d'une liste d'oeuvre d'arts */
$artworks = [];
while ($row = $result->fetch_assoc()) {
    $artworks[] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Œuvres visuelles</title>
</head>
<body>

<h1>Œuvres visuelles</h1>
<!-- Boucle de toutes les oeuvres d'art-->
<?php foreach ($artworks as $artwork): ?>
<!-- Chaque oeuvre d'art est présentée sous forme d'article -->
<article itemscope 
         itemtype="https://schema.org/VisualArtwork"
         itemid="https://www.wikidata.org/wiki/
         <?= htmlspecialchars($artwork['id_wikidata']) ?>
">
<!-- S'il existe une image... -->
<?php if ($img = wikimediaImageUrl($artwork['image_filename'])): ?>
<!-- ... on l'affiche -->
<img src="<?= htmlspecialchars($img) ?>" 
     alt="<?= htmlspecialchars($artwork['title']) ?>" 
     width="80%" itemprop="image">
<?php endif; ?>
<!-- affiche le nom -->
<h2 itemprop="name">
    <?= htmlspecialchars($artwork['title']) ?>
</h2>
<!-- affiche la description -->
<p itemprop="description">
    <?= htmlspecialchars($artwork['description']) ?>
</p>
<!-- affiche le nom de l'auteur / artiste -->
<p itemprop="creator">
    <strong>Auteur :</strong>
    <p itemscope itemtype="https://schema.org/Person" >
        <span itemprop="Name">
            <?= htmlspecialchars($artwork['creator']) ?>
        </span>
    </p>
</p>
<!-- affiche la date de l'oeuvre -->
<p>
    <strong>Date de création :</strong>
    <span itemprop="dateCreated">
        <?= htmlspecialchars($artwork['creation_date']) ?>
    </span>
</p>
<!-- affiche le support de l'oeuvre -->
<p>
    <strong>Médium :</strong>
    <span itemprop="artMedium">
        <?= htmlspecialchars($artwork['art_medium']) ?>
    </span>
</p>
<!-- affiche le type d'art -->
<p>
    <strong>Type d’œuvre :</strong>
    <span itemprop="artform">
    <?= htmlspecialchars($artwork['artform']) ?>
</span>
</p>
<!-- affiche le lieu d'expo / de conservation -->
<p>
    <strong>Lieu de conservation :</strong>
    <span itemprop="locationCreated">
        <?= htmlspecialchars($artwork['location']) ?>
    </span>
</p>
<!-- affiche le lien Wikidata -->
<a href="https://www.wikidata.org/wiki/
    <?= htmlspecialchars($artwork['id_wikidata']) ?>
" >Référence Wikidata</a>
</article>
<hr>
<?php endforeach; ?>
</body>
</html>
