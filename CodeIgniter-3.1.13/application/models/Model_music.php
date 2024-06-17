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

// Modèle Model_music
public function get_album_details($album_id) {
    $this->db->select('album.id, album.name, album.artistId, album.year, artist.name as artistName, genre.id as genreId, genre.name as genreName, cover.jpeg');
    $this->db->from('album');
    $this->db->join('artist', 'album.artistId = artist.id');
    $this->db->join('genre', 'album.genreId = genre.id');
    $this->db->join('cover', 'album.coverId = cover.id');
    $this->db->where('album.id', $album_id);
    $album_query = $this->db->get();

    if ($album_query->num_rows() == 0) {
        return null;
    }

    $this->db->select('track.id, track.diskNumber, track.number, track.duration, song.name as songName');
    $this->db->from('track');
    $this->db->join('song', 'track.songId = song.id');
    $this->db->where('track.albumId', $album_id);
    $this->db->order_by('track.diskNumber, track.number');
    $tracks_query = $this->db->get();

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
    public function getAlbumsByGenre($genre_id = null) {
        $this->db->select('album.id, album.name, artist.name as artistName, year, genre.name as genreName, cover.jpeg');
        $this->db->from('album');
        $this->db->join('artist', 'album.artistId = artist.id');
        $this->db->join('genre', 'album.genreId = genre.id');
        $this->db->join('cover', 'album.coverId = cover.id');
        
        if ($genre_id !== null) {
            $this->db->where('genre.id', $genre_id);
        }
    
        $query = $this->db->get();
        return $query->result();
    }
    public function getSongsByArtist($artist_id) {
        $this->db->select('song.*');
        $this->db->from('track');
        $this->db->join('album', 'album.id = track.albumId');
        $this->db->join('song', 'song.id = track.songId');
        $this->db->where('album.artistId', $artist_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    


    
    
    
}


?>
