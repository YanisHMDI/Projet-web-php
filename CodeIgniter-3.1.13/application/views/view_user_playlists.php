<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/playlist.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-details-section">
        <h2><?php echo $playlist->name; ?></h2>
        <div class="playlist-info">
            <p>Visibilité : <?php echo $playlist->visibility; ?></p>
            <?php if ($playlist->image): ?>
                <img src="<?php echo base_url($playlist->image); ?>" alt="<?php echo $playlist->name; ?>" class="playlist-detail-image">
            <?php endif; ?>
        </div>
        <h3>Titres de la playlist :</h3>
        <?php if (!empty($playlist->tracks)): ?>
            <ul class="track-list">
                <?php foreach ($playlist->tracks as $track): ?>
                    <li>
                        <?php echo $track->songName; ?> - <?php echo $track->artistName; ?> (<?php echo $track->albumName; ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Cette playlist ne contient aucun titre.</p>
        <?php endif; ?>
    </section>
</body>
</html>
