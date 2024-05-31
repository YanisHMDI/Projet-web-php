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

    public function get_playlist_details($playlist_id) {
        // Obtenez les informations de base de la playlist
        $this->db->select('playlist.*');
        $this->db->from('playlist');
        $this->db->where('playlist.id', $playlist_id);
        $playlist_query = $this->db->get();

        if ($playlist_query->num_rows() == 0) {
            return null; // Si la playlist n'existe pas
        }

        $playlist = $playlist_query->row();

        // Obtenez les pistes de la playlist
        $this->db->select('track.*, song.name as songName, album.name as albumName, artist.name as artistName');
        $this->db->from('track');
        $this->db->join('song', 'track.songId = song.id');
        $this->db->join('album', 'track.albumId = album.id');
        $this->db->join('artist', 'album.artistId = artist.id');
        $this->db->join('playlist_track', 'track.id = playlist_track.track_id');
        $this->db->where('playlist_track.playlist_id', $playlist_id);
        $tracks_query = $this->db->get();

        $playlist->tracks = $tracks_query->result();

        return $playlist;
    }
}
?>
