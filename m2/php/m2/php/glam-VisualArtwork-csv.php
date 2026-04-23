<?php
/* File PATH /cchemin vers le fichier CSV */
$csvFile = "visual_artwork.csv";

/* does it exist / vérification existence fichier */
if (!file_exists($csvFile)) {
    die("Fichier CSV introuvable");
}

/* img url building function / fonction qui calcule l'URL d'une image Wikimedia Commons */
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

/* lecture du CSV / CSV reading*/
$artworks = [];
if (($handle = fopen($csvFile, "r")) !== false) {
    /* récupération des noms de colonnes (séparateur ;) */
    $headers = fgetcsv($handle, 0, ";");
    if ($headers === false) {
        die("CSV vide ou invalide");
    }
    /* lecture des lignes */
    while (($row = fgetcsv($handle, 0, ";")) !== false) {
        /* sécurisation si ligne incomplète */
        if (count($row) === count($headers)) {
            $artworks[] = array_combine($headers, $row);
        }
    }
    fclose($handle);
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
        <?php foreach ($artworks as $artwork): ?>
        <article
            itemscope
            itemtype="https://schema.org/VisualArtwork"
            itemid="https://www.wikidata.org/wiki/<?= htmlspecialchars($artwork['id_wikidata'], ENT_QUOTES, 'UTF-8') ?>"
        >
        <meta
            itemprop="identifier"
            content="https://www.wikidata.org/wiki/<?= htmlspecialchars($artwork['id_wikidata'], ENT_QUOTES, 'UTF-8') ?>"
        >
        <?php if ($img = wikimediaImageUrl($artwork['image_filename'])): ?>
        <img
        src="<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
        alt="<?= htmlspecialchars($artwork['title'], ENT_QUOTES, 'UTF-8') ?>"
        width="80%"
        itemprop="image"
        >
        <?php endif; ?>
        <h2 itemprop="name">
            <?= htmlspecialchars($artwork['title'], ENT_QUOTES, 'UTF-8') ?>
        </h2>

        <p itemprop="description">
            <?= htmlspecialchars($artwork['description'], ENT_QUOTES, 'UTF-8') ?>
        </p>
        <div>
          <strong>Auteur :</strong>
          <p itemscope
          itemtype="https://schema.org/Person"
          itemprop="creator">
            <span itemprop="name">
                <?= htmlspecialchars($artwork['creator'], ENT_QUOTES, 'UTF-8') ?>
            </span>
          </p>
        </div>
        <p>
          <strong>Date de création :</strong>
          <span itemprop="dateCreated">
          <?= htmlspecialchars($artwork['creation_date'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </p>
        <p>
          <strong>Médium :</strong>
          <span itemprop="artMedium">
          <?= htmlspecialchars($artwork['art_medium'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </p>
        <p>
          <strong>Type d’œuvre :</strong>
          <span itemprop="artform">
          <?= htmlspecialchars($artwork['artform'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </p>
        <p>
          <strong>Lieu de conservation :</strong>
          <span itemprop="contentLocation">
          <?= htmlspecialchars($artwork['location'], ENT_QUOTES, 'UTF-8') ?>
          </span>
        </p>
        <p>
          <a
          href="https://www.wikidata.org/wiki/<?= htmlspecialchars($artwork['id_wikidata'], ENT_QUOTES, 'UTF-8') ?>"
          target="_blank"
          rel="noopener"
          >
          Référence Wikidata
          </a>
        </p>
    </article>
    <hr>
    <?php endforeach; ?>
</body>
</html>
