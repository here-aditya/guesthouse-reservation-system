<?php
class Rooms_reservation extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'rooms_reservation';
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
	
	
	public function getReserveInfoByRoomNo($room_no)
	{
		$this->db->select("{$this->_table}.*")
		->from($this->_table)
		->where("{$this->_table}.room_no", $room_no);
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$book_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$book_list[] = $row;
				}
				return $book_list;
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
	
	
     public function addEntry($room_no, $room_charge, $post_data)
    {
		$data = array('booking_code' => trim($post_data['guest_book_code']), 
					  'bookby_userid' => trim($post_data['guest_usr_id']),
					  'booking_date' => trim($post_data['guest_book_date']),
					  'book_start_date' => trim($post_data['book_from_date']),
					  'book_end_date' => trim($post_data['book_to_date']),
					  'room_no' => trim($room_no),
					  'room_charge' => $room_charge,
					  'guest_name' => trim($post_data['guest_name']),
					  'guest_add1' => trim($post_data['guest_add1']),
					  'guest_add2' => trim($post_data['guest_add2']),
					  'guest_phone' => trim($post_data['guest_phone']),
					  'guest_mobile' => trim($post_data['guest_mobile']),
					  'guest_email' => trim($post_data['guest_email']),
					  'receipt_no' => trim($post_data['guest_rcptno'])
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
	
	
	public function getRoomsUnderBookedId($booking_id)
	{
		$this->db->select("{$this->_table}.room_no")
		->from($this->_table)
		->where("{$this->_table}.booking_code", $booking_id);
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$room_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$room_list[] = $row->room_no;
				}
				return $room_list;
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