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
            redirect('playlist');
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
    
}
?>