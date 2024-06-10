<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/search.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="search-results">
        <h2>Résultats de Recherche</h2>

        <!-- Formulaire de filtre -->
        <form action="<?php echo site_url('search'); ?>" method="get">
            <input type="text" name="query" value="<?php echo $this->input->get('query'); ?>">
            <select name="filter">
                <option value="all">Tous</option>
                <option value="songs" <?php echo $this->input->get('filter') == 'songs' ? 'selected' : ''; ?>>Titres</option>
                <option value="artists" <?php echo $this->input->get('filter') == 'artists' ? 'selected' : ''; ?>>Artistes</option>
                <option value="albums" <?php echo $this->input->get('filter') == 'albums' ? 'selected' : ''; ?>>Albums</option>
            </select>
            <button type="submit">Filtrer</button>
        </form>

        <!-- Affichage des résultats pour les titres -->
        <?php if ($this->input->get('filter') == 'songs' || $this->input->get('filter') == 'all'): ?>
            <h3>Titres</h3>
            <?php if (!empty($songs)): ?>
                <div class="song-list">
                    <?php foreach ($songs as $song): ?>
                        <section class="song">
                            <div class="song-bubble">
                                <div class="song-details">
                                    <div class="song-name"><?php echo $song->songName; ?></div>
                                    <div class="song-album"><?php echo $song->albumName; ?> - <?php echo $song->artistName; ?></div>
                                </div>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-song">Aucun titre trouvé.</p>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Affichage des résultats pour les artistes -->
        <?php if ($this->input->get('filter') == 'artists' || $this->input->get('filter') == 'all'): ?>
            <h3>Artistes</h3>
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
                <p class="no-artist">Aucun artiste trouvé.</p>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Affichage des résultats pour les albums -->
        <?php if ($this->input->get('filter') == 'albums' || $this->input->get('filter') == 'all'): ?>
            <h3>Albums</h3>
            <?php if (!empty($albums)): ?>
                <div class="album-list">
                    <?php foreach ($albums as $album): ?>
                        <section class="album">
                            <div class="album-bubble">
                                <a href="<?php echo site_url('album/details/' . $album->id); ?>">
                                    <div class="album-title"><?php echo $album->name; ?> - <?php echo $album->artistName; ?></div>
                                </a>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-album">Aucun album trouvé.</p>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</body>
</html>
