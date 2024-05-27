<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
        $this->db->select('album.id, album.name, album.year');
        $this->db->from('album');
        $this->db->where('artistId', $artist_id);
        $query = $this->db->get();
        return $query->result();
    }
}
?>
