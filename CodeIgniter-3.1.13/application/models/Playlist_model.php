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

    public function create_playlist($playlist_name, $user_id, $album_ids) {
        $data = array(
            'name' => $playlist_name,
            'user_id' => $user_id
        );
        $this->db->insert('playlist', $data);
        $playlist_id = $this->db->insert_id();
        foreach ($album_ids as $album_id) {
            $this->db->insert('playlist_album', array('playlist_id' => $playlist_id, 'album_id' => $album_id));
        }
    }
}
?>
