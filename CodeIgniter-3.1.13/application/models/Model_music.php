<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_music extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function search_albums($query) {
        $this->db->select('album.id, album.name, artist.name as artistName, year, genre.name');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistId = artist.id');
        $this->db->join('genre', 'album.genreId = genre.id');
        $this->db->like('album.name', $query ,'after');
        $result = $this->db->get();
        return $result->result();
    }

    public function getGenres() {
        $query = $this->db->get('genre');
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

    public function search_songs($query) {
        $this->db->select('track.id, song.name as songName, album.name as albumName, artist.name as artistName');
        $this->db->from('track');
        $this->db->join('album', 'track.albumId = album.id');
        $this->db->join('artist', 'album.artistId = artist.id');
        $this->db->join('song', 'track.songId = song.id');
        $this->db->like('song.name', $query ,'after');
        $result = $this->db->get();
        return $result->result();
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

        // Récupérer les pistes de l'album avec les noms des chansons
        $tracks_query = $this->db->query("
            SELECT track.id, track.diskNumber, track.number, track.duration, song.name as songName
            FROM track
            JOIN song ON track.songId = song.id
            WHERE track.albumId = ?
            ORDER BY track.diskNumber, track.number", array($album_id)
        );

        // Créer un objet avec les détails de l'album et ses pistes
        $album_details = $album_query->row();
        $album_details->tracks = $tracks_query->result();

        return $album_details;
    }

    public function getTracks() {
        $this->db->select('track.id, song.name'); // Sélectionnez les colonnes nécessaires
        $this->db->from('track');
        $this->db->join('song', 'track.songId = song.id'); // Joignez la table des chansons pour obtenir les noms des chansons
        $query = $this->db->get();
        return $query->result();
    }

    public function getTracksNotInPlaylist($playlist_id) {
        // Sélectionnez les pistes qui ne sont pas déjà dans la playlist
        $this->db->select('track.id, song.name');
        $this->db->from('track');
        $this->db->join('song', 'track.songId = song.id');
        $this->db->where_not_in('track.id', "(SELECT track_id FROM playlist_track WHERE playlist_id = $playlist_id)", FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAlbums() {
        return $this->db->count_all('album');
    }
    
    public function getAlbumsPaginated($argument1, $argument2, $start_index, $per_page) {
        $this->db->select('album.name, album.id, year, artist.name as artistName, genre.name as genreName, jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistid = artist.id');
        $this->db->join('genre', 'genre.id = album.genreid');
        $this->db->join('cover', 'cover.id = album.coverid');
        $this->db->limit($per_page, $start_index); // Limiter les résultats pour la pagination
        $query = $this->db->get();
        return $query->result();
    }
    public function get_user_playlists($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');
        return $query->result();
    }

    public function get_tracks_by_genre($genre_id, $limit) {
        $this->db->where('genre_id', $genre_id);
        $this->db->limit($limit);
        $query = $this->db->get('tracks');
        return $query->result();
    }
    
    
    
    
}


?>
