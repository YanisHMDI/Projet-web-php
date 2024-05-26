<!-- views/details.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="album-details">
        <?php if(isset($album)): ?>
            <h2><?php echo $album->name; ?></h2>
            <?php if(isset($album->artistName)): ?>
                <p>Artiste: <?php echo $album->artistName; ?></p>
            <?php endif; ?>
            <p>Année: <?php echo $album->year; ?></p>
            <?php if(isset($album->jpeg) && !is_null($album->jpeg)): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
            <?php endif; ?>
            <?php if(isset($album->description)): ?>
                <p>Description: <?php echo $album->description; ?></p>
            <?php endif; ?>
            <?php if(isset($album->songs) && count($album->songs) > 0): ?>
    <h3>Liste des chansons</h3>
    <ul>
        <?php foreach($album->songs as $song): ?>
            <li>
                                <?php echo $song->song; ?> - Durée: <?php echo floor($song->duration / 60) . ':' . sprintf("%02d", $song->duration % 60); ?>
                                <?php if(isset($song->diskNumber)): ?>
                                    (Disque <?php echo $song->diskNumber; ?>)
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                <p>Aucune chanson trouvée pour cet album.</p>
            <?php endif; ?>

            

        <?php else: ?>
            <p>Album non trouvé.</p>
        <?php endif; ?>
    </section>

    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</body>
</html>
