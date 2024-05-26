<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Model_music');
        $this->load->helper(array('url', 'html'));
        $this->load->library('session');
    }

    public function index($page = 1) {
        $limit = 10; // Nombre d'albums par page
        $start_index = ($page - 1) * $limit; // Index de départ pour la pagination

        $total_albums = $this->Model_music->countAlbums(); // Nombre total d'albums
        $albums = $this->Model_music->getAlbums($limit, $start_index); // Récupération des albums pour la page actuelle

        $config['base_url'] = base_url('albums/index');
        $config['total_rows'] = $total_albums;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);

        $data['albums'] = $albums;
        $this->load->view('ExplorerView', $data); // Charge la vue 'ExplorerView'
        $this->load->view('layout/sidebar');
    }

    public function details($album_id) {
        $album = $this->Model_music->get_album_details($album_id);
        if (!$album) {
            show_404();
        }

        $data['album'] = $album;
        $this->load->view('details', $data);
        $this->load->view('layout/sidebar');
    }
}
?>
