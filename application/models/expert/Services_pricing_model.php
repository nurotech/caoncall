<?php 
class Services_pricing_model extends CI_Model {    
    
    /*Get all services*/
    function get_services(){
        return $this->db->order_by("name","ASC")->get("services")->result_array();
    }
    /*
     * Get serivice info
     * @param int $row_id
     * */
    function get_service_info($row_id){
        return $this->db->get_where("service_package",array("id"=>$row_id))->row_array();
    }
    function save_service_pricing($array){
        $this->db->insert("service_package",$array);
        return $this->db->insert_id();
    }
    function update_service_pricing($array,$row_id){
        $this->db->where("id",$row_id);
        $this->db->update("service_package",$array);
        return true;
    }
}
?>