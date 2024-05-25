<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAlbums($argument1, $argument2) {
        // Utilise $argument1 et $argument2 dans ta requête SQL ou autre logique de traitement
        $query = $this->db->query("
            SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            ORDER BY year
        ");
        return $query->result();
    }

    public function get_album_details($album_id) {
        // Récupérer les détails de l'album
        $album_query = $this->db->query("
            SELECT album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg 
            FROM album 
            JOIN artist ON album.artistid = artist.id
            JOIN genre ON genre.id = album.genreid
            JOIN cover ON cover.id = album.coverid
            WHERE album.id = ?", array($album_id)
        );

        // Vérifier si l'album existe
        if ($album_query->num_rows() == 0) {
            return null; // Retourne null si l'album n'existe pas
        }

        // Récupérer les pistes de l'album
        $tracks_query = $this->db->query("
            SELECT track.name as trackName, track.duration
            FROM track
            JOIN album_track ON album_track.trackid = track.id
            WHERE album_track.albumid = ?", array($album_id)
        );

        // Créer un objet avec les détails de l'album et ses pistes
        $album_details = $album_query->row();
        $album_details->tracks = $tracks_query->result();

        return $album_details;
    }
}
?>
