<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Controller {
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("admin/Appointment_model","appt");
        $this->load->model("admin/Expert_model","expert");
        
        $this->load->model("admin/Services_model","service");
    }             
    
    function delete_time(){
        $row_id=intval($this->input->post('row_id',true));
        $this->appt->delete_time_row($row_id);        
    }    

    /**
     * Delete expert appointment of the selected date
     * */
    function delete_appoints(){
        $expert_id=intval($this->uri->segment(4));
        $apnt_date=date('Y-m-d',strtotime($this->uri->segment(5)));
        
        $this->appt->delete_expert_dates($expert_id,$apnt_date);
        $this->session->set_flashdata("success_msg","Appointments have been deleted for the selected date.");
        redirect(site_url('admin/appointment/view'));
    }

     /**
     * Updating Status of Category User
     * */
    function update_status(){
        $cat_id=$this->uri->segment(4);
        $status=$this->uri->segment(5);
        $this->cat->update_category_status($cat_id,$status);
        $this->session->set_flashdata("success_msg","Category status has been updated successfully.");
        redirect(site_url("admin/category/view"));
    }

    function view(){
      // $this->input->get('cat_id',true);
      // $filter_cid=$this->input->get('filter_cid',true);
      $data['appt_list']=$this->appt->selectAppt();
      //$data['cat_list']=$this->cat->categoryList($filter_cid);
      $this->load->view("admin/view_appointment",$data);
    }

    function edit(){
    //$data['cat_id'] = $this->input->get('cat_id',true);

    //$this->load->view("admin/update_category", $data);
    }

    function delete(){
        $cat_id=$this->input->get('cat_id',true);
        $this->cat->deleteCategory($cat_id);
        $this->session->set_flashdata("success_msg","Category has been deleted successfully.");
        redirect(site_url("admin/category/view"));
    }
    
        // appointment of expert
    function index()
	{
        $this->form_validation->set_rules("expert_id","Expert","required");
        $this->form_validation->set_rules("service_id","Service","required");
        $this->form_validation->set_rules("date"," Date","required");
        $this->form_validation->set_rules("time[]","Time","required");

	   if($this->form_validation->run() == FALSE)
        {            
            $data['exp_list'] = $this->expert->get_experts();        
            $data['service_list'] = $this->appt->get_services_by_flag();       
            
            $expert_id=$this->input->get('expert_id',true);
            $date=$this->input->get('date',true);     
                    
            if($expert_id && $date){            
                $data['apnt_edit']=$this->appt->get_apnt_edit($expert_id,$date);        
                $data['apnt_time_edit_parsed']=$this->appt->get_apnt_time_edit_parsed($expert_id,$date);            
            }      
            $this->load->view('admin/appointment',$data);
        
        }     
        else
        {
            $expert_id=$this->input->post('expert_id');
            $service_id=$this->input->post('service_id');       
            $date=$this->input->post('date');
            $db_date=date('Y-m-d',strtotime($date));            
            $date=$this->input->post('date1');
            $db_date1=date('Y-m-d',strtotime($date));
            
                // get all days between 2 dates @deepak
            $listOfDates=array();
            $start = strtotime($db_date);
            $stop = strtotime($db_date1);
            for ($seconds=$start; $seconds<=$stop; $seconds+=86400)
            {               
                $date = date("Y-m-d", $seconds);                 
                $listOfDates[]=$date;
            }                   
                             
            $form_expert_id = $this->input->post('form_expert_id',true);
            $form_apnt_date=$_POST['form_apnt_date'];   
          
            forEach($listOfDates as $list){
                
                    // get service name by service_id
                $service_array = $this->appt->get_service_service_id($service_id);
                $serviceName = $service_array['0']['name'];
                
                    // get expert name by expert_id
                $expert_array = $this->expert->get_expert_info($expert_id);                
                $expertName = $expert_array['name'];                
                
                    // get service id by service name
                $service_id_for_service_name = $this->appt->get_service_id_by_service_name($serviceName);
                
                $time_array_cmp=array(
                    'expert_id'=>$expert_id,
                    'exp_name'=>$expertName,
                    'date'=>$list,
                    'service_id'=>$service_id,
                    'ser_name'=>$serviceName
                );           
                
                $data['appt_list']=$this->appt->ApptByExpertidDateService($expert_id, $list, $service_id_for_service_name);
                
                $get_array = array('expert_id'=>$data['appt_list']['0']['expert_id'],'exp_name'=>$expertName,
                    'service_id'=>$data['appt_list']['0']['service_id'],'ser_name'=>$serviceName,
                    'date'=>$data['appt_list']['0']['date'],
                );                
                
                $result=array_diff($get_array, $time_array_cmp);
                
                if(empty($result)){
                    $this->session->set_flashdata("success_msg","Error: One of the selected ".$list." ".$service_name." is already exists.");
                    redirect(site_url("admin/appointment"));
                }             
           
            if($form_expert_id && $form_apnt_date){                
                /*on update mode */
                $data = array(
                    'expert_id' => $expert_id,
                    'service_id' => $service_id,
                    'date' => $list                    
                );
                
                $this->appt->updateAppointment($data,$form_expert_id,$form_apnt_date);
            }else{
                /*on insert mode*/
            $data = array(
                 'expert_id' => $expert_id,
                 'service_id' => $service_id,
                 'date' => $list                 
               );
              
            $this->appt->saveAppointment($data);
            }
            
            // for insertion of time            
            $time=$_POST['time'];
            if(!empty($time)){
                foreach($time as $tk=>$tv){
                    $supplied_time=explode('-',$tv);
                    /*extract start time*/
                    $start_time=date('H:i:s',strtotime($supplied_time['0'].":00"));
                    $datetime_start=$list." ".$start_time;
                    $time_extracted_start=date('Y-m-d H:i:s',strtotime($datetime_start));
                    
                    /*extract end time*/
                    $end_time=date('H:i:s',strtotime($supplied_time['1'].":00"));
                    $datetime_end=$list." ".$end_time;
                    $time_extracted_end=date('Y-m-d H:i:s',strtotime($datetime_end));
                    
                    $time=array();
                    
                    $time_array=array(
                        'expert_id'=>$expert_id,
                        'date'=>$list,
                        'start_time'=>$time_extracted_start,
                        'end_time'=>$time_extracted_end,
                    );
                    
                    
                    $this->appt->save_datetime($time_array);
                }
            }
            
                /*Save expert appointment times*/             
            if($form_expert_id && $form_apnt_date){                 
                   $this->appt->delete_time_entries($form_expert_id,$form_apnt_date);
            }    
        
            
            } //end_of_foreach
            
            $this->session->set_flashdata("success_msg","Appointment has been saved successfully.");
            redirect(site_url("admin/appointment/view"));
        }
        
	} //index

}
