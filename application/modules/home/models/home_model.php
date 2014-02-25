<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	function get_case_studies_client_logos($status = false)
	{
		$sql = 'select id,id_title, image from case_studies where image != ""';
		if($status){
			$sql .= ' and status = "active"';	
		}
		$sql .= ' order by study_date desc';
		$result = $this->db->query($sql)->result();
		if($result){
			return $result;	
		}
		return false;
	}
	
	function get_dir($case_study_id)
	{
		if($case_study_id){
			$folder = md5('case_std'.$case_study_id);
			return $folder;
		}
		return false;
	}
	
	function create_logo_sets()
	{
		$clients = $this->get_case_studies_client_logos(true);
		$total = count($clients);
		//check if the logos are in multiple of 5 so that we can get perfect sets of logos
		$perfect = true;
		$extra_needed = 0;
		$more_logos = '';
		if($total%5){
			$perfect = false;
			$remainder = (float)($total / 5);
  			$remainder = ($remainder - (int)$remainder)*5;
			$extra_needed = 5 - $remainder;
		}
		$count = 0;
		$out = '<ul class="logo-set">';
		if($clients){
			foreach($clients as $c){
				$folder = $this->get_dir($c->id);
				$count++;
				if($count > 5){
					$out .= '</ul><ul class="logo-set">';
					$count = 1;
				}
				$out .= '<li><a href="'.base_url().'case-studies/'.$c->id_title.'" ><img src="'.base_url().'uploads/case_studies/'.$folder.'/thumb2/'.$c->image.'" /></a></li>';
			}
		//if logo set is irregular
		//make modification
		if(!$perfect){
			$more_logos = $this->get_remaining_client_logos($extra_needed,true);	
		}
			$out .= $more_logos.'</ul>';
		}
		return array('total' => count($clients),'logos' => $out);
	}
	
	function get_remaining_client_logos($limit,$status = false)
	{
		$sql = 'select id,id_title, image from case_studies where image != ""';
		if($status){
			$sql .= ' and status = "active"';	
		}
		$sql .= ' order by study_date desc';
		$sql .= ' limit '.$limit;
		
		$clients = $this->db->query($sql)->result();
		$out = '';
		if($clients){
			foreach($clients as $c){
				$folder = $this->get_dir($c->id);
					$out .= '<li><a href="'.base_url().'case-studies/'.$c->id_title.'" ><img src="'.base_url().'uploads/case_studies/'.$folder.'/thumb2/'.$c->image.'" /></a></li>';
			}
		}
		return $out;
	}
	
	function all_files_active() {
		$this->db->where('actived',1);
		$this->db->order_by('position','asc');
		$query = $this->db->get('banners');
		return $query->result_array();		
	}
	
	function update_banner_hitcount($banner_id)
	{
		if($banner_id){
			$banner = $this->db->select('id,hit,url')->from('banners')->where('id',$banner_id)->get()->row();
			if($banner){
				$hit_count = $banner->hit + 1;
				$this->db->where('id',$banner_id)->update('banners',array('hit' => $hit_count));
				if(trim($banner->url) != ""){
					redirect(trim($banner->url));
				}else{
					redirect(base_url());		
				}
			}
		}else{
			redirect(base_url());		
		}
		

	}
	
	function update_banner_viewcount($banner_id)
	{
		if($banner_id){
			$banner = $this->db->select('id,view')->from('banners')->where('id',$banner_id)->get()->row();
			if($banner){
				$view_count = $banner->view + 1;
				$this->db->where('id',$banner_id)->update('banners',array('view' => $view_count));
			}
		}
		

	}

	
}