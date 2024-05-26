<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explorer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $argument1 = 'valeur_argument1';
        $argument2 = 'valeur_argument2';
        $albums = $this->Model_music->getAlbums($argument1, $argument2);
        $this->load->view('ExplorerView', ['albums' => $albums]);
    }

    public function details($album_id) {
        $album = $this->Model_music->get_album_details($album_id);
        if (!$album) {
            show_404();
        }
        $this->load->view('details', ['album' => $album]);
    }
}
?>

