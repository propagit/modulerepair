<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lookup_model extends CI_Model {
	public function search_suburb($keyword,$state)
    {
       if($keyword){
	     $sql = 'select id,name,postcode from suburbs where id != "" and state = '.$state;
	     //postcode like "%'.$keyword.'%" or name like "%'.$keyword.'%"';
	     $order_by = '';
	     if(is_numeric(trim($keyword))){
	              $sql .= ' and postcode like "'.$keyword.'%"';        
	              $order_by = ' order by postcode asc';
	     }else{
	              $sql .= ' and name like "'.$keyword.'%"';
	              $order_by = ' order by name asc';   
	     }
	     $sql .= ' limit 20';
	     $results = $this->db->query($sql)->result();
	     if($results){
	              return $results;
	     }
       }
       return false;
    }
	
	public function search_state($keyword)
    {
       if($keyword){
	     $sql = 'select id,name from state where id != ""';
	     //postcode like "%'.$keyword.'%" or name like "%'.$keyword.'%"';
	     $order_by = '';
	     if(is_numeric(trim($keyword))){
	              $sql .= ' and name like "'.$keyword.'%"';        
	              $order_by = ' order by name asc';
	     }else{
	              $sql .= ' and name like "'.$keyword.'%"';
	              $order_by = ' order by name asc';   
	     }
	     $sql .= ' limit 20';
	     $results = $this->db->query($sql)->result();
	     if($results){
	              return $results;
	     }
       }
       return false;
    }

	public function search_country($keyword)
    {
       if($keyword){
	     $sql = 'select id,name from countries where id != ""';
	     //postcode like "%'.$keyword.'%" or name like "%'.$keyword.'%"';
	     $order_by = '';
	     if(is_numeric(trim($keyword))){
	              $sql .= ' and name like "'.$keyword.'%"';        
	              $order_by = ' order by name asc';
	     }else{
	              $sql .= ' and name like "'.$keyword.'%"';
	              $order_by = ' order by name asc';   
	     }
	     $sql .= ' limit 20';
	     $results = $this->db->query($sql)->result();
	     if($results){
	              return $results;
	     }
       }
       return false;
    }

	function get_suburb($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('suburbs');
		$result = $query->first_row('array'); 
		return $result['name'];
	}
	
	function get_state($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('state');
		$result = $query->first_row('array'); 
		return $result['name'];
	}
	
	function get_country($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('countries');
		$result = $query->first_row('array'); 
		return $result['name'];
	}

	function id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	
	function customer_id($customer_id) {
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
}