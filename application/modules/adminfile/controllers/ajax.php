<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('file_model');
	}
	
	
	
	function get_name() 
	{
		$id = $_POST['id'];
		$file = $this->file_model->identify($id);
		echo $file['name'];
	}
	
	function get_url() 
	{
		$id = $_POST['id'];
		$file = $this->file_model->identify($id);
		echo $file['url'];
	}
}