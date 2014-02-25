<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Client controller. 
*	@class_comments 
*	
*
*/
 
class Client extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('client_model');
		$this->load->model('lookup_model');
		$this->load->model('user_model');
		$this->load->model('customer_model');
		
	}	
	
	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{		
			case 'validate':
				$this->validate();
			break;
			
			case 'edit':
				$this->client_edit();
			break;
			
			case 'update':
				$this->update();
			break;
			
			case 'sign_out':
				$this->sign_out();
			break;
			
			default:
				$this->document_overview($param1,$param2);
			break;
		}
	}
	
	/**
	*	@desc Shows the document overview
	*	
	*	@name document_overview
	*	@access public
	*	@return shows view file
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	

	function document_overview($category_link="",$product_link="")
	{
		//error_reporting(E_ALL);
		if($this->session->userdata('id')){
			$data['customer'] = $this->client_model->get_customer($this->session->userdata('id'));
			$data['files'] = $this->client_model->get_all_files();
			$this->load->view('client', isset($data) ? $data : NULL);
		}else
		{
			redirect(base_url());
		}
	}

	function validate()
	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$validate = $this->client_model->validate($username,$password);
		if(count($validate)>0)
		{
			$this->session->set_userdata('id',$validate['customer_id']);
			$this->session->set_userdata('userid',$validate['id']);
			$this->session->set_userdata('login',TRUE);
			redirect('client');
		}
		else
		{
			
			redirect(base_url());
		}				
	}
	
	function sign_out()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	function client_edit()
	{
		$data['user'] = $this->lookup_model->customer_id($this->session->userdata('id'));
		$data['customer'] = $this->client_model->get_customer($this->session->userdata('id'));
		$this->load->view('client_edit', isset($data) ? $data : NULL);
	}
	
	function update()
	{
		if (!isset($_POST['id'])) { redirect('client/edit'); }
		$id = $_POST['id'];
		$user = $this->user_model->id($id);
		
		$customer = $this->customer_model->identify($user['customer_id']);
		
		
		$data['firstname'] = $_POST['firstname'];
		$data['lastname'] = $_POST['lastname'];
		$data['phone'] = $_POST['phone'];
		$data['mobile'] = $_POST['mobile'];
		$data['address'] = $_POST['address'];
		$data['address2'] = $_POST['address2'];
		$data['suburb'] = $_POST['suburb'];
		$data['state'] = $_POST['state'];
		$data['country'] = $_POST['country'];
		$data['postcode'] = $_POST['postcode'];
		
		$this->customer_model->update($customer['id'],$data);
		
		if($_POST['password'] != '')
		{
			$data_user['password'] = md5($_POST['password']);
			$this->user_model->update($id,$data_user);
		}
		
		$cust_id = $user['customer_id'];
		
		$directory = md5('cus'.$cust_id);
		$config['upload_path'] = "./uploads/customers/".$directory;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload()) {
			//echo $this->upload->display_errors();
			//exit;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];
			# Add details to database			
			$photo = array(
				'image' => $name
			);
			$this->customer_model->update($cust_id,$photo);		
						
						
			// Thumbnail creation
			$config = array();
			$config['source_image'] = "./uploads/customers/".md5('cus'.$cust_id)."/".$name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			
			//$width_thumb = 262;
			//$height_thumb = 132;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (234/300))
				{
					$config['height'] = 300;
					$config['width'] = intval(300 * ($height/$width));
					$config['master_dim'] = 'height';
				}
				else
				{
					$config['width'] = 300;
					$config['height'] = intval(234 * ($height/$width));
					$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (300/234))
				{
					$config['width'] = 300;
					$config['height'] = intval(234 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(300 * ($width/$height));
					
				$config['height'] = 234;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 300;
				$config['height'] = intval(300 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$name;
			
			$config['width'] = 300;
			$config['height'] = 234;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$file_name);
			rename("./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/customers/".md5('cus'.$cust_id)."/thumb1/".$name);
		}
		
		
		redirect('client/edit');
	}
	
}