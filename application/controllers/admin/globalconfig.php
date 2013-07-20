<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Globalconfig extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 16-Jan-12
	* Accessed via http://hostname/index.php/admin/globalconfig
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_menu');				// load admin_menu model
		$this->load->model('site_config');			   // load site_config model
		$this->load->library('form_validation');	  // load form validation library	
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;					   // keeps the page error message	
		$this->data['site_config_list'] = $this->site_config->getEntries();	// get all site_config list
	}
	
	
	
	
	public function index()
	{
		showPage('globalconfig', $this->data);
	}
	
	
	
	
	// save / update data to site_config
	public function save()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/globalconfig") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_site_title', 'Site Title', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_meta_title', 'Meta Title', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_meta_desc', 'Meta Description', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_analytics', 'Google Ananlytics', 'xss_clean|callback_replace_js|trim');
		$this->form_validation->set_rules('txt_contact_mail', 'Site Contact Mail', 'xss_clean|valid_email|trim');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('globalconfig', $this->data);
		}
		else	// valdation success
		{
			if($this->site_config->addEntry($post_data))	// add a new site_config 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Site Configuration', 'body' => 'Site configuration has been added successfully');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Add Site Configuration', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/globalconfig");
		}
	}
	
	
	
	
	// replace <script> tag
	public function replace_js($str)
	{
		return preg_replace('@<script[^>]*?>.*?</script>@si', '', $str); 
	}
}

/* End of file globalconfig.php */
/* Location: ./application/controllers/admin/globalconfig.php */