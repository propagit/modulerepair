<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller: Case Studies
 * @author: propagate dev team
 */
class Case_studies extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('case_studies_model');
	}
	

	function index($method='', $param='')
	{
		switch($method)
		{
			case 'preview-story':
				$this->preview_story($param);
			break;
			
			default:
				$this->case_studies($param);
			break;
		}
	}

	
	function case_studies($link="")
	{
		$data['categories'] = $this->case_studies_model->get_all_categories();
		$data['records_per_page'] = $this->case_studies_model->get_records_per_page('frontend');	
		if(!$link){
			$this->load->view('case_studies', isset($data) ? $data : NULL);
		}else{
			$case_story = $this->case_studies_model->get_case_studies_by_link($link);
			if(!$case_story){
				redirect('case-studies');	
			}
			$data['case_story'] = $case_story;
			$this->load->view('case_story', isset($data) ? $data : NULL);	
		} 
	}
	
	function preview_story($link)
	{
		if($this->session->userdata('is_admin_logged_in')){
			$data['categories'] = $this->case_studies_model->get_all_categories();
			$case_story = $this->case_studies_model->get_case_studies_by_link($link,false);
			if(!$case_story){
				redirect('case-studies');	
			}
			$data['case_story'] = $case_story;
			$this->load->view('case_story', isset($data) ? $data : NULL);	
		}else{
			redirect('case-studies');
		}
	}
	
	
	
	
	
}