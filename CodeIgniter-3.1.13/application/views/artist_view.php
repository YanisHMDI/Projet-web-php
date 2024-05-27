<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistes</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/artist.css'); ?>">

</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="artist-section">
        <h2>Artistes</h2>
        <?php if (!empty($artists)): ?>
            <ul>
                <?php foreach ($artists as $artist): ?>
                    <li><a href="<?php echo site_url('artist/view/' . $artist->id); ?>"><?php echo $artist->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun artiste disponible.</p>
        <?php endif; ?>
    </section>
</body>
</html>
