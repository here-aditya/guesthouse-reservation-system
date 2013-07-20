<?php
class Careers extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'careers';
    }
    
	// get all entries to show in table
    public function getEntries()
    {
		$this->db->select("{$this->_table}.id,
							{$this->_table}.post, 
							{$this->_table}.qualification, 
							{$this->_table}.experience, 
							{$this->_table}.status,
							states.name as state,
							cities.name as city, 
							departments.name as department"
						)
		->from($this->_table)
		->join('cities', "{$this->_table}.city_id = cities.id")
		->join('states', "cities.state_id = states.id")
		->join('departments', "{$this->_table}.dept_id = departments.id");
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$career_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$career_list[] = $row;
				}
				return $career_list;
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
	
	
	// fetch one entry
	public function fetchEntry($id)
	{
		$this->db->select("{$this->_table}.post, 
							{$this->_table}.qualification, 
							{$this->_table}.experience,
							{$this->_table}.city_id,
							{$this->_table}.dept_id,
							{$this->_table}.job_desc,
							states.id as state_id"
						)
		->from($this->_table)
		->join('cities', "{$this->_table}.city_id = cities.id")
		->join('states', "cities.state_id = states.id")
		->where("{$this->_table}.id", $id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			return $result;
		}
		else
		{
			return array();
		}
	}
	
	
    public function addEntry($post_data)
    {	
		$data = array('post' => trim($post_data['txt_post']), 
					  'dept_id' => trim($post_data['sel_dept']),
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
		$data = array('post' => trim($post_data['txt_post']), 
					  'dept_id' => trim($post_data['sel_dept']),
					  'city_id' => trim($post_data['sel_city']),
					  'qualification' => trim($post_data['txt_qualfic']),
					  'experience' => trim($post_data['txt_exp']),
					  'job_desc' => trim($post_data['txt_desc'])
					 );
		try
		{
				$this->db->where('id', $post_data['edit_career_id']);
				if($this->db->update($this->_table, $data))
				{
					return true;
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
	
	
	public function deleteEntry($id)
	{
		try
		{
			if($this->db->delete($this->_table, array('id' => $id)))
			{
				return true;
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
			//$this->db->where('id', $id);
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