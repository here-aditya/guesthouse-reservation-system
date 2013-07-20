<?php
class Departments extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'departments';
    }
    
	
    public function getDeptList()
    {
		$dept_list = array();
		$this->db->select("*")
		->from($this->_table); 
		try
		{
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$result = $query->result();
				foreach($result as $row)
				{
					$dept_list[] = array('id' => $row->id, 'name' => $row->name);
				}
			}
			return $dept_list;
		}
		catch(Exception $e)
		{
			return false;
		}
    }
	
	/*
    public function addEntry($post_data)
    {	
		$data = array('post' => trim($post_data['txt_post']), 
					  'dept_id' => trim($post_data['sel_dept']), 
					  'state_id' => trim($post_data['sel_state']), 
					  'city_id' => trim($post_data['sel_city']),
					  'qualification' => trim($post_data['txt_qualfic']),
					  'experience' => trim($post_data['txt_exp']),
					  'job_desc' => trim($post_data['txt_desc'])
					 );
		try
		{
			$this->db->insert($this->_table, $data);
			return $career_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
		   return false;
		} 
    }


	public function updateEntry($post_data)
	{
		$data = array('head' => trim($post_data['txt_pg_head']), 
					  'content' => trim($post_data['txt_pg_content']),
					  'meta_keyword' => trim($post_data['txt_pg_meta_key'])
					 );
					 
		$this->db->select("{$this->_table}.id as pg_id")
								->from($this->_table)
								->join('front_menu', "front_menu.page_id = {$this->_table}.id")
								->where('front_menu.id', $post_data['edit_front_menu_id']);
		try
		{
			$query = $this->db->get();
			$this->db->where('id', $query->row()->pg_id);
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
		$this->db->select("{$this->_table}.id as pg_id")
								->from($this->_table)
								->join('front_menu', "front_menu.page_id = {$this->_table}.id")
								->where('front_menu.id', $id);
		try
		{
			$query = $this->db->get();
			$pg_id = $query->row()->pg_id;
			if($this->db->delete($this->_table, array('id' => $pg_id)))
				return true;
			else
				return false;
		}
		catch(Exception $e)
		{
			return false;
		}
	}*/
}