<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model {
	
	
	
	
	function add($data) {
		$this->db->insert('pages',$data);
		return $this->db->insert_id();
	}
	
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('pages');
	}
	
	function all_pages() {
		$this->db->order_by('title','asc');
		$query = $this->db->get('pages');
		return $query->result_array();		
	}
	
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('pages');
		return $query->first_row('array');
	}
	
	function identify_title($id) {
		$this->db->where('id_title',$id);
		$query = $this->db->get('pages');
		return $query->first_row('array');
	}
	
	function update($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('pages',$data);
	}
	
	function get_page_by_link($id_title)
	{
		$page = $this->db->where('id_title',$id_title)->get('pages')->first_row('array');
		
			return $page;	
		
	}
	function load_gallery_options($current_gallery_id = "")
	{
		$this->load->model('admingallery/gallery_model');
		$active_gallery = $this->gallery_model->get_galleries_activepreview();
		$out = '<option '.($current_gallery_id == '' ? 'selected="selected"' : '').' value="0">Select Gallery</option>';
		if($active_gallery){
			foreach($active_gallery as $gallery){
				$out .= '<option value="'.$gallery['id'].'" '.($current_gallery_id == $gallery['id'] ? 'selected="selected"' : '').'>'.trim($gallery['title']).'</option>';	
			}
		}
		return $out;
			
	}
	
}