<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {
	
	
	function get_galleries() 
	{
		$query = $this->db->get('galleries');
		return $query->result_array();
	}
	function get_galleries_activepreview()
	{
		$this->db->where('active_preview',1);
		$query = $this->db->get('galleries');
		return $query->result_array();
	}
	function get_galleries_activepage()
	{
		$this->db->where('active_page',1);
		$query = $this->db->get('galleries');
		return $query->result_array();
	}
	function get_photos($gallery_id) 
	{
		$this->db->where('gallery_id',$gallery_id);
		$this->db->where('thumbnail',0);
		$this->db->order_by('order','asc');
		$query = $this->db->get('photos');
		return $query->result_array();		
	}
	
	function create_gallery($data) 
	{
		$this->db->insert('galleries',$data);
		return $this->db->insert_id();
	}
	
	function delete_gallery($id) 
	{
		$this->db->where('id',$id);
		return $this->db->delete('galleries');
	}
	function update_gallery($id,$data) 
	{
		$this->db->where('id',$id);
		$this->db->update('galleries',$data);
	}
	
	function get_gallery($id) 
	{
		$this->db->where('id',$id);
		$query = $this->db->get('galleries');
		return $query->first_row('array');
	}
	
	function add_photo($data) 
	{
		$this->db->insert('photos',$data);
		return $this->db->insert_id();
	}	
	
	function update_photo($id,$data) 
	{
		$this->db->where('id',$id);
		$this->db->update('photos',$data);
	}
	
	function get_photo($id) 
	{
		$this->db->where('id',$id);
		$query = $this->db->get('photos');
		return $query->first_row('array');
	}
	
	function delete_photo($id) 
	{
		$this->db->where('id',$id);
		return $this->db->delete('photos');
	}
	
	function reset_thumbnail($id) 
	{
		$this->db->where('thumbnail',$id);
		$query = $this->db->get('galleries');
		if ($query->num_rows() > 0) {
			$gallery = $query->first_row('array');
			$gid = $gallery['id'];
			$this->db->where('id',$gid);
			$this->db->update('galleries', array('thumbnail' => '0'));
		}
	}
	
	function get_gallery_thumbnail($id) 
	{
		$this->db->where('id',$id);
		$query = $this->db->get('galleries');
		$gallery = $query->first_row('array');
		if ($gallery['thumbnail'] == '0') {
			$sql = "SELECT * FROM `photos` WHERE `gallery_id` = '$id' ORDER BY id ASC LIMIT 1";
			$query = $this->db->query($sql);
		}
		else {
			$this->db->where('id',$gallery['thumbnail']);
			$query = $this->db->get('photos');
		}
		$photo = $query->first_row('array');
		return $photo['name'];
	}
	
	function get_gallery_from_page($id)
	{
		$this->db->where('gallery',$id);
		$query = $this->db->get('pages');
		return $query->result_array();	
		
	}
	
	function get_gallery_from_casestudy($id)
	{
		$this->db->where('gallery',$id);
		$this->db->where('status','active');
		$query = $this->db->get('case_studies');
		return $query->result_array();	
		
	}
	
	function get_gallery_setting($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('gallery_setting');
		return $query->first_row('array');
		
	}
	function update_gallery_setting($data)
	{
		$this->db->where('id',1);
		$this->db->update('gallery_setting',$data);
	}
	
}
?>