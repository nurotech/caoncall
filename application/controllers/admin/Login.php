<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        /* checks if admin is already logged in*/
        $this->login_logged_in();
        $this->load->model("admin/login_model","login");
    }
    public function index()
    {

        $this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //if validation fails
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/login');
        }
        else
        {
            //check login status
            $check_flag=$this->login->check_credentials($this->input->post('email',TRUE),$this->input->post('password',TRUE));

            if($check_flag===1){
                //redirect on success
                redirect(site_url('admin/dashboard'));
            }else{
                //show error msg on error wrong credentials
                $data['error_msg']=TRUE;
                $this->load->view('admin/login',$data);
            }
        }
    }




}
