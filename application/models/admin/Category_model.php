<?php 
class Category_model extends CI_Model {    
      /*
		  * It Saves expert details
      * @param array $array
 		  * @return bool 
 			*/

        // update expert status
    public function update_category_status($cat_id,$status){       
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


      public function selectMaincategory(){
        return $this->db->get_where('categories',array("pid"=>0))->result_array();
      }


    public function saveCategory($data){    

      $result=$this->db->insert('categories',$data);
      return $result;
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

    public function update_subcat($data,$cat_id){
      
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


    // operation for sub category

    public function selectSubcategory($cat_id){        
        $this->db->where("pid",$cat_id);
        return $this->db->get('categories')->result_array();
      }    

	}
?>