<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style'); ?>">

</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <h2>Créer une nouvelle Playlist</h2>
    <?php echo form_open('playlist/create_process'); ?>
        <label for="playlist_name">Nom de la playlist</label>
        <input type="text" name="playlist_name" required>

        <label for="album_ids">Sélectionnez les albums</label>
        <?php foreach($albums as $album): ?>
            <div>
                <input type="checkbox" name="album_ids[]" value="<?php echo $album->id; ?>">
                <?php echo $album->name; ?> - <?php echo $album->artistName; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit">Créer</button>
    <?php echo form_close(); ?>
</body>
</html>
