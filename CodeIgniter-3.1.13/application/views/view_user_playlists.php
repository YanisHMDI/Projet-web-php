<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/view_user_playlist.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">

</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="playlist-details-section">
        <h2><?php echo $playlist->name; ?></h2>
        <div class="playlist-info">
            <p>Visibilité : <?php echo $playlist->visibility; ?></p>
            <?php if ($playlist->image): ?>
                <img src="<?php echo base_url($playlist->image); ?>" alt="<?php echo $playlist->name; ?>" class="playlist-detail-image">
            <?php endif; ?>
        </div>
        <h3>Titres de la playlist :</h3>
        <?php if (!empty($playlist->tracks)): ?>
            <ul class="track-list">
                <?php foreach ($playlist->tracks as $track): ?>
                    <li>
                        <?php echo $track->songName; ?> - <?php echo $track->artistName; ?> (<?php echo $track->albumName; ?>)
                        <button onclick="confirmDelete(<?php echo $playlist->id; ?>, <?php echo $track->id; ?>)">Supprimer</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Cette playlist ne contient aucun titre.</p>
        <?php endif; ?>
    </section>

    <script>
        function confirmDelete(playlistId, trackId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette chanson de la playlist ?')) {
                window.location.href = '<?php echo site_url('playlist/delete_track/'); ?>' + playlistId + '/' + trackId;
            }
        }
    </script>
</body>
</html>
