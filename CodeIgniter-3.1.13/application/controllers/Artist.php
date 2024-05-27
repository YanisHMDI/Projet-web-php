<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Artist_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $data['artists'] = $this->Artist_model->get_all_artists();
        $this->load->view('artist_view', $data);
    }

    public function view($artist_id) {
        $data['artist'] = $this->Artist_model->get_artist_by_id($artist_id);
        $data['albums'] = $this->Artist_model->get_albums_by_artist($artist_id);
        $this->load->view('artist_albums_view', $data);
    }
}
?>
