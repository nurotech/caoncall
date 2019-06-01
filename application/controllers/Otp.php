<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Otp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->load->view('otp');
    }

    public function index1(){
        $this->load->view('otp1');
    }

    public function verifyOtp(){
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
                $this->session->set_flashdata('success_msg', 'you are registered successfully');
                redirect(site_url('auth'));
            }
            else{
                $this->session->set_flashdata('success_msg', 'some technical problem, pls register again');
                redirect(site_url('signup'));
            }
        }
       else
        {
          $this->session->set_flashdata('success_msg', 'entered otp is not correct, pls enter correct otp');
          redirect(site_url('otp'));
        }

    } //verifyOtp


    public function recoveryPassword(){
            $u_otp=$this->input->post('otp');
            $g_otp = $this->session->userdata('given_otp');
            //echo $u_otp." ".$g_otp ;die;

              if(!strcmp($g_otp, $u_otp))
              {
                            
              $this->load->view('update_password');
            }
            else{
                echo 'your otp is not correct';
            }
      }



} //end_of_class
