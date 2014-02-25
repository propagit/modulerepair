<?php
class Meta_data_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function get_meta_data($controller = '',$method = '',$param1 = '',$param2='',$param3='',$param4='')
	{
		switch($controller){
			case 'case_studies':
				if($param1){
					$data = $this->query_content_meta_data($param1,'case_studies','id_title');
					$title = $data['title'];
					$keywords = $data['keywords'];
					$description = $data['description'];	
				}else{
					$title = "Case Studies - Wave1";
					$keywords = "";
					$description = "";	
				}
			break;
			
			case 'news':
				if($param1){
					$data = $this->query_content_meta_data($param1,'news','id_title');
					$title = $data['title'];
					$keywords = $data['keywords'];
					$description = $data['description'];	
				}else{
					$title = "Recent News - Wave1";
					$keywords = "";
					$description = "";	
				}
			break;
			
			case 'pages':
				if($method == 'page'){
					if($param1){
						$data = $this->query_page_meta_data($param1);
						$title = $data['title'];
						$keywords = $data['keywords'];
						$description = $data['description'];	
					}
				}else{
					//for conact us page
					$title = "Contact Us - Wave1";
					$keywords = "";
					$description = "";
				}
			break;
			
			case 'product':
				$data = $this->query_product_meta_data($param1,$param2);
				$title = $data['title'];
				$keywords = $data['keywords'];
				$description = $data['description'];
			break;
			
			default:
				$title = "Module Repair Service. Australia's largest independant repairer of electronic control modules";
				$keywords = "module, repair, service, module repair, module repair service, electronic, control, modules, module repair gear";
				$description = "Module Repair Service";
			break;	
		}
		
		return $meta_data = array(
						'title' => $title,
						'keywords' => $keywords,
						'description' => $description
						);
	}
	
	function query_content_meta_data($permalink,$table_name,$field_name)
	{
		$meta_data = array(
						'title' => "Wave1, Australia's leading Wireless Microwave Communications provider",
						'keywords' => "",
						'description' => ""
						);	
		if($permalink){
			$sql = "select title,meta_title,meta_description,meta_keywords from ".$table_name." where ".$field_name." = '".$permalink."'";
			$data = $this->db->query($sql)->row();
			if($data){
				$meta_data = array(
						'title' => ($data->meta_title != "" ? $data->meta_title : $data->title),
						'keywords' => $data->meta_keywords,
						'description' => $data->meta_description
						);	
			}
		}
		
		return $meta_data;
	}
	
	function query_page_meta_data($permalink)
	{
		$meta_data = array(
						'title' => "Wave1, Australia's leading Wireless Microwave Communications provider",
						'keywords' => "",
						'description' => ""
						);	
		if($permalink){
			$sql = "select title,meta_title,meta_description,meta_keywords from pages where id_title = '".$permalink."'";
			$data = $this->db->query($sql)->row();
			if($data){
				$meta_data = array(
						'title' => ($data->meta_title != "" ? $data->meta_title : $data->title),
						'keywords' => $data->meta_keywords,
						'description' => $data->meta_description
						);	
			}
		}
		
		return $meta_data;
	}
	
	function query_product_meta_data($category_link,$product_link)
	{
		if($product_link){
			$sql = "select title,short_desc,long_desc from products where id_title = '".$product_link."'";
			$data = $this->db->query($sql)->row();
			if($data){
				$meta_data = array(
						'title' => substr($data->short_desc,0,100),
						'keywords' => $data->title,
						'description' => substr($data->long_desc,0,160)
						);	
			}
			
		}else{
			$sql = "select * from category_products where id != 0";
			if($category_link){
				$sql .= " and id_title = '".$category_link."'";	
			}
			$sql .= " limit 1";
			$data = $this->db->query($sql)->row();
			if($data){
				$meta_data = array(
						'title' => $data->name,
						'keywords' => "",
						'description' => ""
						);	
			}
		}
		
		return $meta_data;
	}
	
}
?>