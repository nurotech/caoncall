<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Expert_Controller {

    function __construct()
    {
        parent::__construct();
        $this->login_logged_in();
        $this->load->model("expert/login_model","login");
    }

    function index()
    {

        $this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //if validation fails
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('expert/login');
        }
        else
        {
                //echo 'testing';die;
              //check login status
            $check_flag=$this->login->check_credentials($this->input->post('email',TRUE),sha1($this->input->post('password',TRUE)));
            
            if($check_flag===1){
                //redirect on success
                redirect(site_url('expert/dashboard'));
            }else{
                //show error msg on error wrong credentials
                $data['error_msg']=TRUE;
                $this->load->view('expert/login',$data);
            }
        }
    } //index

}
