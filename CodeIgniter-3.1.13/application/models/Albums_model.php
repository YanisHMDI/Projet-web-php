<?php
defined('BASEPATH') OR exit ('No direct script acces allowed');

class Album_model extends CI_Model {

    public function __construct()
{
parent::__construct();
$this->load->database();
}
public function get_all_albums()
    {

$query = $this->db->querry('SELECT * FROM album;');
return $query->result();
    }
}
?>