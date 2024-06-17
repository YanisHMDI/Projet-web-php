<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function search_artists($query) {
        $this->db->like('name', $query ,'after');
        $result = $this->db->get('artist');
        return $result->result();
    }
    
    public function get_all_artists() {
        $query = $this->db->get('artist');
        return $query->result();
    }

    public function get_artist_by_id($artist_id) {
        $query = $this->db->get_where('artist', array('id' => $artist_id));
        return $query->row();
    }

    public function get_albums_by_artist($artist_id) {
        $this->db->select('album.id, album.name, album.year, cover.jpeg');
        $this->db->from('album');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->where('album.artistId', $artist_id);
        $query = $this->db->get();
        return $query->result();
    }
    

    public function get_songs_by_artist($artist_id) {
        $this->db->select('song.id, song.name');
        $this->db->from('song');
        $this->db->join('track', 'song.id = track.songId');
        $this->db->join('album', 'track.albumId = album.id');
        $this->db->where('album.artistId', $artist_id);
        $query = $this->db->get();
        return $query->result();
    }
    
}
?>