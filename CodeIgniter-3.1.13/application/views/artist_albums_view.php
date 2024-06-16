<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Albums de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Album.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <div class="content">
        <h2>Albums de <?php echo $artist ? $artist->name : 'Artiste Inconnu'; ?></h2>
        <section class="list">
            <?php if (!empty($albums)): ?>
                <?php foreach ($albums as $album): ?>
                    <div>
                        <article>
                            <header class='short-text'>
                                <!-- Assurez-vous que l'ID de l'artiste est inclus dans le lien -->
                                <?php echo anchor("album/details/{$album->id}?artist_id={$artist->id}", "<h2 class='album-title'>{$album->name}</h2>"); ?>
                            </header>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
                            <footer class='short-text'><?php echo "{$album->year} - {$artist->name}"; ?></footer>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-album">Aucun album disponible pour cet artiste.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
