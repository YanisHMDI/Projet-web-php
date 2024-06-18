<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/search.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="search-results">
        <h2>Résultats de Recherche</h2>


        
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
                            <?php if ($user_logged_in): ?>
                                <div class="song-actions">
                                    <form action="<?php echo site_url('playlist/add_track_to_playlist'); ?>" method="post">
                                        <input type="hidden" name="track_id" value="<?php echo $song->id; ?>">
                                        <select name="playlist_id">
                                            <?php foreach ($playlists as $user_playlist): ?>
                                                <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit">Ajouter à la playlist</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-song">Aucun titre trouvé.</p>
        <?php endif; ?>

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

    </section>
</body>
</html>
