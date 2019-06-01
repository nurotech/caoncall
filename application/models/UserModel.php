<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function add($master_user_id,$sub_user_name,$sub_user_mobile,$sub_user_email){            
            
            $this->db->where(['sub_user_mobile'=>$sub_user_mobile]);             
            $qObj=$this->db->get('sub_users'); 
            $res=$qObj->result();
            //$=$res[0]->sub_user_mobile;
            if($res!=NULL){
                //echo 'mobile already exits';
                $this->session->set_flashdata('msg', 'Mobile no. already exists, pls try another number');
                return redirect('user/adduser');
            }
            else{
               $token=rand(1000, 9999);
               $this->session->set_userdata('token',$token);
               $text1="Use token to add user by client  ".$token;  
               $text =str_replace(" ","%20",$text1);
               $this->load->model('SmsModel'); 
               $sms_api_result=$this->SmsModel->sendSMS($sub_user_mobile,$text);
                   if($sms_api_result){
                    return redirect('review');                    
                    }
                    else
                    {                    
                    $this->session->set_flashdata('msg', 'some technical problem, please try again ');                
                    return redirect('user/adduser');                   
                    } 
               }              
            }          
         
          
        public function validateMobile($mobile){
              
             $this->db->where(['sub_user_mobile'=>$mobile]);
             $obj=$this->db->get('sub_users');
             return $obj;
        }
        
        public function save($name, $mobile){
          $data = array($name, $mobile);
          $this->db->insert('users', $data);
        }
          
}   	

?>