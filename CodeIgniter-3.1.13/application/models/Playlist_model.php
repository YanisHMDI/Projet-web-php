<?php
class Playlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_playlists_by_user($user_id) {
        if ($user_id === null) {
            // Si l'utilisateur n'est pas connecté, ne retourner que les playlists publiques
            $this->db->where('visibility', 'public');
        } else {
            // Si l'utilisateur est connecté, retourner les playlists publiques et celles de l'utilisateur
            $this->db->where('visibility', 'public');
            $this->db->or_where('user_id', $user_id);
        }
        $query = $this->db->get('playlist');
        return $query->result();
    }

    public function create_playlist($playlist_name, $user_id, $visibility, $image_path) {
        // Vérifie si le user_id existe dans la table utilisateurs
        $this->db->where('id', $user_id);
        $query = $this->db->get('utilisateurs');

        if ($query->num_rows() > 0) {
            // L'utilisateur existe, procéder à l'insertion de la playlist
            $data = array(
                'name' => $playlist_name,
                'user_id' => $user_id,
                'visibility' => $visibility,
                'image' => $image_path
            );
            $this->db->insert('playlist', $data);
            $playlist_id = $this->db->insert_id();
            return $playlist_id;
        } else {
            // L'utilisateur n'existe pas, retourner une erreur ou gérer en conséquence
            return false; // ou vous pouvez lancer une exception ou gérer comme nécessaire
        }
    }

    public function add_track_to_playlist($playlist_id, $track_id) {
        // Récupérer l'ID de la piste à partir de la table track
        $this->db->select('id');
        $this->db->from('track');
        $this->db->where('id', $track_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Si la piste existe, insérer son ID dans la table playlist_track
            $track_info = $query->row();
            $data = array(
                'playlist_id' => $playlist_id,
                'track_id' => $track_info->id
            );
            $this->db->insert('playlist_track', $data);
        } else {
            // Gérer le cas où la piste n'existe pas
            // Vous pouvez générer une erreur ou prendre d'autres mesures selon vos besoins
        }
    }

    public function add_album_to_playlist($playlist_id, $album_id) {
        // Récupérer tous les morceaux de l'album
        $this->db->select('id');
        $this->db->where('albumId', $album_id);
        $query = $this->db->get('track');
        $tracks = $query->result();

        // Insérer chaque piste de l'album dans la table playlist_track
        foreach ($tracks as $track) {
            $data = array(
                'playlist_id' => $playlist_id,
                'track_id' => $track->id
            );
            $this->db->insert('playlist_track', $data);
        }
    }

    public function get_playlist_details($playlist_id) {
        // Obtenez les informations de base de la playlist
        $playlist_query = $this->db->get_where('playlist', array('id' => $playlist_id));

        if ($playlist_query->num_rows() == 0) {
            return null; // Si la playlist n'existe pas
        }

        $playlist = $playlist_query->row();

        // Obtenez les pistes de la playlist
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
        // Vérifier si la playlist appartient à l'utilisateur
        $this->db->where('id', $playlist_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');

        if ($query->num_rows() > 0) {
            // Supprimer les entrées de la table playlist_track
            $this->db->where('playlist_id', $playlist_id);
            $this->db->delete('playlist_track');

            // Supprimer la playlist
            $this->db->where('id', $playlist_id);
            $this->db->delete('playlist');

            return true;
        } else {
            return false;
        }
    }
<<<<<<< HEAD
    public function delete_track_from_playlist($playlist_id, $track_id, $user_id) {
        // Vérifier si la playlist appartient à l'utilisateur
        $this->db->where('id', $playlist_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('playlist');
    
        if ($query->num_rows() > 0) {
            // Supprimer l'entrée de la table playlist_track
            $this->db->where('playlist_id', $playlist_id);
            $this->db->where('track_id', $track_id);
            $this->db->delete('playlist_track');
    
            return true;
        } else {
            return false;
        }
    }
    
=======

    public function delete_track_from_playlist($playlist_id, $track_id, $user_id) {
        // Assurez-vous que l'utilisateur est le propriétaire de la playlist et que la piste appartient à cette playlist
        $this->db->where('playlist_id', $playlist_id);
        $this->db->where('track_id', $track_id);
        $this->db->where('user_id', $user_id); // Vérifie que l'utilisateur est le propriétaire de la playlist et que la piste appartient à cette playlist
        
        return $this->db->delete('playlist_track'); // 'playlist_track' est le nom de la table où les relations playlist-track sont stockées
    }
    

    public function delete_user_and_playlists($user_id) {
        // Supprimer d'abord les playlists associées à l'utilisateur
        $this->db->where('user_id', $user_id);
        $this->db->delete('playlist');

        // Ensuite, supprimez l'utilisateur
        $this->db->where('id', $user_id);
        $this->db->delete('utilisateurs');
    }
>>>>>>> 0c6dece16a8d7fe724453833ca705e9ae92bd1e7
}
?>
