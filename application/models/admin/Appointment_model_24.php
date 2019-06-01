<?php
class Appointment_model extends CI_Model {
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
     /**
	  * It Saves expert details
      * @param array $array
 	  * @return bool
 	  */
    //get service for appointment
    function get_services_by_flag(){
        return $this->db->order_by("name","ASC")->get_where("services",array("flag"=>1))->result_array();
    }
    
    public function saveAppointment($data){      
      $result=$this->db->insert('expert_appointment', $data);
      return $result;
    }
    
        // update expert status
      public function update_category_status($cat_id,$status){
        //$this->db->where("id",$expert_id);
        $this->db->where("cat_id",$cat_id);
        $this->db->update("categories",array("status"=>$status));
        return true;
    }

        //list of categories
    public function categoryList($filter_cid){
        if($filter_cid){
            $this->db->where("pid",$filter_cid);
        }
        $cat_list=$this->db->get('categories');
        return $cat_list->result_array();
      }
      
      
      public function ApptByExpertidDate($expert_id,$list,$time_extracted_start,$time_extracted_end){
          return $this->db->where(['expert_id'=>$expert_id,'date'=>$list,'start_time'=>$time_extracted_start,'end_time'=>$time_extracted_end])->group_by(array("date","expert_id"))->get('appoint_time')->result_array();
          
      }


      public function selectAppt(){
        //return $this->db->get_where('expert_appointment',array("flag"=>1))->result_array();
        return $this->db->group_by(array("date","expert_id"))->get('expert_appointment')->result_array();
      }


    public function getCategoryById($cat_id){
        $row=$this->db->get_where('categories',array("cat_id" => $cat_id))->row_array();
        return $row;
    }

          // cat_id
    public function updateCategory($data,$cat_id){

      $this->db->where('cat_id', $cat_id);
      $this->db->update('categories',$data);
      return true;

    }

      //delete category
    public function deleteCategory($cat_id){

    $this->db->where('cat_id', $cat_id);
    $result=$this->db->delete('categories');
    return $result;
  }

	}
?>
