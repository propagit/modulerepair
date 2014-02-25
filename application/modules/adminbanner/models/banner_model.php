<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends CI_Model {
	function add($data) {
		$this->db->insert('banners',$data);
		return $this->db->insert_id();
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('banners');
	}
	
	function all_files() {
		$this->db->order_by('position','asc');
		$query = $this->db->get('banners');
		return $query->result_array();		
	}
	
	function all_files_active() {
		$this->db->where('actived',1);
		$this->db->order_by('position','asc');
		$query = $this->db->get('banners');
		return $query->result_array();		
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		return $query->first_row('array');
	}
	
	function search($keyword)
	{
		$sql = "select * from banners where name like '%$keyword%' or url like '%$keyword%' order by name asc";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('banners',$data);
	}
}