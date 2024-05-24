<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1,width=device-width, maximum-scale=1, user-scalable=no">
    <title>Binks</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>
    <!-- Inclure la barre supérieure -->
    <?php $this->load->view('layout/topbar'); ?>

    <!-- Inclure la barre latérale -->
    <?php $this->load->view('layout/sidebar'); ?>

    <!-- Contenu de la page -->
    <h5>Albums list</h5>
    <section class="list">
        <?php foreach($albums as $album): ?>
            <div>
                <article>
                    <header class='short-text'>
                        <?php echo anchor("albums/view/{$album->id}", "{$album->name}"); ?>
                    </header>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
                    <footer class='short-text'><?php echo "{$album->year} - {$album->artistName}"; ?></footer>
                </article>
            </div>
        <?php endforeach; ?>
    </section>
    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</body>
</html>
