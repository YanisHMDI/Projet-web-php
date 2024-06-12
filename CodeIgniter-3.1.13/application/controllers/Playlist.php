<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Playlist_model');
        $this->load->model('Model_music');
    }

    public function index() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $data['playlists'] = $this->Playlist_model->get_playlists_by_user($this->session->userdata('user_id'));
            $this->load->view('playlist_view', $data);
        }
    }

    public function create() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $data['albums'] = $this->Model_music->getAlbums(null, null);
            $this->load->view('create_playlist_view', $data);
        }
    }

    public function create_process() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $playlist_name = $this->input->post('playlist_name');
            $user_id = $this->session->userdata('user_id');
            $visibility = $this->input->post('visibility');
    
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('playlist_image')) {
                $error = array('error' => $this->upload->display_errors());
                $image_path = 'denis.jpg'; 
            } else {
                $data = $this->upload->data();
                $image_path = 'uploads/' . $data['file_name'];
            }
    
            $this->Playlist_model->create_playlist($playlist_name, $user_id, $visibility, $image_path);
            redirect('playlist');
        }
    }
    

    public function add_tracks($playlist_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $data['albums'] = $this->Model_music->getAlbums(null, null);
            $data['tracks'] = $this->Model_music->getTracksNotInPlaylist($playlist_id);
            $data['playlist_id'] = $playlist_id;
            $this->load->view('add_tracks_to_playlist', $data);
        }
    }

    public function add_track_to_playlist() {
        // Assure-toi que l'utilisateur est connecté
        if (!$this->session->userdata('username')) {
            // Redirige vers la page de connexion
            redirect('login');
        }
    
        // Récupère les données du formulaire
        $track_id = $this->input->post('track_id');
        $album_id = $this->input->post('album_id');
        $playlist_id = $this->input->post('playlist_select');
    
        // Ajoute la piste à la playlist
        $this->Playlist_model->add_track_to_playlist($playlist_id, $track_id);
    
        // Redirige vers la page des détails de l'album ou une autre page appropriée
        redirect('album/details/' . $album_id);
    }
    

    public function add_tracks_process() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $playlist_id = $this->input->post('playlist_id');
            $selected_albums = $this->input->post('selected_albums');
            $selected_tracks = $this->input->post('selected_tracks');
    
            if (!empty($selected_albums)) {
                foreach ($selected_albums as $album_id) {
                    $this->Playlist_model->add_album_to_playlist($playlist_id, $album_id);
                }
            }
    
            if (!empty($selected_tracks)) {
                foreach ($selected_tracks as $track_id) {
                    $this->Playlist_model->add_track_to_playlist($playlist_id, $track_id);
                }
            }
    
            // Redirigez vers la page de la playlist une fois les chansons ou albums ajoutés
            redirect('playlist/view/' . $playlist_id);
        }
    }
    
    public function view($playlist_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        $data['playlist'] = $this->Playlist_model->get_playlist_details($playlist_id);
        if ($data['playlist']) {
            $this->load->view('view_user_playlists', $data);
        } else {
            show_404();
        }
    }

    
    

    public function delete($playlist_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        $user_id = $this->session->userdata('user_id');
        $success = $this->Playlist_model->delete_playlist($playlist_id, $user_id);
    
        if ($success) {
            $this->session->set_flashdata('message', 'Playlist supprimée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Impossible de supprimer la playlist.');
        }
    
        redirect('playlist');
    }

    public function delete_track($playlist_id, $track_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        $user_id = $this->session->userdata('user_id');
        $success = $this->Playlist_model->delete_track_from_playlist($playlist_id, $track_id, $user_id);
    
        if ($success) {
            $this->session->set_flashdata('message', 'Chanson supprimée de la playlist avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Impossible de supprimer la chanson de la playlist.');
        }
    
        redirect('playlist/view/' . $playlist_id);
    }
    public function delete_track_from_playlist($playlist_id, $track_id, $user_id) {
        // Vérifier si la playlist appartient à l'utilisateur
        $this->db->where('id', $playlist_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');
    
        if ($query->num_rows() > 0) {
            // Supprimer l'entrée de la table playlist_track
            $this->db->where('playlist_id', $playlist_id);
            $this->db->where('track_id', $track_id);
            $this->db->delete('playlist_track');
    
            return true;
        } else {
            return false;
        }
    }  

    public function delete_user_and_playlists($user_id) {
        // Supprimer d'abord les playlists associées à l'utilisateur
        $this->db->where('user_id', $user_id);
        $this->db->delete('playlist');
    
        // Ensuite, supprimer l'utilisateur
        $this->db->where('id', $user_id);
        $this->db->delete('utilisateurs');
    }
    
    public function get_playlists_for_user($user_id) {
        if ($user_id === null) {
            // Si l'utilisateur n'est pas connecté, ne retourner que les playlists publiques
            $this->db->where('visibility', 'public');
        } else {
            // Si l'utilisateur est connecté, retourner les playlists publiques et celles de l'utilisateur
            $this->db->where('visibility', 'public');
            $this->db->or_where('user_id', $user_id);
        }
        $query = $this->db->get('playlist');
        return $query->result();
    }

    public function duplicate($playlist_id) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        // Récupérer les détails de la playlist à dupliquer
        $playlist_details = $this->Playlist_model->get_playlist_details($playlist_id);
    
        if ($playlist_details) {
            // Créer une nouvelle playlist avec les mêmes détails que la playlist d'origine
            $new_playlist_id = $this->Playlist_model->create_playlist($playlist_details->name, $this->session->userdata('user_id'), $playlist_details->visibility, $playlist_details->image);
    
            if ($new_playlist_id) {
                // Récupérer les pistes de la playlist d'origine
                $tracks = $this->Playlist_model->get_tracks_by_playlist($playlist_id);
    
                // Ajouter ces pistes à la nouvelle playlist
                if (!empty($tracks)) {
                    foreach ($tracks as $track) {
                        $this->Playlist_model->add_track_to_playlist($new_playlist_id, $track->id);
                    }
                }
    
                // Rediriger avec un message de succès
                $this->session->set_flashdata('message', 'Playlist dupliquée avec succès.');
            } else {
                // Rediriger avec un message d'erreur
                $this->session->set_flashdata('error', 'Erreur lors de la duplication de la playlist.');
            }
        } else {
            // Rediriger avec un message d'erreur si la playlist n'existe pas
            $this->session->set_flashdata('error', 'La playlist à dupliquer n\'existe pas.');
        }
    
        // Rediriger vers la page des playlists
        redirect('playlist');
    }
    
    
}
?>