<?php
defined('BASEPATH') OR exit('direct access not allowed');
class User extends CI_Controller{
    
    public function index(){
        echo 'at user index page';
    }
    
    public function adduser(){
        //echo 'adduser';
        $lastId=$this->session->userdata('lastInsertedId');
        $this->form_validation->set_rules('name','Enter Mobile','required');
		$this->form_validation->set_rules('mobile','Enter Password','required');
		
		    if($this->form_validation->run()){
		            $master_user_id=$lastId;
		            $sub_user_name=$this->input->post('name');
		            $sub_user_mobile=$this->input->post('mobile');
		            $sub_user_email=$this->input->post('email');
		            
		            $this->session->set_userdata('master_user_id',$master_user_id);
		            $this->session->set_userdata('sub_user_name',$sub_user_name);
		            $this->session->set_userdata('sub_user_mobile',$sub_user_mobile);
                    $this->session->set_userdata('sub_user_email',$sub_user_email);                 
                       
                    $this->load->model('UserModel'); 
                    $rs=$this->UserModel->add($master_user_id,$sub_user_name,$sub_user_mobile,$sub_user_email);
                    //echo $rs;                   
                   /*$this->UserModel->checkMobile($sub_user_mobile);
                    $rNumber=$this->UserModel->checkMobile($sub_user_mobile);
                       if($rNumber){
                            //echo 'number already exits';
                            $this->session->set_flashdata('msg', 'Dear customer your number is already registered !');
                            return redirect('user/add');
                        } 
                        else
                        {
                            //echo 'add number';
                            return redirect('auth');
                        }*/
                    //$this->load->model('UserModel');
                    //$this->UserModel->add($master_user_id,$sub_user_name,$sub_user_mobile,$sub_user_email);
			      } //if of run()
                  else{
                    $this->load->view('user'); 
                  }
        } //add  

    }

?>