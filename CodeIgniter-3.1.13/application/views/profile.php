<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h2>Profil</h2>
    <p>Bienvenue, <?php echo $this->session->userdata('username'); ?>!</p>
    <a href="<?php echo site_url('user/logout'); ?>">Se déconnecter</a>
</body>
</html>
