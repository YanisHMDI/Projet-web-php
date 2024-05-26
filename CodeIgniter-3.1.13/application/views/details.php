<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Détails de l'album</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/detail.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>

    <section class="album-details">
        <div class="album-cover">
            <?php if(isset($album->jpeg) && !is_null($album->jpeg)): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($album->jpeg); ?>" alt="Album cover" />
            <?php endif; ?>
        </div>
        <div class="album-info">
            <?php if(isset($album)): ?>
                <h2><?php echo $album->name; ?></h2>
                <?php if(isset($album->artistName)): ?>
                    <p class="artist">Artiste: <?php echo $album->artistName; ?></p>
                <?php endif; ?>
                <p class="year">Année: <?php echo $album->year; ?></p>
                <?php if(isset($album->description)): ?>
                    <p>Description: <?php echo $album->description; ?></p>
                <?php endif; ?>
                <?php if(isset($album->tracks) && count($album->tracks) > 0): ?>
                    <div class="track-list">
                        <h3>Liste des chansons</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Nom de la chanson</th>
                                    <th>Durée</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($album->tracks as $index => $track): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $track->songName; ?></td>
                                        <td><?php echo floor($track->duration / 60) . ':' . sprintf("%02d", $track->duration % 60); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Aucune chanson trouvée pour cet album.</p>
                <?php endif; ?>
            <?php else: ?>
                <p>Album non trouvé.</p>
            <?php endif; ?>
        </div>
    </section>

    <script src="<?php echo base_url('assets/script.js'); ?>"></script>
</body>
</html>
