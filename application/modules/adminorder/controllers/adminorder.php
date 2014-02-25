<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Adminorder extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('cart_model');
		$this->load->model('customer_model');
		$this->load->model('system_model');
		$this->load->model('user_model');
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('gallery_model');
		$this->load->model('subscribe_model');
		$this->load->model('content_model');
		$this->load->model('product/product_model');
	}
	
	public function index($method='', $param='')
	{
		switch($method)
		{
			case 'import':
					$this->import_orders();
				break;			
			case 'export':
					$this->export_orders();
				break;
			case 'view_order':
					$this->order_details($param);
				break;
			case 'empty':
					$this->empty_orders();
				break;
			case 'search':
					$this->search_orders($param);
				break;
			case 'finish_order':
					$this->finish_order($param);
				break;
			case 'salesreport':	
					$this->statistic();
				break;
			case 'show_stat':	
					$this->show_stat($param);
				break;
			case 'update_order_detail2':	
					$this->update_order_detail2();
				break;
			case 'sales_date_per_cat':	
					$this->sales_date_per_cat();
				break;
			case 'last_month_income':	
					$this->last_month_income();
				break;
			case 'best_customer':	
					$this->best_customer();
				break;
			case 'update_order_yearly':	
					$this->update_order_yearly();
				break;
			case 'update_order_daily':	
					$this->update_order_daily();
				break;
			case 'all_sales_report':	
					$this->all_sales_report();
				break;
			case 'all_sales_report2':	
					$this->all_sales_report2();
				break;
			case 'refresh_dashboard':	
					$this->refresh_dashboard();
				break;
			default:
					$this->orders_list($method);
				break;
		}
	}
	
	
	function finish_order($ids=0)
	{
		if($ids==0){
			$cust_id=$this->input->post('id');
		}
		else {
			$cust_id=$ids;
		}
		$carts = $this->cart_model->all_cust_order($cust_id);
		$customer = $this->customer_model->identify($cust_id);
		$dashboard = $this->order_model->get_data_dashboard();	
		$days = $dashboard['compare_price'];
        $last_date =  date('Y-m-d',strtotime("-".$days." days"));
		$total=0;
		foreach($carts as $cart)
		{
			$price=$this->product_model->identify($cart['product_id']);
			$change = $this->product_model->check_fluctuative_price($cart['product_id'],$last_date);
			if($customer['discount_level']=='A'){
				if($price['price']>$price['sale_price'] && $price['sale_price']> 0)
				{
					$price_product=$price['sale_price'];
				}
				else {$price_product=$price['price'];}
				if($change == 1)
				{
					if($price_product == $price['last_price'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			
			if($customer['discount_level']=='B'){
				if($price['price_b']>$price['sale_price_b'] && $price['sale_price_b']> 0)
				{
					$price_product=$price['sale_price_b'];
				}
				else {$price_product=$price['price_b'];}
				if($change == 1)
				{
					if($price_product == $price['last_price_b'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price_b'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price_b'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			
			if($customer['discount_level']=='C'){
				if($price['price_c']>$price['sale_price_c'] && $price['sale_price_c']> 0)
				{
					$price_product=$price['sale_price_c'];
				}
				else {$price_product=$price['price_c'];}
				if($change == 1)
				{
					if($price_product == $price['last_price_c'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price_c'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price_c'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			
			if($customer['discount_level']=='D'){
				if($price['price_d']>$price['sale_price_d'] && $price['sale_price_d']> 0)
				{
					$price_product=$price['sale_price_d'];
				}
				else {$price_product=$price['price_d'];}
				if($change == 1)
				{
					if($price_product == $price['last_price_d'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price_d'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price_d'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			
			if($customer['discount_level']=='E'){
				if($price['price_e']>$price['sale_price_e'] && $price['sale_price_e']> 0)
				{
					$price_product=$price['sale_price_e'];
				}
				else {$price_product=$price['price_e'];}
				if($change == 1)
				{
					if($price_product == $price['last_price_e'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price_e'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price_e'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			
			if($customer['discount_level']=='F'){
				if($price['price_f']>$price['sale_price_f'] && $price['sale_price_f']> 0)
				{
					$price_product=$price['sale_price_f'];
				}
				else {$price_product=$price['price_f'];}
				if($change == 1)
				{
					if($price_product == $price['last_price_f'])
					{
						$status_price = 'same';
					}
					if($price_product > $price['last_price_f'])
					{
						$status_price = 'up';
					}
					if($price_product < $price['last_price_f'])
					{
						$status_price = 'down';
					}
				}
				else 
				{
					$status_price = 'same';
				}
			}
			//$dt=array('price' => $price_product);
			$dt = array();
			$dt['price'] = $price_product;
			$dt['updown'] = $status_price;
			$this->cart_model->update($cart['id'],$dt);
			$total += $price_product*$cart['quantity'];
		}
		
		$data = array(
				'customer_id' => $cust_id,
				'session_id' => '',
				'order_time' => date('Y-m-d H:i:s'),
				'subtotal' => $total,												
				'total' => $total,
				'firstname' => $customer['firstname'],
				'lastname' => $customer['lastname'],
				'address' => $customer['address'],
				'address2' => $customer['address2'],
				'city' => $customer['city'],
				'state' => $customer['state'],
				'country' => $customer['country'],
				'postcode' => $customer['postcode'],
				'email' => $customer['email'],
				'status' => 'successful',
				'order_status' => 'processed'
			);			
		$order_id = $this->order_model->add($data);
		foreach($carts as $cart)
		{
			$dt=array('order_id' => $order_id);
			$this->cart_model->update($cart['id'],$dt);
		}
	}
	function finish_all_order()
	{
		$customers = $this->order_model->get_customer();
		foreach($customers as $custs) { 
			$cust_ord = $this->order_model->upcoming_orders($custs['id']);
			foreach($cust_ord as $co)
			{
				$status_cart = $co['lock'];
			}
			$tot_ord = count($cust_ord);
			if($tot_ord > 0)
			{
				if($status_cart==1)
				{
					$this->finish_order($custs['id']);
				}
			}
		}
	}
	function order_details($order_id)
	{
		$order = $this->order_model->identify($order_id);
		if($order == NULL)
		{
			redirect('admin/store/order');
		}		
		$data['cart'] = $this->cart_model->all_order($order_id);
		//$data['shipping'] = $this->system_model->get_shipping($order['shipping_method']);
		$data['order'] = $order;		
		$data['cust'] = $this->customer_model->identify($order['customer_id']);		
		$data['price_guide'] = $this->order_model->get_data_dashboard();			
		//$data['comments'] = $this->customer_model->all_comment($order['customer_id']);
		$this->load->view('admin_order_details', isset($data) ? $data : NULL);
	}
	
	function orders_list($action="",$period="")
	{		
		if ($action == "search") {
			if ($period == "total") {
				$orders = $this->order_model->search_period("total","");
			} else if ($period == "month") {
				$orders = $this->order_model->search_period("month",date('Y-m'));
			} else if ($period == "week") {
				$orders = $this->order_model->search_period("week","");
			} else if ($period == "day") {
				$orders = $this->order_model->search_period("day",date('Y-m-d'));
			} 
			else
			{
	
				$orders = $this->order_model->search_v2($this->session->userdata('customer_name'),$this->session->userdata('order_id'),$this->session->userdata('from_date'),$this->session->userdata('to_date'),$this->session->userdata('by_keyword'),$this->session->userdata('by_status'),4,$this->session->userdata('by_payment'),$this->session->userdata('by_ord_status'),$this->session->userdata('customer_id'));	
			}
			
			$total = 0;
			foreach($orders as $order) {
				if ($order['status'] == 'successful') {
					$total += $order['total'];
				}
			}
			
			$data['total'] = $total;
			$data['orders'] = $orders;
			$this->load->view('admin_orders_list', isset($data) ? $data : NULL);
			
		} else if ($action == "view") {
			$order = $this->order_model->identify($period);
			if($order == NULL)
			{
				redirect('admin/store/order');
			}
			
			$data['cart'] = $this->cart_model->all($order['session_id']);
			$data['shipping'] = $this->system_model->get_shipping($order['shipping_method']);
			$data['order'] = $order;		
			$data['cust'] = $this->customer_model->identify($order['customer_id']);			
			$data['comments'] = $this->customer_model->all_comment($order['customer_id']);
			$this->load->view('admin/order/order',$data);
		} else {
			$this->session->unset_userdata('customer_name');
			$this->session->unset_userdata('customer_id');
			$this->session->unset_userdata('order_id');
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date');
			$this->session->unset_userdata('by_keyword');
			$this->session->unset_userdata('by_payment');
			$this->session->unset_userdata('by_ord_status');	
			$this->session->unset_userdata('by_status');
			$data['orders'] = $this->order_model->last(20);
			$data['customers'] = $this->order_model->get_customer();
			$this->load->view('admin_orders_list', isset($data) ? $data : NULL);
		}			
	}
	
	
	
	function search_orders()
	{
		if ($this->input->post())
		{
			$this->session->set_userdata('customer_name',$_POST['customer_name']);
			$this->session->set_userdata('customer_id',$_POST['customer_id']);
			$this->session->set_userdata('order_id',$_POST['order_id']);
			$this->session->set_userdata('from_date',$_POST['from_date']);
			$this->session->set_userdata('to_date',$_POST['to_date']);
			$this->session->set_userdata('by_keyword',$_POST['by_keyword']);
			$this->session->set_userdata('by_payment','');
			$this->session->set_userdata('by_ord_status',$_POST['by_status']);		
			$status=0;
			if(isset($_POST['by_status'])&& $_POST['by_status']==1){
				$status=1;
			}
			else
			{
				$status = $_POST['by_status'];
			}
			$this->session->set_userdata('by_status',$status);
			
			$orders = $this->order_model->search_v2($this->session->userdata('customer_name'),$this->session->userdata('order_id'),$this->session->userdata('from_date'),$this->session->userdata('to_date'),$this->session->userdata('by_keyword'),$this->session->userdata('by_status'),4,$this->session->userdata('by_payment'),$this->session->userdata('by_ord_status'),$this->session->userdata('customer_id'));
			
			
			$total = 0;
			foreach($orders as $order) {
				if ($order['status'] == 'successful') {
					$total += $order['total'];
				}
			}
			
			$data['total'] = $total;
			$data['orders'] = $orders;
			$data['mode'] = 'search';
			$data['customers'] = $this->order_model->get_customer($this->session->userdata('customer_name'),$this->session->userdata('customer_id'));
			$this->load->view('admin_orders_list', isset($data) ? $data : NULL);
		}
		
		//$this->load->view('admin_orders_search', isset($data) ? $data : NULL);
	}
	
	
	
	function statistic()
	{

		//$dbet = $this->createDateRangeArray('2013-02-15', '2013-04-05');
		
		//echo "<pre>".print_r($dbet,true)."</pre>";
		
		//error_reporting(E_ALL);
		
		$order_detail = $this->system_model->get_order_detail();
		
		//error_reporting(E_ALL);
		// every days this month
		
		//filter for year
		if(isset($_POST['y_f']))
		{
			$yyear_f = $_POST['yyear_f'];
			$dbet = $this->createDateRangeArray(date('Y-m-d',strtotime('01-01-'.$yyear_f)), date('Y-m-d',strtotime('31-12-'.$yyear_f)));
			//echo "<pre>".print_r($dbet,true)."</pre>";
			
			$all_income = '';
			$cc = 0;
			
			foreach($dbet as $g)
			{
				if($cc  == 0)
				{
					$all_income .= $this->order_model->sales_date(date('Y-m-d',strtotime($g)));
				}
				else 
				{
					$all_income .= ', '.$this->order_model->sales_date(date('Y-m-d',strtotime($g)));
				}
				$cc++;
			}
			
			//echo "<pre>".print_r($get,true)."</pre>";
			
			$data['all_income'] = $all_income;
			$data['yyear_f'] = $yyear_f;
			$data['header_year_f'] = 'Income of '.$yyear_f;
		}
		else
		{
			
			
			$data['all_income'] = $order_detail['all_income'];
			$data['yyear_f'] = $order_detail['yyear_f'];
			$data['header_year_f'] = $order_detail['header_year_f'];
		}
		
		
		
		//filter for month
		if(isset($_POST['m_f']))
		{
			$m_f = 1;
			$mmonth_f = $_POST['mmonth_f'];
			$myear_f = $_POST['myear_f'];
			$num_mf = cal_days_in_month(CAL_GREGORIAN, $mmonth_f, $myear_f); 
			$monthName = date("F", mktime(0, 0, 0, $mmonth_f, 10));
			//echo $monthName;
			$data['mfilter_header'] = 'Income '.$monthName.' '.$myear_f;
			
			$alldate_mf = "['1'";
		
			for($i = 1; $i<$num_mf; $i++)
			{
				$j = $i+1;
				$alldate_mf .= ",'$j'";
			}
			$alldate_mf .= "]"; 
			//echo  $alldate;
			
			if($_POST['mstate_f'] != '-1')
			{
				$mfilter = 1;
				$mfilter_state = $_POST['mstate_f'];
				$data['mstate_f'] = ' - '.$this->system_model->get_state($mfilter_state);
				
			}
			else
			{
				$mfilter = 0;
				$data['mstate_f'] = '';
			}
		}
		else
		{
			$m_f = 0;
			$data['mstate_f'] = '';
			$data['mfilter_header'] = "This Month's Income";
		}
		
		
		
		//filter for best cat
		if(isset($_POST['filter_bcat']))
		{
			$bcatfilter = 1;
			$bcatfrom = $_POST['from_date_bcat'];
			$bcatto = $_POST['to_date_bcat'];
			//$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			
			$dbet = $this->createDateRangeArray(date('Y-m-d',strtotime($bcatfrom)), date('Y-m-d',strtotime($bcatto)));
			
			$alldate = "[";
			$cc = 0;
			foreach($dbet as $dbt)
			{
				$dd = date('d/m',strtotime($dbt));
				if($cc == 0)
				{
					$alldate .= "'$dd'";
				}
				else 
				{
					$alldate .= ",'$dd'";
				}
				
				$cc++;
			}
			$alldate .= "]"; 
			//echo  $alldate;
			
			$data['listdate_month_bcat'] = $alldate;
			$data['h_bcat'] = ' - '.$bcatfrom.' to '.$bcatto;
		}
		else
		{
			$bcatfilter = 0;
			$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			//$data['mstate_f'] = '';
			$data['h_bcat'] = '';
		}
		
		
		
		//filter for best prod
		if(isset($_POST['filter_prod']))
		{
			$prodfilter = 1;
			$prodfrom = $_POST['from_date_prod'];
			$prodto = $_POST['to_date_prod'];
			//$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			
			
			$data['h_prod'] = ' - '.$prodfrom.' to '.$prodto;
		}
		else
		{
			$prodfilter = 0;
			//$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			//$data['mstate_f'] = '';
			$data['h_prod'] = '';
		}
		
		
		//filter for best cust
		if(isset($_POST['filter_cust']))
		{
			$custfilter = 1;
			$custfrom = $_POST['from_date_cust'];
			$custto = $_POST['to_date_cust'];
			//$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			
			
			$data['h_cust'] = ' - '.$custfrom.' to '.$custto;
		}
		else
		{
			$custfilter = 0;
			//$data['listdate_month_bcat'] = $order_detail['listdate_month'];
			//$data['mstate_f'] = '';
			$data['h_cust'] = '';
		}
		
		
		
		$data['states'] = $this->system_model->get_states();
		if($m_f == 0)
		{
			$data['listdate_month'] = $order_detail['listdate_month'];
		}
		else
		{
			$data['listdate_month'] = $alldate_mf;
		}
		//$data['listincome_month'] = $order_detail['listincome_month'];
		if($m_f == 0)
		{
			$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		}
		else
		{
			$num = $num_mf;	
		}
		$listincome = "[";
		for($i = 1; $i<=$num; $i++)
		{
			if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
			if($m_f == 1)
			{
				$tday = $myear_f.'-'.$mmonth_f.'-'.$j;
			}
			else 
			{
				$tday = date('Y-m-').$j;
			}
			//echo $tday.'<br/>';
			if($m_f == 1)
			{
				if($mfilter == 1)
				{
					$tincome = $this->order_model->sales_date_per_state($tday,$mfilter_state);
				}
				else 
				{
					$tincome = $this->order_model->sales_date_per_state($tday,-1);
				}
			}
			else 
			{
				$tincome = $this->order_model->sales_date($tday);
			}
			
			
			if($i==1)
			{
				$listincome .= "$tincome";
			}
			else
			{
				$listincome .= ",$tincome";
			}
			//echo $tincome.'<br/>';
		}
		$listincome .= "]";
		
		
		
		$data['listincome_month'] = $listincome;
		$data['listmonth_year'] = $order_detail['listmonth_year'];
		$data['listincome_year'] = $order_detail['listincome_year'];
		$data['list_order_today'] = json_decode($order_detail['list_order_today'],true);
		$data['order_detail'] = $order_detail;
		
		if($prodfilter)
		{
			$bprod = $this->system_model->best_products_between_date($prodfrom,$prodto);
		}
		else 
		{
			$bprod = json_decode($order_detail['best_products'],true);
		}
		
		
		
		//echo "<pre>".print_r($bprod,true)."</pre>";
		
		$prod_list = '';
		$prod_count = '';
		$cc=0;
		foreach($bprod as $bp)
		{
			if($cc < 10)
			{
				$p = $this->product_model->identify($bp['product_id']);
				if($cc == 0)
				{
					$prod_list .= "'".$p['title']."'";
					$prod_count .=$bp['total'];
				}
				else
				{
					$prod_list .= ",'".$p['title']."'";
					$prod_count .=','.$bp['total'];
				}	
				$cc++;
			}
		}
		
		//print_r($prod_list);
		//print_r($prod_count);
		$data['ttl_prod'] = $cc;
		$data['prod_list'] = $prod_list;
		$data['prod_count'] = $prod_count;
		
		//exit;
		
		$data['best_categories'] = json_decode($order_detail['best_categories'],true);
// 		
		$all_categories = json_decode($order_detail['best_categories'],true);
// 		
		$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 
// 		
		$listincome_arr = Array();
// 		
// 		
// 		
		// $cc = 0;
		if($bcatfilter)
		{
		 foreach($all_categories as $ac)
		 {
			 $cat = $this->category_model->identify($ac['category_id']);
			 $listincome_arr[$cc]['cat_title'] = $cat['title'];
			 $listincome_arr[$cc]['income'] = "[";
			 
				 $i =1;
				 foreach($dbet as $dbt)
				 {
					 $tday = date('Y-m-d',strtotime($dbt));
					 $tincome = $this->system_model->sales_date_per_cat($tday,$ac['category_id']);
					 if($i==1)
					 {
						 $listincome_arr[$cc]['income'] .= "$tincome";
					 }
					 else
					 {
						 $listincome_arr[$cc]['income'] .= ",$tincome";
					 }
					 $i++;
				 }
			 
			
// 			
			 $listincome_arr[$cc]['income'] .= "]";
// 			
			 $cc++;
		 }
		 $data['listincome_arr'] = $listincome_arr;
		}
		else 
		{
			$data['listincome_arr'] = json_decode($order_detail['listincome_arr'],true);
		}
		
		
		if($custfilter)
		{
			$data['best_customers'] = $this->system_model->best_customers_between_date($custfrom,$custto);
		}
		else 
		{
			$data['best_customers'] = json_decode($order_detail['best_customers'],true);
		}
		
		
		$data['earliest_date'] = $order_detail['earliest_date'];
		
		
		
		
		
		$data['list_date_lmonth']=$order_detail['list_date_lmonth'];

		$data['list_lmonth_income_arr'] = json_decode($order_detail['list_lmonth_income_arr'],true);
		
		$data['sales_all'] = $order_detail['sales_all'];
		
		
		
		
		$this->load->view('admin_orders_report', isset($data) ? $data : NULL);
	}
	function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    // takes two dates formatted as YYYY-MM-DD and creates an
	    // inclusive array of the dates between the from and to dates.
	
	    // could test validity of dates here but I'm already doing
	    // that in the main script
	
	    $aryRange=array();
	
	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
	
	
	function update_order_detail()
	{
		$data['today_income'] = $this->Order_model->sales_date(date('Y-m-d'));
		$data['yesterday_income'] = $this->Order_model->sales_date(date('Y-m-d',strtotime('-1 day')));
		
		$data['this_month_income'] = $this->Order_model->sales_month(date('Y-m'));
		$data['last_month_income'] = $this->Order_model->sales_month(date('Y-m',strtotime('-1 month')));
		
		$data['this_year_income'] = $this->Order_model->sales_year(date('Y'));
		$data['last_year_income'] = $this->Order_model->sales_year(date('Y',strtotime('-1 year')));
		
		$data['best_product'] = $this->System_model->best_product();
		$data['best_category'] = $this->System_model->best_category();
		$data['best_customer'] = $this->System_model->best_customer();
		
		
		
		$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 
		
		$alldate = "['1'";
		
		for($i = 1; $i<$num; $i++)
		{
			$j = $i+1;
			$alldate .= ",'$j'";
		}
		$alldate .= "]"; 
		//echo  $alldate;
		
		$data['listdate_month'] = $alldate;
		
		$listincome = "[";
		for($i = 1; $i<=$num; $i++)
		{
			if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
			$tday = date('Y-m-').$j;
			//echo $tday.'<br/>';
			$tincome = $this->Order_model->sales_date($tday);
			
			if($i==1)
			{
				$listincome .= "$tincome";
			}
			else
			{
				$listincome .= ",$tincome";
			}
			//echo $tincome.'<br/>';
		}
		$listincome .= "]";
		
		$data['listincome_month'] = $listincome;
		
		// every months this year
		
		$data['listmonth_year'] = "['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']";
		
		$listincome = "[";
		for($i = 1; $i<=12; $i++)
		{
			if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
			$tday = date('Y-').$j;
			//echo $tday.'<br/>';
			$tincome = $this->Order_model->sales_month($tday);
			
			if($i==1)
			{
				$listincome .= "$tincome";
			}
			else
			{
				$listincome .= ",$tincome";
			}
			//echo $tincome.'<br/>';
		}
		$listincome .= "]";
		
		$data['listincome_year'] = $listincome;
		
		$data['list_order_today'] = json_encode($this->Order_model->sales_date_list(date('Y-m-d')));
		
		
		
		$this->System_model->update_order_detail($data);
		
		
		
		echo 1;
	}

	function get_yesterday_income()
	{
		$edata['income'] = $this->Order_model->sales_date(date('Y-m-d',strtotime('-1 day')));
		//$edata['income'] = $this->Order_model->sales_date(date('Y-m-d',strtotime('01-06-2013')));
		$edata['date'] = date('Y-m-d',strtotime('-1 day'));
		//$edata['date'] = date('Y-m-d',strtotime('01-06-2013'));
		$this->System_model->add_everyday_income($edata);
		
		
	}

	function update_order_detail2()
	{
		$data['today_income'] = $this->order_model->sales_date(date('Y-m-d'));
		$data['yesterday_income'] = $this->order_model->sales_date(date('Y-m-d',strtotime('-1 day')));
		
		$data['this_month_income'] = $this->order_model->sales_month(date('Y-m'));
		$data['last_month_income'] = $this->order_model->sales_month(date('Y-m',strtotime('-1 month')));
		
		$data['this_year_income'] = $this->order_model->sales_year(date('Y'));
		$data['last_year_income'] = $this->order_model->sales_year(date('Y',strtotime('-1 year')));
		
		$data['best_product'] = $this->system_model->best_product();
		$data['best_category'] = $this->system_model->best_category();
		$data['best_customer'] = $this->system_model->best_customer();
		
		
		$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 
		
		$alldate = "['1'";
		
		for($i = 1; $i<$num; $i++)
		{
			$j = $i+1;
			$alldate .= ",'$j'";
		}
		$alldate .= "]"; 
		//echo  $alldate;
		
		$data['listdate_month'] = $alldate;
		
		$listincome = "[";
		for($i = 1; $i<=$num; $i++)
		{
			if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
			$tday = date('Y-m-').$j;
			//echo $tday.'<br/>';
			$tincome = $this->order_model->sales_date($tday);
			
			if($i==1)
			{
				$listincome .= "$tincome";
			}
			else
			{
				$listincome .= ",$tincome";
			}
			//echo $tincome.'<br/>';
		}
		$listincome .= "]";
		
		$data['listincome_month'] = $listincome;
		
		// every months this year
		
		$data['listmonth_year'] = "['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']";
		
		$listincome = "[";
		for($i = 1; $i<=12; $i++)
		{
			if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
			$tday = date('Y-').$j;
			//echo $tday.'<br/>';
			$tincome = $this->order_model->sales_month($tday);
			
			if($i==1)
			{
				$listincome .= "$tincome";
			}
			else
			{
				$listincome .= ",$tincome";
			}
			//echo $tincome.'<br/>';
		}
		$listincome .= "]";
		
		$data['listincome_year'] = $listincome;
		
		$data['list_order_today'] = json_encode($this->order_model->sales_date_list(date('Y-m-d')));
		
		
		
		$this->system_model->update_order_detail($data);
		
		// $edata['income'] = $this->Order_model->sales_date(date('Y-m-d',strtotime('-1 day')));
		// $edata['date'] = date('Y-m-d',strtotime('-1 day'));
		// $this->System_model->add_everyday_income($edata);
		
		
		//$this->statistic();
		
		redirect('admin/order/salesreport');
	}

	
	function try_income()
	{
		$get = $this->System_model->get_ealiest_income();
		
		echo "<pre>".print_r($get,true)."</pre>";
		
		$get = $this->System_model->get_all_income();
		
		echo "<pre>".print_r($get,true)."</pre>";
	}
	
	function set_tracking_number()
	{
		$id = $_POST['id'];
		$track = $_POST['track'];
		
		$data['tracking_number'] = $track;
		
		$this->Order_model->update($id,$data);
	}
	
	function show_stat($type)
	{
		$this->session->set_userdata('stat_type',$type);
		
		redirect('admin/order/salesreport');
	}
	
	/*
	function order_details($order_id)
	{
		$order = $this->order_model->get_order($order_id);
		if (!$order)
		{
			redirect('admin/order');
		}
		
		$data['order'] = $order;
		$product = $this->order_model->get_product($order['product_part_no']);
		if (!$product)
		{
			echo 'Product Part No does not exist';
		}
		$data['product'] = $product;
		$this->load->model('product/customer_model');
		$data['states'] = $this->customer_model->get_states();
		
		$this->load->view('admin_order_details', $data);
	}
	
	function orders_list($offset=0)
	{
		$distributor_name = $this->session->userdata('order_distributor');
		$order_type = $this->session->userdata('order_type');
		$this->load->library('pagination');
		$config['base_url'] = base_url(). 'admin/order/';
		$config['per_page'] = 20;
		$config['num_links'] = 2;
		$config['uri_segment'] = 3;
		$config['total_rows'] = $this->order_model->get_total_orders($distributor_name, $order_type);
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		$data['pagination'] = $this->pagination->create_links();
		$data['orders'] = $this->order_model->get_orders($config['per_page'], $offset, $distributor_name, $order_type);
		$this->load->model('user/user_model');
		$data['users'] = $this->user_model->get_users();
		$data['distributor_name'] = $distributor_name;
		$this->load->view('admin_orders_list', isset($data) ? $data : NULL);
	}
	
	function export_orders()
	{
		ini_set('memory_limit', '128M');
		ini_set('max_execution_time', 3600); //300 seconds = 5 minutes
		
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Admin Portal");
		$objPHPExcel->getProperties()->setLastModifiedBy("Admin Portal");
		$objPHPExcel->getProperties()->setTitle("Orders");
		$objPHPExcel->getProperties()->setSubject("Orders");
		$objPHPExcel->getProperties()->setDescription("Orders Excel file, generated from Admin Portal.");
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DEALERNAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'PART#');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'SERIAL #');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'REQ_NO');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'DIRECTION');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SYS RMA');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'TYPE');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'SALE DATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'RECEIVED DATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'REPAIR DATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'SHIP DATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'CON LINK');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'CUST NAME');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'CUST EMAIL');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'CUST ADDRESS');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'CUST SUBURB');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'CUST STATE');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'CUST POSTCODE');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'CONTACT NUMBER');
		$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'FAULT');
		$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'PRICE');
		
		$orders = $this->order_model->get_orders();
		for($i=0; $i<count($orders); $i++)
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i+2), $orders[$i]['distributor_company_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . ($i+2), $orders[$i]['product_part_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . ($i+2), $orders[$i]['product_serial_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . ($i+2), $orders[$i]['req_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . ($i+2), $orders[$i]['ship_direction']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . ($i+2), $orders[$i]['sys_rma']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . ($i+2), $orders[$i]['type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . ($i+2), ($orders[$i]['sale_date']) ? date('d/m/Y', $orders[$i]['sale_date']) : NULL);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . ($i+2), ($orders[$i]['received_date']) ? date('d/m/Y', $orders[$i]['received_date']) : NULL);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . ($i+2), ($orders[$i]['repair_date']) ? date('d/m/Y', $orders[$i]['repair_date']) : NULL);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . ($i+2), ($orders[$i]['ship_date']) ? date('d/m/Y', $orders[$i]['ship_date']) : NULL);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . ($i+2), $orders[$i]['consignment']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . ($i+2), $orders[$i]['customer_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . ($i+2), $orders[$i]['customer_email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . ($i+2), $orders[$i]['customer_address']);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . ($i+2), $orders[$i]['customer_suburb']);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . ($i+2), $orders[$i]['customer_state']);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . ($i+2), $orders[$i]['customer_postcode']);
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . ($i+2), $orders[$i]['customer_phone']);
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . ($i+2), htmlentities($orders[$i]['fault']));
			$objPHPExcel->getActiveSheet()->SetCellValue('U' . ($i+2), $orders[$i]['total']);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('order');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		$file_name = "orders_" . time() . ".csv";
		$objWriter->save("./exports/" . $file_name);
		die($file_name);
	}
	
	
	function import_orders()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '2048';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('import_file'))
		{
			echo '<div class="alert alert-error">' . $this->upload->display_errors('','') . '</div>';
		}
		else
		{
			$file_data = $this->upload->data();
			$file_name = "./uploads/" . $file_data['file_name'];
			#$file_name = "./uploads/orders.xls";
			$this->load->library('excel');
			$objPHPExcel = PHPExcel_IOFactory::load($file_name);		
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			for($i=2; $i<=count($sheetData); $i++)
			{
				if ($sheetData[$i]['B'])
				{
					$this->order_model->insert_order(array(
						'distributor_company_name' => $sheetData[$i]['A'],
						'product_part_no' => $sheetData[$i]['B'],
						'product_serial_no' => $sheetData[$i]['C'],
						'req_no' => $sheetData[$i]['D'],
						'ship_direction' => $sheetData[$i]['E'],
						'sys_rma' => $sheetData[$i]['F'],
						'type' => $sheetData[$i]['G'],
						'sale_date' => time_convert($sheetData[$i]['H']),
						'received_date' => time_convert($sheetData[$i]['I']),
						'repair_date' => time_convert($sheetData[$i]['J']),
						'ship_date' => time_convert($sheetData[$i]['K']),
						'consignment' => $sheetData[$i]['L'],
						'customer_name' => $sheetData[$i]['M'],
						'customer_email' => $sheetData[$i]['N'],
						'customer_address' => $sheetData[$i]['O'],
						'customer_suburb' => $sheetData[$i]['P'],
						'customer_state' => $sheetData[$i]['Q'],
						'customer_postcode' => $sheetData[$i]['R'],
						'customer_phone' => $sheetData[$i]['S'],
						'fault' => $sheetData[$i]['T'],
						'total' => $sheetData[$i]['U']
					));
				}
			}
			
			unlink($file_name);
			redirect('admin/order');
		}
	}
	
	function empty_orders()
	{
		$this->db->truncate('orders');
		redirect('admin/order');
	}*/
	
	function sales_date_per_cat()
	{
		// $order_detail = $this->System_model->get_order_detail();
// 		
		// $listincome_arr = $order_detail['listincome_arr'];
		// if($listincome_arr == '')
		// {
			// $listincome_arr = Array();
		// }
		
		$all_categories = $this->system_model->best_categories();
		
		$num = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); 
		
		$listincome_arr = Array();
		
		
		
		$cc = 0;
		
		foreach($all_categories as $ac)
		{
			$cat = $this->category_model->identify($ac['category_id']);
			$listincome_arr[$cc]['cat_title'] = $cat['title'];
			$listincome_arr[$cc]['income'] = "[";
			
			for($i = 1; $i<=$num; $i++)
			{
				if($i<=date('j'))
				{
					if(strlen($i)==1) {$j = '0'.$i;} else {$j = $i;}
					$tday = date('Y-m-').$j;
					//echo $tday.'<br/>';
					$tincome = $this->system_model->sales_date_per_cat($tday,$ac['category_id']);
				}
				else
				{
					$tincome = '0.00';
				}
				
				
				if($i==1)
				{
					$listincome_arr[$cc]['income'] .= "$tincome";
				}
				else
				{
					$listincome_arr[$cc]['income'] .= ",$tincome";
				}
				//echo $tincome.'<br/>';
			}
			
			$listincome_arr[$cc]['income'] .= "]";
			
			$cc++;
		}
		
		$data['listincome_arr'] = json_encode($listincome_arr);
		
		$this->system_model->update_order_detail($data);
		print_r($listincome_arr);
		echo '<br/>'.$this->db->last_query();
	}

	function last_month_income()
	{
		$list_last_month = $this->system_model->best_products_last_month();
		
		$list_date_lmonth = '';
		
		for($i=30; $i>=1; $i--)
		{
			$dt = date('d/m',strtotime('-'.$i.'days'));
			if($i == 30)
			{
				$list_date_lmonth.="'$dt'";
			}
			else
			{
				$list_date_lmonth.=",'$dt'";
			}
			
			
		}
		$data['list_date_lmonth']=$list_date_lmonth;
		$cc=0;
		
		foreach($list_last_month as $ac)
		{
			$prod = $this->product_model->identify($ac['product_id']);
			$list_lmonth_income_arr[$cc]['prod_title'] = $prod['title'];
			$list_lmonth_income_arr[$cc]['income'] = "[";
			for($i=30; $i>=1; $i--)
			{
				$dt = date('Y-m-d',strtotime('-'.$i.'days'));
				//echo $tday.'<br/>';
				$tincome = $this->system_model->total_prod_per_day($ac['product_id'],$dt);
				//echo $tincome;
				if(!$tincome)
				{
					$tincome = 0;
				}
				if($i==30)
				{
					$list_lmonth_income_arr[$cc]['income'] .= "$tincome";
				}
				else
				{
					$list_lmonth_income_arr[$cc]['income'] .= ",$tincome";
				}
				//echo $tincome.'<br/>';
			}
			$list_lmonth_income_arr[$cc]['income'] .= "]";
			
			$cc++;
		}
		
		//echo "<pre>".print_r($list_lmonth_income_arr,true)."</pre>";

		$data['list_lmonth_income_arr'] = json_encode($list_lmonth_income_arr);
		
		$data['sales_all'] = $this->order_model->sales_total();
		
		$this->system_model->update_order_detail($data);
	}

	function best_customer()
	{
		$data['best_customers'] = json_encode($this->system_model->best_customers());
		$data['earliest_date'] = $this->system_model->get_ealiest_income();
		$data['best_products'] = json_encode($this->system_model->best_products());
		$data['best_categories'] = json_encode($this->system_model->best_categories());
		
		$this->system_model->update_order_detail($data);
	}
	
	function update_order_daily()
	{
		$data['today_income'] = $this->order_model->sales_date(date('Y-m-d'));
		$data['yesterday_income'] = $this->order_model->sales_date(date('Y-m-d',strtotime('-1 day')));
		$data['list_order_today'] = json_encode($this->order_model->sales_date_list(date('Y-m-d')));
		$this->system_model->update_order_detail($data);
	}
	
	function update_order_yearly()
	{
		//echo 123;
		//error_reporting(E_ALL);
		$dbet = $this->createDateRangeArray(date('Y-m-d',strtotime('01-01-2013')), date('Y-m-d',strtotime('31-12-2013')));
		//echo "<pre>".print_r($dbet,true)."</pre>";
		
		//exit;
		$all_income = '';
		$cc = 0;
		
		foreach($dbet as $g)
		{
			if($cc  == 0)
			{
				$all_income .= $this->order_model->sales_date(date('Y-m-d',strtotime($g)));
			}
			else 
			{	
				$all_income .= ', '.$this->order_model->sales_date(date('Y-m-d',strtotime($g)));
			}
			$cc++;
		}
		
		//echo "<pre>".print_r($get,true)."</pre>";
		
		$data['all_income'] = $all_income;
		$data['yyear_f'] = date('Y');
		$data['header_year_f'] = "This Year's Income";
		
		//echo $all_income;
		
		$this->system_model->update_order_detail($data);
	}
	
	function refresh_dashboard()
	{
		$data['c_cat'] = count($this->category_model->any_productcategory());
		$data['all_cat_prod'] = count($this->category_model->all_prod());
		$data['all_cat_page'] = count($this->category_model->all_page());
		$data['all_galleries'] = count($this->gallery_model->get_galleries());
		$data['all_banners'] = count($this->content_model->get_banners());
		
		$data['all_prod'] =count($this->product_model->all());
		$data['all_prod_config'] =count($this->product_model->all_on_sale());
		$data['all_prod_in_stock'] =count($this->product_model->all_in_stock());
		$data['all_prod_active'] =count($this->product_model->all_active());
		$data['all_prod_disable'] =count($this->product_model->all_disable());
		$data['all_prod_out_of_stock'] =count($this->product_model->all_out_of_stock());
		$data['all_prod_hidden'] =count($this->product_model->all_hidden());
		
		$data['all_retail_aus'] = count($this->customer_model->all_retailer_aus());
		$data['all_new_retail_aus'] = count($this->customer_model->all_retailer_aus_this_month(date('Y-m')));
		$data['all_retail_int'] = count($this->customer_model->all_retailer_int());
		$data['all_new_retail_int'] = count($this->customer_model->all_retailer_int_this_month(date('Y-m')));
		$data['all_trade'] = count($this->customer_model->all_dealer());
		$data['all_new_trade'] = count($this->customer_model->all_dealer_this_month(date('Y-m')));
		$data['all_subscribe'] = count($this->subscribe_model->all());
		$data['all_new_subscribe'] = count($this->subscribe_model->subscribe_this_month(date('Y-m')));
		
		$this->system_model->update_order_detail($data);
		
	}
	
	function all_sales_report()
	{
		$this->update_order_detail2();	
		$this->sales_date_per_cat();
		$this->last_month_income();
		$this->best_customer();
		$this->update_order_yearly();
		$this->update_order_daily();	
		
		redirect('admin/order/salesreport');		
	}
	
	function all_sales_report2()
	{
		$this->update_order_detail2();	
		$this->sales_date_per_cat();
		$this->last_month_income();
		$this->best_customer();
		$this->update_order_yearly();
		$this->update_order_daily();	
		
		//redirect('admin/order/salesreport');		
	}
}