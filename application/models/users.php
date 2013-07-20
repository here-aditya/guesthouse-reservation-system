<?php
class Users extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'users';
    }
    
	// get all entries to show in table
    public function getEntries($type = null, $id = null)
    {
		$this->db->select("{$this->_table}.*")
		->from($this->_table);
		! empty($type) ? $this->db->where(array('type' => $type)) : '';
		! empty($id) ? $this->db->where(array('id' => $id)) : '';
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
		$this->db->select("{$this->_table}.*")
		->from($this->_table)
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
	
	
	
	// check duplicate email address registration
	public function checkDuplicateEmail($email)
	{
		$this->db->select("id")
		->from($this->_table)
		->where("email", $email);
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			return true;	// duplicate email
		}
		else
		{
			return false;
		}
	}
	
	
    public function addEntry($post_data)
    {
		$data = array('name' => trim($post_data['txt_name']), 
					  'email' => trim($post_data['txt_email']),
					  'pswd' => trim($post_data['txt_pswd'])
					 );
		try
		{
			if($this->db->insert($this->_table, $data))
			{
				return $career_id = $this->db->insert_id();
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


	public function updateEntry($post_data)
	{
		$data = array('name' => trim($post_data['txt_name']), 
					  'email' => trim($post_data['txt_email']),
					  'pswd' => trim($post_data['txt_pswd'])
					 );
		try
		{
				$this->db->where('id', $post_data['edit_account_id']);
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
	
	
	public function validateLogin($email, $pswd, $status = 'active')
	{
		try 
		{
			$this->db->select('id')
			->from($this->_table)
			->where(array('email' => $email, 'pswd' => $pswd, 'status' => $status));
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				return $query->row()->id;	// duplicate email
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
	
	
	public function setLogInDetails($uid, $cur_time, $cur_ip)
	{
		try
		{
			$this->db->where('id', $uid);
			if($this->db->update($this->_table, array('last_log_time' => $cur_time, 'prev_ip_add' => $cur_ip)))
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
	
	
	public function getUserInfo($uid)
	{
		try 
		{
			$this->db->select('name, type, prev_ip_add, last_log_time')
			->from($this->_table)
			->where('id', $uid);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
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
}