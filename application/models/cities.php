<?php
class Cities extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'cities';
    }
    
	
    public function getCityList($state_id = 0)
    {
		try
		{
			$city_list = array();
			$this->db->select("id, name")
			->from($this->_table)
			->where('state_id', $state_id);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$result = $query->result();
				foreach($result as $row)
				{
					$city_list[] = array('id' => $row->id, 'name' => $row->name);
				}
			}
			return $city_list;
		}
		catch(Exception $e)
		{
			return false;
		}
    }
}