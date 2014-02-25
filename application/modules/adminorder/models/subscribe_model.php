<?php
class Subscribe_Model extends CI_Model{
	function __contruct(){
		parent::__construct();
	}
	function all(){
		$query = $this->db->get("subscribers");
		return $query->result_array();
	}
	function add($data){
		$this->db->insert("subscribers",$data);
		return $this->db->insert_id();
	}
	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("subscribers");
	}
	
	function exist($email){
		$this->db->where("email",$email);
		$query =$this->db->get("subscribers");
		$result =$query->first_row("array");
		if(count($result)>0)
			return true;
		return false;
	}
   
   function subscribe_this_month($date)
   {
   		$sql = "SELECT * FROM `subscribers` WHERE `date` LIKE '%$date%'";
		$query = $this->db->query($sql);
		return $query->result_array();
   } 
   function get_updated_subscribe_cronsimply() {		
		$this->db->where('date >=',date('Y-m-d 00:00:00'));		
		$this->db->where('date <=',date('Y-m-d 23:59:59'));
		//$this->db->where('modified >=',date('Y-m-d 00:00:00'));		
		//$this->db->where('modified <=',date('Y-m-d 23:59:59'));
		$this->db->order_by('id','asc');
		$query = $this->db->get('subscribers');
		return $query->result_array();
	}
}
?>