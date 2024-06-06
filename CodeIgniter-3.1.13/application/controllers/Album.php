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

    public function index() {
        $albums = $this->Model_music->getAlbums();
        $this->load->view('AlbumView', ['albums' => $albums]);
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
