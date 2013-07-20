<?php
class Rooms_cancellation extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'rooms_cancellation';
    }
    
	
    public function getEntries($reserve_id = null)
    {
		$this->db->select("{$this->_table}.*, users.name as booked_admin")
		->from($this->_table)
		->join('users',"{$this->_table}.bookby_userid = users.id");
		! empty($reserve_id) ? $this->db->where("{$this->_table}.id", $reserve_id) : '';
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$reserve_details = array();
				$result = $query->result();
				foreach($result as $key => $val)
				{
					$reserve_details[$key] = $val;
				}
				return $reserve_details;
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
		$data = array('cancl_req_date' => $post_data['request_date'], 
					  'cancl_requester_id' => $post_data['requester_usr_id'],
					  'booking_id' => $post_data['cancl_booking_id'],
					  'rooms' => implode('|', $post_data['cancl_roomno']),
					 );
		try
		{
			$this->db->insert($this->_table, $data);
			return $book_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
		   return false;
		} 
    }

/*
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
	}*/
}