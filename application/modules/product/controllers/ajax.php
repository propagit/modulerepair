<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/**

 * @class_name: Product

 * 

 */



class Ajax extends MX_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model('product_model');

		$this->load->model('category_model');

	}

	
	
	

	

	

}