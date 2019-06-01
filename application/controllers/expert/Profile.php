<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Expert_Controller {

    function __construct(){
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("expert/profile_model","expert");
    }

    private function img_upload()
    {
        
        $config['upload_path'] = FCPATH.'assets/admin/expert/';
        // set the filter image types
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $config['max_size']	= '9000';


        $new_name = time().$_FILES["profile_pic"]['name'];
        $config['file_name'] = $new_name;

        //load the upload library
        $this->load->library('upload', $config);

        //$this->upload->initialize($config);

        $this->upload->set_allowed_types('*');

        $data['upload_data'] = '';

        //if not successful, set the error message
        if (!$this->upload->do_upload('profile_pic')) {
            return $data = array('msg' => $this->upload->display_errors());
        } else { //else, set the success message
            $data['msg']=TRUE;
            $data['upload_data'] = $this->upload->data();
            return $data;
        }
    }

    /*Render View Experts*/
    function view(){
        $data['experts_data']=$this->expert->get_experts();
        $this->load->view("expert/view_experts",$data);
    }

	public function index()
	{
	    $this->form_validation->set_rules("name","Name","required");
	    $this->form_validation->set_rules("mobile","Mobile","required");
	    //$this->form_validation->set_rules("password","Password","required");
	    $this->form_validation->set_rules("qualif","Qualification","required");
	    $this->form_validation->set_rules("exp","Experience","required");
	    $this->form_validation->set_rules("speciality","Speciality","required");
	    $this->form_validation->set_rules("short_profile","Short Profile","required");

	    $posted_id=$this->input->post('form_edit_id',true);
	    if($posted_id){
	        $this->form_validation->set_rules("email","Email","required");
	    }else{
	        $this->form_validation->set_rules("email","Email","required|is_unique[expert.email]");
	    }

	    if($this->form_validation->run()===false){

        $expert_info=$this->session->userdata('expert');
          $exp_id_get=$expert_info['id'];
          if($exp_id_get){
              $data['expert_details']=$this->expert->get_expert_details($exp_id_get);
            }
	        $this->load->view('expert/profile',$data);
	    }else{

          $form_edit_id=$this->input->post('form_edit_id',true);

            $vars=array(
                'name'=>$this->input->post("name",true),
                'email'=>$this->input->post("email",true),
                'mobile'=>$this->input->post("mobile",true),
                //'password'=>$this->input->post("password",true),
                'qualification'=>$this->input->post("qualif",true),
                'experience'=>$this->input->post("exp",true),
                'short_profile'=>$this->input->post("short_profile",true),
                'speciality'=>$this->input->post("speciality",true),
                'status'=>0
            );
            $password=trim($this->input->post('password',true));
            if($password){
                $vars['password']=sha1($password);
            }
            /*Updateing the expert details*/
            $this->expert->update_expert_details($form_edit_id,$vars);
            $insert_id=$form_edit_id;

        /*img upload section start*/
        $img_file="";
        if($_FILES["profile_pic"]['name'])
        {
            $get_upload=$this->img_upload();
            if($get_upload['msg']===TRUE)
            {
                $img_file=$get_upload['upload_data']['file_name'];
                $img_name=$get_upload['upload_data']['full_path'];

                /*Update Pic if supplied*/
                $this->expert->update_profile_pic($insert_id,$img_file);
            }
        }
        /*img upload section end*/
            $this->session->set_flashdata("success_msg","Expert details have been updated successfully.");
            redirect(site_url("expert/profile"));
	    }

	}
}
