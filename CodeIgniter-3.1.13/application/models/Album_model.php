<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_albums()
    {
        $query = $this->db->query('SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            ORDER BY year');
        return $query->result();
    }

    public function get_album_details($album_id)
    {
        $query = $this->db->query("SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.id = $album_id");
        return $query->row(); // Utilise row() pour obtenir une seule ligne de résultat
    }

    public function countAlbums(){
        $query = $this->db->query("SELECT COUNT(*) AS total_albums FROM album");
        $row = $query->row();
        return $row->total_albums;
    }

    public function getAlbums($limit, $start_index){
        $query = $this->db->query(
            "SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            ORDER BY year
            LIMIT $start_index, $limit"
        );
        return $query->result();
    }

    // Utilisation cohérente du nommage pour la méthode getAlbumDetails
    public function getAlbumDetails($album_id) {
        $this->db->where('id', $album_id);
        return $this->db->get('album')->row(); // Supposons que votre table s'appelle 'albums'
    }

}
?>
