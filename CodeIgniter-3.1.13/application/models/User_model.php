<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Charger la base de données
    }

    public function register_user($username, $email, $password) {
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->insert('utilisateurs', $data); // Assurez-vous que 'utilisateurs' est le nom de votre table utilisateur
    }

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('utilisateurs'); // Assurez-vous que 'utilisateurs' est le nom de votre table utilisateur
        
        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Vérifiez si le mot de passe est correct
            if (password_verify($password, $user->password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
