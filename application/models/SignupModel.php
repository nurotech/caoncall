<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignupModel extends CI_Model{

    public function add($name,$email,$mobile,$password){
    
                  $token=rand(1000, 9999);
                  $this->session->set_userdata('token',$token);

                  $this->session->set_userdata('name',$name);
                  $this->session->set_userdata('email',$email);
                  $this->session->set_userdata('mobile',$mobile);
                  $this->session->set_userdata('password',$password);
                  $number =$mobile;
                  $text1=" To complete your registration use OTP: $token ";
                  $text =str_replace(" ","%20",$text1);
                  $this->load->model('SmsModel');
                  
                  $sms_api_result=$this->SmsModel->sendSMS($number,$text);
                  
                        if($sms_api_result){
                            //redirect(site_url('signup'));
							redirect(site_url('signup?model=true'));
                        }
                        else
                        {
                            $this->session->set_flashdata('msg', 'some technical problem, please register again ');
                          redirect(site_url('signup'));

                        }
              

        } //end_of_add

}
