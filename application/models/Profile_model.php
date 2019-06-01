<?php
class Profile_model extends CI_Model {
    /**
     * Updating the expert details
     * @param int $row_id
     * @param $expert_array
     * @return bool 
     * */
    function update_expert_details($row_id,$expert_array){
        $this->db->where("id",$row_id);
        $this->db->update("users",$expert_array);
        return $row_id;
    }
    /** 
     * Get Expert Details
     * @param int $expert_id for profile
     *
     */
    function get_expert_details($expert_id){
        return $this->db->get_where("users",array("id"=>$expert_id))->row_array();
    }

   
    /** 
     * Update profile pic
     * @param int $insert_id
     * @param string $profile_pic
     * */
    function update_profile_pic($insert_id,$profile_pic){
        $this->db->where("id",$insert_id);
        $this->db->update("expert",array("profile_pic"=>$profile_pic));
        return true;
    }
    
}
?>
