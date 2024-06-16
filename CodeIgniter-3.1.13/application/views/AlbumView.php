<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Binks</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Album.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
</head>
<body>
    <!-- Inclure la barre latérale -->
    <?php $this->load->view('layout/sidebar'); ?>

    <!-- Contenu de la page -->
    <div class="content">
        <!-- Filtre par genre -->
        <select onchange="window.location.href=this.value">
            <option value="<?php echo site_url('album/index'); ?>">Tous les genres</option>
            <?php foreach ($genres as $genre): ?>
                <option value="<?php echo site_url('album/index/' . $genre->id); ?>"><?php echo $genre->name; ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Liste des albums -->
        <section class="list">
            <?php foreach($albums as $album): ?>
                <div>
                    <article>
                        <header class='short-text'>
                            <?php echo anchor("album/details/{$album->id}", "<h2 class='album-title'>{$album->name}</h2>"); ?>
                        </header>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
                        <footer class='short-text'><?php echo "{$album->year} - {$album->artistName} - {$album->genreName}"; ?></footer>
                    </article>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</body>
</html>
