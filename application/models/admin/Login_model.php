<?php 
class Login_model extends CI_Model {
	/**
	 * Check username and password
	 * @param $username
	 * @param $password
	 * @return True or false depending upon the verification
	 */
    public function check_credentials($username,$password)
	{
		$query = $this->db->get_where('admin', array('email'=>$username,'password'=>sha1($password)));
        
		if($query->num_rows()===1)
		{
			//initiazlie session now
			$this->initialize_session($query->result());
		}		
		return $query->num_rows(); 
	}
	/**
	 * Initialize the session for user
	 * @param int $passed_credentials contains session information in array format of queried user
	 */
	private function initialize_session($passed_credentials)
	{		
		$get_row=$passed_credentials;
		$get_row=$get_row['0'];
		$id=$get_row->id;
		$username=$get_row->email;			
		$newdata = array('admin'=>array(
				'id'  => $id,
				'email'=> $username,
				'role'=>'admin',
				'logged_in' => TRUE				
		));
		$this->session->set_userdata($newdata);	             
	}
        
 	
	
}
?>