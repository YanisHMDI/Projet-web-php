<!-- views/albums/details.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="album-details">
        <?php if(isset($album)): ?> <!-- Vérifiez si $album est défini -->
            <h2><?php echo $album->name; ?></h2>
            <?php if(isset($album->artistName)): ?> <!-- Vérifiez si $album->artistName est défini -->
                <p>Artiste: <?php echo $album->artistName; ?></p>
            <?php endif; ?>
            <p>Année: <?php echo $album->year; ?></p>
            <?php if(isset($album->jpeg) && !is_null($album->jpeg)): ?> <!-- Vérifiez si $album->jpeg est défini et non nul -->
                <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" />
            <?php endif; ?>
            <?php if(isset($album->description)): ?> <!-- Vérifiez si $album->description est défini -->
                <p>Description: <?php echo $album->description; ?></p>
            <?php endif; ?>
        <?php else: ?>
            <p>Album non trouvé.</p>
        <?php endif; ?>
        <!-- Ajoutez d'autres détails si nécessaire -->
    </section>

    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</body>
</html>
