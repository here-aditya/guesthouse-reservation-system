<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
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
		$this->load->model('admin_menu');				 // load admin_menu model
		$this->load->model('images');	  			    // load images model
		$this->load->model('rooms');	  		  	   // load rooms model
		$this->load->model('rooms_catg');	  		  // load rooms_catg model
		$this->load->library('form_validation');	 // load form validation library	
		$this->load->library('image_lib');		    // load image library
		$this->load->library('upload');			   // load upload library
		$this->data['admin_menu'] = $this->admin_menu->getEntries();   // admin menu items array
		$this->data['rooms_catg'] = $this->rooms_catg->getEntries();  // rooms_catg items array
		$this->data['RPath'] = base_url() . 'resources/';	     	 // resources folder  locations
		$this->data['ErrMsg'] = null;						    	// keeps the page error message
		$this->data['edit_front_menu_id'] = null;		      	  // edited front menu id
		$this->data['del_front_menu_id'] = null;		     	 // edited front menu id
		$this->data['sel_gallery_menu_id'] = null;	        	// selected menu id for image gallery
		$this->data['edit_image_id'] = null;		       	   // edited image id
		$this->data['del_image_id'] = null;		          	  // deleted image id
		$this->data['img_upload_err'] = null;			 	 // upload image error
		$this->data['sel_rooms_catg_id'] = null;	        	// selected sel_category_id for rooms
		$this->data['edit_rooms_id'] = null;		      	// edited rooms id
		$this->data['del_rooms_id'] = null;		     	   // deleted rooms id
	}
	
	
	
	
	public function index($menu_id = 0)
	{
		showPage('category', $this->data);
	}
	
	
	
	
	// AJAX call to get page details for editing / deleting
	public function fetch()
    {
		$menu_id = $this->input->post('menu_id', TRUE);
		$result = $this->rooms_catg->getEntries($menu_id);
		$json_array = array('rm_title' => $result[0]->name, 
							'rm_desc' => $result[0]->description
							);
		echo json_encode($json_array);
	}
	
	
	
	
	// save data to rooms_catg tables
	public function save()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/category") : '';
		//	set validation rules
		$this->form_validation->set_rules('txt_catg_name', 'Category Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_catg_desc', 'Category Description', 'xss_clean|trim');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['frm_validation_err'] = true;
			showPage('category', $this->data);
		}
		else	// valdation success
		{
			if($this->rooms_catg->addEntry($post_data))	// add a new page 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Create Room Category', 'body' => 'Room category created successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Create Room Category', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/category");	
		}
	}
	
	
	
	
	// update data to rooms_catg tables
	public function update()
	{
		$post_data = $this->input->post(NULL);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/category") : '';
		$this->data['edit_front_menu_id'] = $post_data['edit_front_menu_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_catg_name', 'Category Name', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_catg_desc', 'Category Description', 'xss_clean|trim');
		//	validate form
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['frm_validation_err'] = true;
			showPage('category', $this->data);
		}
		else
		{
			if($this->rooms_catg->updateEntry($post_data))	// update the page 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Room Category', 'body' => 'Room category updated successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Room Category', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/category");
		}
	}
	
	
	
	
	// Delete data from page & front_menu tables
	public function delete()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/pages") : '';
		$this->data['del_front_menu_id'] = $post_data['del_front_menu_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_catg_name', 'Category Name', 'xss_clean');
		$this->form_validation->set_rules('txt_catg_desc', 'Category Description', 'xss_clean');
		//	validate form
		$this->form_validation->run();
		if($this->rooms_catg->deleteEntry($post_data['del_front_menu_id']))
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Room Category', 'body' => ' Room category deleted successfully.');
		}
		else
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Room Category', 'body' => 'Some database error occured.');
		}
		$this->session->set_flashdata($flash_op_stat);
		redirect("admin/category");

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
	/*************************    Image Section      ******************************/
	// create a breadcrumb menu
	public function createBreadCrumb($id, $type = 'room')
	{
		$menu_name = null;
		$arr_menu_info = $this->rooms_catg->getEntries($id);
		if( ! empty($arr_menu_info) )
		{
			$url = site_url('admin/category');
			$menu_name = anchor($url, 'CATEGORY') . ' / ' . strtoupper($arr_menu_info[0]->name);
		}
		return $menu_name;
	}
	
	// Image gallery
	public function imageGallery($menu_id = 0)
	{
		// without selecting category
		$menu_id == 0 ? redirect("admin/category") : '';
		$this->data['gallery_images'] = $this->images->getImageGallery($menu_id, 'RM');  // gallery images array for menu
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
						if($this->images->addEntry($type = 'RM', $uploaded_image_name, $post_data))	// add a new menu
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
				redirect("admin/category/imageGallery/{$menu_id}");
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
				if($this->images->updateEntry($type = 'RM', $uploaded_image_name = null, $post_data))
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Image updated successfully.');
				}
				else
				{
					$flash_op_stat['flash_op_stat'] = array('head' =>'Update Image', 'body' => 'Some database error occured.');
				}
				$this->data['gallery_images'] = $this->images->getImageGallery($menu_id);  // gallery images array for menu
				$this->session->set_flashdata($flash_op_stat);
				redirect("admin/category/imageGallery/{$menu_id}");
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
							if($this->images->updateEntry($type = 'RM', $uploaded_image_name, $post_data))
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
					redirect("admin/category/imageGallery/{$menu_id}");
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
		redirect("admin/category/imageGallery/{$menu_id}");
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
						if($this->images->addEntry($type = 'RM', $uploaded_image_name, $post_data))	// add a new image
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
			redirect("admin/category/imageGallery/{$menu_id}");
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
		if($result = $this->rooms_catg->changeStatus($img_id))
		{
			$json_array = array('cur_stat' => $result);
			echo json_encode($json_array);
		}
	}
	
	
	
	
	/*******************************************************************************/
	/*************************    Rooms Section      ******************************/
	public function rooms($catg_id = 0)
	{
		if($catg_id == 0)
		{
			redirect("admin/category");
			return ;
		}
		$this->data['sel_rooms_catg_id'] = $catg_id;
		$this->data['rooms_catg_details'] = $this->rooms_catg->getEntries($catg_id); 
		$this->data['rooms_list'] = $this->rooms->getEntries($catg_id); 
		showPage('rooms', $this->data);
	}
	
	
	
	// save room under a category
	public function saveRoom()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/category") : '';
		$this->data['sel_rooms_catg_id'] = $post_data['sel_rooms_catg_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_room_no', 'Room No.', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_floor_no', 'Floor No.', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_donation', 'Donation', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_donation_off', 'Donation (Off)', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_maint', 'Maintenance', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_single_bed', 'Single Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_double_bed', 'Double Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_sofa_bed', 'Sofa cum Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_desc', 'Room Description', 'xss_clean|trim');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['rooms_catg_details'] = $this->rooms_catg->getEntries($this->data['sel_rooms_catg_id']); 
			$this->data['frm_validation_err'] = true;
			showPage('rooms', $this->data);
		}
		else	// valdation success
		{
			if($this->rooms->addEntry($post_data))	// add a new page 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Create Room', 'body' => 'Room created successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Create Room', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/category/rooms/{$this->data['sel_rooms_catg_id']}");	
		}
	}
	
	
	
	
	// update a room
	public function updateRoom()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/category") : '';
		$this->data['sel_rooms_catg_id'] = $post_data['sel_rooms_catg_id'];
		$this->data['edit_rooms_id'] = $post_data['edit_rooms_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_room_no', 'Room No.', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_floor_no', 'Floor No.', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_donation', 'Donation', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_donation_off', 'Donation (Off)', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_maint', 'Maintenance', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_single_bed', 'Single Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_double_bed', 'Double Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('sel_sofa_bed', 'Sofa cum Bed', 'required|xss_clean|trim');
		$this->form_validation->set_rules('txt_desc', 'Room Description', 'xss_clean|trim');
		//	validate form
		if ($this->form_validation->run() == FALSE)	// validation failure
		{
			$this->data['rooms_catg_details'] = $this->rooms_catg->getEntries($this->data['sel_rooms_catg_id']); 
			$this->data['frm_validation_err'] = true;
			showPage('rooms', $this->data);
		}
		else	// valdation success
		{
			if($this->rooms->updateEntry($post_data))	// add a new page 
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Room', 'body' => 'Room updated successfully.');
			}
			else
			{
				$flash_op_stat['flash_op_stat'] = array('head' =>'Update Room', 'body' => 'Some database error occured.');
			}
			$this->session->set_flashdata($flash_op_stat);
			redirect("admin/category/rooms/{$this->data['sel_rooms_catg_id']}");	
		}
	}
	
	
	
	
	// delete a room
	public function deleteRoom()
	{
		$post_data = $this->input->post(NULL, TRUE);	// get all post data & do XSS clean
		// without submiting form will return to menu
		empty($post_data) ? redirect("admin/category") : '';
		$this->data['sel_rooms_catg_id'] = $post_data['sel_rooms_catg_id'];
		$this->data['edit_rooms_id'] = $post_data['edit_rooms_id'];
		$this->data['del_rooms_id'] = $post_data['edit_rooms_id'];
		//	set validation rules
		$this->form_validation->set_rules('txt_room_no', 'Room No.', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_floor_no', 'Floor No.', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_donation', 'Donation', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_donation_off', 'Donation (Off)', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_maint', 'Maintenance', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_single_bed', 'Single Bed', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_double_bed', 'Double Bed', 'xss_clean|trim');
		$this->form_validation->set_rules('sel_sofa_bed', 'Sofa cum Bed', 'xss_clean|trim');
		$this->form_validation->set_rules('txt_desc', 'Room Description', 'xss_clean|trim');
		//	validate form
		$this->form_validation->run();
		if($this->rooms->deleteEntry($post_data['del_rooms_id']))	// delete a room
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Room', 'body' => 'Room deleted successfully.');
		}
		else
		{
			$flash_op_stat['flash_op_stat'] = array('head' =>'Delete Room', 'body' => 'Some database error occured.');
		}
		$this->session->set_flashdata($flash_op_stat);
		redirect("admin/category/rooms/{$this->data['sel_rooms_catg_id']}");	
	}
	
	
	
	
	// Change room status
	public function changeRoomsStatus()
	{
		$room_id = $this->input->post('rooms_id', TRUE);
		if($result = $this->rooms->changeStatus($room_id))
		{
			$json_array = array('cur_stat' => $result);
			echo json_encode($json_array);
		}
	}
	
	
	
	
	// AJAX call to get rooms details for editing / deleting
	public function fetchRooms()
    {
		$menu_id = $this->input->post('room_id', TRUE); 
		$result = $this->rooms->fetchEntry($menu_id);
		$json_array = array('room_no' => $result->room_no, 
							'floor_no' => $result->floor_no,
							'description' => $result->description,
							'ses_donation' => $result->ses_donation,
							'off_ses_donation' => $result->off_ses_donation,
							'maintenance' => $result->maintenance,
							'single_bed' => $result->single_bed,
							'double_bed' => $result->double_bed,
							'sofa_cum_bed' => $result->sofa_cum_bed
							);
		echo json_encode($json_array);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/admin/pages.php */