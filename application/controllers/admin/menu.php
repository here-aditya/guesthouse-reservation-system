<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {
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
		$this->load->model('admin_menu');	// load model
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
	}
	
	
	public function index($menu_name = null)
	{
		$error = false;
		foreach($this->data['admin_menu'] as $menu)
		{
			$arr_menu_name[] = strtolower(str_replace(' ', '', trim($menu->menu_name)));
		}
		// check if total no. of URL segments == 3 &
		// specified menu name is within admin menu array
		($this->uri->total_segments() != 3) || (! in_array(strtolower($menu_name), $arr_menu_name)) ? $error = true : '';
		if($error)
		{ 
			$this->data['ErrMsg'] = 'Invalid Menu Selection';
			showPage('error_page', $this->data);
		}
		else
		{
			// check if file exists in /views/admin/folder
			if(! @file_exists(APPPATH."views/admin/{$menu_name}.php"))
			{
				$this->data['ErrMsg'] = 'Page Not Found';
				showPage('error_page', $this->data);
			}
			else
			{
				redirect("admin/{$menu_name}");
			}
		}	
	}
}

/* End of file menu.php */
/* Location: ./application/controllers/admin/menu.php */