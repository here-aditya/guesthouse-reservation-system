<?php
class Images extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'images';
    }
    
	
	public function getAllImages($selective = null)
	{
		try
		{
			$this->db->select('image_name');
			$this->db->where(array('type' => 'PG'));
			if( ! empty($selective))
			{
				foreach($selective as $id)
				{
					$this->db->where('ref_id =', $id);
				}
			} 
			$query = $this->db->get($this->_table);
			if($query->num_rows() > 0)
			{
				$result = array();
				foreach($row_arr = $query->result() as $row)
				{
					$result[] = $row;
				}
				return $result;
			}
			else
			{
				return array();
			}
        	return $query->result();
		}
		catch(Exception $e)
		{
			return array();
		}
	}
	
	
    public function getImageGallery($ref_id, $type = 'PG')
    {
		try
		{
			$this->db->select('*');
			$this->db->where(array('ref_id' => $ref_id, 'type' => $type)); 
			$query = $this->db->get($this->_table);
			if($query->num_rows() > 0)
			{
				foreach($row_arr = $query->result() as $row)
				{
					$result[] = $row;
				}
				return is_array($result) ? $result : null;
			}
			else
			{
				return null;
			}
        	return $query->result();
		}
		catch(Exception $e)
		{
			return null;
		}
    }
	
	
    public function addEntry($type, $image_name, $post_data, $ref_id = null)
    {
		$ref_id = empty($ref_id) ? $post_data['sel_gallery_menu_id'] : $ref_id;
		$data = array('type' => $type, 
					  'ref_id' => $ref_id, 
					  'image_name	' => $image_name,
					  'title_tag' => isset($post_data['txt_img_title']) ? $post_data['txt_img_title'] : null,
					  'alt_tag' => isset($post_data['txt_img_alt']) ? $post_data['txt_img_alt'] : null,
					 );
		try
		{
			$this->db->insert($this->_table, $data);
			return $menu_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
		   return false;
		}	
    }
	
	
	public function getEntries($id)
	{
		try
		{
			if($this->db->select('*')
			->from($this->_table)
			->where('id', $id))
			{
				$query = $this->db->get();
				return $query->row();
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function updateEntry($type, $image_name, $post_data)
	{
		$data = array(
						'type' => $type,
						'ref_id' => $post_data['sel_gallery_menu_id'],
						'title_tag' => $post_data['txt_img_title'],
						'alt_tag' => $post_data['txt_img_alt']
					);
		$image_name != null ? $data['image_name'] = $image_name : '';
		$this->db->where('id', $post_data['edit_image_id']); 
		try
		{
			$this->db->update($this->_table, $data);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function deleteEntry($id)
	{
		try
		{
			if($this->db->delete($this->_table, array('id' => $id)))
				return true;
			else
				return false;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function changeStatus($img_id)
	{
		try 
		{
			$this->db->select('status')
			->from($this->_table)
			->where('id', $img_id);
			$query = $this->db->get();
			$status = $query->row()->status == 'active' ? 'inactive' : 'active';
			//$this->db->where('id', $img_id);
			if($this->db->update($this->_table, array('status' => $status)))
			{
				return $status;
			}
			else
			{
				return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}
}