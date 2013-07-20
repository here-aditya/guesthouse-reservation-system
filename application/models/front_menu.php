<?php
class Front_menu extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'front_menu';
    }
    
	
    public function getEntries()
    {
        $this->db->select('id, menu_name, menu_id, sequence, default, status')
		->order_by("menu_id, sequence");
		try
		{
			$query = $this->db->get($this->_table);
        	return $query->result();
		}
		catch(Exception $e)
		{
			return null;
		}
    }
	
	
    public function addEntry($post_data , $pg_id = null)
    {
		$sequnce = $this->_getMaxSequence($post_data['sel_front_menu_id']) + 1;
		$data = array('menu_name' => strtoupper(trim($post_data['txt_pg_title'])), 
					  'menu_id' => trim($post_data['sel_front_menu_id']), 
					  'page_id' => $pg_id,
					  'sequence' => $sequnce
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
	
	
	private function _getMaxSequence($menu_id = null)
	{
		$this->db->select('MAX(sequence) as sequence')
		->from($this->_table)
		->where('menu_id', $menu_id);
		try
		{ 
			$query = $this->db->get();
			return $query->row()->sequence;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function getPageId($id = null)
	{
		$this->db->select('page_id')
		->from($this->_table)
		->where('id', $id); 
		try
		{
			$query = $this->db->get();
			return $query->row()->page_id;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function updateEntry($post_data)
	{
		$data = array('menu_name' => strtoupper(trim($post_data['txt_pg_title'])));
		$this->db->where('id', $post_data['edit_front_menu_id']); 
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
	
	
	public function checkDefaultMenu($id)
	{
		try
		{
			$this->db->trans_start();
			$this->db->select("default")
			->from($this->_table)
			->where('id', $id);
			$query = $this->db->get();
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				die('here');
			} 
			return $query->row()->default ? true : false;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function getMenuInfo($id)
	{
		try
		{
			if($this->db->select('id, menu_name, menu_id')
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
				//$this->db->last_query();
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
	
	
	public function getPageIdUnderMenuId($menu_id = 0)
	{
		$this->db->select('page_id')
		->from($this->_table)
		->where('menu_id', $menu_id); 
		try
		{
			$query = $this->db->get();
			return $query->result();
		}
		catch(Exception $e)
		{
			return array();
		}
	}
}