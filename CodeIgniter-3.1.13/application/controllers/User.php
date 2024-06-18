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
            $this->load->view('layout/sidebar');
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->user_model->check_login($email, $password);
    
            if ($user) {
                // Définir les données de l'utilisateur dans la session
                $this->session->set_userdata('user_id', $user->id); 
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
        redirect('AccueilController');
    }
    

    public function profile() {
        // Vérifiez si l'utilisateur est connecté
        if (!$this->session->userdata('user_id')) {
            redirect('user/login');
        }

        // Récupérez les informations de l'utilisateur
        $data['user'] = array(
            'username' => $this->session->userdata('username'),
            'email' => $this->session->userdata('email')
        );

        $this->load->view('profile', $data);
    }

    public function change_password() {
        // Vérifiez si l'utilisateur est connecté
        if (!$this->session->userdata('user_id')) {
            redirect('user/login');
        }

        // Règles de validation
        $this->form_validation->set_rules('current_password', 'Mot de passe actuel', 'required');
        $this->form_validation->set_rules('new_password', 'Nouveau mot de passe', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirmer le mot de passe', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('change_password');
        } else {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->input->post('current_password');
            $new_password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);

            // Vérifiez le mot de passe actuel
            $user = $this->user_model->get_user_by_id($user_id);
            if (password_verify($current_password, $user->password)) {
                // Mettre à jour le mot de passe
                $this->user_model->update_password($user_id, $new_password);
                $this->session->set_flashdata('success', 'Mot de passe mis à jour avec succès.');
                redirect('user/profile');
            } else {
                $this->session->set_flashdata('error', 'Le mot de passe actuel est incorrect.');
                $this->load->view('change_password');
            }
        }
    }

    public function delete_account() {
        // Vérifiez si l'utilisateur est connecté
        if (!$this->session->userdata('user_id')) {
            redirect('user/login');
        }

        $user_id = $this->session->userdata('user_id');
        $this->user_model->delete_user($user_id);
        $this->session->sess_destroy();
        redirect('AccueilController');
    }

}
