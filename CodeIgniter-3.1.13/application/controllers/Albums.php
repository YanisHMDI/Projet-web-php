<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->library('pagination');
	}

	public function index($page = 1) {
		$limit = 10; // Nombre d'albums par page
		$start_index = ($page - 1) * $limit; // Index de départ pour la pagination

		$total_albums = $this->model_music->countAlbums(); // Nombre total d'albums
		$albums = $this->model_music->getAlbums($limit, $start_index); // Récupération des albums pour la page actuelle

		$config['base_url'] = base_url('albums/index');
		$config['total_rows'] = $total_albums;
		$config['per_page'] = $limit;

		$this->pagination->initialize($config);

		$data['albums'] = $albums;
		$this->load->view('layout/header');
		$this->load->view('albums_list', $data);
		$this->load->view('layout/footer');
		$this->load->view('views/explorer');
	}



    public function details($album_id) {
        // Utilisez l'ID de l'album pour récupérer les détails de l'album depuis le modèle
        $album_details = $this->model_music->getAlbumDetails($album_id);

        // Vérifiez si l'album existe
        if ($album_details) {
            // Chargez la vue des détails de l'album avec les données récupérées
            $this->load->view('album_details', ['album_details' => $album_details]);
        } else {
            // Si l'album n'existe pas, redirigez vers une page d'erreur ou affichez un message d'erreur
            show_404(); // Affiche une erreur 404
        }
    }

}
?>
