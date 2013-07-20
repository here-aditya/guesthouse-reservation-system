<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 16-Jan-12
	* Accessed via http://hostname/index.php/admin/login
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('users');			   		// load users model
		$this->load->library('form_validation');	   // load form validation library	
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['Err'] = true;					   		// keeps the page error message
		$this->data['ErrMsg'] = null;					   // keeps the page error message
	}
	
	
	
	
	public function index()
	{
		showLogin('login', $this->data);
	}
	
	
	
	
	// validate login data
	public function validateLogin()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to login
		empty($post_data) ? redirect("admin/login") : '';
		//	set validation rules
		$email = trim($this->input->post('txt_email'));
		$pswd = trim($this->input->post('txt_pswd'));
		//	validate form data
		if (empty($email))	// validation failure
		{
			$this->data['Err'] = true; 
			$this->data['ErrMsg'] = '<div class="error">* Email is empty.</div>';
		}
		else if(empty($pswd))
		{
			$this->data['Err'] = true; 
			$this->data['ErrMsg'] = '<div class="error">* Password is empty.</div>';
		}
		else if( ! filter_var($email = filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
		{
			$this->data['Err'] = true; 
			$this->data['ErrMsg'] = '<div class="error">* Invalid Email Address.</div>';
		}
		else
		{
			if($uid = $this->users->validateLogin($email, md5($pswd)))	// validate login id / pswd
			{
				$cur_time = date('d-F-y h:i:s A');
				$cur_ip = $this->session->userdata('ip_address');
				$user_details = $this->users->getUserInfo($uid);
				
				if($user_details && ! empty($user_details))
				{
					$arr_user_details = array();
					$arr_user_details['usr_name'] = $user_details->name;
					$arr_user_details['usr_id'] = $uid;
					$arr_user_details['usr_type'] = $user_details->type;
					$arr_user_details['usr_prev_ip_add'] = $user_details->prev_ip_add;
					$arr_user_details['usr_last_log_time'] = $user_details->last_log_time;
					$arr_user_details['usr_cur_log_time'] = date('h:i:s A');
					$arr_user_details['logged_in'] = true;
					// set session data for logged-in user
					$this->session->set_userdata($arr_user_details);
				}
				// update current login details
				$this->users->setLogInDetails($uid, $cur_time, $cur_ip);
				$this->data['Err'] = false; 
				$this->data['ErrMsg'] = '<div class="success">Login Success.</div>';
			}
			else
			{
				$this->data['Err'] = true; 
				$this->data['ErrMsg'] = '<div class="error">* Invalid ID / Password.</div>';
			}
		}
		echo json_encode($this->data);
	}
	
	
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/admin/login.php */