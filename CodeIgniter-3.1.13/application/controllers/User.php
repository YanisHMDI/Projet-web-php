<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function register() {
        // Définir les règles de validation pour le formulaire d'inscription
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required');
        $this->form_validation->set_rules('email', 'Adresse e-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirmation du mot de passe', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            // Afficher le formulaire d'inscription en cas d'erreur de validation
            $this->load->view('register');
        } else {
            // Si la validation réussit, enregistrer l'utilisateur dans la base de données
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT); // Hasher le mot de passe
            $this->user_model->register_user($username, $email, $password);
            // Rediriger vers une page de connexion ou une autre page appropriée
            redirect('user/login');
        }
    }

    public function login_success() {
        // Afficher une page de succès après la connexion réussie
        $this->load->view('AccueilView');
    }
}
