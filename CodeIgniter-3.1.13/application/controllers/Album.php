<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index($genre_id = null) {
        $this->load->model('Model_music');
        
        // Charger les genres pour la vue
        $data['genres'] = $this->Model_music->getGenres();
    
        // Charger les albums en fonction du genre sélectionné
        if ($genre_id !== null) {
            $data['albums'] = $this->Model_music->getAlbumsByGenre($genre_id);
        } else {
            // Passer les arguments requis à getAlbums()
            $argument1 = ''; // Remplacez par la valeur de votre premier argument
            $argument2 = ''; // Remplacez par la valeur de votre deuxième argument
            $data['albums'] = $this->Model_music->getAlbums($argument1, $argument2);
        }
    
        // Charger la vue avec les données
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
