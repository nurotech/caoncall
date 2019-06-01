<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_user_Controller {

   public function __construct()
    	{
        	parent::__construct();
          $this->login_logged_in();
    	}

		public function index()
		{
			$this->form_validation->set_rules('mobile','Enter Mobile','required');
			$this->form_validation->set_rules('password','Enter Password','required');
			
			$this->form_validation->set_error_delimiters('<div class="error_input">', '</div>');
			if($this->form_validation->run()==FALSE){
          	$this->load->view('login');
			}
			else{
      //echo ''
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $this->load->model('AuthModel');
        $loginObj = $this->AuthModel->validatelogin($mobile, $password);

            if(!empty($loginObj)){
            //pre($loginObj);die;
              $get_row=$loginObj;
              $id=$get_row->id;
              $username=$get_row->mobile;
              //echo $id." ".$username;die;
              $newdata = array('user'=>array(
                  'id'  => $id,
                  'email'=> $username,
                  'role'=>'user',
                  'logged_in' => TRUE
              ));
              $this->session->set_userdata($newdata);
              redirect(site_url('dashboard'));
            }
            else
            {
            $this->session->set_flashdata('success_msg', 'Invalid details. Please try again');
              redirect(site_url('auth'));
            }
			 }

		} //end of index


}
