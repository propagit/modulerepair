<?php
class Nav_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	
	
	function all() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('menus');
		return $query->result_array();
	}
	
	function get_all_links($id)
	{
		$this->db->where('menu_id',$id);
		$this->db->where('parent_id',0);
		$this->db->order_by('order','asc');			
		$query = $this->db->get('links');
		return $query->result_array();
	}
	
	function get_all_categories()
	{
		$this->db->where('active',1);		
		$this->db->order_by('id','asc');
		$query = $this->db->get('category_products');
		return $query->result_array();
	}
	
	function get_page_id_title_by_id($id)
	{
		$page = $this->db->where('id',$id)->get('pages')->first_row('array');
		
			return $page['id_title'];	
		
	}
}
?>