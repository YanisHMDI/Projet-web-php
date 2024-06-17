<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Albums de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Album.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <div class="content">
        <h2>Albums de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></h2>
        <section class="list">
            <?php if (!empty($albums)): ?>
                <?php foreach ($albums as $album): ?>
                    <div>
                        <article>
                            <header class='short-text'>
                                <?php echo anchor("album/details/{$album->id}?artist_id={$artist->id}", "<h2 class='album-title'>{$album->name}</h2>"); ?>
                            </header>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
                            <footer class='short-text'><?php echo "{$album->year} - {$artist->name}"; ?></footer>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-album">Aucun album disponible pour cet artiste.</p>
            <?php endif; ?>
        </section>

        <h2>Titres de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></h2>
        <section class="list">
            <?php if (!empty($songs)): ?>
                <?php foreach ($songs as $song): ?>
                    <div>
                        <article>
                            <header class='short-text'>
                                <h2 class='song-title'><?php echo $song->name; ?></h2>
                            </header>
                            <!-- Form to add this song to the playlist -->
                            <form action="<?php echo site_url('playlist/add_track_to_playlist'); ?>" method="post">
                                        <input type="hidden" name="track_id" value="<?php echo $song->id; ?>">
                                        <select name="playlist_id">
                                            <?php foreach ($playlists as $user_playlist): ?>
                                                <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                            <?php endforeach; ?>
                                </select>
                                <!-- Button to add this song to the playlist -->
                                <button type="submit">Ajouter à la playlist</button>
                            </form>
                        </article>
                    </div>
                <?php endforeach; ?>
                <!-- Form to add all songs of the artist to a playlist -->
                <div>
                <form action="<?php echo site_url('playlist/add_all_tracks_to_playlist'); ?>" method="post">
                <input type="hidden" name="artist_id" value="<?php echo $artist->id; ?>">
                <select name="playlist_id">
                    <?php foreach ($playlists as $playlist): ?>
                        <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Ajouter tous les titres à la playlist</button>
            </form>
                </div>
            <?php else: ?>
                <p class="no-song">Aucun titre disponible pour cet artiste.</p>
            <?php endif; ?>
        </section>
    </div>
    <?php $this->load->view('layout/footer'); ?>
</body>
</html>
