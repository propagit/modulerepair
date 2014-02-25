<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Adminbanner extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('banner_model');
	}
	
	public function index($method='',$param='')
	{
		switch($method)
		{
			case 'add':
					$this->add_banner();
			break;
			
			case 'listorder':
					$this->listorder();
			break;		
			
			default:
					$this->banner_list();
			break;
		}
	}
	
	function listorder()
	{
		$order=$this->input->post('textorder');
		$orders = explode(',',$order);
		//$banners = $this->banner_model->all_files();	
		$j=0;
		foreach($orders as $banner)
		{
			$data=array(
				'position' => $j
			);
			
			$this->banner_model->update($banner,$data);
			
			$j++;
			
		}
		redirect('admin/banner');
	}
	function banner_list()
	{
		$data['banners'] = $this->banner_model->all_files();	
		$this->load->view('admin_banner_list', isset($data) ? $data : NULL);
	}
	
	function add_banner()
	{
		
		$config['upload_path'] = "./uploads/banners/";
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|jpeg|jpg|pdf|gif|png|txt';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			$this->session->set_flashdata('error_upload',$this->upload->display_errors());
			redirect('admin/banner');		
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];

			# Add details to database			
			$data_file = array(
				'url' => $_POST['web_link'],
				'name' => $name,
				'created' => date('Y-m-d H:i:s')
			
			);
			$this->banner_model->add($data_file);					
		}
		redirect('admin/banner');	
		
	}
		
}