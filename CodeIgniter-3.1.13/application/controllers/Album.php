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

    public function index($genre_id = null) {
        // Charger les genres pour la vue
        $data['genres'] = $this->Model_music->getGenres();
    
        // Charger les albums en fonction du genre sélectionné
        if ($genre_id !== null) {
            $data['albums'] = $this->Model_music->getAlbumsByGenre($genre_id);
        } else {
         
            $argument1 = ''; 
            $argument2 = ''; 
            $data['albums'] = $this->Model_music->getAlbums($argument1, $argument2);
        }
    
        // Charger la vue avec les données
        $this->load->view('AlbumView', $data);
    }
    

    public function details($album_id) {
        // Charger les détails de l'album en utilisant le modèle Model_music
        $data['album'] = $this->Model_music->get_album_details($album_id);
    
        // Vérifie si l'album est trouvé
        if (!$data['album']) {
            show_404();
        }
    
        // Passer artistId et genreId à la vue
        $data['artistId'] = $data['album']->artistId; 
        $data['genreId'] = $data['album']->genreId; 
    
        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $user_id = $this->session->userdata('user_id');
    
        // Récupérer les playlists de l'utilisateur connecté en utilisant le modèle Playlist_model
        $data['playlists'] = $this->Playlist_model->get_playlists_by_user($user_id);
    
        // Passer l'ID de l'utilisateur connecté à la vue
        $data['user_id'] = $user_id;
    
        // Définir si l'utilisateur est connecté ou non
        $data['user_logged_in'] = !empty($user_id);
    
        // Charger la vue avec les données de l'album et des playlists
        $this->load->view('details', $data);
    }
    
    
}
    

?>

