<?php
class States extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'states';
    }
    
	
    public function getStateList()
    {
		try
		{
			$state_list = array();
			$this->db->select("id, name")
			->from($this->_table);
			$query = $this->db->get();
			if ($query->num_rows() > 0)
			{
				$result = $query->result();
				foreach($result as $row)
				{
					$state_list[] = array('id' => $row->id, 'name' => $row->name);
				}
			}
			return $state_list;
		}
		catch(Exception $e)
		{
			return false;
		}
    }
}