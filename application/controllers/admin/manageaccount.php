<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageaccount extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 16-Jan-12
	* Accessed via http://hostname/index.php/admin/manageaccount
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_menu');			  // load admin_menu model
		$this->load->model('users');			  	  // load users model
		$this->load->library('form_validation');	 // load form validation library	
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;					   // keeps the page error message
		$this->data['edit_account_id'] = null;	     // keeps edit option selected
		$this->data['del_account_id'] = null;	     // keeps delete option selected	
		$this->data['account_list'] = $this->session->userdata['usr_type'] == 'admin' ?  
									  $this->users->getEntries(null, $this->session->userdata['usr_id']) : // get particular account for admin
									  $this->users->getEntries();	// get all / own account list for SU
	}
	
	
	
	
	public function index()
	{
		showPage('manageaccount', $this->data);
	}
	
	
	
	
	// save data to users tables
	public function save()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/manageaccount") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_name', 'Account Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_email', 'Email Address', 'required|xss_clean|valid_email|trim|strtolower');
		$this->form_validation->set_rules('txt_pswd', 'Password', 'required|xss_clean|trim|min_length[6]');
		$this->form_validation->set_rules('txt_conf_pswd', 'Password', 'required|xss_clean|trim|matches[txt_pswd]');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('manageaccount', $this->data);
		}
		else	// valdation success
		{
			if($this->users->checkDuplicateEmail($post_data['txt_email']))
			{
				$this->data['ErrMsg'] = 'This email is already registered for an account.';	
				$this->data['frm_validation_err'] = true;
				showPage('manageaccount', $this->data);
			}
			else if($this->users->addEntry($post_data))	// add a new account 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Account', 'body' => 'Administrator has been added successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Account', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/manageaccount");
		}
	}
	
	
	
	// update data to users tables
	public function update()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/manageaccount") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_name', 'Account Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_email', 'Email Address', 'required|xss_clean|valid_email|trim|strtolower');
		$this->form_validation->set_rules('txt_pswd', 'Password', 'required|xss_clean|trim|min_length[6]');
		$this->form_validation->set_rules('txt_conf_pswd', 'Password', 'required|xss_clean|trim|matches[txt_pswd]');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['edit_account_id'] = $post_data['edit_account_id'];
			$this->data['frm_validation_err'] = true;
			showPage('manageaccount', $this->data);
		}
		else	// valdation success
		{
			if( ! empty($post_data['edit_account_id']) && $this->users->updateEntry($post_data))	// add a new account 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Account', 'body' => 'Record has been updated successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Account', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/manageaccount");
		}
	}
	
	
	
	
	// Delete data from users tables
	public function delete()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/manageaccount") : '';
		// delete record from database
		if( ! empty($post_data['del_account_id']) && $this->users->deleteEntry($post_data['del_account_id']))
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Account', 'body' => 'Account deleted successfully.');
		}
		else
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Account', 'body' => 'Some database error occured.');
		}
		$this->session->set_flashdata($flash_op_stat);
		redirect("admin/manageaccount");
	}
	
	
	
	
	// AJAX call to get career details for editing / deleting
	public function fetch()
    {
		$account_id = $this->input->post('account_id', TRUE);
		$result = $this->users->fetchEntry($account_id);
		$json_array = array('name' => $result->name,
							'email' => $result->email,
							'pswd' => $result->pswd
							);
		echo json_encode($json_array);
	}
	
	
	
	
	// Change career status
	public function changeStatus()
	{
		$account_id = $this->input->post('account_id', TRUE);
		if($result = $this->users->changeStatus($account_id))
		{
			$json_array = array('cur_stat' => $result);
			echo json_encode($json_array);
		}
	}
}

/* End of file manageaccount.php */
/* Location: ./application/controllers/admin/manageaccount.php */