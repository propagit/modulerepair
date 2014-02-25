<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Case Studies
 * @author: propagate dev team
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('news_model');
	}
	
	function search_news()
	{
		$params = $this->input->post('params',true);
		
		echo $this->news_model->search_news($params);
		exit();
	}
	
}