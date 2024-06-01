<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Playlist_model');
    }

    public function index() {
        // Vérifiez si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
        if (!$this->session->userdata('username')) {
            redirect('user/login'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        }
    
        // Récupérer l'ID de l'utilisateur à partir de la session
        $user_id = $this->session->userdata('user_id');
    
        // Vérifiez si l'ID de l'utilisateur est valide
        if (!$user_id) {
            // Gérer le cas où l'ID de l'utilisateur est manquant ou invalide
            // Vous pouvez rediriger vers une page d'erreur ou gérer en conséquence
            show_error('ID utilisateur manquant ou invalide');
            return;
        }
    
        // Obtenez les playlists de l'utilisateur à l'aide de l'ID récupéré
        $data['playlists'] = $this->Playlist_model->get_playlists_by_user($user_id);
    
        // Chargez la vue avec les playlists de l'utilisateur
        $this->load->view('playlist_view', $data);
    }
    

    public function view($playlist_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login'); // Redirige vers la page de login si l'utilisateur n'est pas connecté
        }

        $data['playlist'] = $this->Playlist_model->get_playlist_details($playlist_id);
        if ($data['playlist']) {
            $this->load->view('view_user_playlists', $data);
        } else {
            show_404(); // Affiche une page 404 si la playlist n'existe pas
        }
    }
}
?>
