<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Admindashboard extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
		$this->load->model('admingooglestats/googlestats_model');
		
	}
	public function index($method='', $param='')
	{
		switch($method)
		{
			/* case 'insert_dash_components':
					$this->insert_dash_components();
				break; */
			case 'update_dash_modules_status':
					$this->update_dash_modules_status();
				break;
			case 'update_price_guide':
					$this->update_price_guide();
				break;
			case 'update_date':
					$this->update_date();
				break;
			default:
					$this->main();
				break;
		}
	}

	function main()
	{
				
		// # for Retail Price Guide
		// $data['main'] = $this->dashboard_model->get_data();		
// 		
		// #for dashboard data
		// $order_detail = $this->dashboard_model->get_order_detail();
		// $data['order_detail'] = $order_detail;				
// 		
		// #income
		// $data['listdate_month'] = $order_detail['listdate_month'];
		// $data['listincome_month'] = $order_detail['listincome_month'];
		// $data['listmonth_year'] = $order_detail['listmonth_year'];
		// $data['listincome_year'] = $order_detail['listincome_year'];
		// $data['list_order_today'] = json_decode($order_detail['list_order_today'],true);
// 		
		// #category
		// $data['c_cat'] = $order_detail['c_cat'];
// 		
// 		
		// #products
		// $data['all_prod'] = $order_detail['all_prod'];				
		// $data['all_prod_active'] = $order_detail['all_prod_active'];
		// $data['all_prod_disable'] = $order_detail['all_prod_disable'];
// 		
		// #last 5 orders
		// $last5 = $this->dashboard_model->last(5);
		// $data['last5'] = $last5;
		//$data['webstat'] = $this->googlestats_model->identify(1);						
		$this->load->view('admin_dashboard', isset($data) ? $data : NULL);	
	}
	function update_price_guide()
	{
		$price_guide_1 = $this->input->post('price_guide_1');
		$price_guide_2 = $this->input->post('price_guide_2');
		$data=array(
			'price_guide_1' => $price_guide_1,
			'price_guide_2' => $price_guide_2,
		);
		$this->dashboard_model->update($data);
		redirect('admin/dashboard');
	}
	function update_date()
	{
		$date = $this->input->post('from_date');
		$data=array(
			'order_date' => date('Y-m-d',strtotime($date))
		);
		$this->dashboard_model->update($data);
		redirect('admin/dashboard');
		
	}
	
	function update_dash_modules_status()
	{
		//make all status as inactive;
		$sql = "UPDATE dashboard_modules SET visibility_status = 'inactive'";
		$this->db->query($sql);
		//then make the ones maked as active from UI as active
		$dash_modules_ids = $this->input->post('dash_modules_ids',true);
		if($dash_modules_ids){
			foreach($dash_modules_ids as $id){
				$this->db->where('id',$id)->update('dashboard_modules',array('visibility_status' => 'active'));	
			}
		}
		redirect('admin/dashboard');
	}
	
	/* function insert_dash_components()
	{
		$components = array('webstats_today','webstats_yesterday','webstats_month','webstats_lastmonth','news_subscribers','total_customers','australian_customers','international_customers','sales_today','sales_week','sales_month','sales_year','total_products','total_pages','total_articles','total_galleries');
		
		foreach($components as $c){
			$this->db->insert('dashboard_modules',array('component' => $c));	
		}
	} */

	
}