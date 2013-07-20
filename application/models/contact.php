<?php
class Contact extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'contact';
    }
    
	// get all entries to show in table
    public function getEntries()
    {
		$this->db->select("{$this->_table}.*, 
							states.name as state,
							cities.name as city")
		->from($this->_table)
		->join('cities', "{$this->_table}.city_id = cities.id")
		->join('states', "cities.state_id = states.id");
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
		$this->db->select("{$this->_table}.*, states.id as state_id")
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
		$data = array('name' => trim($post_data['txt_name']),
					  'address' => trim($post_data['txt_address']),
					  'phone' => trim($post_data['txt_phone']),
					  'fax' => trim($post_data['txt_fax']),
					  'phone' => trim($post_data['txt_phone']),
					  'mobile' => trim($post_data['txt_mobile']),
					  'email' => trim($post_data['txt_email']),
					  'city_id' => $post_data['sel_city']
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
		$data = array('city_id' => trim($post_data['sel_city']), 
					  'name' => trim($post_data['txt_name']),
					  'address' => trim($post_data['txt_address']),
					  'phone' => trim($post_data['txt_phone']),
					  'fax' => trim($post_data['txt_fax']),
					  'phone' => trim($post_data['txt_phone']),
					  'mobile' => trim($post_data['txt_mobile']),
					  'email' => trim($post_data['txt_email'])
					 );
		try
		{
				$this->db->where('id', $post_data['edit_contact_id']);
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