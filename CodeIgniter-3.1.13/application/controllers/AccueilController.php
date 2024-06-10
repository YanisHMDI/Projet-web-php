<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccueilController extends CI_Controller {

    public function index() {
        // Charger la bibliothèque de session
        $this->load->library('session');
    
        // Charger la vue principale
        $this->load->view('AccueilView');
    }
}
    
?>
