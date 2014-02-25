<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Marketing
 * @author: rseptiane@gmail.com
 */

class Adminmarketing extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
	}
	
	
	public function index($method='', $param='')
	{
		switch($method)
		{
						
			case 'call_survey':
					$this->call_survey();
			break;									
			
			case 'call_email':
					$this->call_email();
			break;									
			
			case 'call_survey':
					$this->call_sms();
			break;					
							
			default:
					$this->call_email();
			break;
		}
	}
	
	
	
	function call_email()
	{
		redirect('http://simplysuite.com.au/dashboard/ajax/login_email/301');
	}
	
	function call_survey()
	{
		redirect('http://simplysuite.com.au/dashboard/ajax/login_survey/301');
	}
	
	function call_sms()
	{
		redirect('http://simplysuite.com.au/dashboard/ajax/login_sms/301');
	}
}