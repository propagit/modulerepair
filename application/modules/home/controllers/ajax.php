<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Home Ajax
 * @author: Propagate Dev Team
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('home_model');
	}
	
	function update_view_count()
	{
		$banner_id = $this->input->post('banner_id',true);
		$this->home_model->update_banner_viewcount($banner_id);
	}
	
}