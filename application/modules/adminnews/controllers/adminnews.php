<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Adminnews extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('news_model');
	}
	
	function index($method='', $param='')
	{
		switch($method)
		{
			case 'add':
				$this->add();
			break;
			
			case 'add_new_news':
				$this->add_new_news();
			break;
			
			case 'edit':
				$this->edit($param);
			break;
			
			case 'update_news':
				$this->update_news();
			break;
			
			case 'activate':
				$this->activate($param);
			break;
			
			case 'deactivate':
				$this->deactivate($param);
			break;
			
			case 'delete_news':
				$this->delete($param);
			break;
			
			case 'update_records_per_page':
				$this->update_records_per_page();
			break;
			
			case 'test':
				$this->test();
			break;
			
			default:
				$this->list_all($method);
			break;
		}
	}
	
	function list_all($offset='')
	{
		$data['categories'] = $this->news_model->get_all_categories();	
		$data['records_per_page'] = $this->news_model->get_records_per_page();		
		$this->load->view('admin_news_list', isset($data) ? $data : NULL);
	}
	
	function add()
	{
		$this->load->view('admin_news_add', isset($data) ? $data : NULL);	
	}
	
	function add_new_news()
	{
	
		$title = $this->input->post('title',true);
		$id_title = $this->input->post('id_title',true);
		$date = $this->input->post('date',true);
		$gallery_id = $this->input->post('gallery_id',true);
		$preview_article = $this->input->post('preview_article',true);
		$complete_article = $this->input->post('complete_article',true);
		$article_categories = $this->input->post('article_categories',true);
		$meta_title = $this->input->post('meta_title',true);
		$meta_desc = $this->input->post('meta_desc',true);
		$meta_keywords = $this->input->post('meta_keywords',true);
		
		$data = array(
				'title' => $title,
				'news_date' => date('Y-m-d', strtotime($date)),
				'preview' => $preview_article,
				'content' => $complete_article,
				'gallery' => $gallery_id,
				'meta_title' => $meta_title,
				'meta_description' => $meta_desc,
				'meta_keywords' => $meta_keywords
				); 
				
		$insert_id = $this->news_model->add_news($data);
		if($insert_id){
			//insert article categories
			if($article_categories){
				$this->news_model->add_news_categories($article_categories, $insert_id);
			}
			//check if permalink exists and make necessary changes
			if($this->news_model->permalink_exists($id_title)){
				$id_title_temp = $id_title.'-'.$insert_id;
			}else{
				$id_title_temp = $id_title;	
			}
			
			$this->news_model->update_news($insert_id,array('id_title' => $id_title_temp));
			
			//create folder
			$folder_name = $this->news_model->create_folders('./uploads/news','wave1_news'.$insert_id,array('thumb','thumb2','doc'));
		}
		
		$this->load->library('upload');
		//if image file has been uploaded
		if ($_FILES['userfile_thumb']['name']){
		//image upload
		$config['upload_path'] = "./uploads/news/".$folder_name;	
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('userfile_thumb')) {
				//image upload filed abort file upload
				$data['upload_error'] = $this->upload->display_errors();
				$valid_upload = false;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$image_name = $data['upload_data']['file_name'];
				# Create thumbnails thumb
				$path = "./uploads/news/".$folder_name;
				$this->news_model->create_thumbs($image_name,$path);

				//update image name
				$data = array(
						'image' => $image_name,
						);
				$this->news_model->update_news($insert_id,$data);											
			}
		}
		
		//if document has been uploaded
		if ($_FILES['userfile_download']['name']){
		//document upload
		$config_file['upload_path'] = "./uploads/news/".$folder_name."/doc";	
		$config_file['allowed_types'] = 'pdf';
		$config_file['max_size']	= '4096'; // 4 MB
		$config_file['overwrite'] = FALSE;
		$config_file['remove_space'] = TRUE;
		$this->upload->initialize($config_file);
		//$this->load->library('upload', $config_file);
		if (!$this->upload->do_upload('userfile_download')) {
				//upload filed abort file upload
				$data['upload_error'] = $this->upload->display_errors();
				$valid_upload = false;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$doc_name = $data['upload_data']['file_name'];


				//update image name
				$data = array(
						'doc' => $doc_name,
						);
				$this->news_model->update_news($insert_id,$data);											
			}
		}
		redirect('admin/news/edit/'.$insert_id);
	}
	
	function edit($news_id = '')
	{
		if(!$news_id){
			redirect('admin/news');	
		}
		$data['news'] = $this->news_model->get_news($news_id);
		$this->load->view('admin_news_add', isset($data) ? $data : NULL);	
	}
	
	function update_news()
	{
	
		$title = $this->input->post('title',true);
		$id_title = $this->input->post('id_title',true);
		$date = $this->input->post('date',true);
		$gallery_id = $this->input->post('gallery_id',true);
		$preview_article = $this->input->post('preview_article',true);
		$complete_article = $this->input->post('complete_article',true);
		$article_categories = $this->input->post('article_categories',true);
		$meta_title = $this->input->post('meta_title',true);
		$meta_desc = $this->input->post('meta_desc',true);
		$meta_keywords = $this->input->post('meta_keywords',true);
		$update_id = $this->input->post('update_id',true);
		
		$data = array(
				'title' => $title,
				'news_date' => date('Y-m-d', strtotime($date)),
				'preview' => $preview_article,
				'content' => $complete_article,
				'gallery' => $gallery_id,
				'meta_title' => $meta_title,
				'meta_description' => $meta_desc,
				'meta_keywords' => $meta_keywords
				); 
				
		$this->news_model->update_news($update_id,$data);

		//insert article categories
		if($article_categories){
			//delete previous categories and update with new ones
			if($this->news_model->delete_news_category_relation($update_id)){
				$this->news_model->add_news_categories($article_categories, $update_id);
			}
		}
		
		//to leave id title variable intact in case it is used in the future
		$id_title_temp = $id_title;
		
		//check if permalink exists and make necessary changes
		while($this->news_model->permalink_exists($id_title_temp,$update_id)){
			$id_title_temp = $id_title_temp.'-'.$update_id;
		}
		
		$this->news_model->update_news($update_id,array('id_title' => $id_title_temp));
		$folder_name = md5('wave1_news'.$update_id);	
	
		
		$this->load->library('upload');
		//if image file has been uploaded
		if ($_FILES['userfile_thumb']['name']){
			
			//delete current image
			if($this->news_model->delete_image_by_id($update_id)){	
					
			//image upload
			$config['upload_path'] = "./uploads/news/".$folder_name;	
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '4096'; // 4 MB
			$config['max_width']  = '4000';
			$config['max_height']  = '4000';
			$config['overwrite'] = FALSE;
			$config['remove_space'] = TRUE;
			
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile_thumb')) {
					//image upload filed abort file upload
					$data['upload_error'] = $this->upload->display_errors();
					$valid_upload = false;
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$image_name = $data['upload_data']['file_name'];
					# Create thumbnails thumb
					$path = "./uploads/news/".$folder_name;
					$this->news_model->create_thumbs($image_name,$path);
	
					//update image name
					$data = array(
							'image' => $image_name,
							);
					$this->news_model->update_news($update_id,$data);											
				}
			}
		}
		
		//if document has been uploaded
		if ($_FILES['userfile_download']['name']){
			
			//delete current document
			if($this->news_model->delete_document_by_id($update_id)){	
			//document upload
			$config_file['upload_path'] = "./uploads/news/".$folder_name."/doc";	
			$config_file['allowed_types'] = 'pdf';
			$config_file['max_size']	= '4096'; // 4 MB
			$config_file['overwrite'] = FALSE;
			$config_file['remove_space'] = TRUE;
			$this->upload->initialize($config_file);
			//$this->load->library('upload', $config_file);
			if (!$this->upload->do_upload('userfile_download')) {
					//upload filed abort file upload
					$data['upload_error'] = $this->upload->display_errors();
					$valid_upload = false;
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$doc_name = $data['upload_data']['file_name'];
	
	
					//update image name
					$data = array(
							'doc' => $doc_name,
							);
					$this->news_model->update_news($update_id,$data);											
				}
			}
		}
		redirect('admin/news/edit/'.$update_id);
	}
	
	function activate($news_id)
	{
		if($news_id){
			$this->news_model->update_news($news_id,array('status' => 'active'));	
		}
		redirect('admin/news');
	}
	
	function deactivate($news_id)
	{
		if($news_id){
			$this->news_model->update_news($news_id,array('status' => 'inactive'));	
		}
		redirect('admin/news');
	}
	
	function delete($news_id)
	{
		if($news_id){
			$this->news_model->delete_news($news_id);	
		}
		redirect('admin/news');
	}
	
	function update_records_per_page()
	{
		$backend = $this->input->post('records_per_page_backend',true);	
		$frontend = $this->input->post('records_per_page_frontend',true);
		$id = $this->input->post('records_per_page_id',true);
		$data = array(
					'backend' => $backend,
					'frontend' => $frontend
					);
		$this->news_model->update_records_per_page($id,$data);
		redirect('admin/news');
	}
	
	function test()
	{
		echo md5('wave1_news1');
		exit;	
	}
	

}