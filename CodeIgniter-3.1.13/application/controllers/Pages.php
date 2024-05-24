<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function about()
    {
        $this->load->view('templates/header'); // Charger l'en-tête commun
        $this->load->view('pages/about'); // Charger la vue spécifique
        $this->load->view('templates/footer'); // Charger le pied de page commun
    }

    public function contact()
    {
        $this->load->view('templates/header');
        $this->load->view('pages/contact');
        $this->load->view('templates/footer');
    }
}
