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

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($playlists)): ?>
        <div class="playlists">
            <?php foreach ($playlists as $playlist): ?>
                <div class="playlist">
                    <img src="<?php echo base_url('uploads/' . $playlist->image); ?>" alt="<?php echo $playlist->name; ?>" class="playlist-image">
                    <div class="playlist-info">
                        <h3 class="playlist-title">
                            <a href="<?php echo site_url('playlist/view/' . $playlist->id); ?>"><?php echo $playlist->name; ?></a>
                            <span class="playlist-options" onclick="openOptions(event, <?php echo $playlist->id; ?>)">...</span>
                        </h3>
                        <button onclick="confirmDelete(<?php echo $playlist->id; ?>)">Supprimer</button>
                    </div>
                    <div id="playlist-options-<?php echo $playlist->id; ?>" class="playlist-options-menu">
                        <a href="<?php echo site_url('playlist/add_tracks/' . $playlist->id); ?>">Ajouter des titres</a>
                        <!-- Ajouter d'autres options si nécessaire -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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
    function confirmDelete(playlistId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?')) {
            window.location.href = '<?php echo site_url('playlist/delete/'); ?>' + playlistId;
        }
    }

    function openPopup() {
        document.getElementById('playlistPopup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('playlistPopup').style.display = 'none';
    }

    function openOptions(event, playlistId) {
        event.stopPropagation();
        const optionsMenu = document.getElementById(`playlist-options-${playlistId}`);
        if (optionsMenu.style.display === 'block') {
            optionsMenu.style.display = 'none';
        } else {
            optionsMenu.style.display = 'block';
        }
    }

    document.addEventListener('click', function() {
        const optionsMenus = document.querySelectorAll('.playlist-options-menu');
        optionsMenus.forEach(menu => {
            menu.style.display = 'none';
        });
    });
</script>


</body>
</html>