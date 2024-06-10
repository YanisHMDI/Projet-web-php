<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->model('Artist_model');
        $this->load->helper('url');
    }

    public function index() {
        $query = $this->input->get('query');
        $filter = $this->input->get('filter');

        // Initialisation des variables
        $albums = [];
        $artists = [];
        $songs = [];

        // Recherche selon le filtre
        if ($filter == 'songs' || $filter == 'all') {
            $songs = $this->Model_music->search_songs($query);
        }
        if ($filter == 'artists' || $filter == 'all') {
            $artists = $this->Artist_model->search_artists($query);
        }
        if ($filter == 'albums' || $filter == 'all') {
            $albums = $this->Model_music->search_albums($query);
        }

        $this->load->view('SearchView', ['albums' => $albums, 'artists' => $artists, 'songs' => $songs]);
    }
}
?>
