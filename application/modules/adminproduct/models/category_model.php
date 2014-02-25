<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model {
	
	
	function get_main_productcategory() {		
		$this->db->where('active',1);	
		$this->db->order_by('id','asc');		
		$query = $this->db->get('category_products');
		return $query->result_array();
	}
	function get_detail_productcategory($category_id)
	{
		$this->db->where('id',$category_id);		
		$query = $this->db->get('category_products');
		return $query->first_row('array');
	}
	function any_productcategory() {
		$query = $this->db->get('category_products');
		return $query->result_array();
	}
	function add_productcategory($data) {
		$this->db->insert('category_products',$data);
		return $this->db->insert_id();
	}
	function update_productcategory($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('category_products',$data);
	}
	function delete_productcategory($id) {
		$this->db->where('id',$id);
		$this->db->delete('category_products');
	}
	
	
	
	
	function get_main() {
		$this->db->where('parent_id',0);
		$this->db->order_by('order','asc');
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function get_category_menu($category_id)
	{
		$this->db->where('category_id',$category_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('category_menu');
		return $query->result_array();
	}
	function any() {
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function all_prod() {
		$this->db->where('type',0);
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function all_page() {
		$this->db->where('type',1);
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function all() {
		$this->db->where('parent_id != ',0);
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function add($data) {
		$this->db->insert('categories',$data);
		return $this->db->insert_id();
	}
	function add_keyword($data)
	{
		$this->db->insert('category_menu',$data);
		return $this->db->insert_id();
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('categories',$data);
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function identify_subcat($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('category_menu');
		return $query->first_row('array');
	}
	function identify_category($id) {
		$this->db->where('product_id',$id);
		$query = $this->db->get('products_categories');
		return $query->first_row('array');
	}
	function identify_category_all($id) {
		$this->db->where('product_id',$id);
		$query = $this->db->get('products_categories');
		return $query->result_array();
	}
	function identify2($cat_name) {
		$this->db->where('name',$cat_name);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function _identify_by_name($name) {
		$this->db->where('name',$name);
		$query = $this->db->get('category_products');
		return $query->first_row('array');
	}
	function identify_by_name($name) {
		$this->db->where('name',$name);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function _identify_by_title($name) {
		$this->db->where('title',$name);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function identify_by_title($name) {
		$this->db->where('title',$name);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function child_name($parent_id,$name) {
		$this->db->where('parent_id',$parent_id);
		$this->db->where('name',$name);
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('categories');
	}
	function get($parent_id) {
		$this->db->where('parent_id',$parent_id);
		$this->db->order_by('order','asc');
		$query = $this->db->get('categories');
		if($parent_id == 7)
		{
			//echo $this->db->last_query();
		}
		return $query->result_array();
	}
	function get_previous($parent_id,$order) {
		$this->db->where('parent_id',$parent_id);
		$this->db->where('order <',$order);
		$this->db->order_by('order','desc');
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}	
	function get_next($parent_id,$order) {
		$this->db->where('parent_id',$parent_id);
		$this->db->where('order >',$order);
		$this->db->order_by('order','asc');
		$query = $this->db->get('categories');
		return $query->first_row('array');
	}
	function remove_products($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->delete('products_categories');
	}
	
}
?>