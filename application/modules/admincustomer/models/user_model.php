<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	function add($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	/*
	function get($type,$dealer) {
		//$this->db->where('level',$type);
		//$query = $this->db->get('users');
		
		$this->db->select('users.customer_id, users.id, users.activated, users.banned, users.username, users.level');
            $this->db->from('users');
            $this->db->where('users.level ',$type);
            
            $this->db->join('customers', 'users.customer_id=customers.id');
            $this->db->where('customers.dealer', $dealer);
		
		 $query = $this->db->get();
		 
		 return $query->result_array();
	}*/
	
	
	function all() {
		// $this->db->order_by('firstname','asc');
		// $this->db->where('deleted',0);
		// $query = $this->db->get('customers');		
		// return $query->result_array();
		
		$sql = "select users.* from users, customers where users.customer_id = customers.id  and users.level < 9 and customers.deleted = 0  order by customers.email asc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	function search($keyword) {
		// $this->db->order_by('firstname','asc');
		// $this->db->where('deleted',0);
		// $query = $this->db->get('customers');		
		// return $query->result_array();
		
		$sql = "select users.* from users, customers where users.customer_id = customers.id  and users.level < 9 and customers.deleted = 0  ";
		
		if($keyword)
		{
			$sql .= " and (customers.lastname like '%$keyword%' or customers.firstname like '%$keyword%' or concat(customers.firstname, ' ' ,customers.lastname) like '%$keyword%')";
		}
		
		
		$sql .= " order by customers.email asc";
		
		//echo $sql;
		//exit;
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get($type,$sort_by) {
		// if($type != 0)
		// {
			// $this->db->where('level',$type);
		// }
		// else
		// {
			// $this->db->where('level <',9);
		// }
		// $query = $this->db->get('users');
		// return $query->result_array();
		
		if($type != 0)
		{
			//$this->db->where('level',$type);
			$sql = "select * from users where level = $type order by id desc limit 15";
		}
		else
		{
			//$this->db->where('level <',9);
			if($sort_by == 0)
			{
				$sql = "select * from users where level < 9 order by id desc limit 15";
			}
			elseif($sort_by == 1)
			{
				$sql = "select users.* from users, customers where users.customer_id = customers.id  and users.level < 9 order by customers.firstname asc limit 15";
			}
			elseif($sort_by == 2)
			{
				$sql = "select users.* from users, customers where users.customer_id = customers.id  and users.level < 9 order by customers.email asc limit 15";
			}
		}
		//$query = $this->db->get('users');
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function validate($data) {
		$this->db->where('username',$data['username']);
		$this->db->where('password',md5($data['password']));
		$this->db->where('level >','0');
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){ 
			return $query->first_row('array');
		}
		return false;
	}
	
	function id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	
	function identify_cust_id($id) {
		$this->db->where('customer_id',$id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('users');
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('users',$data);
	}
	function recognize($username) {
		$this->db->where('username',$username);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
	function recognize_v2($name, $type, $email) {
//		$sql="select users.customer_id, users.id, users.activated, users.banned, users.username, users.level from users, customers where customers.firstname like '%$name%' and users.level =$type and users.customer_id=customers.id"	;	
		
		
		    $this->db->select('users.customer_id, users.id, users.activated, users.banned, users.username, users.level');
            $this->db->from('users');
            $this->db->where('users.level ',$type);
            
            $this->db->join('customers', 'users.customer_id=customers.id');
            //$this->db->where('customers.dealer', $dealer);
			$this->db->like('customers.firstname', $name);
			$this->db->where('customers.email', $email);
		
		 $query = $this->db->get();

		return $query->result_array();
	}
	function recognize_keyword($name, $type, $email, $sort_by) {
		
		
		$sql = "select users.* from users, customers where users.customer_id = customers.id and 
				(concat(customers.firstname,' ',customers.lastname) like '%$name%'
				or customers.email like '%$name%')";
		
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
				
		/*
			$this->db->select('users.customer_id, users.id, users.activated, users.banned, users.username, users.level');
					$this->db->from('users');
					// if($type != 0)
					// {
						// $this->db->where('users.level ',$type);
					// }
					if($type != 0)
					{
						$this->db->where('users.level',$type);
					}
					else
					{
						$this->db->where('users.level <',9);
					}
										 $this->db->join('customers', 'users.customer_id=customers.id');
					//$this->db->where('customers.dealer', $dealer);
					
					$this->db->like('concat(customers.firstname," ",customers.lastname)',$name);
					$this->db->or_like('customers.firstname', $name);			
					$this->db->or_like('customers.lastname', $name);
					$this->db->or_like('customers.email', $name);
										   $query = $this->db->get();
								   echo $this->db->last_query();
		
				return $query->result_array();*/
		
	}
	function customer($customer_id) {
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}
}