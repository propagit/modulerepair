<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Adminnavigation extends MX_Controller {
	/**
	*	@class_desc Navigation controller. Controls most of the navigation of the website including creating main naviagation, sub navigation and link pages under navigation. 
	*	@class_comments Dependent on Navigation Model and Page model from page controller.
	*	
	*
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('navigation_model');
		$this->load->model('adminpage/page_model');
		$this->load->model('adminproduct/category_model');
	}
	
	/**
	*	@desc This is the index function
	*
	*   @name index
	*	@access public
	*	@param [string]method, [string] param
	*	@return to link to the correct function
	*/
	
	public function index($method='',$param='')
	{
		switch($method)
		{
			
			case 'add':
					$this->add($param);
				break;		
			case 'change_status_active':
					$this->change_status_active($param);
				break;	
				
			case 'addsub' :
					$this->addsub();
				break;
			
			case 'detail':
					$this->detail($param);
				break;		
			case 'update':
					$this->update($param);
				break;	
			case 'delete':
					$this->delete($param);
				break;	
			case 'deletelinks':
					$this->deletelinks();
				break;	
			case 'edit_link':
					$this->edit_link();
				break;	
				
			case 'order_nav_links_position':
					$this->order_nav_links_position();
				break;		
			case 'set_sort_cust':
					$this->set_sort_cust($param);
				break;				
			default:
					$this->navigation_list();
				break;
		}
	}
	
	/**
	*	@desc This is the navigation list function
	*
	*   @name navigation_list
	*	@access public
	*	@param [string]action
	*	@return shows all main navigation list 
	*/
	
	public function navigation_list($action='')
	{
		$data['pages'] = $this->page_model->all_pages();
		$data['main'] = $this->navigation_model->get_mainnav();
		$this->load->view('admin_navigation_list', isset($data) ? $data : NULL);		
	}
	
	function deletelinks()
	{
		$id=$_POST['id'];
		$this->navigation_model->deletelinks($id);
	}
	
	function edit_link()
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$data['name'] = $name;
		$data['url'] = $_POST['url'];
		$data['page'] = $_POST['page'];
		
		$this->navigation_model->updatelinks($id,$data);
	}
	
	
	/**
	*	@desc This is add navigation function
	*
	*   @name add
	*	@access public
	*	@return shows all main navigation list 
	*/
	public function add()
	{
		$title = $this->input->post('title',true);
		if($title!='')
		{
			$data = array(
				'parent' => 0,
				'position' => 0,
				'name' => $title,
				'url' =>'',
				'active' => 0,
				'modified' => date('Y-m-d H:i:s')
			);
			$id = $this->navigation_model->add($data);
		}
			
		redirect('admin/navigation');
	}
	
	public function change_status_active($param)
	{
		$menus = $this->navigation_model->get_detailnav($param);
		if($menus['active']==1)
		{
			$set=0;
		}else {$set=1;}
		
		$data = array(
			'active' => $set,
			'modified' => date('Y-m-d H:i:s')
		);
		
		$this->navigation_model->update($param,$data);
		redirect('admin/navigation');
	}
	
	
	public function detail($param)
	{
		$data['menus'] = $this->navigation_model->get_detailsubnav($param);
		if($param == 3){
			$data['product_categories'] = $this->category_model->get_main_productcategory();		
		}
		$data['pages'] = $this->page_model->all_pages();
		$data['alllinks'] = $this->navigation_model->get_all_links($param);
		$data['menu_id'] = $param;
		
		$menu_info = $this->navigation_model->get_menu($param);
		if($menu_info){
			$data['menu_info'] = $menu_info;	
		}else{
			redirect('admin/navigation');
		}	
		
		$this->load->view('admin_navigation_detail', isset($data) ? $data : NULL);
	}
	
	public function addsub()
	{
		if($this->input->post())
		{
			//print_r($_POST);
			//exit;
			$menu_id = $this->input->post('menu_id');
			//$parent_id = $this->input->post('parent_id');
			$parent_id = 0;
			$name = $this->input->post('name');
			$url = '';
			$page = $this->input->post('page');
			if($this->input->post('url')!='http://' || $this->input->post('url')!='')
			{
				$url = $this->input->post('url');
			}
			else
			{
				$page = $this->input->post('page');
			}
			$order = 0;
			$data = array(
				'menu_id' => $menu_id,
				'parent_id' => $parent_id,
				'name' => $name,
				'url' => $url,
				'page' => $page,
				'order' => $order
			);
			$order = $this->navigation_model->add_subnav($data);
			$data = array('order' => $order);
			$this->navigation_model->updatelinks($order,$data);
			redirect('admin/navigation/detail/'.$menu_id);
		}
		else
		{
			redirect('admin/navigation');
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
	
	
	
	
	function update($param)
	{
		if (!isset($_POST['id'])) { redirect('admin/customer'); }
		$id = $_POST['id'];
		$user = $this->user_model->id($id);
		
		$email = $this->input->post('email',true);
		$username = $email;
		$firstname = $this->input->post('firstname',true);
		$lastname = $this->input->post('lastname',true);
		//$dob = $this->input->post('dob',true);
		
		
		$phone= $_POST['phone'];
		$mobile = $_POST['mobile'];
		//$fax = $_POST['fax'];
		
		$address = $_POST['address'];
		$address2 = $_POST['address2'];
		$suburb = $_POST['suburb'];
		$state = $_POST['state'];
		$country = $_POST['country'];						
		$postcode = $_POST['postcode'];
		//$contact1 = $_POST['contact1'];
		//$contact2 = $_POST['contact2'];
		//$discount_level = $_POST['discount_level'];
		//$membership_status = $_POST['membership_status'];
		/*
		$shipping_firstname = $_POST['shipping_firstname'];
		$shipping_lastname = $_POST['shipping_lastname'];
		$shipping_same = $_POST['shipping_same'];
		
		$shipping_address = $_POST['shipping_address'];
		$shipping_address2 = $_POST['shipping_address2'];
		$shipping_suburb = $_POST['shipping_suburb'];
		$shipping_state = $_POST['shipping_state'];
		$shipping_country = $_POST['shipping_country'];						
		$shipping_postcode = $_POST['shipping_postcode'];
		*/
		$data = array(
			'email' => $email,
			'firstname' => $firstname,
			'lastname' => $lastname,			
			'phone' => $phone,
			'mobile' => $mobile,
			//'fax' => $fax,
			//'contact1' => $contact1,
			//'contact2' => $contact2,
			//'discount_level' => $discount_level,
			'address' => $address,
			'address2' => $address2,
			'suburb' => $suburb,
			'country' => $country,
			'state' => $state,
			'postcode' => $postcode,
			
			/*
			'membership_status' => $membership_status,
			'birthday' => date('Y-m-d',strtotime($dob)),
			'shipping_firstname' => $shipping_firstname,
			'shipping_lastname' => $shipping_lastname,
			'shipping_same' => $shipping_same,
			'shipping_address' => $shipping_address,
			'shipping_address2' => $shipping_address2,
			'shipping_suburb' => $shipping_suburb,
			'shipping_country' => $shipping_country,
			'shipping_state' => $shipping_state,
			'shipping_postcode' => $shipping_postcode,
			*/
			'modified' => date('Y-m-d H:i:s')
		);
		
		//if ($_POST['password'] != "") {
		//	$this->user_model->update($id,array('password' => md5($_POST['password'])));
		//}
		if ($this->customer_model->update($user['customer_id'],$data)) {
			$this->session->set_flashdata('update',true);
		}
		redirect('admin/customer');
	}
	
	function delete($param)
	{
		$id=$param;
		$user = $this->user_model->id($id);
		$customer = $this->customer_model->identify($user['customer_id']);
		#check order
		$cust_order = $this->customer_model->identify_order($user['customer_id']);
		
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
	
	function search($param)
	{
		$this->session->set_userdata('name',$_POST['keyword']);		
		$this->session->set_userdata('type',1);
		//echo $this->session->userdata('name');		
		redirect('admin/customer');
	}
	
	function order_nav_links_position()
	{
		$nav_order_ids = $this->input->post('nav_pos_ids',true);
		$menu_id = $this->input->post('menu_id',true);
		$count = 0;	
		foreach($nav_order_ids as $id){
			$this->navigation_model->updatelinks($id,array('order' => $count));
			$count++;	
		}
		redirect('admin/navigation/detail/'.$menu_id);
	}
	
		
}