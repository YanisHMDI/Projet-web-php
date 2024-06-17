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
            $data['genres'] = $this->Model_music->getGenres();
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
            $this->load->model('Artist_model');
            $data['artists'] = $this->Artist_model->get_all_artists();
            $this->load->view('add_tracks_to_playlist', $data);
        }
    }

    public function add_track_to_playlist() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        $track_id = $this->input->post('track_id');
        $playlist_id = $this->input->post('playlist_id');
    
        if (!isset($playlist_id) || empty($playlist_id)) {
            show_error('Playlist ID is missing or empty.');
        }
    
        $this->Playlist_model->add_track_to_playlist($playlist_id, $track_id);
        redirect('playlist/view/' . $playlist_id);
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

    public function change_visibility($playlist_id, $new_visibility) {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        }
    
        $user_id = $this->session->userdata('user_id');
        $success = $this->Playlist_model->change_visibility($playlist_id, $new_visibility, $user_id);
    
        if ($success) {
            $this->session->set_flashdata('message', 'Visibilité de la playlist modifiée avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Impossible de changer la visibilité de la playlist.');
        }
    
        redirect('playlist/view/' . $playlist_id);
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
        $this->db->where('id', $playlist_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');
    
        if ($query->num_rows() > 0) {
            $this->db->where('playlist_id', $playlist_id);
            $this->db->where('track_id', $track_id);
            $this->db->delete('playlist_track');
    
            return true;
        } else {
            return false;
        }
    }

    public function delete_user_and_playlists($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('playlist');
    
        $this->db->where('id', $user_id);
        $this->db->delete('utilisateurs');
    }

    public function get_playlists_for_user($user_id) {
        if ($user_id === null) {
            $this->db->where('visibility', 'public');
        } else {
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
    
        $playlist_details = $this->Playlist_model->get_playlist_details($playlist_id);
    
        if ($playlist_details) {
            $new_playlist_id = $this->Playlist_model->create_playlist($playlist_details->name, $this->session->userdata('user_id'), $playlist_details->visibility, $playlist_details->image);
    
            if ($new_playlist_id) {
                $tracks = $this->Playlist_model->get_tracks_by_playlist($playlist_id);
    
                if (!empty($tracks)) {
                    foreach ($tracks as $track) {
                        $this->Playlist_model->add_track_to_playlist($new_playlist_id, $track->id);
                    }
                }
    
                $this->session->set_flashdata('message', 'Playlist dupliquée avec succès.');
            } else {
                $this->session->set_flashdata('error', 'Erreur lors de la duplication de la playlist.');
            }
        } else {
            $this->session->set_flashdata('error', 'La playlist à dupliquer n\'existe pas.');
        }
    
        redirect('playlist');
    }
    
    public function generate_random() {
        if (!$this->session->userdata('username')) {
            redirect('user/login');
        } else {
            $genre_id = $this->input->post('genre');
            $num_tracks = $this->input->post('num_tracks');
            $user_id = $this->session->userdata('user_id');
            
            $tracks = $this->Model_music->get_random_tracks($genre_id, $num_tracks);
            
            if (!empty($tracks)) {
                $playlist_name = 'Playlist Aléatoire - ' . date('Y-m-d H:i:s');
                $visibility = 'private';
                $image_path = 'denis.jpg'; // Utilisez une image par défaut ou laissez l'utilisateur télécharger une image.
                
                $playlist_id = $this->Playlist_model->create_playlist($playlist_name, $user_id, $visibility, $image_path);
                
                foreach ($tracks as $track) {
                    $this->Playlist_model->add_track_to_playlist($playlist_id, $track->id);
                }
                
                $this->session->set_flashdata('message', 'Playlist aléatoire générée avec succès.');
            } else {
                $this->session->set_flashdata('error', 'Aucune musique trouvée pour les critères sélectionnés.');
            }
            
            redirect('playlist');
        }
    }
    // Contrôleur Playlist
public function add_all_tracks_to_playlist() {
    if (!$this->session->userdata('username')) {
        redirect('user/login');
    }
    
    // Récupère les données du formulaire
    $artist_id = $this->input->post('artist_id');
    $playlist_id = $this->input->post('playlist_id');
    
    // Récupère tous les titres de l'artiste
    $songs = $this->Model_music->getSongsByArtist($artist_id);
    
    // Vérifie si des titres ont été trouvés
    if (!empty($songs)) {
        foreach ($songs as $song) {
            // Ajoute chaque titre à la playlist
            $this->Playlist_model->add_track_to_playlist($playlist_id, $song->id);
        }
    }
    
    // Redirige vers la page de la playlist après l'ajout
    redirect('playlist/view/' . $playlist_id);
}

public function edit_name() {
    if (!$this->session->userdata('username')) {
        redirect('user/login');
    } else {
        $playlist_id = $this->input->post('playlist_id');
        $new_name = $this->input->post('new_playlist_name');

        if ($this->Playlist_model->update_playlist_name($playlist_id, $new_name)) {
            $this->session->set_flashdata('message', 'Nom de la playlist modifié avec succès.');
        } else {
            $this->session->set_flashdata('error', 'Impossible de modifier le nom de la playlist.');
        }
        redirect('playlist/view/' . $playlist_id);
    }
}
    
}
?>
