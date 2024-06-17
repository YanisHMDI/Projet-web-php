<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des albums/titres à la playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/playlist.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/addtacks.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>
    
    <section class="add-tracks-section">
        <h2>Ajouter des albums/titres à la playlist</h2>
        <?php echo form_open('playlist/add_tracks_process'); ?>
            <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">
            
            <div class="form-group">
                <label for="track">Titre :</label>
                <select name="track" id="track">
                    <option value="">Sélectionner un titre</option>
                    <?php foreach ($tracks as $track): ?>
                        <option value="<?php echo $track->id; ?>"><?php echo $track->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="artist">Artiste :</label>
                <select name="artist" id="artist">
                    <option value="">Sélectionner un artiste</option>
                    <?php foreach ($artists as $artist): ?>
                        <option value="<?php echo $artist->id; ?>"><?php echo $artist->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="album">Album :</label>
                <select name="album" id="album">
                    <option value="">Sélectionner un album</option>
                    <?php foreach ($albums as $album): ?>
                        <option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit">Ajouter à la playlist</button>
            </div>
        <?php echo form_close(); ?>
    </section>
</body>
</html>
