<aside class="side-header">
    <h2 class="logo"><img src="<?php echo base_url('assets/logo.png'); ?>" alt="Votre Logo" width="100"></h2>

    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Recherche">
        <button onclick="performSearch()">Rechercher</button>
    </div>
    <nav class="navigation">
        <a href="<?php echo site_url('accueil'); ?>">Accueil</a>
        <a href="<?php echo site_url('album'); ?>">Album</a>
        <a href="<?php echo site_url('artist'); ?>">Artistes</a>
        <a href="<?php echo site_url('playlist'); ?>">Playlist</a>
        <a href="<?php echo site_url('coups_de_coeur'); ?>">Coups de Cœur</a>
    </nav>
    <div class="buttons">
        <a href="<?php echo site_url('user/profile'); ?>">Profil</a>
        <button class="btn_deconnexion" onclick="window.location.href='<?php echo site_url('user/logout'); ?>'">déconnexion</button>
    </div>
</aside>
