<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cancellation extends MY_Controller {
	/*
	* Controller::Menu for SomanyFoam Admin.
	* Created By Aditya Das, 7-Jan-12
	* Accessed via http://hostname/index.php/admin/menu/menu_name
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder  locations
		$this->data['ErrMsg'] = null;	// keeps the page error message
		$this->load->model('rooms_cancellation');	// load model
		$this->load->model('rooms_reservation');	// load model
		$this->load->model('admin_menu');	// load model
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
	}
	
	
	public function index()
	{
		showPage('cancellation', $this->data);
	}
}

/* End of file cancellation.php */
/* Location: ./application/controllers/admin/cancellation.php */