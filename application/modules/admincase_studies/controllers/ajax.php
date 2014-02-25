<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Case Studies
 * @author: propagate dev team
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('case_studies_model');
	}
	
	function add_new_category()
	{
		$name = $this->input->post('name',true);
		$case_study_id = $this->input->post('case_study_id',true);
		if($name){
			$data = array(
						'name' => $name,
					);
			$insert_id = $this->case_studies_model->add_new_category($data);
			if($insert_id){
				echo $this->case_studies_model->create_category_list($case_study_id,$insert_id);
			}else{
				echo 'failed';	
			}
		}else{
			echo 'failed';	
		}
	}
	
	function delete_case_study_image()
	{
		$case_study_id = $this->input->post('case_study_id',true);
		if($this->case_studies_model->delete_image_by_id($case_study_id)){
			echo 'success';
		}else{
			echo 'failed';	
		}
	}
	
	function delete_case_study_doc()
	{
		$case_study_id = $this->input->post('case_study_id',true);
		if($this->case_studies_model->delete_document_by_id($case_study_id)){
			echo 'success';
		}else{
			echo 'failed';	
		}
	}
	
	function delete_category()
	{
		$category_id = $this->input->post('category_id',true);
		$case_study_id = $this->input->post('case_study_id',true);
		if($category_id){
			if($this->case_studies_model->delete_category($category_id)){
				echo $this->case_studies_model->create_category_list($case_study_id);
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
		if($this->case_studies_model->permalink_exists($permalink)){
			echo 'exists';	
		}else{
			echo 'donot_exists';	
		}
	}
	
	function search_case_studies()
	{
		$params = $this->input->post('params',true);
		
		echo $this->case_studies_model->search_case_studies($params);
		exit();
	}
	
}