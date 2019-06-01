<?php
class Appointment_model extends CI_Model {    
    /**
     *  save appointment for expert
     *  28/05/2019 @ 10:45
     */
    
    function saveAppointment($data){        
        $result=$this->db->insert('expert_appointment', $data);
        return $result;
    }
    
    /**
     * It Saves expert details
     * @param array $array
     * @return bool
     */
    //get service for appointment
    function get_services_by_flag(){
        return $this->db->order_by("name","ASC")->get_where("services",array("flag"=>1))->result_array();
    }    
    
    
    /**
     *
     * expert appontment
     */
    function select_expert_appt(){
        return $this->db->get('expert_appointment')->result_array();
    }    
    
    
    /**
     * Delete record of Appointment time table row id
     * @param int $row_id
     * @return bool
     * */
    function delete_time_row($row_id){
        $this->db->where("id",$row_id);
        $this->db->delete("appoint_time");
        return true;
    }
    function delete_time_entries($form_expert_id,$form_apnt_date){
        $this->db->where(array("expert_id"=>$form_expert_id,"date"=>$form_apnt_date));
        $this->db->delete("appoint_time");
        return true;
    }
    function updateAppointment($data,$form_expert_id,$form_apnt_date){
        $this->db->where(array("expert_id"=>$form_expert_id,"date"=>$form_apnt_date));
        $this->db->update("expert_appointment",$data);
        return true;
    }
    
    function get_apnt_time_edit_parsed($expert_id,$date){
        $rows=$this->db->get_where("appoint_time",array("expert_id"=>$expert_id,"date"=>$date))->result_array();
        if(!empty($rows)){
            $temp=array();
            foreach($rows as $rk=>$rv){
                $temp[]=date('H:i',strtotime($rv['time']));
            }
            return $temp;
        }else{
            return false;
        }
    }
    
    /**
     * Get selected date's time
     * @param int $expert_id
     * @param string $date
     * */
    function get_apnt_time_edit($expert_id,$date){
        return $this->db->get_where("appoint_time",array("expert_id"=>$expert_id,"date"=>$date))->result_array();
    }
    /**
     * Get expert id & apnt date
     * @param int $expert_id
     * @param string $apnt_date
     * */
    function get_apnt_edit($expert_id,$apnt_date){
        return $this->db->get_where("expert_appointment",array("expert_id"=>$expert_id,"date"=>$apnt_date))->row_array();
    }
    
    /**
     * Delete appointment for the selected date
     * */
    function delete_expert_dates($expert_id,$apnt_date){
        $this->db->where(array("expert_id"=>$expert_id,"date"=>$apnt_date));
        $this->db->delete("expert_appointment");
        
        /*Delete corressponding time of the selected expert's date*/
        $this->db->where(array("expert_id"=>$expert_id,"date"=>$apnt_date));
        $this->db->delete("appoint_time");
        
        return true;
    }
    
    /**
     * Save appointment time
     * */
    function save_datetime($db_array){
        $this->db->insert("appoint_time",$db_array);
        return $this->db->insert_id();
    }  
    
    function selectAppt(){
        //return $this->db->get_where('expert_appointment',array("flag"=>1))->result_array();
        return $this->db->group_by(array("date","expert_id"))->get('expert_appointment')->result_array();
      }    

	}
?>
