<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller {    
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("admin/services_model","services");
    }
    
    /**
     * Updating Status of Service
     * */
    function update_status(){
        $service_id=$this->uri->segment(4);
        $status=$this->uri->segment(5);
        $this->services->update_service_status($service_id,$status);
        $this->session->set_flashdata("success_msg","Service status has been updated successfully.");
        redirect(site_url("admin/services"));
    }
    public function delete(){
        $service_id=intval($this->uri->segment(4));
        $this->services->delete_service($service_id);
        $this->session->set_flashdata("success_msg","Service has been deleted successfully.");
        redirect(site_url("admin/services"));
    }
    

	public function index()
	{   
		$this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');
		
		$this->form_validation->set_rules("form_serive_id","Service ID","required");
		$this->form_validation->set_rules("service_name","Service Name","required");
		if($this->form_validation->run() == FALSE)
        {
          $data['services']=$this->services->get_services();
          
          $sid=intval($this->input->get('sid',true));
          if($sid){
              /*Get service inforamtion*/
             $data['service_info']=$this->services->get_service_info($sid);              
          }          
          $this->load->view('admin/services',$data);
        }
        else
        {
            $form_serive_id=$this->input->post('form_serive_id',true);
            $service_name=$this->input->post('service_name',true);
            
            $this->services->update_service($form_serive_id,$service_name);
            $this->session->set_flashdata("success_msg","Service has been updated successfully.");
           
            redirect(site_url("admin/services"));
            

        }
	}


}
