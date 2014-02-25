<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Adminproduct extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('product_model');
		$this->load->model('category_model');
	}
	
	public function index($method='', $param='')
	{
		switch($method)
		{
			
			case 'category':
					$this->product_category($param);
				break;
			case 'addcategory':
					$this->add_category($param);
				break;
			case 'updatecategory':
					$this->update_category($param);
				break;
			case 'deletecategory':
					$this->delete_category($param);
				break;
			case 'categoryactive':
					$this->active_category($param);
				break;
			
			
			case 'search':
					$this->product_search($param);
				break;
			case 'active':
					$this->product_search_status('active');
				break;
			
			case 'inactive':
					$this->product_search_status('inactive');
				break;
			case 'add':
					$this->product_add($param);
				break;
			case 'details':
					$this->product_details($param);
				break;
			case 'delete':
					$this->product_delete($param);
				break;
			case 'actionall':
					$this->actionall($param);
				break;
			case 'gallery':
					$this->product_gallery($param);
				break;
			case 'uploadimage':
					$this->product_gallery_upload_image($param);
				break;
			case 'makeheroimage':
					$this->makeheroimage($param);
				break;	
			case 'deletephoto':
					$this->deletephoto($param);
				break;
						
			case 'switch':
					$this->switch_products($param);
				break;	
			case 'switch_trade':
					$this->switch_trade_products($param);
				break;										 
			case 'exportstock':
					$this->exportstock();
				break;
			case 'importproduct':
					$this->importproduct();
				break;
			case 'updatecategories':
					$this->updatecategories();
				break;
			
			
			
			case 'feature':
					$this->featureproduct($param);
				break;
			case 'removefeature':
					$this->removefeature($param);
				break;	
			case 'movefeatureleft':
					$this->movefeatureleft($param);
				break;
			case 'movefeatureright':
					$this->movefeatureright($param);
				break;
			case 'addfeature':
					$this->addfeature($param);
				break;
			
			
			
			default:
					$this->products_list($method);
				break;
		}
	}
	
	function add_category()
	{
		$id_title = $this->input->post('name_category');
		$id_title = str_replace(' ', '-', $id_title);
		$id_title = str_replace('/', '-', $id_title);
		$id_title = str_replace(',', '-', $id_title);
		$id_title = str_replace('&', 'and', $id_title);
		$id_title = str_replace('+', 'and', $id_title);
		$id_title = strtolower($id_title);
		if($this->input->post())
		{
			$data = array('name' => $this->input->post('name_category'), 'id_title' => $id_title, 'active'=>0, 'created'=>date('Y-m-d H:i:s'));
			$this->category_model->add_productcategory($data);
		}
	}
	function update_category()
	{
		if($this->input->post())
		{
			$id=$this->input->post('id');
			$data = array('name' => $this->input->post('name_category'),'subname'=>$this->input->post('subname_category'),'created'=>date('Y-m-d H:i:s'));
			$this->category_model->update_productcategory($id,$data);
		}
	}
	function delete_category()
	{
		if($this->input->post())
		{
			$id=$this->input->post('id');			
			$this->category_model->delete_productcategory($id);
		}
	}
	
	function active_category($id)
	{
		if($id)
		{			
			$cat_active=$this->category_model->get_detail_productcategory($id);
			if($cat_active['active']==1){$active=0;}
			if($cat_active['active']==0){$active=1;}
			$data = array('active' => $active,'created'=>date('Y-m-d H:i:s'));
			$this->category_model->update_productcategory($id,$data);
		}
		redirect('admin/product/category');	
	}
	
	function product_category()
	{
		$data['categories'] = $this->category_model->any_productcategory();
		$this->load->view('admin_product_category',$data);
	}
	
	
	function featureproduct()
	{
		$data['main'] = $this->category_model->get_main_productcategory();
		$data['features'] = $this->product_model->get_features();	
		//$this->load->view('admin_product_feature', isset($data) ? $data : NULL);	
		$this->load->view('admin_product_feature',$data);
	}
	
	function removefeature($product_id="") {
		$this->product_model->remove_feature($product_id);
		redirect('admin/product/feature');
	}
	
	function movefeatureleft($product_id="")
	{
		$feature = $this->product_model->get_feature($product_id);		
		$prev = $this->product_model->get_prev_feature($feature['order']);
		$this->swap_feature($feature,$prev);										
		redirect('admin/product/feature');	
	}
	function movefeatureright($product_id="")
	{
		$feature = $this->product_model->get_feature($product_id);		
		$next = $this->product_model->get_next_feature($feature['order']);
		$this->swap_feature($feature,$next);
		redirect('admin/product/feature');	
	}
	function swap_feature($one,$two) {
		$this->product_model->update_feature($one['id'],array('order' => $two['order']));
		$this->product_model->update_feature($two['id'],array('order' => $one['order']));
	}
	function addfeature()
	{
		$n = $this->product_model->count_features();
		
		if (isset($_POST['products'])) {
			$products = $_POST['products'];			
			if ($n + count($products) > 12) {
				$this->session->set_flashdata('addft_true',true);
			} else
				foreach($products as $product_id) {
					$feature_id = $this->product_model->add_feature(array('product_id' => $product_id));
					$this->product_model->update_feature($feature_id,array('order' => $feature_id));
				}
		}
		redirect('admin/product/feature');
	}
	
	function actionall()
	{
		$list = $_POST['check_ed'];
		$action = $_POST['action'];
		
		//echo "<pre>".print_r($list,true)."</pre>";
		
		if($action == 1)
		{
			//active
			foreach($list as $l)
			{
				$data = Array();
				$data['status'] = 1;
				$this->product_model->update($l,$data);
			}
		}
		elseif($action == 2)
		{
			//inactive
			foreach($list as $l)
			{
				$data = Array();
				$data['status'] = 0;
				$this->product_model->update($l,$data);
			}
		}
		elseif($action == 3)
		{
			//delete
			foreach($list as $l)
			{
				$prod = $this->product_model->identify($l);
		
				$data = Array();
				$data['deleted']=1;
				$data['id_title']=$prod['id_title'] . '_discontinued';
				//$data = Array();
				//$data['deleted'] = 1;
				$this->product_model->update($l,$data);
			}
		}
		
		redirect('admin/product');
	}
	function product_delete($product_id)
	{
		$prod = $this->product_model->identify($product_id);
		
		$data = Array();
		$data['deleted']=1;
		$data['id_title']=$prod['id_title'] . '_discontinued';
				
		$this->product_model->update($product_id,$data);
		
		// $this->product_model->remove_related($id);
		// $this->product_model->remove_attributes($id);
		// $this->product_model->remove_categories($id);
		//$this->product_model->remove_features($product_id);
		// $this->product_model->delete($id);
		// $this->delete_directory('./uploads/products/'.md5('mbb'.$id));
		redirect('admin/product');
	}
	function product_add()
	{
		if ($this->input->post())
		{		
			$title = $_POST['title'];
			$short_desc = $_POST['short_desc'];
			$long_desc = $_POST['long_desc'];
			$features = $_POST['features'];
			$tech_info = $_POST['tech_info'];
			
			
			
			$available=0;
			if(isset($_POST['status']))
			{
				$available = $_POST['status'];	
			}
			
			
			
				$new_id_title = $title.'-'.$short_desc;
				$new_id_title = str_replace(' ','-',$new_id_title);
				$new_id_title = str_replace("/","-",$new_id_title);
				$new_id_title = str_replace(',', '-', $new_id_title);
				$new_id_title = str_replace("'","",$new_id_title);
				$new_id_title = str_replace("&","and",$new_id_title);
				$new_id_title = str_replace("+","and",$new_id_title);
				# Add new data
			   $data = array(
				'title' => $title,
				'id_title' => $new_id_title,
				'short_desc' => $short_desc,	
				'long_desc' => $long_desc,	
				'features' => $features,	
				'technical_information' => $tech_info,				
				'status' => $available,					
				'modified' => date('Y-m-d H:i:s')
			   );

			$product_id = $this->product_model->add($data);
			
			
			
			# Create dir for storing file related to the product
			$path = "./uploads/products";
			$newfolder = md5('mbb'.$product_id);
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
			$directory = md5('mbb'.$product_id);
			$config['upload_path'] = "./uploads/products/".$directory."/doc";
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '4096'; // 4 MB
			$config['overwrite'] = FALSE;
			$config['remove_space'] = TRUE;
			
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload()) {
				//$this->session->set_flashdata('error_upload',$this->upload->display_errors());
				//redirect('admin/product/gallery/'.$product_id);		
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$name = $data['upload_data']['file_name'];
				# Add details to database			
				$photo = array(
					'pdf_url' => $name
				);
				$this->product_model->update($product_id,$photo);					
							
				
			}
			
			
			
			redirect('admin/product');
		}
		else
		{
			//$data['pickers']= $this->picker_model->get_pickers_active();
			$this->load->view('admin_product_add');
		}
		
	}
	
	
	function product_details($product_id)
	{
		$product = $this->product_model->identify($product_id);
		if (!$product)
		{
			redirect('admin/product');
		}
		if ($this->input->post())
		{
			$id =$this->input->post('id');
			
			$new_id_title = $_POST['title'].'-'.$_POST['short_desc'];
			$new_id_title = str_replace(' ','-',$new_id_title);
			$new_id_title = str_replace("/","-",$new_id_title);
			$new_id_title = str_replace(',', '-', $new_id_title);
			$new_id_title = str_replace("'","",$new_id_title);
			$new_id_title = str_replace("&","and",$new_id_title);
			$new_id_title = str_replace("+","and",$new_id_title);
			
			$available=0;
			if(isset($_POST['status']))
			{
				$available = $_POST['status'];	
			}
			

			
			
			
			//echo "123";
			//exit;
			$directory = md5('mbb'.$product_id);
			$config['upload_path'] = "./uploads/products/".$directory."/doc";
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '4096'; // 4 MB
			$config['overwrite'] = FALSE;
			$config['remove_space'] = TRUE;
			
			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_upload()) {
				//echo $this->upload->display_errors();
				//exit;
				//$this->session->set_flashdata('error_upload',$this->upload->display_errors());
				//redirect('admin/product/gallery/'.$product_id);	
				
				$data = array(
					'title' => $_POST['title'],
					'id_title' => $new_id_title,
					'short_desc' => $_POST['short_desc'],
					'long_desc' => $_POST['long_desc'],		
					'features' => $_POST['features'],	
					'technical_information' => $_POST['tech_info'],				
					'status' => $available,				
					'modified' => date('Y-m-d H:i:s')
				 );
	
				if ($this->product_model->update($id,$data)) 
				{
					$this->session->set_flashdata('update',true);
				}		
			}
			else
			{
				//echo "123";
				//exit;
				$data = array('upload_data' => $this->upload->data());
				$name = $data['upload_data']['file_name'];
				
				$data = array(
					'title' => $_POST['title'],
					'id_title' => $new_id_title,
					'short_desc' => $_POST['short_desc'],
					'long_desc' => $_POST['long_desc'],	
					'features' => $_POST['features'],	
					'technical_information' => $_POST['tech_info'],			
					'status' => $available,				
					'modified' => date('Y-m-d H:i:s'),
					'pdf_url' => $name
				 );
	
				if ($this->product_model->update($id,$data)) 
				{
					$this->session->set_flashdata('update',true);
				}			
							
				
			}
			

			redirect('admin/product');
		}
		
		$data['product'] = $this->product_model->identify($product_id);
			
		$this->load->view('admin_product_details',$data);
	}
	
	function product_search() {
		$keyword = $_POST['keyword'];
		$status = $_POST['status'];
		$sort = $_POST['sort'];
		$category = $_POST['category'];
		$this->session->set_userdata('keyword',$_POST['keyword']);
		$this->session->set_userdata('status',$_POST['status']);
		$this->session->set_userdata('sort',$_POST['sort']);
		$this->session->set_userdata('category',$_POST['category']);
		redirect('admin/product/searchproduct');
	}
	
	function product_search_status($param) {
		$status = $param;
		$this->session->set_userdata('status',$status);
		
		redirect('admin/product/searchproduct');
	}
	
	
	function products_list($offset='')
	{		
		$action=$offset;
		$product_id='';
		$data['main'] = $this->category_model->get_main_productcategory();		
		if($action == "searchproduct") {
			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/product/search/";
			$config['total_rows'] = count($this->product_model->search($this->session->userdata('keyword'),$this->session->userdata('category'),$this->session->userdata('status')));
			$config['per_page'] = '50';
			$config['num_links'] = 3;
			$config['uri_segment'] = 3;
			//$config['cur_tag_open'] = '&nbsp;<span class="active">';
			//$config['cur_tag_close'] = '</span>';
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($product_id!="") { $row = $product_id; }
			$data['products'] = $this->product_model->search_group($row,50,$this->session->userdata('keyword'),$this->session->userdata('category'),$this->session->userdata('sort'),$this->session->userdata('status'));		
			$this->load->view('admin_products_list', isset($data) ? $data : NULL);
		}
 		else if($action == "in_stock")
 		{
 			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/cms/product/in_stock/";
			$config['total_rows'] = count($this->product_model->all_in_stock());
			$config['per_page'] = '50';
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			//$config['cur_tag_open'] = '&nbsp;<span class="active">';
			//$config['cur_tag_close'] = '</span>';
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($product_id!="") { $row = $product_id; }
			$data['products'] = $this->product_model->all_in_stock();
			$this->load->view('admin/product/list',$data);
 		}
 		else if($action == "out_of_stock")
 		{
 			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/cms/product/out_of_stock/";
			$config['total_rows'] = count($this->product_model->all_out_of_stock());
			$config['per_page'] = '50';
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			//$config['cur_tag_open'] = '&nbsp;<span class="active">';
			//$config['cur_tag_close'] = '</span>';
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($product_id!="") { $row = $product_id; }
			$data['products'] = $this->product_model->all_out_of_stock();
			$this->load->view('admin/product/list',$data);
 		}
		else if($action == "inactive")
 		{
 			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/cms/product/out_of_stock/";
			$config['total_rows'] = count($this->product_model->all_disable());
			$config['per_page'] = '50';
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			//$config['cur_tag_open'] = '&nbsp;<span class="active">';
			//$config['cur_tag_close'] = '</span>';
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($product_id!="") { $row = $product_id; }
			$data['products'] = $this->product_model->all_disable();
			$this->load->view('admin/product/list',$data);
 		}
		else if($action == "on_sale")
 		{
 			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/cms/product/out_of_stock/";
			$config['total_rows'] = count($this->product_model->all_on_sale());
			$config['per_page'] = '50';
			$config['num_links'] = 4;
			$config['uri_segment'] = 5;
			//$config['cur_tag_open'] = '&nbsp;<span class="active">';
			//$config['cur_tag_close'] = '</span>';
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($product_id!="") { $row = $product_id; }
			$data['products'] = $this->product_model->all_on_sale();
			$this->load->view('admin/product/list',$data);
 		}
		else 
		{
			$this->load->library('pagination');
			$config['base_url'] = base_url()."admin/product/";
			$config['total_rows'] = count($this->product_model->all());
			$config['per_page'] = '20';
			$config['num_links'] = 3;
			$config['uri_segment'] = 3;
			$config['tag_open'] = '<li>';
			$config['tag_close'] = '</li>';
			$config['full_tag_open'] = '<ul>';
			$config['full_tag_close'] = '</ul>';
			
			$this->pagination->initialize($config);
			
			$data['links'] = $this->pagination->create_links();
			$row = 0;
			if ($action!="" && $action > 0) { $row = $action; }
			$data['products'] = $this->product_model->group_product_list($row);			
			$this->load->view('admin_products_list', isset($data) ? $data : NULL);
		}
	}
	function product_gallery($product_id)
	{		
		$data['product'] = $this->product_model->identify($product_id);
		$data['hero'] = $this->product_model->get_hero($product_id);
		$data['photos'] = $this->product_model->get_photos($product_id);
		
		$this->load->view('admin_product_gallery',$data);		
	}
	function product_gallery_upload_image($param)
	{
		$product_id = $_POST['product_id'];
		$directory = md5('mbb'.$product_id);
		$config['upload_path'] = "./uploads/products/".$directory;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload()) {
			$this->session->set_flashdata('error_upload',$this->upload->display_errors());
			redirect('admin/product/gallery/'.$product_id);		
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];
			$width = $data['upload_data']['image_width'];
			$height = $data['upload_data']['image_height'];
			# Add details to database			
			$photo = array(
				'product_id' => $product_id,
				'name' => $name,
				'created' => date('Y-m-d H:i:s')
			);
			$photo_id = $this->product_model->add_photo($photo);
			$this->product_model->update_photo($photo_id,array('order' => $photo_id));					
						
			$this->resizephoto($data,"./uploads/products/".$directory,"thumb1",$width,$height,472,515,1);
			$this->resizephoto($data,"./uploads/products/".$directory,"thumb2",$width,$height,110,120,2);
			$this->resizephoto($data,"./uploads/products/".$directory,"thumb3",$width,$height,89,97,3);
			$this->resizephoto($data,"./uploads/products/".$directory,"thumb4",$width,$height,66,73,4);
			$this->resizephoto($data,"./uploads/products/".$directory,"thumb5",$width,$height,240,262,5);
			
		}
		redirect('admin/product/gallery/'.$product_id);
	}
	
	function resizephoto($data,$directory,$sub,$owidth,$oheight,$width,$height,$no) {
		//$this->load->helper("thumbnail.class");
		$name = $data['upload_data']['file_name'];
		$config = array();
		$config['source_image'] = $directory."/".$name;
		$config['create_thumb'] = FALSE;
		$config['new_image'] = $directory."/".$sub."/".$name;
		$config['maintain_ratio'] = TRUE;
		$config['quality'] = 100;

	 	$config['width'] = $width;
		$config['height'] = $height;
		if ($owidth*$width < $oheight*$height) {		
				$config['width'] = $width+$no;				
			} else {								
				$config['height'] = $height+$no;
			}
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		$this->image_lib->resize();		
		$this->image_lib->clear();							
	}
	function makeheroimage($photo_id) {
		$photo = $this->product_model->get_photo($photo_id);
		$this->product_model->hero_photo($photo['product_id'],$photo_id);
		redirect('admin/product/gallery/'.$photo['product_id']);
	}
	function deletephoto($photo_id) {
		$photo = $this->product_model->get_photo($photo_id);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/'.$photo['name']);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/thumb1/'.$photo['name']);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/thumb2/'.$photo['name']);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/thumb3/'.$photo['name']);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/thumb4/'.$photo['name']);
		unlink('./uploads/products/'.md5('mbb'.$photo['product_id']).'/thumb5/'.$photo['name']);
		$this->product_model->delete_photo($photo_id);
		redirect('admin/product/gallery/'.$photo['product_id']);
	}
	
	function switch_products($product_id)
	{
		$product = $this->product_model->identify($product_id);
		$out = '';
		if ($product['status'] == 0) {
			$this->product_model->update($product_id,array('status' => 1));			
		} else if($product['status'] == 1) {
			$this->product_model->update($product_id,array('status' => 0));
		}
		redirect('admin/product');
	}
	
	function switch_trade_products($product_id) {
		
		$product = $this->product_model->identify($product_id);
		$out = '';
		if ($product['status_trade'] == 0) {
			$this->product_model->update($product_id,array('status_trade' => 1));			
		} else if($product['status_trade'] == 1) {
			$this->product_model->update($product_id,array('status_trade' => 0));			
		}
		redirect('admin/product');
	}
	
	function updatecategories() {
		$product_id = $_POST['product_id'];
		$this->product_model->remove_categories($product_id);
		# Add relation product and category
		if (isset($_POST['categories'])) {
			$categories = $_POST['categories'];
			foreach($categories as $category_id) {
				$data = array(
					'product_id' => $product_id,
					'category_id' => $category_id
				);
				$this->product_model->add_category($data);
			}
		}
		$this->session->set_flashdata('update',true);
		redirect('admin/product');
	}
	
	function exportstock()
	{
		/*error_reporting(E_ALL);
		$csvdir = getcwd();		
		$csvname = 'Product_Stock_'.date('d-m-Y');
		$csvname = $csvname.'.csv';		
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');	
		$stocks=$this->product_model->all();
		$headings = array('Product ID','Product Name','Unit Of Sale','Pack','Short Description','Category','Available','Price A','Sale Price A','Last Price A','Price B','Sale Price B','Last Price B','Price C','Sale Price C','Last Price C','Price D',' Sale Price D','Last Price D','Price E','Sale Price E','Last Price E','Price F','Sale Price F','Last Price F','Stock ID','Stock');
		fputcsv($fp,$headings);
		foreach($stocks as $stock) 
		{
			$cat = $this->category_model->identify($stock['main_category']);						
			fputcsv($fp,array($stock['id'],$stock['title'],$stock['unit_of_sale'],$stock['pack'],$stock['short_desc'],$cat['title'],$stock['status'],$stock['price'],$stock['sale_price'],$stock['last_price'],$stock['price_b'],$stock['sale_price_b'],$stock['last_price_b'],$stock['price_c'],$stock['sale_price_c'],$stock['last_price_c'],$stock['price_d'],$stock['sale_price_d'],$stock['last_price_d'],$stock['price_e'],$stock['sale_price_e'],$stock['last_price_e'],$stock['price_f'],$stock['sale_price_f'],$stock['last_price_f'],$stock['stock_id'],$stock['stock']));
		}
        fclose($fp);		
		*/
		ini_set('memory_limit', '128M');
		ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
		
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin Portal");
		$objPHPExcel->getProperties()->setLastModifiedBy("Admin Portal");
		$objPHPExcel->getProperties()->setTitle("Products");
		$objPHPExcel->getProperties()->setSubject("Products");
		$objPHPExcel->getProperties()->setDescription("Products Excel file, generated from Admin Portal.");
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Product ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Unit Of Sale');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Pack');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Short Description');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Category');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Available');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Sale Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Last Price A');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Sale Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Last Price B');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Sale Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Last Price C');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Sale Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Last Price D');
		$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Sale Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Last Price E');
		$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Sale Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'Last Price F');
		$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'Stock ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Stock');
		
		//$products = $this->product_model->get_products();
		$stocks=$this->product_model->all();
		for($i=0; $i<count($stocks); $i++)
		{			
			$cat = $this->category_model->identify($stocks[$i]['main_category']);	
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i+2), $stocks[$i]['id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . ($i+2), $stocks[$i]['title']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . ($i+2), $stocks[$i]['unit_of_sale']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . ($i+2), $stocks[$i]['pack']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . ($i+2), $stocks[$i]['short_desc']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . ($i+2), $cat['title']);			
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . ($i+2), $stocks[$i]['status']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . ($i+2), $stocks[$i]['price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . ($i+2), $stocks[$i]['sale_price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . ($i+2), $stocks[$i]['last_price']);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . ($i+2), $stocks[$i]['price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . ($i+2), $stocks[$i]['sale_price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . ($i+2), $stocks[$i]['last_price_b']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . ($i+2), $stocks[$i]['price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . ($i+2), $stocks[$i]['sale_price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . ($i+2), $stocks[$i]['last_price_c']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($i+2), $stocks[$i]['price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . ($i+2), $stocks[$i]['sale_price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . ($i+2), $stocks[$i]['last_price_d']);
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . ($i+2), $stocks[$i]['price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('U' . ($i+2), $stocks[$i]['sale_price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('V' . ($i+2), $stocks[$i]['last_price_e']);
			$objPHPExcel->getActiveSheet()->SetCellValue('W' . ($i+2), $stocks[$i]['price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('X' . ($i+2), $stocks[$i]['sale_price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Y' . ($i+2), $stocks[$i]['last_price_f']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Z' . ($i+2), $stocks[$i]['stock_id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('AA' . ($i+2), $stocks[$i]['stock']);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('product');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "CSV");
		$file_name = "products_" . time() . ".csv";
		$objWriter->save("./exports/" . $file_name);
		die($file_name);
	}
	function importproduct()
	{
		ini_set('auto_detect_line_endings', true);
		$config['upload_path'] = "./uploads/docs_raw";
	    $config['allowed_types'] = 'csv|text|txt';
		$config['max_size']	= '8192'; // 8 MB
		$config['overwrite'] = TRUE;
	    $config['remove_space'] = TRUE;
		$errors = '';
		$break = false;
		$warnings = '';
		$this->load->library('upload', $config);
		//print_r($config);
		if ($this->upload->do_upload())
	    {
	      	//echo "good";
	      	
	      	$upload_data = array('upload_data' => $this->upload->data());
      		$file_name = $upload_data['upload_data']['file_name'];
			$error_list='';
			$err_count = 0;
			
			//validation
			$handle1 = fopen(base_url().'uploads/docs_raw/'.$file_name, "r");
			$cc = 0; 
			$line = 1;
			while (($data = fgetcsv($handle1, 5000, ","))!== FALSE) 
			{
				$tempdata = array();
				$tempdata = $data;
				$data = array();
				$data = $tempdata;
				//print_r($data);
				//echo "<br/>";
				
				if($cc != 0)
				{
					$status = 'new';
					$new_prodid = $data[0];
					
					if($new_prodid != '')
					{
						$check_current = $this->product_model->identify($new_prodid);
						if(count($check_current) > 0)
						{
							$status = 'update';
						}
						else
						{
							$err_count++;
							$error_list .= "row#$line col#A - Product ID(".$new_prodid.") does not exist<br/>";
						}
					}
					else
					{
						$status = 'new';
					}
					
					
					$new_id_title = $data[1].'-'.$data[4];					
					$new_id_title = str_replace(' ','-',$new_id_title);
					$new_id_title = str_replace("/","-",$new_id_title);
					$new_id_title = str_replace("'","",$new_id_title);
					$new_id_title = str_replace("&","and",$new_id_title);
					$new_id_title = str_replace("+","and",$new_id_title);
					
					if(trim($new_id_title) == '')
					{
						$err_count++;
						$error_list .= "row#$line col#B - Product title cannot blank<br/>";
					}
					
					// $check_d = $this->product_model->identify2($new_id_title);
// 					
					// if(count($check_d)>0)
					// {
						// if($check_d['deleted'] == 0)
						// {
							// $err_count++;
							// $error_list .= "row#$line col#A - A product with this product name already exists in the system<br/>";
						// }
					// }
					
					$temp = trim($data[4]);
					if($temp == '')
					{
						$err_count++;
						$error_list .= "row#$line col#E - Invalid input, short description cannot empty<br/>";
					}
					
					$temp = trim($data[2]);
					if($temp == '')
					{
						$err_count++;
						$error_list .= "row#$line col#C - Invalid input, short description cannot empty<br/>";
					}
					
					$temp = trim($data[3]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#D - Invalid input, should be numeric<br/>";
					}
					
					// if(strlen($temp)>15)
					// {
						// $err_count++;
						// $error_list .= "row#$line col#C - Invalid input, short description must be less than 16 character<br/>";
					// }
					
					$temp = trim($data[6]);
					if($temp!=1 && $temp!=0)
					{
						$err_count++;
						$error_list .= "row#$line col#D - Invalid input, should be 1 or 0<br/>";
					}
					
					
					$temp = trim($data[7]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#H - Invalid input, should be numeric<br/>";
					}
					
					$temp = trim($data[8]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#I - Invalid input, should be numeric<br/>";
					}
					
					$temp = trim($data[9]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#J - Invalid input, should be numeric<br/>";
					}
					
					$temp = trim($data[10]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#K - Invalid input, should be numeric<br/>";
					}
					
					$temp = trim($data[11]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#L - Invalid input, should be numeric<br/>";
					}
					
					$temp = trim($data[12]);
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#M - Invalid input, should be numeric<br/>";
					}
					
					$temp = strtolower(trim($data[5]));
					$new_cat = $this->category_model->identify_by_name($temp);
					
					if(count($new_cat) > 0)
					{
						
					}
					else 
					{
						$err_count++;
						$error_list .= "row#$line col#F - Invalid input, This category doesn't exist in our category list<br/>";
					}
					
					
					
					
					
				}
				
				
				
				$data = array();
				//echo '<br/><br/>cleared'.$line.'<br/><br/>';
				$cc++;
				$line++;
			}
			//echo $err_count.'<br/>';
			//echo $error_list;
			//exit;

			if($err_count==0)
			{
			//save it
		      	$handle = fopen(base_url().'uploads/docs_raw/'.$file_name, "r");
				$cc = 0; 
				while (($data = fgetcsv($handle, 5000, ","))!== FALSE) 
				{
					if($cc != 0)
					{
						//echo '<pre>'.print_r($data,true).'</pre>';
						
						
						$status = 'new';
						$new_prodid = $data[0];
						
						if($new_prodid != '')
						{
							//echo $new_prodid.'<br/>';
							$status = 'update';
							
						}
						else
						{
							$status = 'new';
						}
						//echo $status.'<br/>';
						
						
						$new_id_title = $data[1].'-'.$data[4];					
						$new_id_title = str_replace(' ','-',$new_id_title);
						$new_id_title = str_replace("/","-",$new_id_title);
						$new_id_title = str_replace("'","",$new_id_title);
						$new_id_title = str_replace("&","and",$new_id_title);
						$new_id_title = str_replace("+","and",$new_id_title);
						
						$ndata = Array();
						$ndata['id_title'] = $new_id_title;
						//$ndata['title'] = $data[1];
						$ntitle = str_replace("'","",$data[1]);
						$ndata['title'] = $ntitle;
						$new_desc = $data[4];
						$new_desc = str_replace("?","'",$new_desc);
						$ndata['short_desc'] = $new_desc;
						$ndata['unit_of_sale'] = $data[2];
						$ndata['pack'] = $data[3];
						$ndata['available'] = $data[6];
						$ndata['price'] = $data[7];
						$ndata['price_b'] = $data[8];
						$ndata['price_c'] = $data[9];
						$ndata['price_d'] = $data[10];
						$ndata['price_e'] = $data[11];
						$ndata['price_f'] = $data[12];
						
						$cat = trim($data[5]);
						
						$new_cat = $this->category_model->identify_by_name($cat);
						
						/*
						$category_id=0;
												if($cat == 'new arrivals') {$category_id = 1;}
												if($cat == 'handbags') {$category_id = 2;}
												if($cat == 'wallets') {$category_id = 3;}
												if($cat == 'travel') {$category_id = 4;}
												if($cat == 'accessories') {$category_id = 5;}
												if($cat == 'sale') {$category_id = 6;}
												if($cat == 'stylefile') {$category_id = 7;}
												if($cat == 'news') {$category_id = 8;}*/
						
						$mcat = $new_cat['id'];
						//$ndata['main_category'] = $new_cat['id'];
						
						
						
						
						
						if($status == 'new')
						{
							//echo "new<br/>";
							//print_r($ndata);
							//exit;
							$ndata['sale_price'] = $data[7];
							$ndata['sale_price_b'] = $data[8];
							$ndata['sale_price_c'] = $data[9];
							$ndata['sale_price_d'] = $data[10];
							$ndata['sale_price_e'] = $data[11];
							$ndata['sale_price_f'] = $data[12];
							$product_id = $this->product_model->add($ndata);
							//echo $status.'<br/>';
							
							//$sql = 'update products set title ="'.$ntitle.'" where id = '.$product_id;
							//$sql = "";
							//$query = $this->db->query($sql);
						}
						else
						{
							
							//print_r($data);
							//exit;
							$product_id = $new_prodid;
							$this->product_model->update($product_id,$ndata);
							
							$sql = "delete from products_categories where product_id = $product_id";
							$query = $this->db->query($sql);
							//main category
							$mcatdata['product_id'] = $product_id;
							$mcatdata['category_id'] = $mcat;
							$this->product_model->add_category($mcatdata);
							
							
							//sub categories
							

						}
						
						
						if($status == 'new')
						{
							$nprod = $this->product_model->identify($product_id);
							$new_desc = $nprod['short_desc'];
							$new_desc = str_replace("?","'",$new_desc);
							$sd = $new_desc;
							$sql = 'update products set short_desc ="'.$sd.'" where id = '.$product_id;
							$query = $this->db->query($sql);
							$mcatdata['product_id'] = $product_id;
							$mcatdata['category_id'] = $mcat;
							$this->product_model->add_category($mcatdata);
						}
						
						
						
						
						
						
						# Create dir for storing file related to the product
						if($status == 'new')
						{
							$path = "./uploads/products";
							$newfolder = md5('mbb'.$product_id);
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
						}
						//echo $product_id.'<br/>';
					}
					$cc++;
				}
				
				//$this->session->set_flashdata('upload_csv_sc','your csv has been successfully Uploaded');
				$cc--;
				$this->session->set_flashdata('upload_csv_sc',"$cc data from your csv has been successfully Uploaded");
				echo 'good';
				//redirect('admin/product');
			}
			else
			{
				$this->session->set_flashdata('upload_csv_er',"sorry, currently we cannot upload your file as we found $err_count error(s):<br/>".$error_list);
				echo 'bad1';
				//redirect('admin/product');
			}
	    }
		else
		{
			$this->session->set_flashdata('upload_csv_er','sorry, currently we cannot upload your file');
			echo 'bad2';
			//redirect('admin/product');
		}
		//redirect('admin/product');
		echo 'bad3';
	}

    function _importproduct()
	{
		ini_set('auto_detect_line_endings', true);
		$config['upload_path'] = "./uploads/docs_raw";
	    $config['allowed_types'] = 'csv|text|txt';
		$config['max_size']	= '8192'; // 8 MB
		$config['overwrite'] = TRUE;
	    $config['remove_space'] = TRUE;
		$errors = '';
		$break = false;
		$warnings = '';
		$this->load->library('upload', $config);
		//print_r($config);
		if ($this->upload->do_upload())
	    {
	      	//echo "good";
	      	
	      	$upload_data = array('upload_data' => $this->upload->data());
      		$file_name = $upload_data['upload_data']['file_name'];
			$error_list='';
			$err_count = 0;
			
			//validation
			$handle1 = fopen(base_url().'uploads/docs_raw/'.$file_name, "r");
			$cc = 0; 
			$line = 1;
			while (($data = fgetcsv($handle1, 5000, ","))!== FALSE) 
			{
				$tempdata = array();
				$tempdata = $data;
				$data = array();
				$data = $tempdata;
				//print_r($data);
				//echo "<br/>";
				
				if($cc != 0)
				{
					$status = 'new';
					$new_prodid = $data[0];
					
					if($new_prodid != '')
					{
						$check_current = $this->product_model->identify($new_prodid);
						if(count($check_current) > 0)
						{
							$status = 'update';
						}
						else
						{
							$err_count++;
							$error_list .= "row#$line col#A - Product ID(".$new_prodid.") does not exist<br/>";
						}
					}
					else
					{
						$status = 'new';
					}
					
					
					$new_id_title = $data[1].'-'.$data[2];					
					$new_id_title = str_replace(' ','-',$new_id_title);
					$new_id_title = str_replace("/","-",$new_id_title);
					$new_id_title = str_replace("'","",$new_id_title);
					$new_id_title = str_replace("&","and",$new_id_title);
					$new_id_title = str_replace("+","and",$new_id_title);
					
					if(trim($new_id_title) == '')
					{
						$err_count++;
						$error_list .= "row#$line col#B - Product title cannot blank<br/>";
					}
					
					// $check_d = $this->product_model->identify2($new_id_title);
// 					
					// if(count($check_d)>0)
					// {
						// if($check_d['deleted'] == 0)
						// {
							// $err_count++;
							// $error_list .= "row#$line col#A - A product with this product name already exists in the system<br/>";
						// }
					// }
					
					$temp = trim($data[2]);
					if($temp == '')
					{
						$err_count++;
						$error_list .= "row#$line col#C - Invalid input, short description cannot empty<br/>";
					}
					
					// if(strlen($temp)>15)
					// {
						// $err_count++;
						// $error_list .= "row#$line col#C - Invalid input, short description must be less than 16 character<br/>";
					// }
					
					$temp = trim($data[3]);
					if($temp!='Y' && $temp!='y' && $temp!='N' && $temp!='n')
					{
						$err_count++;
						$error_list .= "row#$line col#D - Invalid input, should be 'Y'or'y'or'N'or'n'<br/>";
					}
					
					
					$temp = $data[4];
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#E - Invalid input, should be numeric<br/>";
					}
					
					$temp = $data[7];
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#H - Invalid input, should be nummeric<br/>";
					}
					
					$temp = strtolower(trim($data[8]));
					$new_cat = $this->category_model->identify_by_title($temp);
					
					if(count($new_cat) > 0)
					{
						
					}
					else 
					{
						$err_count++;
						$error_list .= "row#$line col#I - Invalid input, This category doesn't exist in our category list<br/>";
					}
					
					
					
					
					$temp = strtolower(trim($data[9]));
					$nscat = explode(';', $temp);
					$new_cat = 1;
					foreach($nscat as $nsc)
					{
						$res = $this->category_model->identify_by_title(trim($nsc));
						if(count($res) > 0)
						{
							
						}
						else
						{
							$new_cat = 0;
						}
					}
					
					if(count($new_cat) > 0)
					{
						
					}
					else 
					{
						if($temp != '')
						{
							$err_count++;
							$error_list .= "row#$line col#J - Invalid input, This category doesn't exist in our category list<br/>";
						}
					}

					$temp = $data[10];
					if(!is_numeric($temp))
					{
						$err_count++;
						$error_list .= "row#$line col#K - Invalid input, should be nummeric<br/>";
					}
					
					$temp = $data[11];
					if(trim($temp) == '')
					{
						$err_count++;
						$error_list .= "row#$line col#L - Stock ID cannot blank<br/>";
					}
				}
				
				
				
				$data = array();
				//echo '<br/><br/>cleared'.$line.'<br/><br/>';
				$cc++;
				$line++;
			}
			//echo $err_count.'<br/>';
			//echo $error_list;
			//exit;

			if($err_count==0)
			{
			//save it
		      	$handle = fopen(base_url().'uploads/docs_raw/'.$file_name, "r");
				$cc = 0; 
				while (($data = fgetcsv($handle, 5000, ","))!== FALSE) 
				{
					if($cc != 0)
					{
						//echo '<pre>'.print_r($data,true).'</pre>';
						
						
						$status = 'new';
						$new_prodid = $data[0];
						
						if($new_prodid != '')
						{
							//echo $new_prodid.'<br/>';
							$status = 'update';
							
						}
						else
						{
							$status = 'new';
						}
						//echo $status.'<br/>';
						
						
						$new_id_title = $data[1].'-'.$data[2];					
						$new_id_title = str_replace(' ','-',$new_id_title);
						$new_id_title = str_replace("/","-",$new_id_title);
						$new_id_title = str_replace("'","",$new_id_title);
						$new_id_title = str_replace("&","and",$new_id_title);
						$new_id_title = str_replace("+","and",$new_id_title);
						
						$ndata = Array();
						$ndata['id_title'] = $new_id_title;
						//$ndata['title'] = $data[1];
						$ntitle = str_replace("'","",$data[1]);
						$ndata['title'] = $ntitle;
						$new_desc = $data[2];
						$new_desc = str_replace("?","'",$new_desc);
						$ndata['short_desc'] = $new_desc;
						$ndata['available_retail'] = trim($data[3]);
						$ndata['price'] = $data[4];
						$ndata['long_desc'] = $data[5];
						$ndata['features'] = $data[6];
						$ndata['weight'] = $data[7];
						
						$cat = trim($data[8]);
						
						$new_cat = $this->category_model->identify_by_title($cat);
						
						/*
						$category_id=0;
												if($cat == 'new arrivals') {$category_id = 1;}
												if($cat == 'handbags') {$category_id = 2;}
												if($cat == 'wallets') {$category_id = 3;}
												if($cat == 'travel') {$category_id = 4;}
												if($cat == 'accessories') {$category_id = 5;}
												if($cat == 'sale') {$category_id = 6;}
												if($cat == 'stylefile') {$category_id = 7;}
												if($cat == 'news') {$category_id = 8;}*/
						
						$mcat = $new_cat['id'];
						$ndata['main_category'] = $new_cat['id'];
						
						$cat = trim($data[9]);
						$scat = Array();
						if($cat != '')
						{
							$cat = explode(';',$cat);
							$ccat = 0;
							//$scat = Array();
							//print_r($cat);
							foreach($cat as $c)
							{
								$new_cat = $this->category_model->identify_by_title(trim($c));
								//print_r($new_cat);
								$scat[$ccat] = $new_cat['id'];
								$ccat++;
							}
						}
						
						
						

						$ndata['volume'] = $data[10];
						$ndata['stock_id'] = $data[11];
						
						
						
						if($status == 'new')
						{
							//echo "new<br/>";
							//print_r($ndata);
							//exit;
							$product_id = $this->product_model->add($ndata);
							//echo $status.'<br/>';
							
							//$sql = 'update products set title ="'.$ntitle.'" where id = '.$product_id;
							//$sql = "";
							//$query = $this->db->query($sql);
						}
						else
						{
							
							//print_r($data);
							//exit;
							$product_id = $new_prodid;
							$this->product_model->update($product_id,$ndata);
							
							$sql = "delete from products_categories where product_id = $product_id";
							$query = $this->db->query($sql);
							//main category
							$mcatdata['product_id'] = $product_id;
							$mcatdata['category_id'] = $mcat;
							$this->product_model->add_category($mcatdata);
							
							
							//sub categories
							foreach($scat as $scatl)
							{
								$scatdata['product_id'] = $product_id;
								$scatdata['category_id'] = $scatl;
								$this->product_model->add_category($scatdata);
							}

						}
						
						
						if($status == 'new')
						{
							$nprod = $this->product_model->identify($product_id);
							$new_desc = $nprod['short_desc'];
							$new_desc = str_replace("?","'",$new_desc);
							$sd = $new_desc;
							$long_desc = $nprod['long_desc'];
							$long_desc = str_replace("?","'",$new_desc);
							$ld = $long_desc;
							
							$sql = 'update products set short_desc ="'.$sd.'", long_desc = "'.$ld.'" where id = '.$product_id;
							$query = $this->db->query($sql);
							
							
							
							
							$mcatdata['product_id'] = $product_id;
							$mcatdata['category_id'] = $mcat;
							$this->product_model->add_category($mcatdata);
							foreach($scat as $scatl)
							{
								$scatdata['product_id'] = $product_id;
								$scatdata['category_id'] = $scatl;
								$this->product_model->add_category($scatdata);
							}
						}
						
						
						
						
						
						
						# Create dir for storing file related to the product
						if($status == 'new')
						{
							$path = "./uploads/products";
							$newfolder = md5('mbb'.$product_id);
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
						}
						//echo $product_id.'<br/>';
					}
					$cc++;
				}
				
				//$this->session->set_flashdata('upload_csv_sc','your csv has been successfully Uploaded');
				$cc--;
				$this->session->set_flashdata('upload_csv_sc',"$cc data from your csv has been successfully Uploaded");
				
				redirect('admin/product');
			}
			else
			{
				$this->session->set_flashdata('upload_csv_er',"sorry, currently we cannot upload your file as we found $err_count error(s):<br/>".$error_list);
				redirect('admin/product');
			}
	    }
		else
		{
			$this->session->set_flashdata('upload_csv_er','sorry, currently we cannot upload your file');
			
			//redirect('admin/product');
		}
	}

}