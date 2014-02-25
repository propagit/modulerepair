<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

 * @class_name: Product

 * 

 */



class Ajax extends MX_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model('navigation_model');


	}

	function get_nav_title()
	{
		$id = $_POST['id'];
		$nav = $this->navigation_model->get_detailnav($id);
		return $nav['name'];
	}
	
	function get_nav_url()
	{
		$id = $_POST['id'];
		$nav = $this->navigation_model->get_detailnav($id);
		return $nav['url'];
	}
	
	function get_nav_page()
	{
		$id = $_POST['id'];
		$nav = $this->navigation_model->get_detailnav($id);
		return $nav['page'];
	}
	
	function edit_nav()
	{
		$id = $_POST['id'];
		$data['name'] = $_POST['title'];
		$data['url'] = $_POST['url'];
		$data['page'] = $_POST['page'];
		
		$this->navigation_model->update($id,$data);
	}
	
	function get_url()
	{
		$id = $_POST['id'];
		echo $this->navigation_model->get_link_url($id);
	}
	
	function get_page()
	{
		$id = $_POST['id'];
		echo $this->navigation_model->get_link_page($id);
	}

	

	

	

}