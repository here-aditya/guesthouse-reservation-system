<?php
class Admin_menu extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'admin_menu';
    }
    
	
    public function getEntries()
    {
        $this->db->select('id, menu_name, menu_id, sequence');
		$this->db->order_by("menu_id, sequence"); 
		$query = $this->db->get($this->_table);
        return $query->result();
    }
}
?>