<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Review extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();        
    }

    public function index(){        
        $this->load->view('userverify');        
    }

    public function verify(){
        $u_otp=$this->input->post('otp');
        $g_otp = $this->session->userdata('token');
        // compare otp       
        if(!strcmp($g_otp,$u_otp))
        { 
            //echo 'otp is correct';
            $data=array(              
                    'master_user_id'=>$this->session->userdata('master_user_id'),
                    'sub_user_name'=>$this->session->userdata('sub_user_name'),
                    'sub_user_mobile'=>$this->session->userdata('sub_user_mobile'),
                    'sub_user_email'=>$this->session->userdata('sub_user_email')
                    );
            $rs=$this->db->insert('sub_users',$data);
            //echo $rs;
                if($rs!=NULL){
                $this->session->set_flashdata('msg', 'user added by client successfully');
                return redirect('user/adduser'); 
                }
                else{
                $this->session->set_flashdata('msg', 'some technical problem, pls register again');                
                return redirect('user/adduser');
                }
        }
       else
        {        
          $this->session->set_flashdata('msg', 'entered otp is not correct, pls enter correct otp');                
          return redirect('review');         
        }
        
    } //verifyOtp
    
} //end_of_class 

