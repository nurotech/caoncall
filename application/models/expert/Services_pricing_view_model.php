<?php 
class Services_pricing_view_model extends CI_Model {    
    
    /*Get all services*/
    function get_services_pacakges(){
        return $this->db->order_by("name","ASC")->get("service_package")->result_array();
    }
    function delete_service_package($row_id){
        $this->db->where("id",$row_id);
        $this->db->delete("service_package");
        return true;
    }
    function save_service_pricing($array){
        $this->db->insert("service_package",$array);
        return $this->db->insert_id();
    }
}
?>