<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Cart
 * @author: propagate dev team
 */

class Cart extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('cart_model');
	}
	
	public function index($method='', $param='')
	{
		
	}

	
	
}