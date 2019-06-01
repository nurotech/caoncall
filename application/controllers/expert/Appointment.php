<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Expert_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->model("expert/Appointment_model","appt");
        $this->load->model("expert/Expert_model","expert");
        
        $this->load->model("expert/Services_model","service");
    }
    
    /**
     * Callback function applied on date to check duplicacy
     * @return mixed returns error with tabular html table format
     * */
    function check_duplicates(){
        //$expert_id=$this->input->post('expert_id');
       
        $expert_info=$this->session->userdata('expert');
        $expert_id=$expert_info['id'];
        //echo ucfirst($exp_name);
        
        $service_id=$this->input->post('service_id');
        
        $from_date=$this->input->post('date');
        $date_from=date('Y-m-d',strtotime($from_date));
        
        $date_to=$this->input->post('date1');
        $date_to=date('Y-m-d',strtotime($date_to));
        $time_posted=$_POST['time'];
        
        $message=array();
        /*From and To date iteration Start*/
        $start = strtotime($date_from);
        $stop = strtotime($date_to);
        for ($seconds=$start; $seconds<=$stop; $seconds+=86400)
        {
            $loop_date = date("Y-m-d", $seconds);
            if(!empty($time_posted)){
                foreach($time_posted as $tk=>$tv){
                    $supplied_time=explode('-',$tv);
                    /*extract start time*/
                    $start_time=date('H:i:s',strtotime($supplied_time['0'].":00"));
                    $datetime_start=$loop_date." ".$start_time;
                    $time_extracted_start=date('Y-m-d H:i:s',strtotime($datetime_start));
                    
                    /*extract end time*/
                    $end_time=date('H:i:s',strtotime($supplied_time['1'].":00"));
                    $datetime_end=$loop_date." ".$end_time;
                    $time_extracted_end=date('Y-m-d H:i:s',strtotime($datetime_end));
                    
                    /*Now validate date and time against saved records */
                    
                    $where_clause=array(
                        "date"=>$loop_date,
                        "service_id"=>$service_id,
                        "expert_id"=>$expert_id,
                        "start_time"=>$time_extracted_start,
                        "end_time"=>$time_extracted_end,
                    );
                    
                    $this->db->where($where_clause);
                    $return_cb=$this->db->get("appoint_time")->row_array();
                    
                    //pre($this->db->last_query());
                    if(!empty($return_cb)){
                        $message['error_msg'][]=$return_cb;
                    }
                }
            }
            
            // $this->form_validation->set_message('check_duplicates', 'Records already exist in system with selected configuration.<br/>Please try different date, time or service.');
        }
        
        /*If records already exist with seleteted configuration else empty records exist*/
        if(!empty($message)){
            //return $message;
            $errors=$message;
            if(!empty($errors)){
                //pre($errors);
                $temp=array();
                foreach($errors['error_msg'] as $ek=>$ev){
                    $temp[$ev['date']][]=$ev;
                }
                
                $html_string="<div style='color:red !important' class='alert alert-info'><strong>Error</strong>: Time with selected date & service already exist in our system.<br/>Please choose different date, time or service.";
                $html_string.="<table class='table table-bordered'><thead><tr><th>Date</th><th>Time</th></tr></thead><tbody>";
                
                foreach($temp as $temp_k=>$temp_v){
                    //pre($temp_v);
                    $times_array=array();
                    //$reformat_time=r
                    if(!empty($temp_v)){
                        foreach($temp_v as $tk=>$tv){
                            $ts_string=date('g:i a',strtotime($tv['start_time']))."-".date('g:i a',strtotime($tv['end_time']));
                            $times_array[]=$ts_string;
                        }
                    }
                    // pre($times_array);
                    // $implode_time=implode('<label class="label label-danger">,</label>',$times_array);
                    $html_string.="<tr>";
                    $html_string.="<td>$temp_k</td>";
                    $html_string.='<td><code>'.implode("</code>&nbsp;<code>",$times_array).'</code></td>';
                    $html_string.="</tr>";
                }
                
                
            }
            $html_string.="</tbody></table></div>";
            return $html_string;
        }else{
            return false;
        }
        
    }
    /**
     * Receive appointment form, data via ajax method
     * @since 27052019
     * */
    function throw_data(){
        
        /*apply some validations*/
        //$this->form_validation->set_rules("expert_id","Expert","required");
        $this->form_validation->set_rules("service_id","Service","required");
        $this->form_validation->set_rules("date"," Start Date","required");
        $this->form_validation->set_rules("date1"," End Date","required");
        $this->form_validation->set_rules("time[]","Time","required");
        
        if($this->form_validation->run() == FALSE)
        {
            if(validation_errors()){
                echo "<div class='alert alert-danger' style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
            ".validation_errors()."</div>";
            }
        }else{
            
            /*Validate start and end date*/
            $time_stamp_start=strtotime(date('Y-m-d',strtotime($_POST['date'])));
            $time_stamp_end=strtotime(date('Y-m-d',strtotime($_POST['date1'])));
            
            if($time_stamp_end<$time_stamp_start){
                echo "<div class='alert alert-danger' style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
                    <b>Error</b>: End date should be higher than start end.
                    </div>";
                exit();
            }
            
            
            /*Check entries before saving to system*/
            (!empty($this->check_duplicates())?die($this->check_duplicates()):"");
            
            //
            
            $expert_info=$this->session->userdata('expert');
            $expert_id=$expert_info['id'];
            
            //$expert_id=$this->input->post('expert_id');
            $service_id=$this->input->post('service_id');
            
            $from_date=$this->input->post('date');
            $date_from=date('Y-m-d',strtotime($from_date));
            
            $date_to=$this->input->post('date1');
            $date_to=date('Y-m-d',strtotime($date_to));
            $time_posted=$_POST['time'];
            
            /*From and To date iteration Start*/
            $start = strtotime($date_from);
            $stop = strtotime($date_to);
            for ($seconds=$start; $seconds<=$stop; $seconds+=86400)
            {
                $loop_date = date("Y-m-d", $seconds);
                $date_array=array(
                    'expert_id'=>$expert_id,
                    'service_id'=>$service_id,
                    'date'=>$loop_date
                );
                /*Now save an appointment record to table in loop first*/
                $this->appt->_save_appointment($date_array);
                
                /*Save select date's respective time start*/
                //$this->appt->_save_appointment($date_array);
                if(!empty($time_posted)){
                    foreach($time_posted as $tk=>$tv){
                        $supplied_time=explode('-',$tv);
                        /*extract start time*/
                        $start_time=date('H:i:s',strtotime($supplied_time['0'].":00"));
                        $datetime_start=$loop_date." ".$start_time;
                        $time_extracted_start=date('Y-m-d H:i:s',strtotime($datetime_start));
                        
                        /*extract end time*/
                        $end_time=date('H:i:s',strtotime($supplied_time['1'].":00"));
                        $datetime_end=$loop_date." ".$end_time;
                        $time_extracted_end=date('Y-m-d H:i:s',strtotime($datetime_end));
                        
                        $time_array=array(
                            'expert_id'=>$expert_id,
                            'service_id'=>$service_id,
                            'date'=>$loop_date,
                            'start_time'=>$time_extracted_start,
                            'end_time'=>$time_extracted_end,
                        );
                        
                        
                        $this->appt->_save_appoint_time($time_array);
                    }
                }
                /*Save select date's respective time end*/
                
                
            }/*Main loop iteration end*/
            /*From and To date iteration End*/
            
            /************As of now Date & Respetive Time has been saved*************************/
            $this->session->set_flashdata("success_msg","Records added successfully.");
            echo "<script>window.location.reload()</script>";
        }
        
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
        redirect(site_url("expert/category/view"));
    }
    
    function view(){
        // $this->input->get('cat_id',true);
        // $filter_cid=$this->input->get('filter_cid',true);
        $data['appt_list']=$this->appt->selectAppt();
        //$data['cat_list']=$this->cat->categoryList($filter_cid);
        $this->load->view("expert/view_appointment",$data);
    }
    
    function edit(){
        //$data['cat_id'] = $this->input->get('cat_id',true);
        
        //$this->load->view("admin/update_category", $data);
    }
    
    function delete(){
        $cat_id=$this->input->get('cat_id',true);
        $this->cat->deleteCategory($cat_id);
        $this->session->set_flashdata("success_msg","Category has been deleted successfully.");
        redirect(site_url("expert/category/view"));
    }
    
    // appointment of expert
    function index()
    {
        //$this->form_validation->set_rules("expert_id","Expert","required");
        $this->form_validation->set_rules("service_id","Service","required");
        $this->form_validation->set_rules("date"," Date","required");
        $this->form_validation->set_rules("time[]","Time","required");
        
        if($this->form_validation->run() == FALSE)
        {
            $data['exp_list'] = $this->expert->get_experts();
            $data['service_list'] = $this->appt->get_services_by_flag();
            
            //$expert_id=$this->input->get('expert_id',true);
            $date=$this->input->get('date',true);            
            
            $this->load->view('expert/appointment',$data);
            
        }
        else
        {
            //$expert_id=$this->input->post('expert_id');
            $expert_info=$this->session->userdata('expert');
            $expert_id=$expert_info['id'];
            
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
