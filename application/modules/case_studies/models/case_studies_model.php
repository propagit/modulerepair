<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_studies_model extends CI_Model {
	
	function get_case_studies_by_link($link,$active = true)
	{
		if($link){
			if($active){
				$case_study = $this->db->where('id_title',$link)->where('status','active')->get('case_studies')->row();
			}else{
				$case_study = $this->db->where('id_title',$link)->get('case_studies')->row();
			}
			if($case_study){
				return $case_study;	
			}
		}
		return false;
	}
	
	function get_all_categories()
	{
		$categories = $this->db->where('status','active')->get('case_studies_category')->result();
		if($categories){
			return $categories;	
		}
		return false;
	}
	
	function search_case_studies($params = "")
	{
		$out = '';
		$data_per_page = 25;
		if($this->get_records_per_page('frontend')){
			$data_per_page = $this->get_records_per_page('frontend');	
		}
		$new_limit = '<input id="limit" type="hidden" value="no-more-data">';
		$category_id = '';
		if(isset($params['category_id'])){
			$category_id = $params['category_id'];
		}
		
		$keywords = '';
		if(isset($params['keywords'])){
			$keywords = $params['keywords'];
		}
		
		$limit = 0;
		if(isset($params['limit'])){
			$limit = $params['limit'];	
		}
		
		if($category_id){
			$sql = "select distinct 
			case_studies.id,
			case_studies.id_title, 
			case_studies.title, 
			case_studies.study_date,
			case_studies.preview,
			case_studies.image,
			case_studies.status 
			from case_studies, case_studies_categories_relation 
			where case_studies.id = case_studies_categories_relation.case_studies_id 
			and case_studies_categories_relation.case_studies_category_id = ".$category_id;	
		}else{
			$sql = "select id,id_title,title,study_date,preview,image,status from case_studies where id != '' ";	
		}
		
		if($keywords){
			$sql .= " and case_studies.title like '%".$keywords."%'";
		}
		
		//select only active
		$sql .= " and case_studies.status = 'active'";
		
		//order by date
		$sql .= " order by case_studies.study_date desc";

		$sql .= " limit ".$limit.",".$data_per_page;
		
		$case_studies = '';
		if($limit != 'no-more-data'){
			$case_studies = $this->db->query($sql)->result();
		}
	
		//output - no changes required here for any sql related changes
		if($case_studies){
			$new_limit = '<input id="limit" type="hidden" value="'.($limit+$data_per_page).'">';	
			foreach($case_studies as $case){
				$src = '';
				if(trim($case->image)){
					$src = $this->get_image_path($case->id,$case->image);	
				}else{
					$src = base_url().'assets/frontend-assets/img/core/no-image-case-study-thumb.jpg';
				}
				$out .= '<div class="case-studies-row">          
							<div class="case-studies-img-box">
								<a href="'.base_url().'case-studies/'.$case->id_title.'"><img src="'.$src.'" /></a>
							</div>
							
							<div class="case-studies-desc-box">
								<div class="case-studies-left-box">
									<a class="h2-link" href="'.base_url().'case-studies/'.$case->id_title.'"><h2 class="normal-h2">'.$case->title.'</h2></a>
									<span class="article-info pull-right custom-sml-screen-show" >
										<strong>Show All Case Studies From</strong><br>
										<button type="button" class="button search-btn" onclick="filterbycategory('.$this->get_case_studies_category_id($case->id,'ID').');">'.strtoupper($this->get_case_studies_category_id($case->id,'Name')).' SECTOR</button>
										<br><br>
										<strong>INDUSTRY: </strong> '.$this->get_case_studies_categories($case->id).'<br />
										<strong>DATE: </strong>'.date('d <\s\u\p>S</\s\u\p> F Y',strtotime($case->study_date)).'
									</span>
									'.$case->preview.'
									<a href="'.base_url().'case-studies/'.$case->id_title.'">READ FULL ARTICLE</a> <a href="'.base_url().'case-studies/'.$case->id_title.'">VIEW TESTIMONIAL</a>
								</div>
								
								<div class="case-studies-right-box">
									<span class="article-info pull-right custom-sml-screen-hide text_right" >
										<strong>Show All Case Studies From</strong><br>
										<button type="button" class="button search-btn" style="margin-right:0px;"onclick="filterbycategory('.$this->get_case_studies_category_id($case->id,'ID').');">'.strtoupper($this->get_case_studies_category_id($case->id,'Name')).' SECTOR</button>
										<br><br><br>
										<strong>INDUSTRY: </strong> '.$this->get_case_studies_categories($case->id).'<br />
										<strong>DATE: </strong>'.date('d <\s\u\p>S</\s\u\p> F Y',strtotime($case->study_date)).'
									</span>
								</div>
							</div>
						</div>';	
			}
		}
		$data = array(
				'case_studies' => $out,
				'new_limit' => $new_limit
			);

		return json_encode($data);	
	}

	
	function get_image_path($case_study_id,$image_name)
	{
		if($case_study_id && $image_name){
			$dir = $this->get_directory($case_study_id);
			$src = base_url().'uploads/case_studies/'.$dir.'/thumb/'.$image_name;
			return $src;	
		}
		return false;
	}
	
	function get_doc_path($case_study_id,$doc_name)
	{
		if($case_study_id && $doc_name){
			$dir = $this->get_directory($case_study_id);
			$path = base_url().'uploads/case_studies/'.$dir.'/doc/'.$doc_name;
			return $path;	
		}
		return false;
	}
	
	function get_directory($case_study_id)
	{
		if($case_study_id){
			return md5('case_std'.$case_study_id);
		}
		return false;
	}
	
	function get_case_studies_categories($case_study_id,$return = false)
	{
		$sql = "select case_studies_category.* from case_studies_category,case_studies_categories_relation where case_studies_category.id = case_studies_categories_relation.case_studies_category_id and case_studies_categories_relation.case_studies_id = ".$case_study_id." group by case_studies_category.id order by case_studies_categories_relation.id desc";
		$categories = $this->db->query($sql)->result();
		$out = '';
		if($categories){
			if($return){
				return $categories;	
			}else{
				$total = count($categories);
				$count = 1;
				foreach($categories as $cat){
					if($count == 1){
						$out .= $cat->name;
					}
					$count++;
				}
				if($total > 1){
					$out .= ',(and '.($total-1).' Others)';	
				}
				return $out;
			}
		}
	}
	
	function get_case_studies_category_id($case_study_id,$type,$return = false)
	{
		$sql = "select case_studies_category.* from case_studies_category,case_studies_categories_relation where case_studies_category.id = case_studies_categories_relation.case_studies_category_id and case_studies_categories_relation.case_studies_id = ".$case_study_id." group by case_studies_category.id order by case_studies_categories_relation.id desc";
		$categories = $this->db->query($sql)->result();
		$out = '';
		if($categories){
			if($return){
				return $categories;	
			}else{
				$total = count($categories);
				$count = 1;
				foreach($categories as $cat){
					if($count == 1){
						if($type=='Name'){
							$out .= $cat->name;
						}else {$out .= $cat->id;}
					}
					$count++;
				}				
				return $out;
			}
		}
	}
	
	function get_next_link($case_study_id,$study_date)
	{
		if($case_study_id){
			$sql = "select id_title from case_studies where id = (select id from case_studies where study_date >= '".$study_date."' and status = 'active' and id != ".$case_study_id." order by study_date asc limit 1)";
			$link = $this->db->query($sql)->row();
			if($link){
				return $link->id_title;	
			}
		}
		return false;
	}
	
	function get_previous_link($case_study_id,$study_date)
	{
		if($case_study_id){
			$sql = "select id_title from case_studies where id = (select id from case_studies where study_date <= '".$study_date."' and status = 'active' and id != ".$case_study_id." order by study_date desc limit 1)";
			$link = $this->db->query($sql)->row();
			if($link){
				return $link->id_title;	
			}
		}
		return false;
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
	
	function get_records_per_page($return = '')
	{
		$records_per_page = $this->db->where('module','article')->get('records_per_page_config')->row();
		if($records_per_page){
			if($return){
				if($return == 'frontend'){
					return $records_per_page->frontend;
				}else{
					return $records_per_page->backend;	
				}
			}else{
				return $records_per_page;	
			}
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