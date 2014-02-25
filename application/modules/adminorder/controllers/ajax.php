<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: namnd86@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('cart_model');
		$this->load->model('customer_model');
		$this->load->model('system_model');
		$this->load->model('product/product_model');
	}
	
	
	function select_distributor()
	{
		$this->session->set_userdata('order_distributor', $_POST['name']);
	}
	
	function select_order_type()
	{
		$this->session->set_userdata('order_type', $_POST['type']);
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
	function print_invoice()
	{
		$order_id=$this->input->post('order_id');
		$order = $this->order_model->identify($order_id);		
		$cart = $this->cart_model->all_order($order_id);				
		$cust = $this->customer_model->identify($order['customer_id']);		
		$price_guide = $this->order_model->get_data_dashboard();			
		$message='';
		$message.='
				<table width="800" style="font-size: 9px;">
            	<tr>
                	<td>
                    FRUITOPIA PRODUCE (AUST) PTY.LTD.<br /> 
                    PO BOX 792 <BR />
                    MULGRAVE VIC 3170 <BR />
                    A.B.N 15 366 746 389 <br />
                    RICK: 0419 370 312 FAX: (03) 9701-1069<br />
                    ANGELO: 0409 233 544 FAX: (03) 9439-7747
                    </td>
                    <td>&nbsp;</td>
                    <td align="center"><span style="font-size:24px; font-weight:600;">TAX INVOICE</span></td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td style="border:1px solid #999;">
                    	SOLD TO:<br />
                        '.$cust['firstname'].' '.$cust['lastname'].'<br />
                        '.$cust['address'].' '.$cust['address2'].'<br />
                      	'.$cust['suburb'].'<br />
                        '.$this->system_model->get_state($cust['state']).' '.$cust['postcode'].'<br />
                    </td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top">
                    	<table width="100%" style="font-size: 9px;">
                        	<tr style="border:1px solid #999;">
                            	<td>INVOICE #:</td>
                                <td>&nbsp;</td>
                                <td align="right">'.$order['id'].'</td>
                            </tr>

                            <tr style="border:1px solid #999;">
                            	<td>DATE :</td>
                                <td>&nbsp;</td>
                                <td align="right">'.date("d/M/Y",strtotime($order['order_time'])).'</td>
                            </tr>
                            
                            <tr style="border:1px solid #999;">
                            	<td>AMOUNT :</td>
                                <td>&nbsp;</td>
                                <td align="right">$'.$order['total'].'</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>

                <tr>
                	<td colspan="3">
                    <table width="100%" style="font-size: 9px;">
                    	<tr>                        	
                            <td colspan="8">&nbsp;</td>
                            <td style="border:1px solid #000;" colspan="2" align="center">
                            	RETAIL PRICE GUIDE
                            </td>                            
                        </tr>                       
                        <tr >
                        	<td style="border:1px solid #000;" align="center">
                            	PRODUCT
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	QTY
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	PACK $
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	<i class="fa fa-long-arrow-down"></i><i class="fa fa-long-arrow-up"></i>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	UNITS
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	UNITS/PACK
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	**UNIT $
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	TOTAL
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	+ '.$price_guide['price_guide_1'].'%
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	+ '.$price_guide['price_guide_2'].'%
                            </td>
                        </tr>';
                        
                        foreach($cart as $cr)
						{
							$pro = $this->product_model->identify($cr['product_id']);
							$signupdown = '-';
							if($cr['updown'] == 'up')
							{
								$signupdown = '<i class="fa fa-long-arrow-up"></i>';
							}
							if($cr['updown'] == 'down')
							{
								$signupdown = '<i class="fa fa-long-arrow-down"></i>';
							}
							if($cr['updown'] == 'same')
							{
								$signupdown = '-';
							}
						$message.='
						<tr>
                        	<td style="border:1px solid #000;"> 
                            	'.strtoupper($pro['title'].' '.$pro['short_desc']).'
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	'.$cr['quantity'].'
                            </td>
                            <td style="border:1px solid #000;" align="right">
								                           	
									$'.sprintf("%01.2f", $cr['price']).'
								
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	'.$signupdown.'
                            </td >
                            <td style="border:1px solid #000;" align="right">
                            	'.strtoupper($pro['unit_of_sale']).'
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	'.strtoupper($pro['pack']).'
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	';
									$price_unit = round($cr['price']/$pro['pack'],2);
									$message.='$'.sprintf("%01.2f", $price_unit).'
								
                                
                            </td>
                            <td style="border:1px solid #000;" align="right">';
                            	 
									$price_unit = round($cr['price']*$cr['quantity'],2);
									$message.='$'.sprintf("%01.2f", $price_unit).'
								
                            </td>
                            <td style="border:1px solid #000;" align="right">';
                            	    $price_unit = round($cr['price']/$pro['pack'],2);
									$price_guide1 = $price_unit + round($price_unit/100*$price_guide['price_guide_1'],2);
									$message.= '$'.sprintf("%01.2f", $price_guide1).' / UNIT 
                            	
                            </td>
                            <td style="border:1px solid #000;" align="right">';
                            	
                            		$price_unit = round($cr['price']/$pro['pack'],2);
									$price_guide2 = $price_unit + round($price_unit/100*$price_guide['price_guide_2'],2);
									$message.='$'.sprintf("%01.2f", $price_guide2).' / UNIT
                            	
                            </td>
                        </tr>';
                        
						}
						
                    $message.='</table>
                   </td>
                </tr>
            </table>
		';
		echo $message;
	}
	function exportorder()
	{				
		$csvdir = getcwd();
		$csvname = 'Order_'.date('d-m-Y');
		$csvname = $csvname.'.csv';
		header('Content-type: application/csv; charset=utf-8;');
       	header("Content-Disposition: attachment; filename=$csvname");
		$fp = fopen("php://output", 'w');	
		
		$orders = $this->order_model->search_v3($this->session->userdata('customer_name'),$this->session->userdata('order_id'),$this->session->userdata('from_date'),$this->session->userdata('to_date'),$this->session->userdata('by_keyword'),$this->session->userdata('by_status'),4,$this->session->userdata('by_payment'),$this->session->userdata('by_ord_status'),$this->session->userdata('customer_id'));
		
		$headings = array('Order ID','Customer Name','Order Date','Status','Total','Product Name');
		
		fputcsv($fp,$headings);
		
		foreach($orders as $order) {				
			
				$carts = $this->cart_model->all_order($order['id']);
				
				$productname='';
				foreach($carts as $cart){
					$product = $this->product_model->identify($cart['product_id']);
					if(!empty($product['title']))
						$productname.=$product['title'].'('.$cart['quantity'].')'.'; ';
				}
				
				$customer = $this->customer_model->identify($order['customer_id']);
				fputcsv($fp,array($order['id'],$customer['firstname'].' '.$customer['lastname'],$order['order_time'],$order['order_status'],$order['total'],$productname));
		}
        
		fclose($fp);
		
	
	}
}