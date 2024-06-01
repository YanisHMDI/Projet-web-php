<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation'); // Charger la bibliothèque de validation de formulaire
        $this->load->library('session'); // Charger la bibliothèque de session
        $this->load->helper('url');

    }
    
    

    public function register() {
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', 'required');
        $this->form_validation->set_rules('email', 'Adresse e-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
        $this->form_validation->set_rules('password_confirm', 'Confirmation du mot de passe', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('register');
        } else {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->user_model->register_user($username, $email, $password);
            redirect('user/login');
        }
    }

    public function login_process() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->user_model->check_login($email, $password);
    
            if ($user) {
                // Définir les données de l'utilisateur dans la session
                $this->session->set_userdata('user_id', $user->id); // Assurez-vous d'avoir une colonne id dans votre table d'utilisateurs
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('email', $user->email);
    
                // Créer un cookie pour marquer la connexion de l'utilisateur
                setcookie('user_logged_in', true, time() + (86400 * 30), "/"); // Cookie valable pendant 30 jours
    
                redirect('user/login_success');
            } else {
                $this->session->set_flashdata('error', 'Email ou mot de passe incorrect');
                redirect('user/login');
            }
        }
    }
    
    

    public function login() {
        $this->load->view('login');
    }

    public function login_success() {
        $this->load->view('AccueilView');
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('AccueilView');
    }
}
