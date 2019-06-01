<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_pricing_view extends MY_Controller {    
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("admin/services_pricing_view_model","service");
    }
    function delete(){
        $row_id=$this->uri->segment(4);
        $this->service->delete_service_package($row_id);
        $this->session->set_flashdata("success_msg","Record has been deleted successfully.");
        redirect(site_url("admin/services_pricing_view"));
    }
	public function index() 
	{   
		$this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');
		
		$this->form_validation->set_rules("service_id","Service Type","required");
		$this->form_validation->set_rules("service_name","Service Name","required");
		$this->form_validation->set_rules("price","Amount","required");
		if($this->form_validation->run() == FALSE)
        { 
          $data['services_pacakges']=$this->service->get_services_pacakges();   
          $this->load->view('admin/services_pricing_view',$data);
        }
        else
        {
            $form_serive_id=$this->input->post('form_serive_id',true);
            $array=array(
                'service_id'=>$this->input->post('service_id',true),
                'name'=>$this->input->post('service_name',true),
                'amount'=>$this->input->post('price',true)
            );
            $this->service->save_service_pricing($array);
            $this->session->set_flashdata("success_msg","Service Pricing has been added successfully.");           
            redirect(site_url("admin/services_pricing_view"));
            

        }
	}


}
