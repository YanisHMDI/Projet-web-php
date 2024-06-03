<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le mot de passe</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sidebar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/profil.css'); ?>">
</head>
<body>
    <?php $this->load->view('layout/sidebar'); ?>  
    <div class="main-content">
        <h2>Modifier le mot de passe</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <?php echo form_open('user/change_password'); ?>
            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
                <?php echo form_error('current_password'); ?>
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
                <?php echo form_error('new_password'); ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                <?php echo form_error('confirm_password'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
