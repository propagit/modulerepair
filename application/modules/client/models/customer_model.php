<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function add($data) {
		$this->db->insert('customers',$data);
		return $this->db->insert_id();
	}
	
	function identify_membership_status($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('membership');
		return $query->first_row('array');
	}
	
	function all_membership() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('membership');
		return $query->result_array();
	}
	
	function identify_by_email($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	
	function recognize($email) {
		$this->db->where('email',$email);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function validate($username,$password) {
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('deleted',0);
		$query = $this->db->get('customers');
		return $query->first_row('array');
	}
	function last($limit) {
		$sql = "SELECT a.*, b.level, b.id as `u_id`
				FROM `customers` a, `users` b 
				where a.id = b.customer_id
				order by `id` desc
				limit $limit";
		
		$query = $this->db->query($sql);
			return $query->result_array();
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('customers',$data);
	}
	function all_byid() {
		$this->db->order_by('id','asc');
		$this->db->where('deleted',0);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function get_updated_customer_trade() {
		$this->db->order_by('id','asc');
		$this->db->where('dealer',1);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function get_updated_customer_retailer() {
		$this->db->order_by('id','asc');
		$this->db->where('dealer',0);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function get_updated_customer_cron() {
		$time = strtotime("now");		
		$this->db->where('modified <=',date('Y-m-d H:i:s'));		
		$this->db->where('modified >=',date('Y-m-d H:i:s',strtotime('-30 minutes',$time)));
		$this->db->order_by('id','asc');
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	
	function get_updated_customer_cronsimply() {		
		$this->db->where('modified >=',date('Y-m-d 00:00:00'));		
		$this->db->where('modified <=',date('Y-m-d 23:59:59'));
		//$this->db->where('modified >=',date('Y-m-d 00:00:00'));		
		//$this->db->where('modified <=',date('Y-m-d 23:59:59'));
		$this->db->order_by('id','asc');
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function all() {
		$this->db->order_by('firstname','asc');
		$this->db->where('deleted',0);
		$query = $this->db->get('customers');		
		return $query->result_array();
	}
	function all_dealer() {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',1);
		$this->db->where('deleted',0);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	function all_dealer_this_month($date) {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',1);
		$this->db->where('deleted',0);
		$this->db->like('joined',$date);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	function all_retailer() {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',0);
		$this->db->where('deleted',0);
		$query = $this->db->get('customers');
		return $query->result_array();
	}

	function all_retailer_aus() {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',0);
		$this->db->where('deleted',0);
		$this->db->where('country','Australia');
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function all_retailer_aus_this_month($date) {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',0);
		$this->db->where('deleted',0);
		$this->db->where('country','Australia');
		$this->db->like('joined',$date);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function all_retailer_int() {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',0);
		$this->db->where('deleted',0);
		$this->db->where('country !=','Australia');
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function all_retailer_int_this_month($date) {
		$this->db->order_by('firstname','asc');
		$this->db->where('dealer',0);
		$this->db->where('deleted',0);
		$this->db->where('country !=','Australia');
		$this->db->like('joined',$date);
		$query = $this->db->get('customers');
		return $query->result_array();
	}
	
	function total_orders($customer_id,$status) {
		$this->db->where('customer_id',$customer_id);		
		if ($status != "") {
			$this->db->where('status',$status);
		}
		$query = $this->db->get('orders');
		return $query->num_rows();
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('customers');
	}
	
	function search()
	{
		//
	}
	
	function add_comment($data)
	{
		$this->db->insert('admin_comment',$data);
		return $this->db->insert_id();
	}
	
	function all_comment($id) {
		$this->db->where('customer_id',$id);
		$this->db->order_by('created','asc');
		$query = $this->db->get('admin_comment');
		return $query->result_array();
	}
	function delete_comment($id) {
		$this->db->where('id',$id);
		$this->db->delete('admin_comment');
	}
	function get_total_spend($id)
	{
		$sql = "select sum(total) as ttl, customer_id from `orders` where customer_id = $id and (status = 'completed' or status='processed') group by customer_id, status";
		$query = $this->db->query($sql);
		$row = $query->first_row('array');
		if(count($row) > 0)
		{
			return $row['ttl'];
		}
		else 
		{
			return 0;
		}
		
	}
	
	function identify_order($custid) {
		
		$this->db->where('customer_id',$custid);	
		$query = $this->db->get('orders');
		return $query->result_array();
	}
}