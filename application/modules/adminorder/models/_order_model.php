<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model {
	
	function get_customer()
	{
		$query = $this->db->get('customers');		
		return $query->result_array();
	}
	
	function upcoming_orders($id)
	{	
		//$this->db->where('lock',1);
		$this->db->where('order_id',0);
		$this->db->where('customer_id',$id);
		$query = $this->db->get('carts');		
		return $query->result_array();
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
		/*$type=$this->session->userdata('by_typecustomer');
		if(empty($type))
			$type=1;
		$sql="select orders.*  top $limit from orders, users where users.customer_id=orders.customer_id and users.level='$type' LIMIT $limit";
		$query=$this->db->query($sql);*/
		return $query->result_array();
	}
	
	function add($data) {
		$this->db->insert('orders',$data);
		return $this->db->insert_id();
	}
	function add_paypal_txn($data) {
		$this->db->insert('paypal_txn',$data);
		return $this->db->insert_id();
	}
	function update_paypal_txn($id,$data) {
		$this->db->where('session_id',$id);
		$this->db->update('paypal_txn',$data);
	}
	function save_paypal($data) {
		$this->db->insert('paypal_txn',$data);
		return $this->db->insert_id();
	}
	function get_txn($id) {
		$this->db->where('custom',$id);
		$query = $this->db->get('paypal_txn');
		return $query->first_row('array');
	}
	function get_txn_session($id) {
		$this->db->where('session_id',$id);
		$query = $this->db->get('paypal_txn');
		return $query->first_row('array');
	}
	function identify($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('orders');
		return $query->first_row('array');
	}
	function all_not_export()
	{
		$this->db->where('export',0);
		$this->db->where('status','successful');		
		$query = $this->db->get('orders');
		return $query->result_array();
	}
	function identify_promotioncode($code,$custid) {
		$this->db->where('promotion_code',$code);	
		$this->db->where('customer_id',$custid);	
		$query = $this->db->get('orders');
		return $query->result_array();
	}
	function update($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('orders',$data);
	}
	function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('orders');
	}
	function delete_all($customer_id) {
		$this->db->where('customer_id',$customer_id);
		$this->db->delete('orders');
	}
	/*
	function last($limit) {
		$this->session->set_userdata('by_typecustomer',1);
		$this->db->order_by('id','desc');
		$this->db->limit($limit);
		$query = $this->db->get('orders');
		/*$type=$this->session->userdata('by_typecustomer');
		if(empty($type))
			$type=1;
		$sql="select orders.*  top $limit from orders, users where users.customer_id=orders.customer_id and users.level='$type' LIMIT $limit";
		$query=$this->db->query($sql);*//*
		return $query->result_array();
	}*/
	function search($customer_name,$order_id,$from_date,$to_date,$by_keyword,$by_status, $by_typecustomer) {
		#$sql = "SELECT * FROM `orders` WHERE";
		if($customer_name || $order_id || $from_date || $to_date || $by_keyword)
		{
			$sql = "Select DISTINCT orders.* from orders,products,carts, users WHERE orders.id = carts.order_id AND products.id = carts.product_id AND orders.customer_id = users.customer_id and users.level='$by_typecustomer' ";
			
			if ($customer_name != "")
			{
				$sql .= " AND orders.firstname LIKE '$customer_name'";
			
				//$this->db->like('firstname',$customer_name);
				//$this->db->or_like('lastname',$customer_name);
				#$sql .= " (`firstname` LIKE '%$customer_name%' OR `lastname` LIKE '%$customer_name%')";
			} 
			
			if ($order_id != "")
			{
				$sql .= " AND orders.id = '$order_id'";
											
				//$this->db->where('id',$order_id);
				#$sql .= " `id` = $order_id";
			}
			
						
			if ($from_date != "") {
				//$this->db->where("DATEDIFF(DATE(`order_time`),DATE('$from_date')) >",0);
				$sql .= " AND DATEDIFF(DATE(`order_time`),DATE('$from_date'))>=0";
			}
			
			if ($to_date != "") {
				//$this->db->where("DATEDIFF(DATE('$to_date'),DATE(`order_time`)) >",0);
				$sql .= " AND DATEDIFF(DATE('$to_date'),DATE(`order_time`))>=0";
			}
						
			
			if ($by_keyword != "") {
				//do this query - by Haydn
				$sql .= " AND products.title LIKE '%$by_keyword%'";
			}
			if($by_status==1)
				$sql.= " AND orders.status ='successful'";
			$sql.=" order by orders.id desc";
			$query = $this->db->query($sql);
			return $query->result_array();
		}	
		else
		{			
			$sql="select orders.* from orders, users where users.customer_id=orders.customer_id and users.level='$by_typecustomer' order by orders.id desc";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		
	}
	function search_v2($customer_name,$order_id,$from_date,$to_date,$by_keyword,$by_status, $by_typecustomer,$by_payment,$by_ord_status,$cust_id) {
		#$sql = "SELECT * FROM `orders` WHERE";
		if($customer_name || $order_id || $from_date || $to_date || $by_keyword || $by_payment || $cust_id || $by_ord_status)
		{
			//$sql = "Select DISTINCT orders.* from orders,products,carts, users WHERE orders.session_id = carts.session_id AND products.id = carts.product_id AND orders.customer_id = users.customer_id and users.level='$by_typecustomer' ";
			// $sql = "Select DISTINCT orders.* from orders,products,carts,customers, users WHERE orders.session_id = carts.session_id AND products.id = carts.product_id AND orders.customer_id = users.customer_id and users.customer_id = customers.id";
			$sql = "Select orders.customer_id, orders.id, orders.total, orders.order_status, orders.order_time
					from orders,customers, products, carts
					where orders.customer_id = customers.id
					and orders.id = carts.order_id AND products.id = carts.product_id";
			if ($customer_name != "")
			{
				$sql .=" AND (CONCAT(customers.firstname, ' ', customers.lastname) LIKE '%$customer_name%' OR customers.lastname LIKE '%$customer_name%' OR customers.firstname LIKE '%$customer_name%')";
				
				/*$cust_name=explode(' ',$customer_name);
				if(count($cust_name)>1){
					$sql .= " AND customers.firstname = '$cust_name[0]' and customers.lastname = '$cust_name[1]'";
				}
				else{
					$sql .= " AND customers.firstname LIKE '%$customer_name%' or customers.lastname LIKE '%$customer_name%'";
				}*/
			
				//$this->db->like('firstname',$customer_name);
				//$this->db->or_like('lastname',$customer_name);
				#$sql .= " (`firstname` LIKE '%$customer_name%' OR `lastname` LIKE '%$customer_name%')";
			} 
			
			if ($order_id != "")
			{
				$sql .= " AND orders.id = '$order_id'";
											
				//$this->db->where('id',$order_id);
				#$sql .= " `id` = $order_id";
			}
			
						
			if ($from_date != "") {
				//$this->db->where("DATEDIFF(DATE(`order_time`),DATE('$from_date')) >",0);
				$from_date=date('Y-m-d',strtotime($from_date));
				$sql .= " AND DATEDIFF(DATE(`order_time`),DATE('$from_date'))>=0";
			}
			
			if ($to_date != "") {
				//$this->db->where("DATEDIFF(DATE('$to_date'),DATE(`order_time`)) >",0);
				$to_date=date('Y-m-d',strtotime($to_date));
				$sql .= " AND DATEDIFF(DATE('$to_date'),DATE(`order_time`))>=0";
			}
						
			
			if ($by_keyword != "") {
				//do this query - by Haydn
				$sql .= " AND (products.id = '$by_keyword' or products.title like '%$by_keyword%')";
			}
			if ($cust_id != "") {
				//do this query - by Haydn
				$sql .= " AND orders.customer_id = $cust_id";
			}
			/*
			if ($by_payment != "All") {
				//do this query - by Haydn
				$sql .= " AND orders.cardtype = '$by_payment'";
			}
			*/
			if ($by_ord_status != "All") {
				//do this query - by Haydn
				$sql .= " AND orders.order_status = '$by_ord_status'";
			}
			if($by_status==1)
				$sql.= " AND orders.status ='successful'";
			$sql.=" group by orders.customer_id, orders.id, orders.total, orders.order_status, orders.order_time order by orders.id desc
			limit 20";
			
			//echo $sql;
			$query = $this->db->query($sql);
			
			return $query->result_array();
		}	
		else
		{			
			//$sql="select orders.* from orders, users where users.customer_id=orders.customer_id and users.level='$by_typecustomer' order by orders.id desc";
			$sql="select orders.* from orders, users where users.customer_id=orders.customer_id order by orders.id desc limit 20";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		
	}

	function search_v3($customer_name,$order_id,$from_date,$to_date,$by_keyword,$by_status, $by_typecustomer,$by_payment,$by_ord_status,$cust_id) {
		#$sql = "SELECT * FROM `orders` WHERE";
		if($customer_name || $order_id || $from_date || $to_date || $by_keyword || $by_payment || $cust_id || $by_ord_status)
		{
			//$sql = "Select DISTINCT orders.* from orders,products,carts, users WHERE orders.session_id = carts.session_id AND products.id = carts.product_id AND orders.customer_id = users.customer_id and users.level='$by_typecustomer' ";
			// $sql = "Select DISTINCT orders.* from orders,products,carts,customers, users WHERE orders.session_id = carts.session_id AND products.id = carts.product_id AND orders.customer_id = users.customer_id and users.customer_id = customers.id";
			$sql = "Select orders.customer_id, orders.id, orders.total, orders.order_status, orders.order_time, orders.tax, orders.shipping_cost, orders.session_id
					from orders,customers, products, carts
					where orders.customer_id = customers.id
					and orders.id = carts.order_id AND products.id = carts.product_id";
			if ($customer_name != "")
			{
				$sql .=" AND (CONCAT(customers.firstname, ' ', customers.lastname) LIKE '%$customer_name%' OR customers.lastname LIKE '%$customer_name%' OR customers.firstname LIKE '%$customer_name%')";
				
				/*$cust_name=explode(' ',$customer_name);
				if(count($cust_name)>1){
					$sql .= " AND customers.firstname = '$cust_name[0]' and customers.lastname = '$cust_name[1]'";
				}
				else{
					$sql .= " AND customers.firstname LIKE '%$customer_name%' or customers.lastname LIKE '%$customer_name%'";
				}*/
			
				//$this->db->like('firstname',$customer_name);
				//$this->db->or_like('lastname',$customer_name);
				#$sql .= " (`firstname` LIKE '%$customer_name%' OR `lastname` LIKE '%$customer_name%')";
			} 
			
			if ($order_id != "")
			{
				$sql .= " AND orders.id = '$order_id'";
											
				//$this->db->where('id',$order_id);
				#$sql .= " `id` = $order_id";
			}
			
						
			if ($from_date != "") {
				//$this->db->where("DATEDIFF(DATE(`order_time`),DATE('$from_date')) >",0);
				$from_date=date('Y-m-d',strtotime($from_date));
				$sql .= " AND DATEDIFF(DATE(`order_time`),DATE('$from_date'))>=0";
			}
			
			if ($to_date != "") {
				//$this->db->where("DATEDIFF(DATE('$to_date'),DATE(`order_time`)) >",0);
				$to_date=date('Y-m-d',strtotime($to_date));
				$sql .= " AND DATEDIFF(DATE('$to_date'),DATE(`order_time`))>=0";
			}
						
			
			if ($by_keyword != "") {
				//do this query - by Haydn
				$sql .= " AND (products.id = '$by_keyword' or products.title like '%$by_keyword%')";
			}
			if ($cust_id != "") {
				//do this query - by Haydn
				$sql .= " AND orders.customer_id = $cust_id";
			}
			/*
			if ($by_payment != "All") {
				//do this query - by Haydn
				$sql .= " AND orders.cardtype = '$by_payment'";
			}
			*/
			if ($by_ord_status != "All") {
				//do this query - by Haydn
				$sql .= " AND orders.order_status = '$by_ord_status'";
			}
			if($by_status==1)
				$sql.= " AND orders.status ='successful'";
			$sql.=" group by orders.customer_id, orders.id, orders.total, orders.order_status, orders.order_time order by orders.id desc
			limit 20";
			
			//echo $sql;
			$query = $this->db->query($sql);
			
			return $query->result_array();
		}	
		else
		{			
			//$sql="select orders.* from orders, users where users.customer_id=orders.customer_id and users.level='$by_typecustomer' order by orders.id desc";
			$sql="select orders.* from orders, users where users.customer_id=orders.customer_id order by orders.id desc limit 20";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		
	}

	function search_period($period,$value) {
		if($period == "total") {
			$sql = "SELECT * FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')";
		} else if ($period == "month") {
			$sql = "SELECT * FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND `order_time` LIKE '$value%'";
		} else if ($period == "week") {
			$sql = "SELECT * FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND DATEDIFF(CURDATE(),DATE(`order_time`)) <= 7";
		} else if ($period == "day") {
			$sql = "SELECT * FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND date_format(`order_time`, '%Y-%m-%d') = '$value'";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function sales_total() {
		$sql = "SELECT sum(`total`) as `sales` FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result['sales'] != NULL) {
			return $result['sales'];
		}
		return '0.00';
	}
	function sales_month($month) {
		$sql = "SELECT sum(`total`) as `sales` FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND `order_time` LIKE '$month%'";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result['sales'] != NULL) {
			return $result['sales'];
		}
		return '0.00';
	}
	function sales_year($year) {
		$sql = "SELECT sum(`total`) as `sales` FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND `order_time` LIKE '$year%'";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result['sales'] != NULL) {
			return $result['sales'];
		}
		return '0.00';
	}
	function sales_week() {
		$sql = "SELECT sum(`total`) as `sales` FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND DATEDIFF(CURDATE(),DATE(`order_time`)) <= 7";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result['sales'] != NULL) {
			return $result['sales'];
		}
		return '0.00';
	}
	function sales_date($date) {

		$sql = "SELECT sum(`total`) as `sales` FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND date_format(`order_time`, '%Y-%m-%d') = '$date'";
		
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if($result['sales'] != NULL) {
			return $result['sales'];
		}
		
		return '0.00';
	}
	
	function sales_date_per_state($date,$state) {
		if($state == -1)
		{
			$sql = "SELECT sum(`total`) as `sales` FROM `orders` a, `customers` b WHERE (a.`status` = 'successful' or a.status = '30 days trade')
				AND date_format(a.`order_time`, '%Y-%m-%d') = '$date' and a.customer_id = b.id";
		}
		else
		{
			$sql = "SELECT sum(`total`) as `sales` FROM `orders` a, `customers` b WHERE (a.`status` = 'successful' or a.status = '30 days trade')
				AND date_format(a.`order_time`, '%Y-%m-%d') = '$date' and a.customer_id = b.id and a.state = $state";
		}
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if($result['sales'] != NULL) {
			return $result['sales'];
		}
		
		return '0.00';
	}
	
	function sales_date_list($date) {

		$sql = "SELECT * FROM `orders` WHERE (`status` = 'successful' or status = '30 days trade')
				AND date_format(`order_time`, '%Y-%m-%d') = '$date'";
		
		$query = $this->db->query($sql);
		$result = $query->result_array('array');
		// if($result['sales'] != NULL) {
			// return $result['sales'];
		// }
		
		return $result;
	}
	
	
	/*dashboard*/
	function get_data_dashboard()
	{
		$this->db->where('id', 1);	
		$query = $this->db->get('dashboard');
		return $query->first_row('array');
	}
	/*dashboard*/
	
	
	
	
	
	
	
	
	
	/*
	
	function prepare_order_data($data)
	{
		$data['fault'] = htmlentities($data['fault']);
		return $data;	
	}
	
	function insert_order($data)
	{
		$data = $this->prepare_order_data($data);
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}
	
	function update_order($order_id, $data)
	{
		$this->db->where('order_id', $order_id);
		return $this->db->update('orders', $data);
	}
	
	function get_total_orders($distributor_name='', $order_type='')
	{
		if ($distributor_name != '')
		{
			$this->db->where('distributor_company_name', $distributor_name);
		}
		if ($order_type == 'REP/RTN')
		{
			$this->db->where('type', 'REP/RTN');
		}
		else if ($order_type == 'EXCHANGE')
		{
			$this->db->where('type', 'EXCHANGE');
			$this->db->where('sys_rma', NULL);
		}
		else
		{
			$this->db->where('type', 'EXCHANGE');
			$this->db->where('sys_rma !=', '');
		}
		$query = $this->db->get('orders');
		return $query->num_rows();
	}
	
	function get_order($order_id)
	{
		$this->db->where('order_id', $order_id);
		$query = $this->db->get('orders');
		return $query->first_row('array');
	}
	
	function get_order_available($distributor_company_name, $part_no, $req_no)
	{
		$this->db->where('distributor_company_name', $distributor_company_name);
		$this->db->where('product_part_no', $part_no);
		$this->db->where('req_no', $req_no);
		$this->db->where('customer_name', NULL);
		$this->db->where('sale_date', NULL);
		$query = $this->db->get('orders');
		return $query->first_row('array');
	}
	
	function search_orders($keywords)
	{
		$sql = "SELECT o.*, p.title as product_name FROM
				orders o
				LEFT JOIN products p ON o.product_part_no = p.part_no
				WHERE p.title LIKE '%" . $keywords . "%' OR o.distributor_company_name LIKE '%" . $keywords . "%'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_orders($per_page = NULL, $offset = NULL, $distributor_name = '', $order_type='')
	{
		$offset = ($offset) ? $offset : 0;
		$sql = "SELECT o.*, p.title as product_name, p.pic_url FROM
			orders o
			LEFT JOIN products p ON o.product_part_no = p.part_no";
		if ($distributor_name != '')
		{
			$sql .= " WHERE o.distributor_company_name = '" . $distributor_name . "'";
		}
		if ($order_type != '')
		{
			if ($distributor_name != '')
			{
				$sql .= " AND";
			}
			else
			{
				$sql .= " WHERE";
			}
			if ($order_type == "REP/RTN")
			{
				$sql .= " o.type='REP/RTN'";
			}
			else if ($order_type == "EXCHANGE")
			{
				$sql .= " o.type='EXCHANGE' AND o.sys_rma IS NULL";				
			}
			else
			{
				$sql .= " o.type='EXCHANGE' AND o.sys_rma IS NOT NULL";	
			}
		}
		if ($per_page != NULL)
		{
			$sql .= " ORDER BY o.sale_date DESC LIMIT " . $offset . ", " . $per_page;
		}
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	
	function get_product($part_no)
	{
		$this->db->where('part_no', $part_no);
		$query = $this->db->get('products');
		return $query->first_row('array');
	}
	
	function generate_sys_rma()
	{
		$this->db->order_by('sys_rma', 'desc');
		$query = $this->db->get('orders');
		$order = $query->first_row('array');
		$sys_rma = $order['sys_rma'];
		$sys_rma = str_replace('PQ','',$sys_rma);
		$sys_rma = intval($sys_rma);
		$sys_rma++;
		return sprintf('PQ%06d', $sys_rma);
	}*/
}