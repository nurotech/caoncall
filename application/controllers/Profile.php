<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_user_Controller {

   public function __construct()
    	{
          parent::__construct();
          $this->load->model('Profile_model','profile');
          $this->is_logged_in();
    	}

		public function index()
		{	    
            
			$expert_info = $this->session->userdata('user');			
			    $id=$expert_info['id'];
                $data['user_info']=$this->profile->get_expert_details($id);                
                $this->load->view('profile',$data);           

		} //index
		
		public function update(){			 
                $posted_id=$this->input->post('id',true);                
			    $user_array=array(
			    'name'=>$this->input->post("name",true),
                'email'=>$this->input->post("email",true),
                //'mobile'=>$this->input->post("mobile",true),
			        );
			 
			    $password=trim($this->input->post('password',true));
                if($password){
                $user_array['password']=sha1($password);
                    }  
                $this->profile->update_expert_details($posted_id, $user_array);
                $this->session->set_flashdata("success_msg","User details have been updated successfully.");
                redirect(site_url('profile'));
			}	
					
		}
			

