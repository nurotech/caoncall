<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SignupModel');
    }

    public function get_otp(){
        $u_otp=$this->input->post('otp');
        $g_otp = $this->session->userdata('token');
        // compare otp
        if(!strcmp($g_otp,$u_otp))
        {
            $data=array(
                    'name'=>$this->session->userdata('name'),
                    'email'=>$this->session->userdata('email'),
                    'mobile'=>$this->session->userdata('mobile'),
                    'password'=>$this->session->userdata('password')
                );

            $rs=$this->db->insert('users',$data);
            if($rs==1){

                echo json_encode(array('Success' => 'TRUE', 'Message' => 'Form Registered Successfully'));

                 $this->session->set_flashdata('success_msg', 'you are registered successfully');
                 
                // redirect(site_url('auth'));
                
                
            }
            
            else
            {
                    echo json_encode(array('Success' => 'FALSE', 'Message' => 'some technical problem, pls register again'));
                
                // $this->session->set_flashdata('success_msg', 'some technical problem, pls register again');
                // redirect(site_url('signup'));
            }
        }
       else
        {
          $this->session->set_flashdata('success_msg', 'entered otp is not correct, pls enter correct otp');
          redirect(site_url('otp'));
        }

    } //verifyOtp
    public function index(){

        $this->form_validation->set_rules('name','enter name','required');
        $this->form_validation->set_rules('email','enter email','required');
         $this->form_validation->set_rules('mobile','enter mobile no.','required|is_unique[users.mobile]');
        $this->form_validation->set_rules('password','enter password','required');
        
        $this->form_validation->set_error_delimiters('<div class="error_input">', '</div>');

        if($this->form_validation->run() == FALSE){

            $this->load->view('signup');

        } else {
          $name=$this->input->post('name');
          $email=$this->input->post('email');
          $mobile=$this->input->post('mobile');
          $password=sha1($this->input->post('password'));

          //$status=1;
          $this->load->model('SignupModel');
          $this->SignupModel->add($name,$email,$mobile,$password);       

       }
    }

}
