<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccueilController extends CI_Controller {

    public function index() {
        
        $this->load->library('session');
    
        
        $this->load->view('AccueilView');
    }
}
    
?>
