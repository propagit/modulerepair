<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
		$this->load->model('user_model');
		$this->load->model('system_model');
		$this->load->model('lookup_model');
	}
	
	public function suburbs_search()
	  {
       $keyword = $this->input->post('keyword');
	   $state = $this->input->post('state');
       $out = '';
       if($keyword && $state){
         $results = $this->lookup_model->search_suburb(trim($keyword),$state);
         if($results){
          foreach($results as $r){
                    $out .= '<li onclick="lookup.select_suburb('.$r->id.','.$r->postcode.',\''.ucwords(strtolower($r->name)).' ('.$r->postcode.')\');">'.ucwords(strtolower($r->name)).' ('.$r->postcode.')</li>';         
          }
         }
       }
       echo  '<ul>'.$out.'</ul>';
	  }
	  
	  public function state_search()
	  {
       $keyword = $this->input->post('keyword');
       $out = '';
       if($keyword){
         $results = $this->lookup_model->search_state(trim($keyword));
         if($results){
          foreach($results as $r){
                    $out .= '<li onclick="lookup.select_state('.$r->id.',\''.ucwords(strtolower($r->name)).'\');">'.ucwords(strtolower($r->name)).'</li>';         
          }
         }
       }
       echo  '<ul>'.$out.'</ul>';
	  }
	  
	  public function country_search()
	  {
       $keyword = $this->input->post('keyword');
       $out = '';
       if($keyword){
         $results = $this->lookup_model->search_country(trim($keyword));
         if($results){
          foreach($results as $r){
                    $out .= '<li onclick="lookup.select_country('.$r->id.',\''.ucwords(strtolower($r->name)).'\');">'.ucwords(strtolower($r->name)).'</li>';         
          }
         }
       }
       echo  '<ul>'.$out.'</ul>';
	  }
	
	function add_comment()
	{
		$admin_id = 1;
		$comment = $_POST['comment'];
		$cust_id = $_POST['cust_id'];
		
		$data['admin_id'] = $admin_id;
		$data['customer_id'] = $cust_id;
		$data['comment'] = $comment;
		
		$this->customer_model->add_comment($data);
		
		$comments = $this->customer_model->all_comment($cust_id);
		$text = '';
		foreach($comments as $cm)
		{
			
			$user = $this->user_model->id($cm['admin_id']);
			$text .='
			<tr>
				<td>'.date('d-m-Y',strtotime($cm['created'])).'</td>
				<td>'.$cm['comment'].'</td>
				<td>'.$user['username'].'</td>
				<td align="center">
					<div class="all_tt center_icon " data-toggle="tooltip" title="Delete Product" onclick="delete_comment('.$cm['id'].');">
	    				<i class="fa fa-trash-o blue-icon" style="cursor:pointer;"></i>
	    			</div>
                </td>
			</tr>
			';
		}
		
		echo $text;
	}
	
	function deletecomment(){
		$id=$this->input->post('id');
		$this->customer_model->delete_comment($id);
	}
	function export() {
		
		$type = 1;
		
		
		if($this->session->userdata('name'))
		{
			$name = $this->session->userdata('name');
		}
		else
		{
			$name = '';
		}
		
		
		$csvdir = getcwd();		
		$csvname = 'customer_'.date('d-m-Y');
		$csvname = $csvname.'.csv';
		header('Content-type: application/csv; charset=utf-8;');
        header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');
		
		
		
		$users = $this->user_model->get($type);
		
		
		
		if($type==1)
		{
			$headings = array('Username','First Name','Last Name','Email','Phone Number','Mobile Number','Fax Number','Address 1','Address 2','Suburb','State','Country','Postcode','Contact Name 1','Contact Name 2','Discount Level');
		fputcsv($fp,$headings);
			foreach ($users as $user) 
			{
				$customer = $this->customer_model->identify($user['customer_id']);
				$state = $this->system_model->get_state($customer['state']);
				$class='Class '.$customer['discount_level'];
				fputcsv($fp,array($user['username'],$customer['firstname'],$customer['lastname'],$customer['email'],$customer['phone'],$customer['mobile'],$customer['fax'],$customer['address'],$customer['address2'],$customer['suburb'],$state,$customer['country'],$customer['postcode'],$customer['contact1'],$customer['contact2'],$class));
			}
		}
		elseif($type==2)
		{
			$headings = array('Username','Title','First Name','Last Name','Email','Trader Name','Trading As','Retail Address 1','Retail Address 2','Telephone','Fax','Mobile','Suburb','State','Country','Postcode');
		fputcsv($fp,$headings);
			foreach ($users as $user) 
			{
				$customer = $this->customer_model->identify($user['customer_id']);
				$state = $this->system_model->get_state($customer['state']);
				fputcsv($fp,array($user['username'],$customer['title'],$customer['firstname'],$customer['lastname'],$customer['email'],$customer['tradename'],$customer['trading'],$customer['address'],$customer['address2'],$customer['phone'],$customer['fax'],$customer['mobile'],$customer['suburb'],$state,$customer['country'],$customer['postcode']));
			}
		}
		
		else
		{
			$this->load->model('subscribe_model');
			$subscribers = $this->subscribe_model->all($name);
			$headings = array('Email','Date time');
			fputcsv($fp,$headings);
			foreach ($subscribers as $s) 
			{
				
				fputcsv($fp,array($s['email'],$s['date']));
			}
		}
		
        fclose($fp);
		//redirect('admin/customer');
	}
		
}