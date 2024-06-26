<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/inscription'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar'); ?>">

</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>
    <div class="container">
        <?php echo validation_errors(); ?>
        <?php echo form_open('user/register'); ?>
            <h2>Inscription</h2>
            <div>
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>">
            </div>
            <div>
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>">
            </div>
            <div>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="password_confirm">Confirmation du mot de passe :</label>
                <input type="password" id="password_confirm" name="password_confirm">
            </div>
            <button type="submit">S'inscrire</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
