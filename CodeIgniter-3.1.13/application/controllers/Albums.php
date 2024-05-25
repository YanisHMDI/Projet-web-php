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

}
?>
