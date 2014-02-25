<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Adminfile extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('file_model');
	}
	
	public function index($method='', $param='')
	{
		switch($method)
		{
			
			case 'add':
					$this->add_file();
				break;
			
			case 'delete':
					$this->delete_file($param);
				break;
			
				
			case 'update':
					$this->edit_file();
				break;
			case 'search':
					$this->search();
				break;
			
			
			default:
					$this->file_list($method);
				break;
		}
	}
	
	function add_file()
	{
		//print_r($_POST);
		//exit;
					
		$config['upload_path'] = "./uploads/files/";
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|jpeg|jpg|pdf|gif|png|txt';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			$this->session->set_flashdata('error_upload',$this->upload->display_errors());
			redirect('admin/file');		
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];
			$size = $data['upload_data']['file_size'];
			# Add details to database			
			$data_file = array(
				'url' => $name,
				'name' => $_POST['filename'],
				'size' => $size
			);
			$this->file_model->add($data_file);					
		}
		redirect('admin/file');	
		
	}
	
	function edit_file()
	{
		//print_r($_POST);
		//exit;
		
		$id = $_POST['file_id'];
		$name = $_POST['filename'];
			
		$config['upload_path'] = "./uploads/files/";
		$config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|jpeg|pdf|gif|png|txt';
		$config['max_size']	= '4096'; // 4 MB
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()) {
			//$this->session->set_flashdata('error_upload',$this->upload->display_errors());
			//redirect('admin/file');		
			$data_file = array(
				'name' => $_POST['filename']
			);
			$this->file_model->update($id,$data_file);		
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];
			$size = $data['upload_data']['file_size'];
			# Add details to database			
			$data_file = array(
				'url' => $name,
				'name' => $_POST['filename'],
				'size' => $size
			);
			$this->file_model->update($id,$data_file);					
		}
		
		
		
		redirect('admin/file');	
	}
	
	function edit_page($id)
	{
		$data['page'] = $this->page_model->identify($id);
		
		$this->load->view('admin_page_edit', isset($data) ? $data : NULL);
	}
	
	function delete_file($id)
	{
		$file = $this->file_model->identify($id);
		unlink("./uploads/files/".$file['url']);
		$this->file_model->delete($id);
	}
	
	function duplicate_page()
	{
		$name = $_POST['name'];
		$id = $_POST['id'];
		
		$data = $this->page_model->identify($id);
		
		$new_id_title = $name;
		$new_id_title = str_replace(' ','-',$new_id_title);
		$new_id_title = str_replace("'","",$new_id_title);
		$new_id_title = str_replace("&","and",$new_id_title);
		$new_id_title = str_replace("+","and",$new_id_title);
		
		$data = $this->page_model->identify($id);
		
		if($data['id_title'] == $new_id_title)
		{
			echo 0;
		}
		else 
		{
			$data['id'] = NULL;
			$data['title'] = $name;
			$data['id_title'] = $new_id_title;
			
			$new_id = $this->page_model->add($data);
			
			
			
			echo $new_id;
		}
		
		
	}
	
	
	function file_list($offset='')
	{
		$data['files'] = $this->file_model->all_files();			
		$this->load->view('admin_file_list', isset($data) ? $data : NULL);
	}
	
	function search()
	{
		$keyword = $_POST['keyword'];
		$data['files'] = $this->file_model->search($keyword);			
		$this->load->view('admin_file_list', isset($data) ? $data : NULL);
	}
	

}