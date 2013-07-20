<?php
class Feedback extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'feedback';
    }
    
	// get all entries to show in table
    /*public function getEntries()
    {
		$this->db->select("{$this->_table}.*")
		->from($this->_table);
		try
		{
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$config_list = array();
				$result = $query->row();
				foreach($result as $key => $row)
				{
					$config_list[$key] = $row;
				}
				return $config_list;
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
    }*/
	
	
    public function addEntry($post_data)
    {
		$data = array('name' => trim($post_data['txt_name']), 
					  'email' => trim($post_data['txt_email']),
					  'subject' => trim($post_data['txt_subj']),
					  'feedback' => trim($post_data['txt_feedback']),
					  'feedback_time' => date('d-F-y h:i:s A')
					 );
		if($this->db->insert($this->_table, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}