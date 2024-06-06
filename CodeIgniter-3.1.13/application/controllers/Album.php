<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->model('Playlist_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

<<<<<<< HEAD
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
=======
    public function index() {
        $albums = $this->Model_music->getAlbums();
        $this->load->view('AlbumView', ['albums' => $albums]);
>>>>>>> 3227c0080b01a3b417159a69b22e0b27b6de8435
    }
    

    public function details($album_id) {
        $album = $this->Model_music->get_album_details($album_id);
        if (!$album) {
            show_404();
        }
        $user_id = $this->session->userdata('user_id');
        $playlists = $this->Playlist_model->get_playlists_by_user($user_id);
        $this->load->view('details', ['album' => $album, 'playlists' => $playlists]);
    }
}

?>
