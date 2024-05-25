<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getAlbums($argument1, $argument2){
	    // Utilise $argument1 et $argument2 dans ta requête SQL ou autre logique de traitement
	    $query = $this->db->query(
	        "SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
	        FROM album 
	        JOIN artist ON album.artistid = artist.id
	        JOIN genre ON genre.id = album.genreid
	        JOIN cover ON cover.id = album.coverid
	        ORDER BY year
	        "
	    );
	    return $query->result();
	}

	public function countAlbums(){
		$query = $this->db->query("SELECT COUNT(*) AS total_albums FROM album");
		$row = $query->row();
		return $row->total_albums;
	}
}
