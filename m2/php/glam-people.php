<?php
/* =========================
        Calculer l'URL de l'image wikimédia 
        depuis son nom (réconcilié depuis wikidata avec OpenRefine)
        grâce à md5 (c'te galère)
    ======================== */
function wikimediaImageUrl(string $filename): ?string
{
    if (empty($filename)) {
        return null;
    }
    // Normalisation minimale
    $filename = str_replace(' ', '_', $filename);
    // Encodage URL
    $encodedFilename = rawurlencode($filename);
    // Hash MD5 requis par Wikimedia Commons
    $hash = md5($filename);
    return "https://upload.wikimedia.org/wikipedia/commons/"
         . substr($hash, 0, 1) . "/"
         . substr($hash, 0, 2) . "/"
         . $encodedFilename;
}
/* =========================
        Connexion MySQL
   ========================= */
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "GLAM";

$mysqli = new mysqli($host, $user, $password, $dbname);

if ($mysqli->connect_error) {
    die("Erreur de connexion : " . $mysqli->connect_error);
}

/* =========================
        Requête SQL
   ========================= */

$sql = "SELECT * FROM Personnes";
$result = $mysqli->query($sql);

$persons = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $persons[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <title>Personnes inspirantes – M1 CTM</title>
        <link rel="stylesheet" href="../css/Person.css">
</head>
<body>
<h1>Personnes inspirantes</h1>

<?php
/* =========================
        HTML5 sémantique
   ========================= */

foreach ($persons as $person) :
?>
<section itemscope itemprop="Person" itemtype="https://schema.org/Person" itemid="http://isni.org/isni/
<?php echo htmlspecialchars($person['ISNI']); ?>
">
    <h2>
        <meta itemprop="image" content="<?php echo wikimediaImageUrl($person['Picture']); ?>">
        <span itemprop="givenName">
            <?php echo htmlspecialchars($person['prenom']); ?>
        </span>
        <span itemprop="familyName">
            <?php echo htmlspecialchars($person['nom']); ?>
        </span>
    </h2>

    <p itemprop="description">
        <?php echo htmlspecialchars($person['Info']); ?>
    </p>
    <p>
        <strong>Fonction :</strong>
        <span itemprop="jobTitle">
            <?php echo htmlspecialchars($person['métier']); ?>
        </span>
    </p>
    <p>
        <strong>Date de naissance :</strong>
        <time itemprop="birthDate" datetime="<?php echo $person['dateN']; ?>">
            <?php echo $person['dateN']; ?>
        </time>
    </p>
    <p>
        <strong>Lieu de naissance :</strong>
        <span itemprop="birthPlace">
            <?php echo htmlspecialchars($person['LieuN']); ?>
        </span>
    </p>
</section>
<hr>
<?php endforeach; ?>
</body>
</html>
