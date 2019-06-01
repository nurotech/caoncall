<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModal extends CI_Model{

    function selectMaincategory(){
         return $this->db->get_where('categories','pid="0"')->result_array();
    }
      function selectServices(){
         return $this->db->get('services')->result_array();
    }
    
    function selectSubCategory($cid){
                $this->db->where("pid",$cid);
        return $this->db->get('categories')->result_array();
    }
    
    function getService($sid){
    
      $this->db->where("service_id",$sid);
        return $this->db->get('service_package')->result_array();
    }

 function add($query_data){
     return $this->db->insert('query', $query_data);
     
    } 

}
