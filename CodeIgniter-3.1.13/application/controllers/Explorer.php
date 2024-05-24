<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explorer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_music');
    }

    public function index() {
        $data['albums'] = $this->Model_music->getAlbums();
        $this->load->view('ExplorerView', $data);
    }
}
?>
