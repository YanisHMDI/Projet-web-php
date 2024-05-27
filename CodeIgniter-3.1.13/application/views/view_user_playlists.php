<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Playlists</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-section">
        <h2>Mes Playlists</h2>
        <?php if (!empty($playlists)): ?>
            <ul>
                <?php foreach ($playlists as $playlist): ?>
                    <li><?php echo $playlist->name; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez pas encore créé de playlists.</p>
        <?php endif; ?>
    </section>
</body>
</html>
