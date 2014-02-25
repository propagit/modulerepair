<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('news_model');
	}
	
	function add_new_category()
	{
		$name = $this->input->post('name',true);
		$news_id = $this->input->post('news_id',true);
		if($name){
			$data = array(
						'name' => $name,
					);
			$insert_id = $this->news_model->add_new_category($data);
			if($insert_id){
				echo $this->news_model->create_category_list($news_id,$insert_id);
			}else{
				echo 'failed';	
			}
		}else{
			echo 'failed';	
		}
	}
	
	function delete_news_image()
	{
		$news_id = $this->input->post('news_id',true);
		if($this->news_model->delete_image_by_id($news_id)){
			echo 'success';
		}else{
			echo 'failed';	
		}
	}
	
	function delete_news_doc()
	{
		$news_id = $this->input->post('news_id',true);
		if($this->news_model->delete_document_by_id($news_id)){
			echo 'success';
		}else{
			echo 'failed';	
		}
	}
	
	function delete_category()
	{
		$category_id = $this->input->post('category_id',true);
		$news_id = $this->input->post('news_id',true);
		if($category_id){
			if($this->news_model->delete_category($category_id)){
				echo $this->news_model->create_category_list($news_id);
			}else{
				echo 'failed';	
			}
		}else{
			echo 'failed';	
		}
	}
	
	function permalink_exists()
	{
		$permalink = $this->input->post('permalink',true);
		if($this->news_model->permalink_exists($permalink)){
			echo 'exists';	
		}else{
			echo 'donot_exists';	
		}
	}
	
	function search_news()
	{
		$params = $this->input->post('params',true);
		
		echo $this->news_model->search_news($params);
		exit();
	}
	
}