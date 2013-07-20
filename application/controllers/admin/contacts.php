<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 16-Jan-12
	* Accessed via http://hostname/index.php/admin/contacts
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_menu');				// load admin_menu model
		$this->load->model('contact');			  	  // load contact model
		$this->load->model('states');			 	  // load states model
		$this->load->model('cities');			 	 // load cities model
		$this->load->library('form_validation');	 // load form validation library	
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;					   // keeps the page error message
		$this->data['edit_contact_id'] = null;	     // keeps edit option selected
		$this->data['del_contact_id'] = null;	     // keeps delete option selected	
		$this->data['contact_list'] = $this->contact->getEntries();	// get all contact list
		$this->data['state_list'] = $this->states->getStateList();		   	   // get all states list
	}
	
	
	
	
	public function index()
	{
		showPage('contacts', $this->data);
	}
	
	
	
	
	// save data to contact tables
	public function save()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/contacts") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_name', 'Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_address', 'Address', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_phone', 'Phone', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_fax', 'Fax', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_mobile', 'Mobile', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_email', 'Email', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_state', 'State', 'required|xss_clean');
		$this->form_validation->set_rules('sel_city', 'City', 'required|xss_clean');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			! empty($post_data['sel_state']) ? $this->data['city_list'] = $this->cities->getCityList($post_data['sel_state']) : '';
			$this->data['frm_validation_err'] = true;
			showPage('contacts', $this->data);
		}
		else	// valdation success
		{
			if($this->contact->addEntry($post_data))	// add a new contact 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Contact', 'body' => 'A new contact has been added successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Contact', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/contacts");
		}
	}
	
	
	
	// update data to contact tables
	public function update()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/contacts") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_name', 'Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_address', 'Address', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_phone', 'Phone', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_fax', 'Fax', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_mobile', 'Mobile', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_email', 'Email', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_state', 'State', 'required|xss_clean');
		$this->form_validation->set_rules('sel_city', 'City', 'required|xss_clean');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			! empty($post_data['sel_state']) ? $this->data['city_list'] = $this->cities->getCityList($post_data['sel_state']) : '';
			$this->data['edit_contact_id'] = $post_data['edit_contact_id'];
			$this->data['frm_validation_err'] = true;
			showPage('contacts', $this->data);
		}
		else	// valdation success
		{
			if( ! empty($post_data['edit_contact_id']) && $this->contact->updateEntry($post_data))	// add a new contact 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Contact', 'body' => 'Record has been updated successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Contact', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/contacts");
		}
	}
	
	
	
	
	// Delete data from contact tables
	public function delete()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/contacts") : '';
		// delete record from database
		if( ! empty($post_data['del_contact_id']) && $this->contact->deleteEntry($post_data['del_contact_id']))
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Contact', 'body' => 'Contact deleted successfully.');
		}
		else
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Contact', 'body' => 'Some database error occured.');
		}
		$this->session->set_flashdata($flash_op_stat);
		redirect("admin/contacts");
	}
	
	
	
	
	// get city list from state
	public function getCityList()
	{
		$state_id = $this->input->post('state_id', TRUE);
		$city_list = $this->cities->getCityList($state_id);
		echo json_encode($city_list);
	}
	
	
	
	
	// AJAX call to get career details for editing / deleting
	public function fetch()
    {
		$career_id = $this->input->post('career_id', TRUE);
		$result = $this->contact->fetchEntry($career_id);
		$json_array = array('name' => $result->name,
							'address' => $result->address,
							'phone' => $result->phone,
							'fax' => $result->fax,
							'mobile' => $result->mobile,
							'email' => $result->email,
							'city_id' => $result->city_id,
							'state_id' => $result->state_id
							);
		echo json_encode($json_array);
	}
	
	
	
	
	// Change career status
	public function changeStatus()
	{
		$contact_id = $this->input->post('contact_id', TRUE);
		if($result = $this->contact->changeStatus($contact_id))
		{
			$json_array = array('cur_stat' => $result);
			echo json_encode($json_array);
		}
	}
}

/* End of file contacts.php */
/* Location: ./application/controllers/admin/contacts.php */