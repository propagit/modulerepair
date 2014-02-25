<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Product controller. 
*	@class_comments 
*	
*
*/
 
class Product extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('category_model');
	}	
	
	function index($method='', $param1='', $param2="")
	{
		switch($method)
		{		
			case 'get_quotes':
				$this->get_quotes();
			break;
			
			default:
				$this->products($param1,$param2);
			break;
		}
	}
	
	/**
	*	@desc Shows the product overview
	*	
	*	@name products_overview
	*	@access public
	*	@return shows view file
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	
	function products($category_link="",$product_link="")
	{
		
		if($category_link && $product_link){
			$category_info = $this->category_model->get_category_by_link($category_link);
			$data['category'] = $category_info;
			$data['category_crumb'] = $this->category_model->get_category_bread_crumbs($category_link,true);
			$product = $this->product_model->get_product_by_link($product_link);
			$data['product'] = $product;
			$data['photos'] = $this->product_model->get_all_photos($product->id);
			$this->load->view('products_overview', isset($data) ? $data : NULL);	
		}else{
			
			$category_info = $this->category_model->get_category_by_link($category_link);
			$data['category'] = $category_info;
			$data['category_crumb'] = $this->category_model->get_category_bread_crumbs($category_link,true);
			
			$order_prod = json_decode($category_info->order_position);
			$lpord = array();
			$prods= array();
			$dbpd[]=array();
			$i=0;
			foreach($order_prod as $op)
			{
				//$lpord[$i] = $this->product_model->get_product_by_id($op);
				$prods[] = $op; 
				//$i++;
			}
			
			$data['products_all'] = $this->product_model->get_products_by_category($category_link);

			foreach($data['products_all'] as $dt)
			{
				if(!in_array($dt->id,$prods)){
					//$lpord[$i] = $this->product_model->get_product_by_id($dt->id);
					$prods[]=$dt->id;
					//$i++;					
				}
				$dbpd[]=$dt->id;
			}
			foreach($prods as $pd)
			{
				if(in_array($pd,$dbpd)){
					$lpord[$i] = $this->product_model->get_product_by_id($pd);
					//$prods[]=$dt->id;
					$i++;
					
				}
			}
			$data['products'] = $lpord;	
			$this->load->view('products', isset($data) ? $data : NULL);
		}
	}

	function get_quotes()
	{
		$product_id = $this->input->post('product_id');
		$product_link = $this->input->post('product_link');
		$category_link = $this->input->post('category_link');
		$salutation = $this->input->post('salutation');
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$email = $this->input->post('email');
		$companyname = $this->input->post('companyname');
		$position = $this->input->post('position');
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$state = $this->input->post('state');
		$zip = $this->input->post('zip');
		$country = $this->input->post('country');
		$phone = $this->input->post('phone');
		$mobile = $this->input->post('mobile');
		$department = $this->input->post('department');
		$message = $this->input->post('message');
		$product = $this->input->post('product');
		
		$msg = "<table>
					<tr>
						<td>Company</td>
						<td>$companyname</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>$salutation $firstname $lastname</td>
					</tr>
					<tr>
						<td>Position</td>
						<td>$position</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>$email</td>
					</tr>
					<tr>
						<td>Street Address</td>
						<td>$address</td>
					</tr>
					<tr>
						<td>City</td>
						<td>$city</td>
					</tr>
					<tr>
						<td>State / County</td>
						<td>$state</td>
					</tr>
					<tr>
						<td>Zip / Postal Code</td>
						<td>$zip</td>
					</tr>
					<tr>
						<td>Country</td>
						<td>$country</td>
					</tr>
					<tr>
						<td>Office Phone</td>
						<td>$phone</td>
					</tr>
					<tr>
						<td>Mobile Phone</td>
						<td>$mobile</td>
					</tr>
					<tr>
						<td>Department</td>
						<td>$department</td>
					</tr>
					<tr>
						<td>Message</td>
						<td>$message</td>
					</tr>
				<table>";
		
		$this->load->library('email');
		$config['mailtype'] = 'html';	
		$this->email->initialize($config);	
		$this->email->from('noreply@wave1.com.au','Get Quote '.$product);		
		
		$this->email->to('raquel@propagate.com.au');
		
		$this->email->subject('Get Quote '.$product);
		$this->email->message($msg);
		$sent = $this->email->send();
		
		$this->session->set_flashdata('quote_success','Thank you for contacting us, we will back to you shortly');		
		redirect('products/'.$category_link.'/'.$product_link);
	}	
	
}