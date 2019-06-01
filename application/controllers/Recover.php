<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recover extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $this->load->view('recover');
  }

  public function recoveryPassword(){
          $u_otp=$this->input->post('otp');
          $g_otp = $this->session->userdata('given_otp');
        //echo $u_otp." ".$g_otp ;die;

            if(!strcmp($g_otp, $u_otp))
            {
              //echo 'testing';die;
            redirect(site_url('auth/updatepassword'));
          }
          else{
              echo 'your otp is not correct';
          }

    }

    public function forgot(){
        $recover_input=$this->input->post('mobile');
        $this->db->where('mobile',$recover_input);
        $query=$this->db->get('users');
        $res=$query->result();
        if($res)
        {
            $name=$res[0]->name;
            $email=$res[0]->email;
            $real_input=$res[0]->mobile;
            $u_password=$res[0]->password;

            if(!strcmp($recover_input, $real_input))
            {
                $token = rand(1000,9999) ;
                $this->session->set_userdata('given_otp', $token);
                $this->session->set_userdata('given_mobile', $real_input);
                $text1='Dear '.$name.' your token is: '.$token;
                $text =str_replace(" ","%20",$text1);
                //use SmsModel
                $this->load->model('SmsModel');
                $sms_api_result=$this->SmsModel->sendSMS($real_input,$text);
                if($sms_api_result){
                            $this->session->set_flashdata('success_msg', 'Please check your mobile');
                            redirect(site_url('otp/index1'));
                        }
                        else
                        {
                            $this->session->set_flashdata('success_msg', 'technical problem, please try again');
                            redirect(site_url('recover'));
                        }

            }
            else{
                $this->session->set_flashdata('success_msg', 'technical problem, please try again');
                redirect(site_url('recover'));
            }
        }
        else
        {
            $this->session->set_flashdata('success_msg', 'entered mobile number is incorrect, please try again');
            redirect(site_url('recover'));
        }
    } // forgot

    public function password(){
      $rpassword=$this->input->post('rpass');
      $mobileN = $this->session->userdata('given_mobile');
        //echo $rpassword." ".$mobileN;die;
      $this->db->where("mobile",$mobileN);
      $this->db->update("users",array("password"=>sha1($rpassword))); //check
      $this->session->set_flashdata('success_msg', 'your password is updated successfully');
      redirect(site_url('auth'));
    }

}
