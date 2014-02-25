<?php
class Content_Model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	function get_categories() {
		$this->db->where('parent_id',0);
//		$this->db->where('location_id',$location_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('page_categories');
		return $query->result_array();
	}
	
	function get_first_category() {
		$this->db->where('parent_id',0);
//		$this->db->where('location_id',$location_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('page_categories');
		return $query->first_row('array');
	}
	
	function search($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->order_by('title','asc');
		$query = $this->db->get('pages');
		return $query->result_array();
	}
	
	function sub_categories($parent_id) {
		$this->db->where('parent_id',$parent_id);
		$this->db->order_by('name','asc');
		$query = $this->db->get('page_categories');
		return $query->result_array();
	}
	
	function add_category($data) {
		$this->db->insert('page_categories',$data);
		return $this->db->insert_id();
	}
	
	function get_category($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('page_categories');
		return $query->first_row('array');
	}
	
	function add($data) {
		$this->db->insert('pages',$data);
		return $this->db->insert_id();
	}
	
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('pages',$data);
	}

	function id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('pages');
		return $query->first_row('array');
	}
	
	function root_categories() {
		$this->db->where('parent_id',0);
		$this->db->order_by('name','asc');
		$query = $this->db->get('page_categories');
		return $query->result_array();
	}
	function clear($category_id) {
		$this->db->where('category_id',$category_id);
		$this->db->delete('pages');
	}
	function delete_category($id) {
		$this->db->where('id',$id);
		$this->db->delete('page_categories');
	}
	#Banners
	
	function get_banners() {
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	
	function get_banners_temp_site($temp,$site) {
		$this->db->where('site',$site);
		$this->db->where('template',$temp);
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	
	function get_banners_temp($temp) {
		$this->db->where('template',$temp);
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	
	function get_active_banners_temp_site($temp,$site)
	{
		$this->db->where('site',$site);
		$this->db->where('template',$temp);
		$this->db->where('actived','1');
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	function get_active_banners_temp($temp)
	{
		$this->db->where('template',$temp);
		$this->db->where('actived','1');
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	function get_banner($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		return $query->first_row('array');
	}
	
	function min_lru() {
		$sql = "SELECT min(`lru`) as `min` FROM `banners`";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		$lru = $result['min'];
		if ($lru != NULL) { return $lru; }
		return 0;
	}
	function get_active_banners()
	{
		$this->db->where('actived','1');
		$query = $this->db->get('banners');
		
		return $query->result_array();
	}
	function add_banner($data) {
		$this->db->insert('banners',$data);
		return $this->db->insert_id();	
	}
	function active_banner($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		$banner = $query->first_row('array');
		$this->db->where('id',$id);
		if ($banner['actived'] == 0) {			
			$this->db->update('banners',array('actived' => 1));
		} else if ($banner['actived'] == 1) {
			$this->db->update('banners',array('actived' => 0));
		}
	}
	function get_random_banner() {
		$sql = "SELECT * FROM `banners` WHERE `actived` = 1 ORDER BY RAND()";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	function update_lru($banner_id) {
		$this->db->where('id',$banner_id);
		$query = $this->db->get('banners');
		$banner = $query->first_row('array');
		$lru = $banner['lru'] + 1;
		$this->db->where('id',$banner_id);
		$this->db->update('banners',array('lru' => $lru));		
	}
	function update_banner($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('banners',$data);
	}
	function delete_banner($id) {
		$this->db->where('id',$id);
		$this->db->delete('banners');
	}
}
?>