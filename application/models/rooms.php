<?php
class Rooms extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'rooms';
    }
    
	// get entries to show in table
    public function getEntries($catg_id = null)
    {
		$this->db->select("{$this->_table}.*")
		->from($this->_table);
		! empty($catg_id) ? $this->db->where("{$this->_table}.room_catg_id = ".$catg_id) : '';
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$rooms_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$rooms_list[] = $row;
				}
				return $rooms_list;
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
	
	
    public function addEntry($post_data)
    {
		$data = array('room_catg_id' => trim($post_data['sel_rooms_catg_id']), 
					  'room_no' => trim($post_data['txt_room_no']),
					  'floor_no' => trim($post_data['sel_floor_no']),
					  'description' => trim($post_data['txt_desc']),
					  'ses_donation' => trim($post_data['txt_donation']),
					  'off_ses_donation' => trim($post_data['txt_donation_off']),
					  'maintenance' => trim($post_data['txt_maint']),
					  'single_bed' => trim($post_data['sel_single_bed']),
					  'double_bed' => trim($post_data['sel_double_bed']),
					  'sofa_cum_bed' => trim($post_data['sel_sofa_bed']),
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
		$data = array('room_no' => trim($post_data['txt_room_no']),
					  'floor_no' => trim($post_data['sel_floor_no']),
					  'description' => trim($post_data['txt_desc']),
					  'ses_donation' => trim($post_data['txt_donation']),
					  'off_ses_donation' => trim($post_data['txt_donation_off']),
					  'maintenance' => trim($post_data['txt_maint']),
					  'single_bed' => trim($post_data['sel_single_bed']),
					  'double_bed' => trim($post_data['sel_double_bed']),
					  'sofa_cum_bed' => trim($post_data['sel_sofa_bed']),
					 );
		try
		{
			$this->db->where('id', $post_data['edit_rooms_id']);
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
	
	
	public function getAllCharges($charge_type)
	{
		try 
		{
			$charge_type == 'sess' ? $this->db->select('room_no, ses_donation, maintenance') : 
									$this->db->select('room_no, off_ses_donation, maintenance');
			$this->db->from($this->_table);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$charge_list = array();
				$result = $query->result();
				foreach($result as $row)
				{
					$charge_list[$row->room_no] = $charge_type == 'sess'? ($row->ses_donation + $row->maintenance) : 
												 						($row->off_ses_donation + $row->maintenance);
				}
				return $charge_list;
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
}