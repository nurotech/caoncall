<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustomerModal',"cust");
    }
    
    public function get_cid(){
        $cid=$this->input->get('catId',true);
        $sub_cats=$this->cust->selectSubCategory($cid);
        echo $html='<select name="subcat_id" id="subcat_id" class="form-control" >';
										echo '<option value="">--Select Sub category--</option>';
											if(!empty($sub_cats)){
        								foreach($sub_cats as $sub_cat=>$scat){
											echo "<option  value='".$scat['cat_id']."'>".$scat['cat_name']."</option>";
        								
        								}
        							}
		echo '</select>';
        							
   }
    public function get_service(){
      
        $sid=$this->input->get('sId',true);
        
        
        $service_id=$this->cust->getService($sid);
        
        foreach($service_id as $sub_cat1=>$scat1){
            
            if($scat1['flag']==1)
            {
               echo $html ='   <div class="form-body">
                    <div class="form-group">
                      <label for="eventInput1">Date</label>
                      <input autocomplete="off" value="" type="text" id="datepicker1" name="date1" class="form-control" placeholder="MM-DD-YYYY">
                    </div>
                  </div>';
            }
            else {
                {
                    echo $html=no;
                }
            }
        }
//               echo $html='<div="col-md-12">
//               <table class="table table-striped"><tr> <p style="text-align:center;">Please Select Package</p></tr>';
// 					                    if(!empty($service_id)){
//         								foreach($service_id as $sub_cat1=>$scat1){
//         							    echo'<tr><td><input type="radio" id="service_package" name="package_id" value="'.$scat1['id'].'" style="height: 21px;
//               width: 21px;"></td><td>'.$scat1['name'].'</td><td>'.$scat1['amount'].'</td><td>'.$scat1['des1'].'</td><td>'.$scat1['des2'].'</td></tr>';
        								
//         								}
//         								echo'</div></table>';
//         							}
    }

  
    public function index(){
        
        //$this->form_validation->set_rules('name','enter name','required');
        //$this->form_validation->set_rules('name','enter name','required');
        //$this->form_validation->set_rules('name','enter name','required');
        
        $data['main_cats']=$this->cust->selectMaincategory();
        $data['services']=$this->cust->selectServices();
         $this->load->view('customer',$data);
           //$this->cust->add($query_data);

    }//index
    
    public function saveDetails(){
        
            $user_sess=$this->session->userdata('user');
           $query_data = array(
          'user_id' => $user_sess['id'],
          'subcat_id' => $this->input->post('subcat_id'),
          'query' => $this->input->post('query'),
          'service_id' => $this->input->post('service_id'),
          'package_id' => $this->input->post('package_id')
          );
          
          $rs = $this->cust->add($query_data);
            if($rs == 1){          
              redirect(site_url('customer'));
            }
            else{
               redirect(site_url('customer')); 
            }
            
    } //saveDetails
    
  /**
     * It will check user's login status
     * @param int via ajax
     * */
    function check_login_status(){
        $user_session=$this->session->userdata('user');
        $user_id=$user_session['id'];
           $flag=0;
        if($user_id){
            $flag=1;
        }
        echo $flag;
    }
    
}
