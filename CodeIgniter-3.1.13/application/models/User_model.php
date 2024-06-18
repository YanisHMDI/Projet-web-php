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
        $this->db->insert('utilisateurs', $data); 
    }

    public function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('utilisateurs');
        return $query->row();
    }

    public function update_password($user_id, $new_password) {
        $this->db->where('id', $user_id);
        $this->db->update('utilisateurs', array('password' => $new_password));
    }

    public function delete_user($user_id) {
        // Supprimer les playlists de l'utilisateur
        $this->db->where('user_id', $user_id);
        $playlists = $this->db->get('playlist')->result();
        
        // Pour chaque playlist de l'utilisateur, supprimer les enregistrements associés dans la table playlist_track
        foreach ($playlists as $playlist) {
            $this->db->where('playlist_id', $playlist->id);
            $this->db->delete('playlist_track');
        }
    
        // Supprimer les playlists de l'utilisateur
        $this->db->where('user_id', $user_id);
        $this->db->delete('playlist');
        
        // Supprimer l'utilisateur
        $this->db->where('id', $user_id);
        $this->db->delete('utilisateurs');
    }
    

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('utilisateurs'); 
        
        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Vérifie si le mot de passe est correct
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
?>
