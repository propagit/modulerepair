<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_model extends CI_Model {
	
	
	
	
	function add($data) {
		$this->db->insert('files',$data);
		return $this->db->insert_id();
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('files');
	}
	
	function all_files() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('files');
		return $query->result_array();		
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('files');
		return $query->first_row('array');
	}
	
	function search($keyword)
	{
		$sql = "select * from files where name like '%$keyword%' or url like '%$keyword%' order by name asc";
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('files',$data);
	}
	
	
	
	
}