<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {

    function __construct()
    {
        parent::__construct();        
        $this->is_logged_in();
        $this->load->model("admin/dashboard_model");
    }
    public function index()
    {
       $this->load->view('admin/dashboard');
    } 

    

    
}
