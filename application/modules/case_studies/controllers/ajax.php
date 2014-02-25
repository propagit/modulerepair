<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('case_studies_model');
	}
	
	function search_case_studies()
	{
		$params = $this->input->post('params',true);
		
		echo $this->case_studies_model->search_case_studies($params);
		exit();
	}
	
}