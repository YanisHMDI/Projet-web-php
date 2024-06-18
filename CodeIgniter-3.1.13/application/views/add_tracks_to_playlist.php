<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des titres, artistes, et albums à la playlist</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/add_tracks_to_playlist.css'); ?>">
</head>
<body>
    <div class="sidebar">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>
    
    <section class="add-tracks-section">
        <h2>Ajouter un titre à la playlist</h2>
        <?php echo form_open('playlist/add_track_to_playlist'); ?>
            <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">
            
            <div class="form-group">
                <label for="track">Titre :</label>
                <select name="track_id" id="track">
                    <option value="">Sélectionner un titre</option>
                    <?php foreach ($tracks as $track): ?>
                        <option value="<?php echo $track->id; ?>"><?php echo $track->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit">Ajouter le titre à la playlist</button>
            </div>
        <?php echo form_close(); ?>
    </section>

    <section class="add-tracks-section">
        <h2>Ajouter toutes les musiques d'un artiste à la playlist</h2>
        <?php echo form_open('playlist/add_all_tracks_to_playlist'); ?>
            <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">
            
            <div class="form-group">
                <label for="artist">Artiste :</label>
                <select name="artist_id" id="artist">
                    <option value="">Sélectionner un artiste</option>
                    <?php foreach ($artists as $artist): ?>
                        <option value="<?php echo $artist->id; ?>"><?php echo $artist->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit">Ajouter toutes les musiques de l'artiste à la playlist</button>
            </div>
        <?php echo form_close(); ?>
    </section>

    <section class="add-tracks-section">
        <h2>Ajouter toutes les musiques d'un album à la playlist</h2>
        <?php echo form_open('playlist/add_album_to_playlist'); ?>
            <input type="hidden" name="playlist_id" value="<?php echo $playlist_id; ?>">
            
            <div class="form-group">
                <label for="album">Album :</label>
                <select name="album_id" id="album">
                    <option value="">Sélectionner un album</option>
                    <?php foreach ($albums as $album): ?>
                        <option value="<?php echo $album->id; ?>"><?php echo $album->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <button type="submit">Ajouter l'album à la playlist</button>
            </div>
        <?php echo form_close(); ?>
    </section>
</body>
</html>
