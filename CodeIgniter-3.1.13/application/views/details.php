<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/detail.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>
    <section class="album-details">
        <div class="album-cover">
            <?php if(isset($album->jpeg) && !is_null($album->jpeg)): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album cover" />
            <?php endif; ?>
        </div>
        <div class="album-info">
            <?php if(isset($album)): ?>
                <h2><?php echo $album->name; ?></h2>
                <a href="<?php echo site_url('artist/view/' . $artistId); ?>">Artiste: <?php echo $album->artistName; ?></a>
                <a href="<?php echo site_url('album/index/' . $album->genreId); ?>">Genre: <?php echo $album->genreName; ?></a>
                <p class="year">Année: <?php echo $album->year; ?></p>
                
                <div class="track-list">
                    <h3>Liste des chansons</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Nom de la chanson</th>
                                <th>Durée</th>
                                <?php if($user_logged_in): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($album->tracks as $index => $track): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td>
                                    <?php echo $track->songName; ?>
                                </a>
                            </td>
                            <td><?php echo floor($track->duration / 60) . ':' . sprintf("%02d", $track->duration % 60); ?></td>
                            <?php if($user_logged_in): ?>
                                <td>
                                    <!-- Formulaire pour ajouter cette musique à la playlist -->
                                    <form action="<?php echo site_url('playlist/add_track_to_playlist'); ?>" method="post">
                                        <input type="hidden" name="track_id" value="<?php echo $track->id; ?>">
                                        <!-- Liste déroulante des playlists de l'utilisateur -->
                                        <select name="playlist_id">
                                            <?php foreach ($playlists as $user_playlist): ?>
                                                <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Bouton pour ajouter cette musique à la playlist -->
                                        <button type="submit">Ajouter à la playlist</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($user_logged_in): ?>
                    <!-- Formulaire pour ajouter toutes les chansons de l'album à une playlist -->
                    <div class="add-all-tracks">
                        <form action="<?php echo site_url('playlist/add_tracks_process'); ?>" method="post">
                            <!-- Liste déroulante des playlists de l'utilisateur -->
                            <select name="playlist_id">
                                <?php foreach ($playlists as $user_playlist): ?>
                                    <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- Ajout de tous les identifiants des chansons de l'album -->
                            <?php foreach($album->tracks as $track): ?>
                                <input type="hidden" name="selected_tracks[]" value="<?php echo $track->id; ?>">
                            <?php endforeach; ?>
                            <!-- Bouton pour ajouter toutes les chansons à la playlist -->
                            <button type="submit">Ajouter toutes les chansons à la playlist</button>
                        </form>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <p>Album non trouvé.</p>
            <?php endif; ?>
        </div>
    </section>
    
    <script>
        function performSearch() {
            var query = document.getElementById('search-input').value;
            window.location.href = "<?php echo site_url('search'); ?>?query=" + query;
        }
    </script>
</body>
</html>
