<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_model');
		
	}
	
	function delete()
	{
		$id=$this->input->post('id');
		
		$this->banner_model->delete($id);
	}
	function toggle()
	{
		$id=$this->input->post('id');
		$banner = $this->banner_model->identify($id);
		
		if($banner['actived']==1){
			$data=array('actived'=>0);
			$status=0;
		}
		else
		{
			$data=array('actived'=>1);
			$status=1;
		}
		
		$this->banner_model->update($id,$data);
		
		echo $status;
	}
	
	function update()
	{
		$id=$this->input->post('id');

		$url=$this->input->post('url');

		$data=array('url'=>$url);
		
		$this->banner_model->update($id,$data);
		
		
	}
}