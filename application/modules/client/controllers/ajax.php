<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @class_name: Cart
 * 
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('client_model');
		$this->load->model('lookup_model');
		$this->load->model('customer_model');
	}
	
	function delete_photo()
	{
		$id = $_POST['id'];
		$photo = array(
				'image' => $name
			);
			$this->customer_model->update($id,$photo);	
		
	}
	
	function validate()
	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$validate = $this->client_model->validate($username,$password);
		if(count($validate)>0)
		{
			$this->session->set_userdata('id',$validate['customer_id']);
			$this->session->set_userdata('login',TRUE);
			echo 'ok';
		}
		else
		{
			echo 'no';
		}				
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
}