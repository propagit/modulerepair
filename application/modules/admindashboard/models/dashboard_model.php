<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	
	
	function get_data()
	{
		$this->db->where('id', 1);	
		$query = $this->db->get('dashboard');
		return $query->first_row('array');
	}
	
	function update($data)
	{
		$this->db->where('id',1);
		return $this->db->update('dashboard',$data);
	}
	
	
	function get_order_detail() {
		$this->db->where('id',1);
		$query = $this->db->get('order_detail');
		return $query->first_row('array');
	}
	function last($limit) {
		$this->session->set_userdata('by_typecustomer',1);
		$this->db->order_by('id','desc');
		$this->db->limit($limit);
		$query = $this->db->get('orders');	
		return $query->result_array();
	} 
	function customer_last($limit) {
		$sql = "SELECT a.*, b.level, b.id as `u_id`
				FROM `customers` a, `users` b 
				where a.id = b.customer_id
				order by `id` desc
				limit $limit";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}	
	
	
	/* Dash Stats Functions */
	function get_webstat()
	{
		$sql = 'select today_unique,yesterday_unique,thismonth_unique,lastmonth_unique from webstat where id = 1';
		$webstats = $this->db->query($sql)->row();
		$data = array(
			'today' => 0,
			'yesterday' => 0,
			'this_month' => 0,
			'last_month' => 0
		);
		
		if($webstats){
			$data = array(
				'today' => $webstats->today_unique,
				'yesterday' => $webstats->yesterday_unique,
				'this_month' => $webstats->thismonth_unique,
				'last_month' => $webstats->lastmonth_unique
			);
		}
		return json_encode($data);	
	}
	
	function get_customer_stats()
	{
		$data = array(
			'newsletter' => $this->total_newsletter_subscribers(),
			'total_customers' => $this->get_total_customer(),
			'aussi_customers' => $this->get_aussi_customer(),
			'international_customers' => $this->get_international_customers(),
		);	
		
		return json_encode($data);
	}
	
	function get_total_customer()
	{
		$sql = 'select count(id) as total from customers where deleted = 0';
		$customers = $this->db->query($sql)->row();
		if($customers){
			return $customers->total;	
		}
		return 0;
	}
	
	function get_aussi_customer()
	{
		/* country 13 = Australia */
		$sql = 'select count(id) as total from customers where deleted = 0 and country = 13';
		$customers = $this->db->query($sql)->row();
		if($customers){
			return $customers->total;	
		}
		return 0;
	}
	
	function get_international_customers()
	{
		$sql = 'select count(id) as total from customers where deleted = 0 and country != 13';
		$customers = $this->db->query($sql)->row();
		if($customers){
			return $customers->total;	
		}
		return 0;
	}
	
	function total_newsletter_subscribers()
	{
		/* as this project lacks newsletter module */
		return 0;
	}
	
	function get_products_stats()
	{
		$total_products = $this->get_total_products();
		$active_products = $this->get_active_products();
		$inactive_products = $this->get_inactive_products();
		
		$out = $total_products.' <span class="item-counter">(<span class="active-count">'.$active_products.'</span> - <span class="inactive-count">'.$inactive_products.'</span>)</span>';
		
		$data = array(
			'products' => $out
		);	
		
		return json_encode($data);
	}
	
	function get_total_products()
	{
		
		$sql = 'select count(id) as total from products';
		$products = $this->db->query($sql)->row();
		if($products){
			return $products->total;	
		}
		return 0;	
	}
	
	function get_active_products()
	{
		
		$sql = 'select count(id) as total from products where status = 1';
		$products = $this->db->query($sql)->row();
		if($products){
			return $products->total;	
		}
		return 0;	
	}
	
	function get_inactive_products()
	{
		
		$sql = 'select count(id) as total from products where status = 0';
		$products = $this->db->query($sql)->row();
		if($products){
			return $products->total;	
		}
		return 0;	
	}
	
	function get_total_pages()
	{
		
		$sql = 'select count(id) as total from pages';
		$pages = $this->db->query($sql)->row();
		if($pages){
			return $pages->total;	
		}
		return 0;	
	}
	
	function get_pages_stats()
	{
		$data = array(
			'total_pages' => $this->get_total_pages(),
		);	
		
		return json_encode($data);
	}
	
	function get_articles_stats()
	{
		$total_articles = $this->get_total_articles();
		$active_articles = $this->get_active_articles();
		$inactive_articles = $this->get_inactive_articles();
		
		$out = $total_articles.' <span class="item-counter">(<span class="active-count">'.$active_articles.'</span> - <span class="inactive-count">'.$inactive_articles.'</span>)</span>';
		
		$data = array(
			'articles' => $out
		);	
		
		return json_encode($data);
	}
	
	function get_total_articles()
	{
		
		$sql = 'select count(id) as total from case_studies';
		$acticles = $this->db->query($sql)->row();
		if($acticles){
			return $acticles->total;	
		}
		return 0;	
	}
	
	function get_active_articles()
	{
		
		$sql = 'select count(id) as total from case_studies where status = "active"';
		$acticles = $this->db->query($sql)->row();
		if($acticles){
			return $acticles->total;	
		}
		return 0;	
	}
	
	function get_inactive_articles()
	{
		
		$sql = 'select count(id) as total from case_studies where status = "inactive"';
		$acticles = $this->db->query($sql)->row();
		if($acticles){
			return $acticles->total;	
		}
		return 0;	
	}
	
	function get_galleries_stats()
	{
		$total_galleries = $this->get_total_galleries();
		$active_galleries = $this->get_active_galleries();
		$inactive_galleries = $this->get_inactive_galleries();
		
		$out = $total_galleries.' <span class="item-counter">(<span class="active-count">'.$active_galleries.'</span> - <span class="inactive-count">'.$inactive_galleries.'</span>)</span>';
		
		$data = array(
			'galleries' => $out
		);	
		
		return json_encode($data);
	}
	
	function get_total_galleries()
	{
		
		$sql = 'select count(id) as total from galleries';
		$gallery = $this->db->query($sql)->row();
		if($gallery){
			return $gallery->total;	
		}
		return 0;	
	}
	
	function get_active_galleries()
	{
		
		$sql = 'select count(id) as total from galleries where active_preview = 1';
		$gallery = $this->db->query($sql)->row();
		if($gallery){
			return $gallery->total;	
		}
		return 0;	
	}
	
	function get_inactive_galleries()
	{
		
		$sql = 'select count(id) as total from galleries where active_preview = 0';
		$gallery = $this->db->query($sql)->row();
		if($gallery){
			return $gallery->total;	
		}
		return 0;	
	}
	
	function get_all_dashboard_modules()
	{
		$dashboard_modules = $this->db->order_by('order','asc')->get('dashboard_modules')->result();
		if($dashboard_modules){
			return $dashboard_modules;	
		}
		return false;
	}
	
	function check_dash_module_visibility_status($component)
	{
		if($component){
			$status = $this->db->where('component',$component)->get('dashboard_modules')->row();
			if($status->visibility_status == 'active'){
				return true;	
			}
		}
		return false;
	}
	
	function generate_dashboard_lists()
	{
		$dash_modules = $this->get_all_dashboard_modules();
		if($dash_modules){
			$total = count($dash_modules);
			$col_max = (int)$total/2;
			$count = 0;
			$col_1 = '';
			$col_2 = '';
			foreach($dash_modules as $dm){
				if($count < $col_max){
					$col_1 .= '<div class="dash-mod-row">
								<div class="checker">
									<span '.($dm->visibility_status == 'active' ? 'class="checked"' : '').'>
										<input type="checkbox" name="dash_modules_ids[]"  class="check" value="'.$dm->id.'" '.($dm->visibility_status == 'active' ? 'checked="checked"' : '').'/>
									</span>
								</div>
								<span class="dash-module-title">'.$dm->display_name.'</span>
							</div>';
				}else{
					$col_2 .= '<div class="dash-mod-row">
								<div class="checker">
									<span '.($dm->visibility_status == 'active' ? 'class="checked"' : '').'>
										<input type="checkbox" name="dash_modules_ids[]"  class="check" value="'.$dm->id.'" '.($dm->visibility_status == 'active' ? 'checked="checked"' : '').'/>
									</span>
								</div>
								<span class="dash-module-title">'.$dm->display_name.'</span>
							</div>';
				}
				$count++;
			}
		}
		$data = array(
			'modules' => '<div class="col-md-6 remove-gutter">'.$col_1.'</div><div class="col-md-6 remove-gutter">'.$col_2.'</div>'
		);	
		
		return json_encode($data);
	}
	
	function get_query_function_for_active_dash_modules()
	{
		$out = '';
		$web_stats = array('webstats_today','webstats_yesterday','webstats_month','webstats_lastmonth');
		$news_stats = 'news_subscribers';
		$cust_stats = array('total_customers','australian_customers','international_customers');
		$sales_stats = array('sales_today','sales_week','sales_month','sales_year');
		$products_stats = 'total_products';
		$pages_stats = 'total_pages';
		$articles_stats = 'total_articles';
		$galleries_stats = 'total_galleries';
		
		foreach($web_stats as $web){
			if($this->check_dash_module_visibility_status($web)){
				$out .= 'dash.web_stats();';	
				break;
			}
		}
		
		foreach($cust_stats as $cust){
			if($this->check_dash_module_visibility_status($cust)){
				$out .= 'dash.cust_stats();';	
				break;
			}
		}
		
		if($this->check_dash_module_visibility_status($products_stats)){
			$out .= 'dash.product_stats();';
		}
		
		if($this->check_dash_module_visibility_status($pages_stats)){
			$out .= 'dash.pages_stats();';
		}
		
		if($this->check_dash_module_visibility_status($articles_stats)){
			$out .= 'dash.article_stats();';
		}
		
		if($this->check_dash_module_visibility_status($galleries_stats)){
			$out .= 'dash.galleries_stats();';
		}
		
		return $out;
		
	}

	
	
	
	
}