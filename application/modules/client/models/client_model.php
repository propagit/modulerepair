<?php
class Client_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function get_all_files()
	{
		
		$this->db->order_by('id','desc');
		$query = $this->db->get('files');
		return $query->result_array();
	
	}
	
	function validate($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	
	function get_customer($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
}