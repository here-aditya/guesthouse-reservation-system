<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
	/*
	* Controller::Pages for SomanyBhawan Frontend.
	* Created By Aditya Das, 30-Jan-12
	* Accessed via http://hostname/index.php/index
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('site_config');					// load site_config module
		$this->load->model('front_menu');					// load front_menu module
		$this->load->model('menu_pages');					// load menu_pages module
		$this->load->model('images');						// load images module
		$this->load->model('feedback');						// load feedback module
		$this->load->model('contact');						// load contact module
		$this->data['RPath'] = base_url() . 'resources/';	// resources folder locations
		$this->data['site'] = $this->site_config->getEntries();	// fetch site configuratio
		$this->data['front_menu'] = $this->front_menu->getEntries();	// fetch site configuratio
	}
	
	
	
	
	public function index($menu = null)
	{
		$sel_menu = ! empty($menu) ? strtolower(str_replace(' ', '', $menu)) : 'home';
		$page_id = 0;
		$page_name = null;
		foreach ($this->data['front_menu'] as $key => $value) {
			if(strtolower(str_replace(' ', '', $value->menu_name))== $sel_menu )
			{
				$page_id = $value->id;
				$page_name = $sel_menu;
				break;
			} 
		}
		
		// fetch page data
		$page_id != 0 ? $this->data['page_data'] = $this->menu_pages->getEntries($page_id) : '';
		// fetch image gallery
		$page_id != 0 && $page_id != 1 ? $this->data['image_gallery'] = $this->images->getImageGallery($page_id) : '';	// id = 1 = home
		
		// invalid menu selection 
		if($page_id == 0)
		{
			$page = 'error_page';
		} 
		else if(@file_exists(APPPATH."views/{$page_name}.php")) // customized view file exists
		{
			$this->_getExtraData($page_id);
			$page = $page_name;
		}
		else {
			$page = 'default';
		}
		
		$this->load->view('header', $this->data);
		$this->load->view($page, $this->data);
		$this->load->view('footer', $this->data);
	}
	
	
	
	
	private function _getExtraData($page_id)
	{
		switch($page_id)
		{
			// rooms front menu
			case 2: $this->load->model('rooms_catg');
					$this->load->model('images');
					$this->data['rooms_catg_details'] = $obj_catg_id = $this->rooms_catg->getEntries();
					$this->data['rooms_pics'] = array();
					foreach($obj_catg_id as $catg_id)
					{
						$this->data['rooms_pics'][] = $this->images->getImageGallery($catg_id->id, 'RM');
					}
					break;
			// reservation front menu
			case 4: $this->data['contact_details'] = $this->contact->getEntries();
					break;
			// excursions front menu
			case 5: $this->load->model('menu_pages');
					$obj_page_id = $this->front_menu->getPageIdUnderMenuId(5);	// menu_id = 5 = EXCURSIONS
					foreach($obj_page_id as $page)
					{
						$this->data['excursion_details'][] = $this->menu_pages->getPageDetails($page->page_id);
					}
					$obj_page_id = $this->front_menu->getPageIdUnderMenuId(20);	// menu_id = 20 = TOURIST POINT
					foreach($obj_page_id as $page)
					{
						$this->data['tour_details'][] = $this->menu_pages->getPageDetails($page->page_id);
					}
					$obj_page_id = $this->front_menu->getPageIdUnderMenuId(19);	// menu_id = 19 = LOCAL ATTRACTIONS
					foreach($obj_page_id as $page)
					{
						$this->data['local_details'][] = $this->menu_pages->getPageDetails($page->page_id);
					}
					break;
			// rate front menu
			case 12: $this->load->model('rooms_catg');
					 $this->data['rooms_catg_details'] = $obj_catg_id = $this->rooms_catg->getEntries();
					 $this->data['sel_catg_id'] = $this->input->post('sel_catg_id');
					 break;
			default: break;
		}
	}
	
	
	
	
	public function getImages()
	{
		$all_images = $this->images->getAllImages(array(1)); // get images from 1 = Home page ...
		$arr_images = array();
		if(is_array($all_images))
		{
			foreach ($all_images as $value) {
				$arr_images[] = $this->data['RPath'] . 'pics/image_gallery/' . $value->image_name;
			}
		}
		echo json_encode($arr_images);
	}
	
	
	
	
	public function sendFeedback()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("index/contactus") : '';
		//	set validation rules
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txt_name', 'Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_email', 'Email', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_subj', 'Subject', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_feedback', 'Feedback / Query', 'required|xss_clean|trim');
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			$this->data['ErrMsg'] = validation_errors();
		}
		else	// valdation success
		{
			if($this->feedback->addEntry($post_data))	// add a new contact 
			{
				if($this->_mailSend($post_data))
				{
					$this->data['frm_validation_err'] = false;
				}
				else 
				{
					$this->data['frm_validation_err'] = true;
					$this->data['ErrMsg'] = 'Mail can not be sent, but your message has been saved.';
				}
			}
			else
			{
				$this->data['frm_validation_err'] = true;
				$this->data['ErrMsg'] = 'Database error occured.';
			}
		}
		echo json_encode($this->data);
	}




	private function _mailSend($post_data)
	{
		$global_config = $this->site_config->getEntries();
		$this->load->library('email');
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'iso-8859-1';
		$this->email->initialize($config);
		$this->email->from(trim($post_data['txt_email']), trim($post_data['txt_name']));
		$this->email->to(trim($global_config['contact_mail']));
		$this->email->subject(trim($post_data['txt_subj']));
		$this->email->message(trim($post_data['txt_feedback']));
		if($this->email->send())
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	
	
	
	public function fetchRoomDetails()
	{
		$catg_id = $this->input->post('catg_id');
		if(empty($catg_id)) 
		{ 
			return false ;
		}
		$this->load->model('rooms');
		$arr_rooms_details = $this->rooms->getEntries($catg_id);
		echo json_encode($arr_rooms_details);
	}
}

/* End of file index.php */
/* Location: ./application/controllers/admin/index.php */