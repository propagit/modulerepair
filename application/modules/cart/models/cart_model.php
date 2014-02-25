<?php
class Cart_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function add($data) {
		$this->db->where('session_id',$data['session_id']);
		$this->db->where('product_id',$data['product_id']);
		$this->db->where('price',$data['price']);
		$this->db->where('attributes',$data['attributes']);
		$query = $this->db->get('carts');
		if ($query->num_rows() > 0) {
			$result = $query->first_row('array');
			$quantity = $result['quantity'] + $data['quantity'];
			$temp = $this->Product_model->identify($data['product_id']);
			if($temp['stock']<$quantity){
				$t=$temp['stock'] + 2;
				return $t *(-1);
			}else{	
				$this->db->where('id',$result['id']);
				$this->db->update('carts',array('quantity' => $quantity));
				return -1;
			}
		} else {
			$result = $this->Product_model->identify($data['product_id']);			
			if($data['quantity']>$result['stock']){
				$t=$data['quantity'] +2;
				return $t * (-1);
			}else{
				$this->db->insert('carts',$data);
				return $this->db->insert_id();
			}
		}
	}
	
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('carts',$data);
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('carts');
		return $query->first_row('array');
	}
	
	function all($session_id) {
		$this->db->where('session_id',$session_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('carts');
		return $query->result_array();
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('carts');
	}
	
	function has_duplicate() {
		$sql = "SELECT `id`, COUNT(*) AS `count` FROM `carts` GROUP BY `session_id`,`product_id`,`price`,`attributes` HAVING `count` > 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_current_cart()
	{
		$session_id = $this->session->userdata('session_id');
		$cart = $this->Cart_model->all($session_id);
		$total = 0;
		$quantity = 0;
		foreach ($cart as $item){
		  $total += $item['price'] * $item['quantity'];
		  $quantity += $item['quantity'];
		}
		
		$current_cart = array('items' => '0','total' => '0.00');
		
		if($cart){
			$current_cart = array('items' => count($cart),'total' => $total);
		}
		
		return $current_cart;
	 }
}
?>