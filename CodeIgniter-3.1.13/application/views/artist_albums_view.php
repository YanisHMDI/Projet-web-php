<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums de <?php echo $artist->name; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/albums_artist.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="artist-albums-section">
        <h2>Albums de <?php echo $artist->name; ?></h2>
        <?php if (!empty($albums)): ?>
            <ul class="album-list">
                <?php foreach ($albums as $album): ?>
                    <li class="album-item">
                        <a href="<?php echo site_url('album/details/' . $album->id); ?>">
                            <?php echo $album->name; ?> (<?php echo $album->year; ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-album">Aucun album disponible pour cet artiste.</p>
        <?php endif; ?>
    </section>
</body>
</html>