<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explorer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
    }

    public function index() {
        // Définir les arguments nécessaires pour la fonction getAlbums()
        $argument1 = 'valeur_argument1';
        $argument2 = 'valeur_argument2';

        // Passer les arguments à la fonction getAlbums() du modèle Model_music
        $albums = $this->Model_music->getAlbums($argument1, $argument2);
        
        // Charger la vue avec les données des albums
        $this->load->view('ExplorerView', ['albums' => $albums]);
    }

}
?>
