<?php
class Rooms_catg extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'rooms_catg';
    }
    
	
    public function getEntries($catg_id = null)
    {
		$rooms_list = array();
		$this->db->select("{$this->_table}.*")
		->from($this->_table);
		! empty($catg_id) ? $this->db->where("{$this->_table}.id", $catg_id) : '';
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$catg_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$catg_list[] = $row;
				}
				return $catg_list;
			}
			else
			{
				return array();
			}
		}
		catch(Exception $e)
		{
			return array();
		}
    }
	
	
    public function addEntry($post_data)
    {
		$data = array('name' => trim($post_data['txt_catg_name']), 
					  'description' => trim($post_data['txt_catg_desc'])
					 );
		try
		{
			$this->db->insert($this->_table, $data);
			return $catg_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
		   return false;
		} 
    }


	public function updateEntry($post_data)
	{
		$data = array('name' => trim($post_data['txt_catg_name']), 
					  'description' => trim($post_data['txt_catg_desc'])
					 );
		try
		{
			$this->db->where('id', $post_data['edit_front_menu_id']);
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
	
	
	public function changeStatus($id)
	{
		try 
		{
			$this->db->select('status')
			->from($this->_table)
			->where('id', $id);
			$query = $this->db->get();
			$status = $query->row()->status == 'active' ? 'inactive' : 'active';
			$this->db->where('id', $id);
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