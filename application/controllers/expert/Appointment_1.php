<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Expert_Controller {
    
    public function __construct()
    {   
        parent::__construct();      
        $this->is_logged_in();
        $this->load->model("expert/Appointment_model", "appt");        
    }
    
    /**
     * expert appointment
     * 
     */    
    function index(){
        
        $this->form_validation->set_rules("name","Expert Name","required");
        $this->form_validation->set_rules("service_id","Service","required");
        $this->form_validation->set_rules("date"," Date","required");
        $this->form_validation->set_rules("time[]","Time","required");
        
            if($this->form_validation->run() == FALSE){
                $data['exp_list'] = $this->appt->select_expert_appt();
                $data['service_list'] = $this->appt->get_services_by_flag();                
                $this->load->view('expert/appointment',$data);            
            }
            else{ 
                //echo 'appoint';die;
                $expert_name = $this->input->post('name');                
                $service_id=$this->input->post('service_id');
                echo  $service_id;die;
                $date=$this->input->post('date');
                //$db_date=date('Y-m-d',strtotime($date));                
                $data = array(
                    'expert_id' => $expert_id,
                    'service_id' => $service_id                  
                );
                
                //$this->appt->saveExpertAppointment($data);                
            }       
        
    } //end_of_index
    
    
    function view(){        
        $data['appt_list']=$this->appt->selectAppt();        
        $this->load->view("expert/view_appointment",$data);        
    }
    
    
    
    
    public function delete_time(){
        $row_id=intval($this->input->post('row_id',true));
        $this->appt->delete_time_row($row_id);
        echo "done";
    }

    /**
     * Delete expert appointment of the selected date
     * */
    function delete_appoints(){
        $expert_id=intval($this->uri->segment(4));
        $apnt_date=date('Y-m-d',strtotime($this->uri->segment(5)));
        
        $this->appt->delete_expert_dates($expert_id,$apnt_date);
        $this->session->set_flashdata("success_msg","Appointments have been deleted for the selected date.");
        redirect(site_url('expert/appointment/view'));
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
    
     public function edit(){

    //$data['cat_id'] = $this->input->get('cat_id',true);

    //$this->load->view("admin/update_category", $data);
    }

    public function delete(){
        $cat_id=$this->input->get('cat_id',true);
        $this->cat->deleteCategory($cat_id);
        $this->session->set_flashdata("success_msg","Category has been deleted successfully.");
        redirect(site_url("admin/category/view"));
    }

        //add category
	public function index_x()
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
            
            /*Get selected date's time*/
            //$data['apnt_time_edit']=$this->appt->get_apnt_time_edit($expert_id,$date);
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
            
                             
            $form_expert_id=$this->input->post('form_expert_id',true);
            $form_apnt_date=$_POST['form_apnt_date'];
            
            
            //$time=$this->input->post('time');
            
            
            /*Save expert appointment dates*/
            if($form_expert_id && $form_apnt_date){
                /*on update mode*/
                $data = array(
                    'expert_id' => $expert_id,
                    'service_id' => $service_id,
                    'date' => $db_date
                );
                $this->appt->updateAppointment($data,$form_expert_id,$form_apnt_date);
            }else{
                /*on insert mode*/
              $data = array(
                 'expert_id' => $expert_id,
                 'service_id' => $service_id,
                 'date' => $db_date
                );
            $this->appt->saveAppointment($data);
            }
            
            
            /*Save expert appointment times*/
            
            if($form_expert_id && $form_apnt_date){
                //delete previous entries in time table 
                $this->appt->delete_time_entries($form_expert_id,$form_apnt_date);
            }
            
            $time=$_POST['time'];
            if(!empty($time)){
                foreach($time as $tk=>$tv){
                    //supplied time format is like 00:00-01:00.. so we need to explode time with -
                    //to save in database 
                    $supplied_time=explode('-',$tv);
                    
                    /*extract start time*/
                    $start_time=date('H:i:s',strtotime($supplied_time['0'].":00"));
                    $datetime_start=$db_date." ".$start_time;
                    $time_extracted_start=date('Y-m-d H:i:s',strtotime($datetime_start));
                    
                    /*extract end time*/
                    $end_time=date('H:i:s',strtotime($supplied_time['1'].":00"));
                    $datetime_end=$db_date." ".$end_time;
                    $time_extracted_end=date('Y-m-d H:i:s',strtotime($datetime_end));
                    
                    
                    $time=array();
                    $time_array=array(
                        'expert_id'=>$expert_id,
                        'date'=>$db_date,
                        'start_time'=>$time_extracted_start,
                        'end_time'=>$time_extracted_end,
                    );            
                    $this->appt->save_datetime($time_array);
                }
            }
            
            $this->session->set_flashdata("success_msg","Appointment has been saved successfully.");
            redirect(site_url("admin/appointment/view"));
        }
	} //index

} //end_of_class
