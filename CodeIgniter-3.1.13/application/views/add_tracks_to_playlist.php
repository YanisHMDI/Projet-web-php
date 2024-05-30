<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des albums/titres à la playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/playlist.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="add-tracks-section">
        <h2>Ajouter des albums/titres à la playlist</h2>
        <?php echo form_open('playlist/add_tracks_process'); ?>
            <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">

            <h3>Albums</h3>
            <?php foreach ($albums as $album): ?>
                <div>
                    <input type="checkbox" name="selected_albums[]" value="<?php echo $album->id; ?>">
                    <label><?php echo htmlspecialchars($album->name); ?></label>
                </div>
            <?php endforeach; ?>

            <h3>Titres</h3>
            <?php foreach ($tracks as $track): ?>
                <div>
                    <input type="checkbox" name="selected_tracks[]" value="<?php echo $track->id; ?>">
                    <label><?php echo htmlspecialchars($track->name); ?></label>
                </div>
            <?php endforeach; ?>

            <button type="submit">Ajouter à la playlist</button>
        <?php echo form_close(); ?>
    </section>
</body>
</html>
