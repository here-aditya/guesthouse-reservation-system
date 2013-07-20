<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	/*
	* Controller::Pages for SomanyFoam Admin.
	* Created By Aditya Das, 7-Jan-12
	* Accessed via http://hostname/index.php/admin/pages
	*/
	private $RPath;
	private $data = array();
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin_menu');				// load admin_menu model
		$this->load->model('images');	  			   // load image model
		$this->load->model('menu_pages');	  		  // load menu_pages model
		$this->load->model('front_menu');			 // load front_menu model
		$this->load->library('form_validation');	// load form validation library	
		$this->load->library('image_lib');		   // load image library
		$this->load->library('upload');			  // load upload library
		$this->data['admin_menu'] = $this->admin_menu->getEntries();	// admin menu items array
		$this->data['front_menu'] = $this->front_menu->getEntries();  // front menu items array
		$this->data['RPath'] = base_url() . 'resources/';	     // resources folder  locations
		$this->data['ErrMsg'] = null;						    // keeps the page error message
		$this->data['sel_front_menu_id'] = null;			   // selected front menu id 
		$this->data['edit_front_menu_id'] = null;		      // edited front menu id
		$this->data['del_front_menu_id'] = null;		     // edited front menu id
		$this->data['sel_gallery_menu_id'] = null;	        // selected menu id for image gallery
		$this->data['edit_image_id'] = null;		       // edited image id
		$this->data['del_image_id'] = null;		          // deleted image id
		$this->data['img_upload_err'] = null;			 // upload image error
	}
	
	
	
	
	public function index($menu_id = 0)
	{
		$this->data['sel_front_menu_id'] = $menu_id;	// selected menu Id
		$this->data['menu_bread_crumb'] = $menu_id > 0 ? $this->createBreadCrumb($menu_id) : null;	// create bread crumb
		showPage('pages', $this->data);
	}
	
	
	
	
	/* create a breadcrumb menu */
	public function createBreadCrumb($id, $type = 'menu')
	{
		$instance_name = & get_instance();
		$menu_name = null;
		while($id > 0)
		{
			if($arr_menu_info = $this->front_menu->getMenuInfo($id))
			{
				$url = $type == 'menu' ?  site_url('admin/pages/'.$arr_menu_info->id) : site_url('admin/pages/imageGallery/'.$arr_menu_info->id);
				$menu_name = anchor($url, $arr_menu_info->menu_name) . ' / ' . $menu_name;
				$id = $arr_menu_info->menu_id;
			}
			else
			{
				break;
			}
		}
		return substr_replace($menu_name, "", -3);
	}
	
	
	
	
	// AJAX call to get page details for editing / deleting
	public function fetch()
    {
		$menu_id = $this->input->post('menu_id', TRUE);
		$result = $this->menu_pages->getEntries($menu_id);
		$json_array = array('pg_title' => $result->menu_name, 
							'pg_head' => $result->head, 
							'pg_content' => $result->content,
							'pg_meta' => $result->meta_keyword,
							'pg_latitude' => $result->latitude,
							'pg_longitude' => $result->longitude,
							'pg_zoom' => $result->zoom
							);
		echo json_encode($json_array);
	}
	
	
	
	
	// save data to page & front_menu tables
	public function save()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$this->data['sel_front_menu_id'] = $post_data['sel_front_menu_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_pg_title', 'Menu / Page Title', 'required|callback_alphaSpace|callback_duplicateMenuCheck');
		$this->form_validation->set_rules('txt_pg_head', 'Page Heading', 'xss_clean');
		$this->form_validation->set_rules('txt_pg_content', 'Page Content', 'xss_clean');
		$this->form_validation->set_rules('txt_pg_meta_key', 'Meta Keywords', 'xss_clean');
		$this->form_validation->set_rules('txt_lat', 'Latitude', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_long', 'Longitude', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_zoom', 'Zoom', 'xss_clean|trim');
		$this->form_validation->set_message('alphaSpace', 'Only alphabet and space is allowed');
		$this->form_validation->set_message('duplicateMenuCheck', 'This menu already exist');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('pages', $this->data);
		}
		else	// valdation success
		{
			$this->db->trans_begin();	// begin transaction
			if($pg_id = $this->menu_pages->addEntry($post_data))	// add a new page 
			{
				if($this->front_menu->addEntry($post_data, $pg_id))	// add a new menu
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Create Page', 'body' => 'Menu / Page created successfully.');
					$this->db->trans_commit();	// commit transaction
				}
				else
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Create Page', 'body' => 'Some database error occured.');
					$this->db->trans_rollback();	// rollback transaction
				}
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Create Page', 'body' => 'Some database error occured.');
				$this->db->trans_rollback();	// rollback transaction
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/pages/{$this->data['sel_front_menu_id']}");	
		}
	}
	
	
	
	
	// update data to page & front_menu tables
	public function update()
	{
		$post_data = $this->input->post(NULL);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$this->data['sel_front_menu_id'] = $post_data['sel_front_menu_id'];
		$this->data['edit_front_menu_id'] = $post_data['edit_front_menu_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_pg_title', 'Menu / Page Title', 'required|callback_alpha_space|callback_duplicateMenuEditCheck|trim');
		$this->form_validation->set_rules('txt_pg_head', 'Page Heading', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_pg_content', 'Page Content', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_pg_meta_key', 'Meta Keywords', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_lat', 'Latitude', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_long', 'Longitude', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_zoom', 'Zoom', 'xss_clean|trim');
		$this->form_validation->set_message('alphaSpace', 'Only alphabet and space is allowed');
		$this->form_validation->set_message('duplicateMenuCheck', 'This menu already exist');
		$this->form_validation->set_message('duplicateMenuEditCheck', 'This menu already exist');
		//	validate form
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['frm_validation_err'] = true;
			showPage('pages', $this->data);
		}
		else
		{
			$this->db->trans_begin();			 			 // begin transaction
			if($this->menu_pages->updateEntry($post_data))	// update the page 
			{
				if($this->front_menu->updateEntry($post_data)) // update the menu
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Page', 'body' => 'Menu / Page updated successfully.');
					$this->db->trans_commit();				// commit transaction
				}
				else
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Page', 'body' => 'Some database error occured.');
					$this->db->trans_rollback();			// rollback transaction
				}
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Page', 'body' => 'Some database error occured.');
				$this->db->trans_rollback();				// rollback transaction
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/pages/{$this->data['sel_front_menu_id']}");
		}
	}
	
	
	
	
	// Delete data from page & front_menu tables
	public function delete()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$this->data['sel_front_menu_id'] = $post_data['sel_front_menu_id'];
		$this->data['del_front_menu_id'] = $post_data['del_front_menu_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_pg_title', '', '');
		$this->form_validation->set_rules('txt_pg_head', '', '');
		$this->form_validation->set_rules('txt_pg_content', '', '');
		$this->form_validation->set_rules('txt_pg_meta_key', '', '');
		//	validate form
		$this->form_validation->run();
		//	restrict default menu deletion
		if ($this->front_menu->checkDefaultMenu($post_data['del_front_menu_id']))
		{
			$this->data['frm_validation_err'] = true;
			$this->data['ErrMsg'] = 'Default Menus can not be deleted.';
			showPage('pages', $this->data);
		}
		else
		{
			if($this->menu_pages->deleteEntry($post_data['del_front_menu_id']))
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Page', 'body' => 'Menu / Page deleted successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Page', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/pages/{$this->data['sel_front_menu_id']}");
		}
	}
	
	
	
	
	// check other than space & alphabetic characters
	public function alphaSpace($str)
	{
		return ! preg_match("/^([a-z ])+$/i", $str) ? false : true;
	}
	
	
	
	
	// check for duplicate menu name
	public function duplicateMenuCheck($str)
	{
		foreach($this->data['front_menu'] as $menu)
		{
			if($menu->menu_name == strtoupper(trim($str)) )
			{ 
				return false;
			}
		}
		return true;
	}
	
	
	
	
	// check for duplicate menu name other than edited menu name
	public function duplicateMenuEditCheck($str)
	{
		$edit_menu = $this->front_menu->getMenuInfo($this->data['edit_front_menu_id'])->menu_name;
		foreach($this->data['front_menu'] as $menu)
		{
			if($menu->menu_name == strtoupper(trim($str)) && $edit_menu != strtoupper(trim($str)))
			{ 
				return false;
			}
		}
		return true;
	}
	
	
	
	
	/*******************************************************************************/
	// Image gallery
	public function imageGallery($menu_id = 0)
	{
		$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
		$this->data['menu_bread_crumb'] = $menu_id > 0 ? $this->createBreadCrumb($menu_id) : null;	// create bread crumb
		$this->data['sel_gallery_menu_id'] = $menu_id;	  // selected menu id for image gallery
		showPage('image_gallery', $this->data);
	}
	
	
	
	
	// save data to page & front_menu tables
	public function saveImage()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$menu_id = $this->data['sel_gallery_menu_id'] = $post_data['sel_gallery_menu_id'];
		$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // front menu items array
		//	set validation rules
		$this->form_validation->set_rules('txt_img_sel', 'Selected Image', 'xss_clean');
		$this->form_validation->set_rules('txt_img_title', 'Image Title', 'xss_clean');
		$this->form_validation->set_rules('txt_img_alt', 'Image Title', 'xss_clean');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('image_gallery', $this->data);
		}
		else	// valdation success
		{
			if( $uploaded_image_name = $this->_uploadImage('txt_img_sel'))	// upload the image to server space
			{
				if($this->_resizeImage($uploaded_image_name, 1024, 768, true) )
				{
					if($this->_resizeImage($uploaded_image_name, 60, 80, true) )
					{
						// ass image to database
						if($this->images->addEntry($type = 'PG', $uploaded_image_name, $post_data))	// add a new menu
						{
							$flash_op_stat['flash_op_stat'] = array('head' =>'Add Image', 'body' => 'Image added successfully.');
						}
						else
						{
							$flash_op_stat['flash_op_stat'] = array('head' =>'Add Image', 'body' => 'Some database error occured.');
						}
					}
					else	// thumbnail creation fails, delete uploaded image
					{
						unlink('resources/pics/image_gallery'.$uploaded_image_name);
						$flash_op_stat['flash_op_stat'] = array('head' =>'Add Image', 'body' => 'Thumbnail can\'t be created, operation failed.');
					}
				}
				else	// image resize fails, delete uploaded image 
				{
					unlink('resources/pics/image_gallery'.$uploaded_image_name);
					$flash_op_stat['flash_op_stat'] = array('head' =>'Add Image', 'body' => 'Image can\'t be resized, operation failed.');
				}
				$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
				$this->session->set_flashdata($flash_op_stat);
				redirect("admin/pages/imageGallery/{$menu_id}");
			}
			else
			{
				$this->data['frm_validation_err'] = true;
				$this->data['ErrMsg'] = $this->upload->display_errors();
				showPage('image_gallery', $this->data);
			}
		}
	}
	
	
	
	
	// save data to page & front_menu tables
	public function updateImage()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$menu_id = $this->data['sel_gallery_menu_id'] = $post_data['sel_gallery_menu_id'];
		$image_id = $this->data['edit_image_id'] = $post_data['edit_image_id'];
		$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // front menu items array
		//	set validation rules
		$this->form_validation->set_rules('txt_img_sel', 'Selected Image', 'xss_clean');
		$this->form_validation->set_rules('txt_img_title', 'Image Title', 'xss_clean');
		$this->form_validation->set_rules('txt_img_alt', 'Image Title', 'xss_clean');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('image_gallery', $this->data);
		}
		else	// valdation success
		{
			// if file name empty then update other fields only
			if(empty($_FILES['txt_img_sel']['name']))
			{
				if($this->images->updateEntry($type = 'PG', $uploaded_image_name = null, $post_data))
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Image updated successfully.');
				}
				else
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Some database error occured.');
				}
				$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
				$this->session->set_flashdata($flash_op_stat);
				redirect("admin/pages/imageGallery/{$menu_id}");
			}
			else
			{
				if( $uploaded_image_name = $this->_uploadImage('txt_img_sel'))	// upload the image to server space
				{
					if($this->_resizeImage($uploaded_image_name, 1024, 768, true) )	// resize image as required
					{
						if($this->_resizeImage($uploaded_image_name, 60, 80, true) )	// create thumb
						{
							// delete previous image
							$this->_deletePrevImage($image_id);
							// update new image to database
							if($this->images->updateEntry($type = 'PG', $uploaded_image_name, $post_data))
							{
								$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Image updated successfully.');
							}
							else
							{
								$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Some database error occured.');
							}
						}
						else	// thumbnail creation fails, delete uploaded image
						{
							unlink('resources/pics/image_gallery/'.$uploaded_image_name);
							$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Thumbnail can\'t be created, operation failed.');
						}
					}
					else	// image resize fails, delete uploaded image 
					{
						unlink('resources/pics/image_gallery/'.$uploaded_image_name);
						$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Image can\'t be resized, operation failed.');
					}
					$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
					$this->session->set_flashdata($flash_op_stat);
					redirect("admin/pages/imageGallery/{$menu_id}");
				}
				else
				{
					$this->data['frm_validation_err'] = true;
					$this->data['ErrMsg'] = $this->upload->display_errors();
					showPage('image_gallery', $this->data);
				}
			}
		}
	}
	
	
	
	
	// Delete data from page & front_menu tables
	public function deleteImage()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$menu_id = $post_data['sel_gallery_menu_id'];
		$image_id = $post_data['del_image_id'];
		// delete previous images
		$this->_deletePrevImage($image_id);
		// delete record from database
		if($this->images->deleteEntry($image_id))
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Image', 'body' => 'Image deleted successfully.');
		}
		else
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Image', 'body' => 'Some database error occured.');
		}
		$this->session->set_flashdata($flash_op_stat);
		redirect("admin/pages/imageGallery/{$menu_id}");
	}
	
	
	
	
	// Multiple save image
	public function saveMultiImage()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$menu_id = $this->data['sel_gallery_menu_id'] = $post_data['sel_gallery_menu_id'];
		$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // front menu items array
		$empty = true;
		foreach($_FILES['multi_img_sel']['name'] as $key => $f_name)	// check for all empty fields
		{ 
			if( ! empty($f_name))
			{
				$empty = false;
				break;
			}
		}
		if($empty)
		{
			$this->data['frm_validation_err'] = true;
			$this->data['ErrMsg'] = 'No Image Selected';
			$this->data['tab_sel'] = 'multi';
			showPage('image_gallery', $this->data);
		}
		$arr_uploaded_image = $this->_uploadMultipleImage('multi_img_sel');	// upload the image to server space
		$err = $this->data['img_upload_err'];
		$success = array();
		if( ! empty($arr_uploaded_image))
		{
			foreach($arr_uploaded_image as $uploaded_image_name)
			{
				if($this->_resizeImage($uploaded_image_name, 1024, 768, true) )	// resize image as desired
				{
					if($this->_resizeImage($uploaded_image_name, 60, 80, true) )	// create thumb
					{
						// save image to database
						if($this->images->addEntry($type = 'PG', $uploaded_image_name, $post_data))	// add a new menu
						{
							$success[] = $uploaded_image_name;
						}
						else
						{
							! in_array($uploaded_image_name, $err) ? $err[] = $uploaded_image_name." (Reason: Database error)" : '';
							unlink('resources/pics/image_gallery/'.$uploaded_image_name);
						}
					}
					else	// thumbnail creation fails, delete uploaded image
					{
						! in_array($uploaded_image_name, $err) ? $err[] = $uploaded_image_name." (Reason: Thumbnail can't be created)" : '';
						unlink('resources/pics/image_gallery/'.$uploaded_image_name);
					}
				}
				else
				{
					! in_array($uploaded_image_name, $err) ? $err[] = $uploaded_image_name." (Reason: Image resize fails)" : '';
					unlink('resources/pics/image_gallery/'.$uploaded_image_name);
				}
			}
		}
		else
		{
			$err[] = " (Reason: ".$this->upload->display_errors().")";
		}
		if( ! empty($err))	// back to same page due to error
		{
			$this->data['frm_validation_err'] = true;
			$this->data['ErrMsg'] = "Following files can't be uploaded -<p>".implode(', ',$err)."</p>";
			if( ! empty($success))
			{
				$this->data['SuccMsg'] = "Following files added successfully -<p>";
				foreach($success as $img)
				{
					$img_name = explode('.', $img);
                    $thumb_name = $this->data['RPath'].'pics/image_gallery/'.$img_name[0].'_thumb'.'.'.$img_name[1];
					$this->data['SuccMsg'] .= '<img src="'.$thumb_name.'" alt="" class="img-rounded thumbnail" />';
				}
				$this->data['SuccMsg'] .= "</p>";
			}
			$this->data['tab_sel'] = 'multi';
			$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // front menu items array
			showPage('image_gallery', $this->data);
		}
		else
		{
			$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
			$flash_op_stat['flash_op_stat'] = array('head' =>'Add Multiple Images', 'body' => 'All images added successfully.');
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/pages/imageGallery/{$menu_id}");
		}
	}
	
	
	
	
	// delete physical image
	private function _deletePrevImage($image_id)
	{
		$image_name = $this->images->getEntries($image_id)->image_name;
		if( ! empty($image_name))
		{
			$img_name_arr = explode('.', $image_name);
			$thumb_loc = 'resources/pics/image_gallery/'.$img_name_arr[0].'_thumb'.'.'.$img_name_arr[1]; 
			$image_loc = 'resources/pics/image_gallery/'.$image_name;
			@unlink($image_loc);
			@unlink($thumb_loc);
		}
	}
	
	
	
	
	// upload the image to physical server location
	private function _uploadImage($img_sel)
	{
		$upload_path = 'resources/pics/image_gallery';
		! is_dir($upload_path) ? mkdir($upload_path, 0777) : '';
		$config['upload_path'] = "{$upload_path}/";
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2048';
		/*$config['max_width']  = '1024';
		$config['max_height']  = '768';*/
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload($img_sel))
		{
			return false;
		}
		else
		{
			$data = $this->upload->data();
			return $data['file_name'];
		}
	}
	
	
	
	
	// resize image to desired size
	private function _resizeImage($img_name, $height, $width, $thumb )
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'resources/pics/image_gallery/'.$img_name;
		if($thumb)
		{
			$config['create_thumb'] = true;
			$config['maintain_ratio'] = false;
		}
		else
		{
			$config['create_thumb'] = false;
			$config['maintain_ratio'] = true;
		}
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);
		return $this->image_lib->resize() ? true : false;
	}
	
	
	
	
	// upload multiple imagse to physical server location
	private function _uploadMultipleImage($img_sel)
	{
		$upload_path = 'resources/pics/image_gallery';
		! is_dir($upload_path) ? mkdir($upload_path, 0777) : '';
		$config['upload_path'] = "{$upload_path}/";
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '2048';
		/*$config['max_width']  = '1024';
		$config['max_height']  = '768';*/
		$this->upload->initialize($config);
		$arr_file_name = array();
		$this->data['img_upload_err'] = $this->upload->do_multi_upload($img_sel);
		$uploaded_data = $this->upload->get_multi_upload_data();
		foreach($uploaded_data as $data)
		{
			$arr_file_name[] = $data['file_name'];
		}	
		return $arr_file_name;
	}
	
	
	
	
	// AJAX call to get image details for editing / deleting
	public function fetchImage()
    {
		$img_id = $this->input->post('img_id', TRUE);
		if( ! empty($img_id))
		{
			if($result = $this->images->getEntries($img_id))
			{
				$json_array = array('img_name' => $this->data['RPath'].'pics/image_gallery/'.$result->image_name, 
									'img_title' => $result->title_tag, 
									'img_alt' => $result->alt_tag
									);
				echo json_encode($json_array);
			}
		}
	}
	
	
	
	
	// Change image status
	public function changeImageStatus()
	{
		$img_id = $this->input->post('img_id', TRUE);
		if($result = $this->front_menu->changeStatus($img_id))
		{
			$json_array = array('cur_stat' => $result);
			echo json_encode($json_array);
		}
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/admin/pages.php */