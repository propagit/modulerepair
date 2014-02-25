<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Googlestats_model extends CI_Model {
	
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('webstat');
		return $query->first_row('array');
	}
	
	
	
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('webstat',$data);
	}
}