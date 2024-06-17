<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->model('Artist_model');
        $this->load->helper('url');
        $this->load->model('Playlist_model');
    }

    public function index() {
        $query = $this->input->get('query');
        $albums = $this->Model_music->search_albums($query);
        $artists = $this->Artist_model->search_artists($query);
        $songs = $this->Model_music->search_songs($query);
    
        // Récupérer les playlists de l'utilisateur pour la vue
        $user_id = $this->session->userdata('user_id');
        $playlists = $this->Playlist_model->get_playlists_by_user($user_id);
    
        $data = [
            'albums' => $albums,
            'artists' => $artists,
            'songs' => $songs,
            'playlists' => $playlists  // Assurez-vous que $playlists est correctement défini
        ];
    
        $this->load->view('SearchView', $data);
    }
    
}
?>