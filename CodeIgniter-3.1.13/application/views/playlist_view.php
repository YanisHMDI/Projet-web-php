<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Playlists</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <h2>Mes Playlists</h2>
    <?php if (empty($playlists)): ?>
        <p>Vous n'avez aucune playlist pour le moment.</p>
    <?php else: ?>
        <ul>
            <?php foreach($playlists as $playlist): ?>
                <li><?php echo $playlist->name; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="<?php echo site_url('playlist/create'); ?>">Créer une nouvelle playlist</a>
</body>
</html>
