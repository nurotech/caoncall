<?php
	/*
 		* This MY_Controller is used to handle session mechanism for all logins such as doctor,school and main site admin
 */

/*This controller is for main site admin*/
class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

	}

	public function is_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(!isset($flag['admin']['logged_in']))
		{
			redirect(site_url('admin/login'));
		}
	}

	public function login_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(isset($flag['admin']['logged_in']))
		{
			redirect(site_url('admin/dashboard'));
		}
	}

}


		//  this controller used by expert
class MY_Expert_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * checks if doctor is logged in
	 * if doctor is logged then redirect to doctor login page
	 */
	public function is_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(!isset($flag['expert']['logged_in']))
		{
			redirect(site_url('expert/login'));
		}
	}

	public function login_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(isset($flag['expert']['logged_in']))
		{
			redirect(site_url('expert/dashboard'));
		}
	}

}




    /*This controller is used fo Login */
class MY_User_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * checks if doctor is logged in
	 * if doctor is logged then redirect to doctor login page
	 */
	public function is_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(!isset($flag['user']['logged_in']))
		{
			redirect(site_url('auth'));
		}
	}

	/*This function will invoke in login contorller page of doctor*/
	public function login_logged_in()
	{
		$flag =$this->session->all_userdata();
		if(isset($flag['user']['logged_in']))
		{
			redirect(site_url('dashboard'));
		}

	}

}

?>
