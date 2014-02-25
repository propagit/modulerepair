<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Page controller. 
*	@class_comments 
*	
*
*/
 
class Pages extends MX_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
	}	
	
	function index($method='', $param='')
	{
		switch($method)
		{
			case 'contact-us':
				$this->contact_us();
			break;
			case'send_contact_msg':
				$this->send_contact_msg();
			break;
			case 'page':
				$this->page($param);
			break;		
			default:
				$this->company();
			break;
		}
	}
	
	/**
	*	@desc Shows the page content
	*	
	*	@name page
	*	@access public
	*	@return shows view file
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	
	function contact_us()
	{
		$this->load->view('contact', isset($data) ? $data : NULL);	
	}
	
	function send_contact_msg()
	{
		$name = $this->input->post('name',true);
		$company = $this->input->post('company',true);
		$email = $this->input->post('email',true);
		$phone = $this->input->post('phone',true);
		$department = $this->input->post('department',true);
		$message = $this->input->post('message',true);
		$spambot = $this->input->post('spambot',true);
		if(!$spambot){
			$valid = true;
			if(!$name || !$email || !$message){
				$valid = false;	
			}

			if($email){
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$valid = false;	
				}
			}
			
			if($valid){
				switch($department){
					case 'tech-support':
						$to = tech_support;
					break;
					
					case 'sales':
						$to = sales_email;
					break;
					
					default:
						$to = sales_email;
					break;	
				}	
				
				//$to = 'kaushtuv@propagate.com.au';			
				$email_message = '<p>Website Contact Form</p>
							
								 <p>
								 Name: '.$name.'<br />
								 Email: '.$email.'<br />
								 Phone: '.$phone.'<br />
								 Message: '.$message.'<br />
								 </p>
							
							     <p>This was sent throught Contact Form @ Wave1 web site</p>';
								 
				$email_data = array(
								'to' => $to,
								'from_text' => 'Wave1 Contact Page',
								'from' => 'noreply@wave1.com.au',
								'subject' => 'New Message From Contact Page at Wave1 Website',
								'message' => $email_message
								);
		 

				$this->page_model->send_email($email_data);
				$this->session->set_flashdata('sent',true);
			}else{
				$this->session->set_flashdata('error',true);	
			}
			
		}
		redirect('contact-us');
	}
	
	function company()
	{
		$this->load->view('company', isset($data) ? $data : NULL);	
	}
	
	function page($id_title)
	{
		$page = $this->page_model->get_page_by_link($id_title);	
		$data['page'] = $page;
		if($page->right_bar == 1)
		{
			$this->load->view('page_template', isset($data) ? $data : NULL);
		}
		else 
		{
			$this->load->view('page_template_no_right_bar', isset($data) ? $data : NULL);
		}
			
	}

	
	
}