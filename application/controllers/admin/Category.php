<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {    

    public function __construct()
    {
        parent::__construct();        
        $this->is_logged_in();
        $this->load->model("admin/category_model","cat");
    }

     /**
     * Updating Status of Category User
     * */
    function update_status(){
        $cat_id=$this->uri->segment(4);
        $status=$this->uri->segment(5);

         /*If came via sub category page */   
        $main_id=$this->uri->segment(6);


        $this->cat->update_category_status($cat_id,$status);
        $this->session->set_flashdata("success_msg","Category status has been updated successfully.");
        if($main_id){
        redirect(site_url("admin/category/subcategory/".$main_id));
        }else{
        redirect(site_url("admin/category/view"));    
        }
        
    }

    public function view(){
            // for main category
        $filter_cid=$this->input->get('filter_cid',true);
        
        $data['main_cats']=$this->cat->selectMaincategory();
        $data['cat_list']=$this->cat->categoryList($filter_cid);
        $this->load->view("admin/view_category",$data);
    }

     public function edit(){

    //$data['cat_id'] = $this->input->get('cat_id',true);

    //$this->load->view("admin/update_category", $data);
    }

    public function delete(){ 
        $cat_id=$this->input->get('cat_id',true);
         $this->cat->deleteCategory($cat_id);
          $this->session->set_flashdata("success_msg","Category has been deleted successfully.");    
          redirect(site_url("admin/category/view"));        
    }
	
        //add category
	public function index()
	{   

		$this->form_validation->set_error_delimiters('<div class="label label-danger">','</div><br/>');

    $posted_form_id=$this->input->post('form_cat_id',true);
    if($posted_form_id){
        $this->form_validation->set_rules('cat_name', 'Category', 'required');    
    }else{
        $this->form_validation->set_rules('cat_name', 'Category', 'required|is_unique[categories.cat_name]');
    }

		if($this->form_validation->run() == FALSE)
        {
        $data['main_cats']=$this->cat->selectMaincategory();

        $cat_id = $this->input->get('cat_id',true);         
        $data['cat_list'] = $this->cat->getCategoryById($cat_id); 

            $this->load->view('admin/category',$data);
        }
        else
        {
			
            $form_cat_id=$this->input->post('form_cat_id',true);           
            if($form_cat_id){
                /*for updation*/    
                $data = array(        
                'cat_name' => $this->input->post('cat_name'), 
                'pid'    => $this->input->post('pid')        
                );
                
                $this->cat->updateCategory($data,$form_cat_id);
                $this->session->set_flashdata("success_msg","Category has been updated successfully.");    
                redirect(site_url("admin/category/view"));
            }else{
                /*for insertion*/    
            $data = array(        
            'cat_name' => $this->input->post('cat_name'), 
            'pid'    => $this->input->post('pid')        
            );

            
            $this->cat->saveCategory($data);
            $this->session->set_flashdata("success_msg","Category has been saved successfully.");    
            redirect(site_url("admin/category"));

            }

        }
	}

      
        // sub category operation
    public function subcategory(){

        $cat_id=$this->uri->segment(4);
        $data['sub_cats']=$this->cat->selectSubcategory($cat_id);
        $this->load->view('admin/sub_category',$data);
    }


    public function sub_delete(){ 
        $cat_id=$this->input->get('cat_id',true); 
        //echo  $cat_id;die;       
         $this->cat->deleteCategory($cat_id);
          $this->session->set_flashdata("success_msg","Sub Category has been deleted successfully.");    
          redirect(site_url("admin/category/subcategory"));
                  
    }

    /*public function sub_view(){
            // for main category
        $filter_cid=$this->input->get('filter_cid',true);
        
        $data['main_cats']=$this->cat->selectMaincategory();
        $data['cat_list']=$this->cat->categoryList($filter_cid);
        $this->load->view("admin/view_category",$data);
    }*/
    


}
