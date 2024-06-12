<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/detail.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">
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
                <p class="artist">Artiste: <?php echo $album->artistName; ?></p>
                <p class="genre">Genre: <?php echo $album->genreName; ?></p>
                <p class="year">Année: <?php echo $album->year; ?></p>
                
                <div class="track-list">
                    <h3>Liste des chansons</h3>
                    <table>
                        <thead>
                            <tr>
                            <th>Numéro</th>
                            <th>Nom de la chanson</th>
                            <th>Durée</th>
                            <?php if ($this->session->userdata('username')) { ?>
                            <th>Playlist</th>
                            <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($album->tracks as $index => $track): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $track->songName; ?></td>
                                <td><?php echo floor($track->duration / 60) . ':' . sprintf("%02d", $track->duration % 60); ?></td>
                                <td>
                                    <!-- Formulaire pour ajouter cette musique à la playlist -->
                                    <form action="<?php echo base_url('index.php/playlist/add_track_to_playlist'); ?>" method="post">
                                        <input type="hidden" name="track_id" value="<?php echo $track->id; ?>">
                                        <input type="hidden" name="album_id" value="<?php echo $album->id; ?>">
                                        <!-- Liste déroulante des playlists de l'utilisateur -->
                                        <select name="playlist_select">
                                            <?php foreach ($playlists as $user_playlist): ?>
                                                <?php if (!is_null($user_playlist->id)): ?>
                                                    <option value="<?php echo $user_playlist->id; ?>"><?php echo $user_playlist->name; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- Bouton pour ajouter cette musique à la playlist -->
                                        <button type="submit">Ajouter à la playlist</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                    



                </div>
            <?php else: ?>
                <p>Album non trouvé.</p>
            <?php endif; ?>
        </div>
    </section>
</html>
