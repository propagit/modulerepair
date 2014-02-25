<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Dashboard Ajax
 * @author: propagate dev team
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();	
		$this->load->model('dashboard_model');
	}
	
	
	function get_web_stats()
	{
		echo $this->dashboard_model->get_webstat();	
	}
	
	function get_customer_stats()
	{
		echo $this->dashboard_model->get_customer_stats();	
	}
	
	function get_products_stats()
	{
		echo $this->dashboard_model->get_products_stats();	
	}
	
	function get_pages_stats()
	{
		echo $this->dashboard_model->get_pages_stats();	
	}
	
	function get_articles_stats()
	{
		echo $this->dashboard_model->get_articles_stats();	
	}
	
	function get_galleries_stats()
	{
		echo $this->dashboard_model->get_galleries_stats();	
	}
	
	function get_dash_modules()
	{
		echo $this->dashboard_model->generate_dashboard_lists();	
	}
	
}