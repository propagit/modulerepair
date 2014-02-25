<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Page_model extends CI_Model {

	

	function get_page_by_link($id_title)
	{
		$page = $this->db->where('id_title',$id_title)->get('pages')->row();
		if($page){
			return $page;	
		}else{
			redirect('pages');	
		}
	}

	function send_email($data)
	{
		$to = '';
		$from = '';
		$cc = '';
		$bcc = '';
		$from_text = '';
		$subject = ''; 
		$message = ''; 
		$attachment = ''; 
		$bcc = '';
		if($data){
			foreach($data as $key=>$val){
				switch($key){
					case 'to':
						$to = $val;
					break;
					
					case 'from':
						$from = $val;
					break;
					
					case 'cc':
						$cc = $val;
					break;
										
					case 'bcc':
						$bcc = $val;
					break;
					
					case 'from_text':
						$from_text = $val;
					break;
					
					case 'subject':
						$subject = $val;
					break;
					
					case 'message':
						$message = $val;
					break;
					
					case 'attachment':
						$attachment = $val;
					break;	
				}
				
				
			}
		
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($from,$from_text);		
			$this->email->to($to);
			$this->email->cc($cc);
			$this->email->bcc($bcc);
			$email_signature = '';
			$this->email->subject($subject);
			$this->email->message($message . $email_signature);
			//$this->email->attach($attachment);
			$this->email->send();
			$this->email->clear(true);	
			return true;
					
		}else{
			return false;	
		}
		

	}
	
	/* gallery functions */
	function get_gallery($gallery_id)
	{
		if($gallery_id){
			$gallery = $this->db->where('gallery_id',$gallery_id)->where('thumbnail',0)->order_by('order','asc')->get('photos')->result();
			if($gallery){
				return $gallery;	
			}
		}
		return false;
	}
	
	function get_gallery_folder($gallery_id)
	{
		if($gallery_id){
			return md5('cdkgallery'.$gallery_id);
		}
		return false;
	}
	
	function get_gallery_setting($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('gallery_setting');
		return $query->first_row('array');
		
	}
}