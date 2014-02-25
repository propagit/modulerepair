<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {
	
	
	function all_cust_order($cust_id) {
		$this->db->where('customer_id',$cust_id);
		$this->db->where('order_id',0);
		$this->db->where('lock',1);
		$this->db->order_by('id','asc');
		$query = $this->db->get('carts');
		return $query->result_array();
	}
	
	function all_order($id) {

		$this->db->where('order_id',$id);

		$this->db->order_by('id','asc');
		$query = $this->db->get('carts');
		return $query->result_array();
	}
	function add_wishlist($data)
	{
		$this->db->insert('wishlist',$data);
		return $this->db->insert_id();
	}
	
	function add_cart_gift_card($data)
	{
		$this->db->insert('carts',$data);
		return $this->db->insert_id();
	}
	
	function get_giftcard($date)
	{
		$sql = "SELECT a.* FROM `carts` a, `orders` b
				where a.session_id = b.session_id
				and a.gift_card = 1
				and b.status = 'successful'
				and a.gift_sent = 0
				and a.send_on = '$date'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_wishlist($id)
	{
		$sql = "select a.* from wishlist a, products b where b.id = a.product_id and b.deleted = 0 and status = 1 and a.user_id = $id";
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
		// $this->db->where('user_id',$id);
		// $this->db->order_by('created','asc');
		// $query = $this->db->get('wishlist');
		// return $query->result_array();
	}
	
	function delete_wishlist($id) {
		$this->db->where('id',$id);
		$this->db->delete('wishlist');
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
			$this->db->where('id',$result['id']);
			$this->db->update('carts',array('quantity' => $quantity));
			return -1;
		} else {		
			$this->db->insert('carts',$data);
			return $this->db->insert_id();
		}
	}
	
	function add_cart_admin($data)
	{
		$this->db->insert('carts',$data);
		return $this->db->insert_id();
	}
	
	/*retail add - limited to store*/
	function add_limited($data) {
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
				//$this->db->where('id',$result['id']);
				//$this->db->update('carts',array('quantity' => $quantity));
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
	
	function add_limited_save($data) {
		$this->db->where('customer_id',$data['customer_id']);
		$this->db->where('product_id',$data['product_id']);
		$this->db->where('price',$data['price']);
		$this->db->where('attributes',$data['attributes']);
		$query = $this->db->get('cart_save');
		if ($query->num_rows() > 0) {
			$result = $query->first_row('array');
			$quantity = $result['quantity'] + $data['quantity'];
			$temp = $this->Product_model->identify($data['product_id']);
			if($temp['stock']<$quantity){
				$t=$temp['stock'] + 2;
				return $t *(-1);
			}else{	
				//$this->db->where('id',$result['id']);
				//$this->db->update('carts',array('quantity' => $quantity));
				return -1;
			}
		} else {
			$result = $this->Product_model->identify($data['product_id']);			
			if($data['quantity']>$result['stock']){
				$t=$data['quantity'] +2;
				return $t * (-1);
			}else{
				$this->db->insert('cart_save',$data);
				return $this->db->insert_id();
			}
		}
	}
	
	/*retail add - limited multiple size to store not checking stock of the product cuz check quantity of each size already in front end*/
	function add_limited_special($data,$stock) {
		$this->db->where('session_id',$data['session_id']);
		$this->db->where('product_id',$data['product_id']);
		$this->db->where('price',$data['price']);
		$this->db->where('attributes',$data['attributes']);
		$query = $this->db->get('carts');
		if ($query->num_rows() > 0) 
		{
			$result = $query->first_row('array');
			$quantity = $result['quantity'] + $data['quantity'];
			$temp = $this->Product_model->identify($data['product_id']);
			// check total quantity of the same item added to the cart with the stock of size specify in back end
			if($quantity > $stock)
			{
				return -2;
			}
				//$this->db->where('id',$result['id']);
				//$this->db->update('carts',array('quantity' => $quantity));
				return -1;
			
		} 
		else 
		{
			$result = $this->Product_model->identify($data['product_id']);			
			
				$this->db->insert('carts',$data);
				return $this->db->insert_id();
			
		}
	}
	
	function add_limited_special_save($data,$stock) {
		$this->db->where('customer_id',$data['customer_id']);
		$this->db->where('product_id',$data['product_id']);
		$this->db->where('price',$data['price']);
		$this->db->where('attributes',$data['attributes']);
		$query = $this->db->get('cart_save');
		if ($query->num_rows() > 0) 
		{
			$result = $query->first_row('array');
			$quantity = $result['quantity'] + $data['quantity'];
			$temp = $this->Product_model->identify($data['product_id']);
			// check total quantity of the same item added to the cart with the stock of size specify in back end
			if($quantity > $stock)
			{
				return -2;
			}
				//$this->db->where('id',$result['id']);
				//$this->db->update('carts',array('quantity' => $quantity));
				return -1;
			
		} 
		else 
		{
			$result = $this->Product_model->identify($data['product_id']);			
			
				$this->db->insert('cart_save',$data);
				return $this->db->insert_id();
			
		}
	}
	
	function add_limited_special2($data) {
		$this->db->where('session_id',$data['session_id']);
		$this->db->where('product_id',$data['product_id']);		
		$this->db->where('attributes',$data['attributes']);
		$query = $this->db->get('carts');
		if ($query->num_rows() > 0) 
		{
			
				return -1;
			
		} 
		else 
		{
			
				return 0;
			
		}
	}
	function update_by_session_id($id,$data) {
		$this->db->where('session_id',$id);
		$this->db->update('carts',$data);
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('carts',$data);
	}
	function update_save($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('cart_save',$data);
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
	function all_save($id) {
		$this->db->where('customer_id',$id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('cart_save');
		return $query->result_array();
	}
	function all_save2($id) {
		
		if($id==1){
			//$ses_id=$this->session->userdata('session_id');
			//$sql = "select * from carts where customer_id='$id' and session_id = $ses_id";
		}
		else{
			$sql = "select * from carts where customer_id='$id' and sent = 0 ";
		}
		$query = $this->db->query($sql);
		// $this->db->where('customer_id',$id);
		// $this->db->order_by('id','asc');
		// $query = $this->db->get('carts');
		return $query->result_array();
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('carts');
	}
	function delete_save($id) {
		$this->db->where('id',$id);
		$this->db->delete('cart_save');
	}
	function has_duplicate() {
		$sql = "SELECT `id`, COUNT(*) AS `count` FROM `carts` GROUP BY `session_id`,`product_id`,`price`,`attributes` HAVING `count` > 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function dosql($sql) {
		//$sql = "SELECT `id`, COUNT(*) AS `count` FROM `carts` GROUP BY `session_id`,`product_id`,`price`,`attributes` HAVING `count` > 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}