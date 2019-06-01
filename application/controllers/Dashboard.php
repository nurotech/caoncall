<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_user_Controller{
    function __construct(){
        parent::__construct(); 
        $this->is_logged_in();
    }
    public function index(){    
        $this->load->view('dashboard');
        
    }

}