<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function register_user($username, $email, $password) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('utilisateurs', $data); // Assurez-vous que 'users' est le nom de votre table utilisateur
    }
    public function login_success() {
        // Afficher la page de connexion réussie
        $this->load->view('login_success');
    }
}
