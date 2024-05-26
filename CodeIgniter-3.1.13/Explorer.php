<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');

class Explorer extends CI_Controller {

    public function index()
    { 
        $this->load->model('Model_music');

        $data['albums'] = this->album_model->get_all_albums();

        $this->load->view('ExplorerView', $data);

    }
}
?>