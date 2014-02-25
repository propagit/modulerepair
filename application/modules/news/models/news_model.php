<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
	
	function get_news_by_link($link,$active = true)
	{
		if($link){
			if($active){
				$n_study = $this->db->where('id_title',$link)->where('status','active')->get('news')->row();
			}else{
				$n_study = $this->db->where('id_title',$link)->get('news')->row();
			}
			if($n_study){
				return $n_study;	
			}
		}
		return false;
	}
	
	function get_all_categories()
	{
		$categories = $this->db->where('status','active')->get('news_category')->result();
		if($categories){
			return $categories;	
		}
		return false;
	}
	
	function search_news($params = "")
	{
		$out = '';

		$category_id = '';
		if(isset($params['category_id'])){
			$category_id = $params['category_id'];
		}
		
		$keywords = '';
		if(isset($params['keywords'])){
			$keywords = $params['keywords'];
		}

		
		if($category_id){
			$sql = "select distinct 
			news.id,
			news.id_title, 
			news.title, 
			news.news_date,
			news.preview,
			news.image,
			news.status 
			from news, news_categories_relation 
			where news.id = news_categories_relation.news_id 
			and news_categories_relation.news_category_id = ".$category_id;	
		}else{
			$sql = "select id,id_title,title,news_date,preview,image,status from news where id != '' ";	
		}
		
		if($keywords){
			$sql .= " and news.title like '%".$keywords."%'";
		}
		
		//select only active
		$sql .= " and news.status = 'active'";
		
		//order by date
		$sql .= " order by news.news_date desc";
		
		$sql .= " limit 0,10";
		//echo $sql;exit();
		$news = $this->db->query($sql)->result();
	
	
		//output - no changes required here for any sql related changes
		if($news){
			foreach($news as $n){
				$src = '';
				if(trim($n->image)){
					$src = $this->get_image_path($n->id,$n->image);	
				}else{
					$src = base_url().'assets/frontend-assets/img/core/no-image-case-study-thumb.jpg';
				}
				$out .= '<div class="case-studies-row">          
							<div class="case-studies-img-box">
								<a href="'.base_url().'recent-news/'.$n->id_title.'"><img src="'.$src.'" /></a>
							</div>
							
							<div class="case-studies-desc-box">
								<a class="h2-link" href="'.base_url().'recent-news/'.$n->id_title.'"><h2 class="normal-h2">'.$n->title.'</h2></a>
								<span class="article-info pull-right custom-sml-screen-show">
									<strong>CATEGORY: </strong> '.$this->get_news_categories($n->id).'<br />
									<strong>DATE: </strong>'.date('d <\s\u\p>S</\s\u\p> F Y',strtotime($n->news_date)).'
								</span>
								'.$n->preview.'
								<a href="'.base_url().'recent-news/'.$n->id_title.'">READ FULL ARTICLE</a> <!--<a href="'.base_url().'recent-news/'.$n->id_title.'">VIEW TESTIMONIAL</a>-->
						
			
								<span class="article-info pull-right custom-sml-screen-hide">
									<strong>CATEGORY: </strong> '.$this->get_news_categories($n->id).'<br />
									<strong>DATE: </strong>'.date('d <\s\u\p>S</\s\u\p> F Y',strtotime($n->news_date)).'
								</span>
							</div>
						</div>';	
			}
		}
		echo $out;
	}

	
	function get_image_path($news_id,$image_name)
	{
		if($news_id && $image_name){
			$dir = $this->get_directory($news_id);
			$src = base_url().'uploads/news/'.$dir.'/thumb/'.$image_name;
			return $src;	
		}
		return false;
	}
	
	function get_doc_path($news_id,$doc_name)
	{
		if($news_id && $doc_name){
			$dir = $this->get_directory($news_id);
			$path = base_url().'uploads/news/'.$dir.'/doc/'.$doc_name;
			return $path;	
		}
		return false;
	}
	
	function get_directory($news_id)
	{
		if($news_id){
			return md5('wave1_news'.$news_id);
		}
		return false;
	}
	
	function get_news_categories($news_id,$return = false)
	{
		$sql = "select news_category.* from news_category,news_categories_relation where news_category.id = news_categories_relation.news_category_id and news_categories_relation.news_id = ".$news_id." group by news_category.id";
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
	
	function get_next_link($news_id,$news_date)
	{
		if($news_id){
			$sql = "select id_title from news where id = (select id from news where news_date >= '".$news_date."' and status = 'active' and id != ".$news_id." order by news_date asc limit 1)";
			$link = $this->db->query($sql)->row();
			if($link){
				return $link->id_title;	
			}
		}
		return false;
	}
	
	function get_previous_link($news_id,$news_date)
	{
		if($news_id){
			$sql = "select id_title from news where id = (select id from news where news_date <= '".$news_date."' and status = 'active' and id != ".$news_id." order by news_date desc limit 1)";
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
			$gallery = $this->db->where('gallery_id',$gallery_id)->order_by('order','asc')->get('photos')->result();
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

	
}