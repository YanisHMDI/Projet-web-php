<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1,width=device-width, maximum-scale=1, user-scalable=no">
    <title>Binks</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>
    <header class="top-header">
        <div class="top-navigation">
            <button class="btn_connexion">connexion</button>
            <a href="#">Menu 2</a>
            <a href="#">Menu 3</a>
        </div>
    </header>
    <header class="side-header">
        <h2 class="logo"><img src="<?php echo base_url('assets/logo.png'); ?>" alt="Votre Logo" width="100"></h2>
        <div class="search-bar">
            <input type="text" id="song-input" placeholder="Ajouter une chanson">
            <button onclick="addSong">Ajouter</button>
        </div>
        <nav class="navigation">
            <a href="<?php echo site_url('accueil'); ?>">Accueil</a>
            <a href="<?php echo site_url('explorer'); ?>">Explorer</a>
            <a href="<?php echo site_url('radio'); ?>">Radio</a>
            <a href="<?php echo site_url('playlist'); ?>">Playlist</a>
            <a href="<?php echo site_url('coups_de_coeur'); ?>">Coups de Cœur</a>
        </nav>
    </header>

    <section class="presentation">
    <h2 class="logo"><img src="<?php echo base_url('assets/logo.png'); ?>" alt="Votre Logo" width="100"></h2>
        <h1>Découvrez de nouveaux morceaux tous les jours</h1>
        <p>Profitez de playlists et d'albums qui s'inspirent des artistes et des genres que vous écoutez. Gratuit pendant 1 mois, puis €10,99/mois.<p>
        <button onclick="addSong">Essayer gratuitement</button>
        <img src="<?php echo base_url('assets/Macbook.png'); ?>" alt="Sample Image" class="sample-image">
    </section>
    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</body>
</html>
