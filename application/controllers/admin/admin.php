<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	/*
	* Controller::Admin for SomanyFoam Admin.
	* Created By Aditya Das, 2-Jan-12
	* Accessed via http://hostname/index.php/admin
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;	// keeps the page error message
		$this->load->model('admin_menu');	// load model
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
	}
	
	
	public function index()
	{
		$instance = & $this;
		showPage('dashboard', $this->data);
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/admin/admin.php */