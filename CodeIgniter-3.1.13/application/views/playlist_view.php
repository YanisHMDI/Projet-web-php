<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Playlists</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/playlist.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-section">
        <h2>Mes Playlists</h2>
        <?php if (!empty($playlists)): ?>
            <ul>
                <?php foreach ($playlists as $playlist): ?>
                    <li>
                        <a href="<?php echo site_url('playlist/add_tracks/' . $playlist->id); ?>">
                            <?php echo $playlist->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Vous n'avez pas encore de playlists.</p>
        <?php endif; ?>
    </section>

    <!-- Bouton + -->
    <button class="btn-add-playlist" onclick="openPopup()">+</button>

    <!-- Popup pour créer une nouvelle playlist -->
    <div id="playlistPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Créer une nouvelle playlist</h2>
            <?php echo form_open_multipart('playlist/create_process'); ?>
                <div>
                    <label for="playlist_name">Nom de la playlist :</label>
                    <input type="text" name="playlist_name" required>
                </div>
                <div>
                    <label for="visibility">Visibilité :</label>
                    <select name="visibility" required>
                        <option value="private">Privée</option>
                        <option value="public">Publique</option>
                    </select>
                </div>
                <div>
                    <label for="playlist_image">Image de la playlist :</label>
                    <input type="file" name="playlist_image" accept="image/*">
                </div>
                <div>
                    <button type="submit">Créer</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('playlistPopup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('playlistPopup').style.display = 'none';
        }
    </script>
</body>
</html>
