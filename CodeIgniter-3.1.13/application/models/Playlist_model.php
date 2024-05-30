<?php
class Playlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_playlists_by_user($user_id) {
        $query = $this->db->get_where('playlist', array('user_id' => $user_id));
        return $query->result();
    }

    public function create_playlist($playlist_name, $user_id, $visibility, $image_path) {
        $data = array(
            'name' => $playlist_name,
            'user_id' => $user_id,
            'visibility' => $visibility,
            'image' => $image_path
        );
        $this->db->insert('playlist', $data);
        $playlist_id = $this->db->insert_id();
        return $playlist_id;
    }

    public function add_album_to_playlist($playlist_id, $album_id) {
        $data = array(
            'playlist_id' => $playlist_id,
            'album_id' => $album_id
        );
        $this->db->insert('playlist_album', $data);
    }

    public function add_track_to_playlist($playlist_id, $track_id) {
        $data = array(
            'playlist_id' => $playlist_id,
            'track_id' => $track_id
        );
        $this->db->insert('playlist_track', $data);
    }
}

?>