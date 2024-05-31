<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $playlist->name; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/playlist.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-details-section">
        <h2><?php echo $playlist->name; ?></h2>
        <p>Visibilité : <?php echo $playlist->visibility; ?></p>

        <h3>Albums</h3>
        <div class="albums">
            <?php if (!empty($albums)): ?>
                <?php foreach ($albums as $album): ?>
                    <div class="album">
                        <p><?php echo $album->name; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun album dans cette playlist.</p>
            <?php endif; ?>
        </div>

        <h3>Titres</h3>
        <div class="tracks">
            <?php if (!empty($tracks)): ?>
                <?php foreach ($tracks as $track): ?>
                    <div class="track">
                        <p><?php echo $track->name; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun titre dans cette playlist.</p>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
