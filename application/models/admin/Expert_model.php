<?php
class Expert_model extends CI_Model {

    /**
     * Check if given sub category exist expert category assignment table
     * @param int $subcat_id subcategory id
     * @param int $main_cat main category id
     * @param $expert_id Expert id
     * @return boolean
     * */
    function check_subcat_id_record($subcat_id,$main_cat,$expert_id){
        $rows=$this->db->get_where("expert_assigned_cats",array("sub_cat_id"=>$subcat_id,"main_cat_id"=>$main_cat,"expert_id"=>$expert_id))->result_array();
        if(!empty($rows)){
            return true;
        }else{
            return false;
        }
    }
    /**
     * Get expert row
     * */
    function get_expert_info($expert_id){
        return $this->db->get_where("expert",array("id"=>$expert_id))->row_array();
    }
    /**
     * clear out expert subcategories
     * */
    function clear_out_expert_cat_relation($expert_id,$main_cat_id){
        $this->db->where(array("expert_id"=>$expert_id,"main_cat_id"=>$main_cat_id));
        $this->db->delete("expert_assigned_cats");
        return true;
    }
    /**
     * Save assigned sub categories for checkbox methods
     * */
    function save_expert_categories($array_data){
        $this->db->insert('expert_assigned_cats',$array_data);
        return $this->db->insert_id();
    }

    function delete_assigned_row($row_id){
        $this->db->where("expert_id",$row_id);
        $this->db->delete("expert_assigned_cats");
        return true;
    }
    function update_assigned_category($db_data,$row_id){
        $this->db->where("id",$row_id);
        $this->db->update("expert_assigned_cats",$db_data);
        return true;
    }
    /**
     * Get assigned record
     * */
    function get_assigned_row($row_id){
        return $this->db->get_where("expert_assigned_cats",array("id"=>$row_id))->row_array();
    }
    /**
     * */
    function assigned_exp_cats(){
        return $this->db->query("SELECT * FROM `expert_assigned_cats` group by `expert_id`")->result_array();
        //return $this->db->order_by("id","DESC")->get("expert_assigned_cats")->result_array();
    }
    function save_assigned_category($array_data){
        $this->db->insert("expert_assigned_cats",$array_data);
        return $this->db->insert_id();
    }
    
    function get_subcats($main_cid){
        return $this->db->get_where("categories",array("pid"=>$main_cid))->result_array();
    }
    /**
     * Updateing Expert Status
     * @param int $expert_id
     * @param int $status
     * @return bool
     * */

        //expert appointment
    function expert_appointment($data){
       $result=$this->db->insert('expert_appointment',$data);
       return $result;
    }


    public function selectMaincategory(){
        return $this->db->get_where('categories',array("pid"=>0))->result_array();
    }

    function update_expert_status($expert_id,$status){
        $this->db->where("id",$expert_id);
        $this->db->update("expert",array("status"=>$status));
        return true;
    }
    /**
     * Updating the expert details
     * @param int $row_id
     * @param $expert_array
     * @return bool
     * */
    function update_expert_details($row_id,$expert_array){
        $this->db->where("id",$row_id);
        $this->db->update("expert",$expert_array);
        return $row_id;
    }
    /**
     * Get Expert Details
     * @param int $expert_id
     *
     */
    function get_expert_details($expert_id){
        return $this->db->get_where("expert",array("id"=>$expert_id))->row_array();
    }
    /**
     * Deleting Expert
     * @param int $expert_id
     * @return boolean
     * */
    function delete_expert($expert_id){
        $this->db->where('id',$expert_id);
        $this->db->delete('expert');
        return true;
    }
    /**
     * Getting all expert records
     * */
    function get_experts(){
        return $this->db->order_by("name","ASC")->get("expert")->result_array();
    }
	/**
	 * It Saves expert details
	 * @param array $array
	 * @return int Return insert id
	 */
    function save_expert_details($arr){
        $this->db->insert("expert",$arr);
        return $this->db->insert_id();
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
