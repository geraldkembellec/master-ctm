<?php
$mysqli = new mysqli("localhost", "root", "root", "GLAM");
if ($mysqli->connect_error) {
    die("Erreur de connexion");
}

$result = $mysqli->query("SELECT * FROM Events");
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Événements culturels</title>
</head>
<body>
<h1>Événements culturels</h1>
<?php foreach ($events as $event): ?>
<article itemscope itemtype="https://schema.org/Event">

<?php if ($img =$event['image']): ?>
<img src="<?php echo htmlspecialchars($img); ?>" 
alt="
<?php echo htmlspecialchars($event['name']); ?>" 
itemprop="image">
<?php endif; ?>

<h2 itemprop="name"><?php echo htmlspecialchars($event['name']);?></h2>
<p itemprop="description"><?php echo htmlspecialchars($event['description']); ?></p>
<time itemprop="startDate" datetime="<?php echo htmlspecialchars($event['start_date']); ?>">
    <?php echo htmlspecialchars($event['start_date']); ?>
</time>

<?php if ($event['end_date']): ?>
<time itemprop="endDate" datetime="<?php echo htmlspecialchars($event['start_date']); ?>">
</time>
<?php endif; ?>

<div itemprop="location" itemscope itemtype="https://schema.org/Place" itemid="https://www.wikidata.org/wiki/<?= htmlspecialchars($event['id_wikidata_organizer']) ?>">
    <span itemprop="name">
        <?= htmlspecialchars($event['location_name']) ?>   
    </span>,
    <span itemprop="addressLocality">
        <?= htmlspecialchars($event['location_city']) ?>
    </span>,
    <span itemprop="addressCountry">
        <?= htmlspecialchars($event['location_country']) ?>
    </span>
</div>

<a href="<?= htmlspecialchars($event['url']) ?>" itemprop="url">Page officielle</a>

</article>
<hr>
<?php endforeach; ?>

</body>
</html>
