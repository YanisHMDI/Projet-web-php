<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('album_model'); // Charger le modèle 'album_model' au lieu de 'model_music'
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('html');

    }

    public function index($page = 1) {
        $limit = 10; // Nombre d'albums par page
        $start_index = ($page - 1) * $limit; // Index de départ pour la pagination
    
        $total_albums = $this->album_model->countAlbums(); // Nombre total d'albums
        $albums = $this->album_model->getAlbums($limit, $start_index); // Récupération des albums pour la page actuelle
    
        $config['base_url'] = base_url('albums/index');
        $config['total_rows'] = $total_albums;
        $config['per_page'] = $limit;
    
        $this->pagination->initialize($config);
    
        $data['albums'] = $albums;
        $this->load->view('layout/header');
        $this->load->view('ExplorerView', $data); // Charge la vue 'ExplorerView' au lieu de 'explorer.php'
        $this->load->view('layout/footer');
    }

    // Dans le contrôleur Albums (Albums.php)
    public function details($album_id) {
        $data['album'] = $this->album_model->getAlbumDetails($album_id); // Supposons que vous avez une méthode getAlbumDetails() dans votre modèle pour obtenir les détails de l'album
        $this->load->view('layout/header');
        $this->load->view('details', $data);
        $this->load->view('layout/footer');
    }

}
?>
