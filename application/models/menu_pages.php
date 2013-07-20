<?php
class Menu_pages extends CI_Model {
	
	private $_table;
	
	
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->_table = 'pages';
    }
    
	
    public function getEntries($menu_id = null)
    {
		$this->db->select("front_menu.menu_name, {$this->_table}.*")
		->from($this->_table)
		->join('front_menu', "front_menu.page_id = {$this->_table}.id")
		->where('front_menu.id', $menu_id); 
		try
		{
			$query = $this->db->get();
			return $result = $query->row();
		}
		catch(Exception $e)
		{
			return false;
		}
    }
	
	
    public function addEntry($post_data)
    {
		$data = array('head' => trim($post_data['txt_pg_head']), 
					  'content' => trim($post_data['txt_pg_content']),
					  'meta_keyword' => trim($post_data['txt_pg_meta_key'])
					 );
		isset($post_data['txt_lat']) ? $data['latitude'] = trim($post_data['txt_lat']) : '';
		isset($post_data['txt_long']) ? $data['longitude'] = trim($post_data['txt_long']) : '';
		isset($post_data['txt_zoom']) ? $data['zoom'] = trim($post_data['txt_zoom']) : '';
		try
		{
			$this->db->insert($this->_table, $data);
			return $pg_id = $this->db->insert_id();
		}
		catch(Exception $e)
		{
		   return false;
		} 
    }


	public function updateEntry($post_data)
	{
		$data = array('head' => trim($post_data['txt_pg_head']), 
					  'content' => trim($post_data['txt_pg_content']),
					  'meta_keyword' => trim($post_data['txt_pg_meta_key'])
					 );
		isset($post_data['txt_lat']) ? $data['latitude'] = trim($post_data['txt_lat']) : '';
		isset($post_data['txt_long']) ? $data['longitude'] = trim($post_data['txt_long']) : ''; 
		isset($post_data['txt_zoom']) ? $data['zoom'] = trim($post_data['txt_zoom']) : '';
		$this->db->select("{$this->_table}.id as pg_id")
								->from($this->_table)
								->join('front_menu', "front_menu.page_id = {$this->_table}.id")
								->where('front_menu.id', $post_data['edit_front_menu_id']);
		try
		{
			$query = $this->db->get();
			$this->db->where('id', $query->row()->pg_id);
			if(@$this->db->update($this->_table, $data))
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
		$this->db->select("{$this->_table}.id as pg_id")
								->from($this->_table)
								->join('front_menu', "front_menu.page_id = {$this->_table}.id")
								->where('front_menu.id', $id);
		try
		{
			$query = $this->db->get();
			$pg_id = $query->row()->pg_id;
			if($this->db->delete($this->_table, array('id' => $pg_id)))
				return true;
			else
				return false;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	
	public function getPageDetails($pg_id = null)
    {
		$this->db->select("{$this->_table}.*, images.image_name, front_menu.menu_name")
		->from($this->_table)
		->join('front_menu', "front_menu.page_id = {$this->_table}.id")
		->join('images', "{$this->_table}.id = images.ref_id",  'left')
		->where("{$this->_table}.id", $pg_id);
		try
		{
			$query = $this->db->get();
			return $result = $query->row();
		}
		catch(Exception $e)
		{
			return array();
		}
    }
}