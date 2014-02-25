<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Admincustomer extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
		$this->load->model('user_model');
		$this->load->model('system_model');
		$this->load->model('lookup_model');
	}
	
	public function index($method='',$param='')
	{
		switch($method)
		{
			
			case 'search':
					$this->search($param);
				break;	
			case 'add':
					$this->add($param);
				break;		
			case 'create':
					$this->create($param);
				break;		
			case 'detail':
					$this->detail($param);
				break;		
			case 'update':
					$this->update();
				break;	
			case 'delete':
					$this->delete($param);
				break;		
			case 'set_sort_cust':
					$this->set_sort_cust($param);
				break;	
				
			case 'export_csv':
					$this->export_csv();
				break;			
			default:
					$this->customer_list();
				break;
		}
	}
	
	
	function set_sort_cust($input = 0)
	{
		/*
		 * $input = 0 = none
		 * $input = 1 = by customer name
		 * $input = 2 = by customer email
		 * */
		 
		 //echo $input;
		 $this->session->set_userdata('admin_sort_cust',$input);
	}
	
	function customer_list()
	{
		//echo 123;
		//exit();
		
		//error_reporting(E_ALL);

		// if($this->session->userdata('admin_sort_cust'))
		// {
			// $sort_by = $this->session->userdata('admin_sort_cust');
			// $this->session->set_userdata('admin_sort_cust',0);
		// }
		// else
		// {
			// $sort_by = 0;
		// }				
// 		
		// //echo $sort_by;	
// 				
		// if ($this->session->userdata('type')) 
		// { 
				// $type = $this->session->userdata('type'); 				
				// if($type==4){$dealer=0; $this->session->set_userdata('dealer',$dealer);}
				// if($type==3){$type=4; $dealer=1; $this->session->set_userdata('dealer',$dealer);}
// 				
		// }
		// else 
		// {
			// if ($this->session->userdata('type') == 0)
			// {
				// $type = 0;
			// } 
			// else
			// {
				// $type = 1;
			// }
		// }
		// $data['type'] = $type;
		// $name='';
		// if ($this->session->userdata('name')){
			// $name=$this->session->userdata('name');	
		// }
		// $email=$name;
// 		
// 		
		// $data['users']=array();
// 			
		// if($type == 5)
		// {
// 					
			// $subs = $this->subscribe_model->all($name);			
			// $data['subscribers'] = $subs;
		// }
		// else
		// {
			// $data['subscribers'] ='';
// 			
			// if(isset($name)&&!empty($name))
			// {
				// $data['users'] = $this->user_model->recognize_keyword($name,$type,$email,$sort_by);				
			// }
			// else
			// {
				// $data['users'] = $this->user_model->get($type,$sort_by);	
				// //echo $this->db->last_query();
			// }
// 		  
		// }
		// $this->session->set_userdata('name','');
		// //$this->load->view('admin_customer_list',$data);
		if(!$this->session->flashdata('search_name_cust'))
		{
			$data['users'] = $this->user_model->all();
		}
		else 
		{
			$data['users'] = $this->user_model->search($this->session->flashdata('search_name_cust'));
		}
		
		
		$this->load->view('admin_customer_list', isset($data) ? $data : NULL);		
	}
	
	function detail($param)
	{
		$user = $this->user_model->id($param);
		$data['customer'] = $this->customer_model->identify($user['customer_id']);
		$data['user'] = $user;
		//$data['countries'] = $this->system_model->get_countries();
		//$data['states'] = $this->system_model->get_states();
		//$data['comments'] = $this->customer_model->all_comment($user['customer_id']);
		//$data['total'] = $this->customer_model->get_total_spend($user['customer_id']);
		$this->load->view('admin_customer_details2',$data);
	}
	
	function add($param)
	{
		$data['countries'] = $this->system_model->get_countries();
		$data['states'] = $this->system_model->get_states();
		$this->load->view('admin_customer_add',$data);
	}
	function create($param)
	{
		
		if ($this->input->post())
		{		
			$data['email'] = $_POST['email'];
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
			
			$cust_id = $this->customer_model->add($data);
			
			$data_user['customer_id'] = $cust_id;
			$data_user['username'] = $_POST['email'];
			$data_user['password'] = md5($_POST['password']);
			$data_user['level'] = 1;
			$data_user['activated'] = 1;
			
			$this->user_model->add($data_user);
			
			
			
			
			
			# Create dir for storing file related to the product
			$path = "./uploads/customers";
			$newfolder = md5('cus'.$cust_id);
			$dir = $path."/".$newfolder;
			
			mkdir($dir,0777);
			chmod($dir,0777);
			$thumb1 = $dir."/thumb1";
			mkdir($thumb1,0777);
			chmod($thumb1,0777);
			$thumb2 = $dir."/thumb2";
			mkdir($thumb2,0777);
			chmod($thumb2,0777);
			$thumb3 = $dir."/thumb3";
			mkdir($thumb3,0777);
			chmod($thumb3,0777);
			$thumb4 = $dir."/thumb4";
			mkdir($thumb4,0777);
			chmod($thumb4,0777);
			$thumb5 = $dir."/thumb5";
			mkdir($thumb5,0777);
			chmod($thumb5,0777);
			$thumb6 = $dir."/thumb6";
			mkdir($thumb6,0777);
			chmod($thumb6,0777);
			$thumb7 = $dir."/thumb7";
			mkdir($thumb7,0777);
			chmod($thumb7,0777);
			$thumb8 = $dir."/thumb8";
			mkdir($thumb8,0777);
			chmod($thumb8,0777);
			$doc = $dir."/doc";
			mkdir($doc,0777);
			chmod($doc,0777);
			//redirect('admin/product/details/'.$product_id);
			
			
			//$product_id = $_POST['product_id'];
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
				$config['new_image'] = "./uploads/customers/".md5('cus'.$gid)."/thumb1/".$name;
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
				
				rename("./uploads/customers/".md5('cus'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/customers/".md5('cus'.$gid)."/thumb1/".$name);
				$this->image_lib->clear();
				
				// Crop thumbnail			
				$config['image_library'] = 'GD2';
				$config['source_image'] = "./uploads/customers/".md5('cus'.$gid)."/thumb1/".$name;
				
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
				unlink("./uploads/customers/".md5('cus'.$gid)."/thumb1/".$file_name);
				rename("./uploads/customers/".md5('cus'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/customers/".md5('cus'.$gid)."/thumb1/".$name);
			}
			
			
			
			redirect('admin/customer');
		}
		else
		{
			//$data['pickers']= $this->picker_model->get_pickers_active();
			//$this->load->view('admin_product_add');
			redirect('admin/customer');
		}
		
		
		
	}
	function update()
	{
		if (!isset($_POST['id'])) { redirect('admin/customer'); }
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
		
		
		redirect('admin/customer/detail/'.$id);
	}
	
	function delete($param)
	{
		$id=$param;
		$user = $this->user_model->id($id);
		$customer = $this->customer_model->identify($user['customer_id']);
		#check order
		//$cust_order = $this->customer_model->identify_order($user['customer_id']);
		
		if(count($cust_order)>0)
		{
			#update cust
			$this->user_model->delete($id);
			$this->customer_model->update($user['customer_id'],array('deleted' =>1));
		}
		else
		{
			$this->user_model->delete($id);
			$this->customer_model->delete($user['customer_id']);
		}
		//$this->Order_model->delete($user['customer_id']);
		
		//redirect('admin/customer');
	}
	function search()
	{
		$this->session->set_flashdata('search_name_cust',$_POST['keyword']);	
		
		//$this->load->view('admin_customer_list', isset($data) ? $data : NULL);	
		//$this->session->set_userdata('type',1);
		//echo $this->session->userdata('name');		
		redirect('admin/customer');
	}
	
	function export_csv()
	{
		$field_name = '';
		$field_name = $this->input->post('field_name',true);
		$file_name = 'Customer-Exports';
		$date = date('Y-m-d');
		  
		  ob_start();
		  header('Content-Type: text/csv');
		  header('Content-Disposition: attachment; filename=' . $file_name . '-' . $date . '.csv');
		  header('Expires: 0');
		  header("Content-Transfer-Encoding: binary");
		  // Generate the server headers
		  if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
		  {
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header("Content-Transfer-Encoding: binary");
			header('Pragma: public');
		  }
		  else
		  {
			header('Pragma: no-cache');
		  }
	 
	
		  $header = '';
		  // Output header
		  $total = count($field_name);
		  $select = 'select ';
		  $count = 0;
		  $out = '';
		  foreach($field_name as $f){
			  $count++;
			  $header .= ucwords($f); 
			  $select .= $f;
			  if($count < $total){
				   $header .= ",";  
				   $select .= ','; 
			  }
		  }
		  
		  $sql = $select." from customers order by firstname asc";
		  $customers = $this->db->query($sql)->result();
		  if($customers){
		  	  foreach($customers as $c){
				 foreach($field_name as $f){
					 $out .= str_replace(array("\r", "\r\n", "\n", ","), '-', $c->$f).",";
				 }
				 $out .= "\r\n";
			  }
			 
		  }

		  echo $header."\r\n".$out;
	
		  ob_end_flush(); 
		  exit();

	}
	

		
}