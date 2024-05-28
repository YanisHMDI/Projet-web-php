<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistes</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/artist.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="artist-section">
        <h2>Artistes</h2>
        <?php if (!empty($artists)): ?>
            <div class="artist-list">
                <?php foreach ($artists as $artist): ?>
                    <section class="artist">
                        <div class="artist-bubble">
                            <a href="<?php echo site_url('artist/view/' . $artist->id); ?>">
                                <div class="artist-name"><?php echo $artist->name; ?></div>
                            </a>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-artist">Aucun artiste disponible.</p>
        <?php endif; ?>
    </section>
</body>
</html>
