<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller: Home
 * @author: propagate dev team
 */
class Home extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	

	function index($method='', $param='')
	{
		switch($method)
		{
			case 'link':
				$this->link($param);
			break;
					
			default:
				$this->home();
			break;
		}
	}
	
	function home()
	{
		$this->load->view('home', isset($data) ? $data : NULL);
	}
	
	function link($banner_id = '')
	{
		if($banner_id){
			$banner = $this->home_model->update_banner_hitcount($banner_id);
		}else{
			redirect(base_url());	
		}
	}

	
	
	
	
}