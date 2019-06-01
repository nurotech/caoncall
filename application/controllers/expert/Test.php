<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Feedback extends CI_Controller {
	/**
	 * Index Page for this controller.  
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->form_validation->set_rules("message","Message","required|trim");
		$this->form_validation->set_rules("app_id","Appointment id is missing","required|trim");
		if($this->form_validation->run()===false){
			$sapp_id=$this->input->get('app_id',true);
			if(!$sapp_id){
				die("link is broken");
			}
			$this->load->view(lang_dir.'feedback');
		}else{
			
			$app_id=$this->input->post('app_id',true);
			$datas=array(
					'rating'=>$this->input->post("rate_no",true),
					'rating2'=>$this->input->post("rate_no2",true),
					'rating3'=>$this->input->post("rate_no3",true),
					'rating4'=>$this->input->post("rate_no4",true),
					'rating5'=>$this->input->post("rate_no5",true),
					'rating6'=>$this->input->post("rate_no6",true),
					'feedback'=>$this->input->post('message',true),
					'how_know'=>$this->input->post('how_know',true)
			);
			$this->db->where(array('id'=>$app_id));
			$this->db->update("ea_appointments",$datas);			
			$this->session->set_flashdata("success_msg","Thank you for feedback !");
			redirect(site_url('feedback?msg=success&app_id='.$this->input->post('app_id',true)));
		}		
	}
}
