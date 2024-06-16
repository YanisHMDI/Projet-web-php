<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/profil.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/global.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css'); ?>">


</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>  

    <div class="main-content">
        <h2>Profil</h2>
        <div class="profile-info">
            <p><strong>Nom d'utilisateur:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        </div>
        <div class="profile-actions">
            <a class="btn" href="<?php echo site_url('user/change_password'); ?>">Modifier le mot de passe</a>
            <a class="btn btn-danger" href="<?php echo site_url('user/delete_account'); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">Supprimer le compte</a>
        </div>
        <a class="btn btn-logout" href="<?php echo site_url('user/logout'); ?>">Se déconnecter</a>
    </div>
    <?php $this->load->view('layout/footer'); ?>

</body>
</html>
