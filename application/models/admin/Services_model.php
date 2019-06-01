<?php 
class Services_model extends CI_Model {    
    function get_services(){
        return $this->db->order_by("name","ASC")->get_where("services")->result_array();
    }
    /**
     * Enable or disable service
     * @param $service_id
     * @param $status
     * @return bool
     * */
    function update_service_status($service_id,$status){
        $this->db->where("id",$service_id);
        $this->db->update("services",array("status"=>$status));
        return true;
    }
    function update_service($service_id,$serivice_name){
        $this->db->where("id",$service_id);
        $this->db->update("services",array("name"=>$serivice_name));
        return true;
    }
    /**
     * Get service infomration
     * @param int $service_id
     * @return boolean
     * */
    function get_service_info($service_id){
        return $this->db->get_where("services",array("id"=>$service_id))->row_array();
    }
    /**
     * Deleting the service
     * */
    function delete_service($service_id){
        $this->db->where("id",$service_id);
        $this->db->delete("services");
        return true;
    }

	}
?>