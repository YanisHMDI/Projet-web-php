<?php
class Playlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_playlists_by_user($user_id) {
        if ($user_id === null) {
            $this->db->where('visibility', 'public');
        } else {
            $this->db->where('visibility', 'public');
            $this->db->or_where('user_id', $user_id);
        }
        $query = $this->db->get('playlist');
        return $query->result();
    }

    public function create_playlist($playlist_name, $user_id, $visibility, $image_path) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('utilisateurs');

        if ($query->num_rows() > 0) {
            $data = array(
                'name' => $playlist_name,
                'user_id' => $user_id,
                'visibility' => $visibility,
                'image' => $image_path
            );
            $this->db->insert('playlist', $data);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function add_track_to_playlist($playlist_id, $track_id) {
        $this->db->select('id');
        $this->db->from('track');
        $this->db->where('id', $track_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $track_info = $query->row();
            $data = array(
                'playlist_id' => $playlist_id,
                'track_id' => $track_info->id
            );
            $this->db->insert('playlist_track', $data);
        }
    }

    public function add_album_to_playlist($playlist_id, $album_id) {
        $this->db->select('id');
        $this->db->where('albumId', $album_id);
        $query = $this->db->get('track');
        $tracks = $query->result();

        foreach ($tracks as $track) {
            $data = array(
                'playlist_id' => $playlist_id,
                'track_id' => $track->id
            );
            $this->db->insert('playlist_track', $data);
        }
    }

    public function get_playlist_details($playlist_id) {
        $playlist_query = $this->db->get_where('playlist', array('id' => $playlist_id));

        if ($playlist_query->num_rows() == 0) {
            return null;
        }

        $playlist = $playlist_query->row();

        $this->db->select('track.*, song.name as songName, album.name as albumName, artist.name as artistName');
        $this->db->from('playlist_track');
        $this->db->join('track', 'playlist_track.track_id = track.id', 'left');
        $this->db->join('song', 'track.songId = song.id', 'left');
        $this->db->join('album', 'track.albumId = album.id', 'left');
        $this->db->join('artist', 'album.artistId = artist.id', 'left');
        $this->db->where('playlist_track.playlist_id', $playlist_id);
        $tracks_query = $this->db->get();

        $playlist->tracks = $tracks_query->result();

        return $playlist;
    }

    public function delete_playlist($playlist_id, $user_id) {
        $this->db->where('id', $playlist_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');

        if ($query->num_rows() > 0) {
            $this->db->where('playlist_id', $playlist_id);
            $this->db->delete('playlist_track');

            $this->db->where('id', $playlist_id);
            $this->db->delete('playlist');

            return true;
        } else {
            return false;
        }
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

    public function get_tracks_by_playlist($playlist_id) {
        $this->db->select('track.id');
        $this->db->from('playlist_track');
        $this->db->join('track', 'playlist_track.track_id = track.id');
        $this->db->where('playlist_track.playlist_id', $playlist_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_random_tracks($genre_id, $num_tracks) {
        $this->db->select('track.id');
        $this->db->from('track');
        $this->db->join('album', 'track.albumId = album.id');
        $this->db->join('genre', 'album.genreId = genre.id');
        $this->db->where('genre.id', $genre_id);
        $this->db->order_by('rand()');
        $this->db->limit($num_tracks);
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>
