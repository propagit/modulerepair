<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigation_model extends CI_Model {

	/* Menus table */
	
	function get_mainnav()
	{
		
		$query = $this->db->get('menus');				
		return $query->result_array();
	}
	
	function get_detailsubnav($id)
	{
		$this->db->where('parent',$id);
		$query = $this->db->get('menus');				
		return $query->result_array();
	}	
	
	function add($data)
	{
		$this->db->insert('menus',$data);
		return $this->db->insert_id();
	}
	
	function update($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('menus',$data);
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('menus');
	}
	
	function deletelinks($id) {
		$this->db->where('id',$id);
		$this->db->delete('links');
	}
	
	function updatelinks($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('links',$data);
	}
	
	function get_detailnav($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('menus');
		return $query->first_row('array');
	}
	
	
	/* Links Table */
	
	function get_all_links($id)
	{
		$this->db->where('menu_id',$id);
		$this->db->where('parent_id',0);
		$this->db->order_by('order','asc');		
		$query = $this->db->get('links');
		return $query->result_array();
	}
	
	function add_subnav($data)
	{
		$this->db->insert('links',$data);
		return $this->db->insert_id();
	}
	
	function get_sub_detail($parent_id,$menu_id)
	{
		$this->db->where('menu_id',$menu_id);
		$this->db->where('parent_id',$parent_id);		
		$query = $this->db->get('links');
		return $query->result_array();
	}
	
	function get_link_url($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('links');
		$result = $query->first_row('array');
		return $result['url'];
	}
	
	function get_link_page($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('links');
		$result = $query->first_row('array');
		return $result['page'];
	}
	
	function get_menu($id)
	{
		if($id){
			$menu = $this->db->where('id',$id)->get('menus')->row();
			if($menu){
				return $menu;	
			}
		}
		return false;
	}
}