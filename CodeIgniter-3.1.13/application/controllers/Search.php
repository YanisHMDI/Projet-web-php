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
        $albums = $this->Model_music->search_albums($query);
        $artists = $this->Artist_model->search_artists($query);
        $this->load->view('SearchView', ['albums' => $albums, 'artists' => $artists]);
    }
}
?>
