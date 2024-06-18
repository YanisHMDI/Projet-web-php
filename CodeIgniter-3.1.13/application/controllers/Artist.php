<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Artist_model');
        $this->load->model('Model_music'); 
        $this->load->helper('url');
        $this->load->model('Playlist_model');

    }

    public function index() {
        $data['artists'] = $this->Artist_model->get_all_artists();
        $this->load->view('artist_view', $data);
    }

    public function view($artist_id) {
        $data['artist'] = $this->Artist_model->get_artist_by_id($artist_id);
        $data['albums'] = $this->Artist_model->get_albums_by_artist($artist_id);
        $data['songs'] = $this->Artist_model->get_songs_by_artist($artist_id); 
        $user_id = $this->session->userdata('user_id');
        $data['playlists'] = $this->Playlist_model->get_playlists_by_user($user_id);
        $data['user_id'] = $user_id;
    
        // Définir si l'utilisateur est connecté ou non
        $data['user_logged_in'] = !empty($user_id);
        $this->load->view('artist_albums_view', $data);
    }
}
?>
