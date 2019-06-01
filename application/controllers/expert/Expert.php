<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expert extends MY_Expert_Controller {

    function __construct(){
        parent::__construct();        
        $this->is_logged_in();
        $this->load->model("expert/expert_model","expert");
    }

    function delete_assigned_cat(){
        $row_id=intval($this->uri->segment(4));
        $this->expert->delete_assigned_row($row_id);
        $this->session->set_flashdata("success_msg","Record has been deleted successfully.");
        redirect(site_url("admin/expert/view_assigned_cats"));
    }
    /**
     * Saving assigned category to expert via ajax method POST
     * */
    function save_exp_cat(){


        $this->form_validation->set_rules("exp_id","Expert","required");
        $this->form_validation->set_rules("main_cid","Main Category","required");
        //$this->form_validation->set_rules("sub_cid","Sub Category","required");
        if($this->form_validation->run()===false){
            /*Throw error when validation error crept in*/
            if(validation_errors()){
                echo "<div class='alert alert-danger'  style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
						".validation_errors()."</div>";
            }
        }else{

            /*Check if sub categories are checked or exist !*/
            $sub_cats=$_POST['sub_cats'];
            /* if(empty($sub_cats)){
                echo "<div class='alert alert-danger'  style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
						Error - Sub categories are required!</div>";exit();
            } */

            $main_cid=$this->input->post('main_cid',true);
            $form_rw_id=$this->input->post('form_rw_id',true);
            $expert_id=$this->input->post('exp_id',true);

            /*clear out old and save afresh on every request in table*/
            $this->expert->clear_out_expert_cat_relation($expert_id,$main_cid);
            if(!empty($sub_cats)){
                foreach($sub_cats as $sk=>$sv){
                    $db_data=array(
                        'expert_id'=>$expert_id,
                        'sub_cat_id'=>$sk,
                        'main_cat_id'=>$main_cid
                    );
                   $this->expert->save_expert_categories($db_data);
                }
            }

            $this->session->set_flashdata("success_msg","Record updated successfully.");
            echo "success";
        }

    }

    /**
     * Get subcategories of supplied main cat id via ajax post
     * @param int $main_cid
     * @deprecated
     * */
    function get_subcats(){
        $main_cid=$this->input->post("main_cid",true);
        $selected_cat=$this->input->post("selected_cat",true);

        $rows=$this->expert->get_subcats($main_cid);
        echo "<option value=''>--Select--</option>";
        if(!empty($rows)){
            foreach($rows as $rk=>$rv){
                if($selected_cat==$rv['cat_id']){
                    echo "<option selected value='".$rv['cat_id']."'>".$rv['cat_name']."</option>";
                }else{
                    echo "<option value='".$rv['cat_id']."'>".$rv['cat_name']."</option>";
                }
            }
        }
    }
    /**
     * Get sub categories of main category in checkbox format
     * @param int $main_id
     * */
    function get_subcats2(){
        $main_cid=$this->input->post("main_cid",true);
        $expert_id=$this->input->post("expert_id",true);
        $selected_cat=$this->input->post("selected_cat",true);

        /*get all sub categories of passed main category id*/
        $rows=$this->expert->get_subcats($main_cid);

        if(!empty($rows)){
            $check_i=1;
            foreach($rows as $rk=>$rv){

                /*Check if expert and main cat id has records then show them checked*/

               $check_flag=$this->expert->check_subcat_id_record($rv['cat_id'],$main_cid,$expert_id);
               $checked_str="";
               if($check_flag){
                   $checked_str="checked";
               }

               echo '
               <label class="col-md-2 checkbox-inline" for="checkboxes-'.$check_i.'">
               <input '.$checked_str.' type="checkbox" name="sub_cats['.$rv['cat_id'].']" id="checkboxes-'.$check_i.'" value="1">
               '.$rv['cat_name'].'
               </label>
                ';

               unset($checked_str);

               $check_i++;
            }
        }
    }

    /*Render assigned categories to view*/
    function view_assigned_cats(){
        $data['assigned_exp_cats']=$this->expert->assigned_exp_cats();
        $this->load->view("admin/view_assigned_cats",$data);
    }
    /**
     * Assign category to Expert Page
     * */
    function assign_cats(){
        $data['experts_data']=$this->expert->get_experts();
        $data['main_cats']=$this->expert->selectMaincategory();

        /*Get row records if edit is triggerred*/
        $exp_id=intval($this->input->get('exp_id',true));
        if($exp_id){
            $data['expert_info']=$this->expert->get_expert_info($exp_id);
        }
        //$data['edit_info']=$this->expert->get_assigned_row($exp_id);

        $this->load->view("admin/expert_assign_cat",$data);
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
    /**
     * Deleting expert
     * */
    function delete(){
        $expert_id=$this->uri->segment(4);
        if(intval($expert_id)){
            $this->expert->delete_expert($expert_id);
            $this->session->set_flashdata("success_msg","Expert has been deleted successfully.");
        }
        redirect(site_url("admin/expert/view"));
    }
    /**
     * Updating Status of Expert User
     * */
    function update_status(){
        $expert_id=$this->uri->segment(4);
        $status=$this->uri->segment(5);
        $this->expert->update_expert_status($expert_id,$status);
        $this->session->set_flashdata("success_msg","Expert status has been updated successfully.");
        redirect(site_url("admin/expert/view"));
    }
    /*Render View Experts*/
    function view(){
        $data['experts_data']=$this->expert->get_experts();
        $this->load->view("admin/view_experts",$data);
    }
	public function index()
	{
	    $this->form_validation->set_rules("name","Name","required");
	    $this->form_validation->set_rules("mobile","Mobile","required");
	    $this->form_validation->set_rules("password","Password","required");
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
            $exp_id_get=intval($this->input->get('expert_id',true));
            if($exp_id_get){
                $data['expert_details']=$this->expert->get_expert_details($exp_id_get);
            }
	        $this->load->view('ex/expert',$data);
	    }else{

        $form_edit_id=$this->input->post('form_edit_id',true);
        if($form_edit_id){
            $vars=array(
                'name'=>$this->input->post("name",true),
                'email'=>$this->input->post("email",true),
                'mobile'=>$this->input->post("mobile",true),
                'password'=>$this->input->post("password",true),
                'qualification'=>$this->input->post("qualif",true),
                'experience'=>$this->input->post("exp",true),
                'short_profile'=>$this->input->post("short_profile",true),
                'speciality'=>$this->input->post("speciality",true),
                'status'=>0
            );
            /*Updateing the expert details*/
            $insert_id=$this->expert->update_expert_details($form_edit_id,$vars);
        }else{
            $vars=array(
                'name'=>$this->input->post("name",true),
                'email'=>$this->input->post("email",true),
                'mobile'=>$this->input->post("mobile",true),
                'password'=>$this->input->post("password",true),
                'qualification'=>$this->input->post("qualif",true),
                'experience'=>$this->input->post("exp",true),
                'short_profile'=>$this->input->post("short_profile",true),
                'speciality'=>$this->input->post("speciality",true),
                'status'=>0
            );
            /*Inserting of expert details*/
            $insert_id=$this->expert->save_expert_details($vars);
        }

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
        if($form_edit_id){
            $this->session->set_flashdata("success_msg","Expert details have been updated successfully.");
            redirect(site_url("expert/expert/view"));
        }else{
            $this->session->set_flashdata("success_msg","Expert details have been added successfully.");
            redirect(site_url("expert/expert"));
        }

	    }

	}
}
