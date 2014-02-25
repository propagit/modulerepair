<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Position_model extends CI_Model {
	
	function get_main() {
		$this->db->where('active',1);
		$this->db->order_by('id');
		$query = $this->db->get('category_products');
		return $query->result_array();
	}
	function identify_category($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('category_products');
		return $query->first_row('array');
	}
	function identify_product($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('products');
		return $query->first_row('array');
	}
	function search($keyword,$category,$status) {	
		if ($category == 0) {
			$sql = "SELECT * FROM `products` WHERE (`products`.`title` LIKE '%$keyword%' OR `products`.`short_desc` LIKE '%$keyword%' OR `products`.`long_desc` LIKE '%$keyword%' OR `products`.`collection` LIKE '%$keyword%')";
		} 
		else 
		{
			//if($category != 4)
			//{
				$sql = "SELECT `products`.* FROM `products`,`products_categories`
					WHERE `products_categories`.`category_id` = $category
					AND `products_categories`.`product_id` = `products`.`id`
					AND (`products`.`title` LIKE '%$keyword%' OR `products`.`short_desc` LIKE '%$keyword%' OR `products`.`long_desc` LIKE '%$keyword%' )";
			//}
			//else 
			//{
				//$sql = "SELECT distinct `products`.* FROM `products`,`products_categories`
					//WHERE (`products_categories`.`category_id` = $category
					//OR `products_categories`.`product_id` = `products`.`id`) AND (
					 //`products`.`price` > `products`.`sale_price` OR `products`.`price_trade` > `products`.`sale_price_trade`)
					//AND (`products`.`title` LIKE '%$keyword%' OR `products`.`short_desc` LIKE '%$keyword%' OR `products`.`long_desc` LIKE '%$keyword%' )";
			//}
			
		}
		if ($status == 'active') 
		{
			$sql .= " AND `products`.`status` = 1";
		}
		elseif ($status == 'inactive') 
		{
			$sql .= " AND `products`.`status` = 0";
		}
		$sql .= " AND `products`.`deleted` = 0";
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();		
	}
	function update_category($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('category_products',$data);
	}
	function check_category($prod_id,$cat_id)
	{
		$this->db->where('product_id',$prod_id);
		$this->db->where('category_id',$cat_id);
		$query = $this->db->get('products_categories');
		return $query->first_row('array');
		
	}
	function get_sub_category($parent_id) {
		/*$this->db->where('parent_id',$parent_id);
		$this->db->order_by('order','asc');
		$query = $this->db->get('category_products');
		if($parent_id == 7)
		{
			//echo $this->db->last_query();
		}
		return $query->result_array();*/
	}
}