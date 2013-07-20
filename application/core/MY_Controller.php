<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	 /**
	 * Controller
	 * 
	 * Extends CodeIgniters native Controller class to add support for 
	 * user login status & redirection accordingly
	 *
	 * @package		CodeIgniter
	 * @subpackage	Core
	 * @category	Controller
	 */
	 
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Calcutta');
		$this->_isLoggedIn();
	}
	
	
	
	
	private function _isLoggedIn() 
	{
		if(strtolower($this->uri->segment(1)) == 'admin')
		{
			if( ! $this->session->userdata('logged_in'))
			{
				strtolower($this->uri->segment(2)) != 'login' ? redirect('admin/login') : '';
			}
			else if(strtolower($this->uri->segment(2) == 'login'))
			{
				if(strtolower($this->uri->segment(3) != 'logout'))
				{
					redirect('admin/admin');
				}
			}
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */