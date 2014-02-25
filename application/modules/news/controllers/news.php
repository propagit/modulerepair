<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller: Case Studies
 * @author: propagate dev team
 */
class news extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}
	

	function index($method='', $param='')
	{
		switch($method)
		{
			case 'preview-news':
				$this->preview_news($param);
			break;
			
			default:
				$this->news($param);
			break;
		}
	}

	
	function news($link="")
	{
		$data['categories'] = $this->news_model->get_all_categories();
		if(!$link){
			$this->load->view('news_lists', isset($data) ? $data : NULL);
		}else{
			$news = $this->news_model->get_news_by_link($link);
			if(!$news){
				redirect('news');	
			}
			$data['news'] = $news;
			$this->load->view('news', isset($data) ? $data : NULL);	
		} 
	}
	
	function preview_news($link)
	{
		if($this->session->userdata('is_admin_logged_in')){
			$data['categories'] = $this->news_model->get_all_categories();
			$news = $this->news_model->get_news_by_link($link,false);
			if(!$news){
				redirect('news');	
			}
			$data['news'] = $news;
			$this->load->view('news', isset($data) ? $data : NULL);	
		}else{
			redirect('news');
		}
	}
	
	
	
	
	
}