<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/view_user_playlists.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-details-section">
        <h2><?php echo $playlist->name; ?></h2>
        <div class="playlist-info">
            <p>Visibilité : <?php echo $playlist->visibility; ?></p>
            <?php if ($playlist->image): ?>
            <?php endif; ?>
        </div>
        <h3>Titres de la playlist :</h3>
        <?php if (!empty($playlist->tracks)): ?>
            <ul class="track-list">
                <?php foreach ($playlist->tracks as $track): ?>
                    <li>
                        <?php echo $track->songName; ?> - <?php echo $track->artistName; ?> (<?php echo $track->albumName; ?>)
                        <button onclick="confirmDeleteTrack(<?php echo $playlist->id; ?>, <?php echo $track->id; ?>)">Supprimer</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Cette playlist ne contient aucun titre.</p>
        <?php endif; ?>

        <div class="playlist-actions">
            <button onclick="confirmDeletePlaylist(<?php echo $playlist->id; ?>)">Supprimer la Playlist</button>
            <button onclick="toggleVisibility(<?php echo $playlist->id; ?>, '<?php echo $playlist->visibility; ?>')">Changer Visibilité</button>
            <button onclick="showEditNameForm()">Modifier le Nom</button>
        </div>

            <div id="editNameForm" style="display: none;">
                <form action="<?php echo site_url('playlist/edit_name'); ?>" method="post">
                 <input type="hidden" name="playlist_id" value="<?php echo $playlist->id; ?>">
                    <label for="newPlaylistName">Nouveau Nom :</label>
                    <input type="text" id="newPlaylistName" name="new_playlist_name" required>
                     <button type="submit">Modifier</button>
    </form>
</div>
    </section>

    <script>
        function confirmDeleteTrack(playlistId, trackId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette chanson de la playlist ?')) {
                window.location.href = '<?php echo site_url('playlist/delete_track/'); ?>' + playlistId + '/' + trackId;
            }
        }

        function confirmDeletePlaylist(playlistId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette playlist ?')) {
                window.location.href = '<?php echo site_url('playlist/delete/'); ?>' + playlistId;
            }
        }

        function toggleVisibility(playlistId, currentVisibility) {
            var newVisibility = (currentVisibility === 'public') ? 'private' : 'public';
            if (confirm('Êtes-vous sûr de vouloir changer la visibilité de cette playlist en ' + newVisibility + ' ?')) {
                window.location.href = '<?php echo site_url('playlist/change_visibility/'); ?>' + playlistId + '/' + newVisibility;
            }
        }

        function showEditNameForm() {
            document.getElementById('editNameForm').style.display = 'block';
        }
    </script>
</body>
</html>
