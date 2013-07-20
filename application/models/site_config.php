<?php
class Site_config extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'site_config';
    }
    
	// get all entries to show in table
    public function getEntries()
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
    }
	
	
    public function addEntry($post_data)
    {
		$data = array('site_title' => trim($post_data['txt_site_title']), 
					  'meta_keyword' => trim($post_data['txt_meta_keyword']),
					  'meta_desc' => trim($post_data['txt_meta_desc']),
					  'google_analytic' => trim($post_data['txt_analytics']),
					  'contact_mail' => trim($post_data['txt_contact_mail'])
					 );
					 
		$this->db->select("{$this->_table}.id")
		->from($this->_table);
		$query = $this->db->get();
		if($query->num_rows() == 0)	// if no of records = 0 , then insert
		{
			$this->db->insert($this->_table, $data);
			return $career_id = $this->db->insert_id();
		}
		else	// if no of records > 0 , then update
		{
			$this->db->where('id', $query->row()->id);
			if($this->db->update($this->_table, $data))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}