<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titres de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/songs.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <div class="content">
        <h2>Titres de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></h2>
        <section class="list">
            <?php if (!empty($songs)): ?>
                <?php foreach ($songs as $song): ?>
                    <div>
                        <article>
                            <header class='short-text'>
                                <h2 class='song-title'><?php echo $song->songName; ?></h2>
                            </header>
                            <div class="song-details">
                                <p><strong>Genre:</strong> <?php echo $song->genreName; ?></p>
                                <p><strong>Année:</strong> <?php echo $song->albumYear; ?></p>
                                <p><strong>Album:</strong> <?php echo $song->albumName; ?></p>
                                <p><strong>Durée:</strong> <?php echo $song->duration; ?> secondes</p>
                            </div>
                            <form action="<?php echo site_url('playlist/add_track_to_playlist'); ?>" method="post">
                                <input type="hidden" name="track_id" value="<?php echo $song->trackId; ?>">
                                <select name="playlist_id">
                                    <?php foreach ($playlists as $user_playlist): ?>
                                        <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">Ajouter à la playlist</button>
                            </form>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-song">Aucun titre disponible pour cet artiste.</p>
            <?php endif; ?>
        </section>
    </div>

    <?php $this->load->view('layout/footer'); ?>
</body>
</html>
