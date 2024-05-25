<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if ($this->session->flashdata('error')): ?>
        <p><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php echo form_open('user/login_process'); ?>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
        <button type="submit">Se connecter</button>
    <?php echo form_close(); ?>
    <p>Pas encore inscrit ? <a href="<?php echo site_url('user/register'); ?>">Inscrivez-vous ici</a></p>
</body>
</html>
