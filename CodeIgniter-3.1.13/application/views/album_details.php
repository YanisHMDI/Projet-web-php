<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <?php echo link_tag('assets/style.css'); ?>
    <style>
        /* Ajoute ton CSS pour la mise en forme ici */
    </style>
</head>
<body>
    <h1>Détails de l'album</h1>
    <h2><?php echo $album->name; ?></h2>
    <h3>Artiste: <?php echo $album->artistName; ?></h3>
    <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Cover">
    <p>Genre: <?php echo $album->genreName; ?></p>
    <p>Année: <?php echo $album->year; ?></p>

    <h3>Liste des morceaux:</h3>
    <ul>
        <?php foreach ($album->tracks as $track): ?>
            <li><?php echo $track->trackName; ?> (<?php echo $track->duration; ?>)</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
