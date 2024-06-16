<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <title>Binks</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/accueil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">


</head>
<body>

<?php $this->load->view('layout/sidebar'); ?>


<section class="presentation">
    <h2 class="logo"><img src="<?php echo base_url('assets/logo.png'); ?>" alt="Votre Logo" width="100"></h2>
    <h1>Découvrez de nouveaux morceaux tous les jours</h1>
    <p>Profitez de playlists et d'albums qui s'inspirent des artistes et des genres que vous écoutez. Gratuit pendant 1 mois, puis €10,99/mois.</p>
    <img src="<?php echo base_url('assets/Macbook.png'); ?>" alt="Sample Image" class="sample-image">
</section>
<?php $this->load->view('layout/footer'); ?>


</body>
</html>
