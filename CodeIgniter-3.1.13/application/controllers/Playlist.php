<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form'); // Charger le helper de formulaire
        $this->load->model('Playlist_model');
        $this->load->model('Model_music'); // Charger le modèle correct ici
    }

    public function index() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $data['playlists'] = $this->Playlist_model->get_playlists_by_user($this->session->userdata('user_id'));
            $this->load->view('playlist_view', $data);
        }
    }

    public function create() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $data['albums'] = $this->Model_music->getAlbums(null, null); // Utilisez Model_music pour obtenir les albums
            $this->load->view('create_playlist_view', $data);
        }
    }

    public function create_process() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $playlist_name = $this->input->post('playlist_name');
            $album_ids = $this->input->post('album_ids');
            $user_id = $this->session->userdata('user_id');
            $this->Playlist_model->create_playlist($playlist_name, $user_id, $album_ids);
            redirect('playlist');
        }
    }
}
?>
