<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($page = 1) {
        $per_page = 10; // Nombre d'albums par page
        $start_index = ($page - 1) * $per_page; // Index de départ pour la requête SQL
        $argument1 = 'valeur_argument1';
        $argument2 = 'valeur_argument2';
        $total_albums = $this->Model_music->countAlbums(); // Nombre total d'albums
        $total_pages = ceil($total_albums / $per_page); // Calcul du nombre total de pages
    
        // Récupérer les albums pour la page actuelle
        $albums = $this->Model_music->getAlbumsPaginated($argument1, $argument2, $start_index, $per_page);
    
        $data = [
            'albums' => $albums,
            'total_pages' => $total_pages,
            'current_page' => $page
        ];
    
        $this->load->view('AlbumView', $data);
    }
    

    public function details($album_id) {
        $album = $this->Model_music->get_album_details($album_id);
        if (!$album) {
            show_404();
        }
    
        // Récupérer les playlists de l'utilisateur
        $user_id = $this->session->userdata('user_id');
        $playlists = $this->Model_music->get_user_playlists($user_id);
    
        // Débogage: Afficher les playlists dans le journal pour vérifier qu'elles sont bien récupérées
        log_message('debug', 'Playlists: ' . print_r($playlists, true));
    
        $this->load->view('details', [
            'album' => $album,
            'playlists' => $playlists
        ]);
    }
    
}

?>

