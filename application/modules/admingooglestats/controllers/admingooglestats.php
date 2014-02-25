<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admingooglestats extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('googlestats_model');
	}
	
	public function index($method='',$param='')
	{
		switch($method)
		{
			
			case 'update':
				$this->update();
			break;
			default:
					$this->googlelist();
			break;
		}
	}
	
	function googlelist()
	{
		$data['webstat'] = $this->googlestats_model->identify(1);	
		$this->load->view('admin_googlestats_list', isset($data) ? $data : NULL);
	}
	function update()
	{
		
		$data=array(
			'web_email' => $this->input->post('web_email'),
			'web_password' => $this->input->post('web_password'),
			'profile_id' => $this->input->post('profile_id')
		);
		$this->googlestats_model->update(1,$data);
		redirect('admin/googlestats');
	}
	
		
}