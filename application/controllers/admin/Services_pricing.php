<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_pricing extends MY_Controller {    
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("admin/services_pricing_model","service");
    }
	public function index() 
	{   
		$this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');
		
		$this->form_validation->set_rules("service_id","Service Type","required");
		$this->form_validation->set_rules("service_name","Package Name","required");
		$this->form_validation->set_rules("price","Amount","required");
		if($this->form_validation->run() == FALSE)
        { 
          $data['services']=$this->service->get_services();
          
          $row_id=$this->input->get('row_id',true);
          $data['edit_info']=$this->service->get_service_info($row_id);
          $this->load->view('admin/services_pricing',$data);
        }
        else
        {
            $form_row_id=$this->input->post('form_row_id',true);
            if($form_row_id){
                $array=array(
                    'service_id'=>$this->input->post('service_id',true),
                    'name'=>$this->input->post('service_name',true),
                    'amount'=>$this->input->post('price',true),
                    'des1'=>$this->input->post('des1',true),
                    'des2'=>$this->input->post('des2',true)
                );
                $this->service->update_service_pricing($array,$form_row_id);
                $this->session->set_flashdata("success_msg","Service Pricing has been updated successfully.");
            }else{
                $array=array(
                    'service_id'=>$this->input->post('service_id',true),
                    'name'=>$this->input->post('service_name',true),
                    'amount'=>$this->input->post('price',true),
                    'des1'=>$this->input->post('des1',true),
                    'des2'=>$this->input->post('des2',true)
                );
                $this->service->save_service_pricing($array);
                $this->session->set_flashdata("success_msg","Service Pricing has been added successfully.");
            }                       
            redirect(site_url("admin/services_pricing_view"));
        }
	}


}
