<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Position
 * @author: rseptiane@gmail.com
 */

class Adminposition extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('position_model');
	}
	
	
	public function index($method='', $param='')
	{
		switch($method)
		{
						
			case 'addfeature':
					$this->addfeature($param);
				break;									
			default:
					$this->position_list($method);
				break;
		}
	}
	function position_list()
	{
		$data['first'] = true;
		$data['main'] = $this->position_model->get_main();
		$this->load->view('admin_position',$data);
	}

	function searchproductposition() {
		
		$category = $_POST['category'];
		$products = $this->position_model->search($keyword,$category,true);		
		//<input type="checkbox" value="'.$product['id'].'" name="products[]" />
		//if($category!=0)
		//{
			$cats = $this->position_model->identify_category($category);
			$cats_product=$cats['order_position'];
			
		//}
		$out = '
		<form name="featureForm" method="post" action="'.base_url().'admin/position/updatefeature">
		<input type="hidden" name="pos_cat" id="pos_cat" value="'.$category.'">
		<div id="top-table">
			<div style="float:left">
				<div id="top-table-title">
					Product List
				</div>
			</div>
			<div id="top-table-button-group">
				<button class="btn btn-info" type="button"  style="float:right;margin-top:15px;" onClick="update_product();">Update Products</button>
			</div>
			<div style="clear: both">&nbsp;</div>
		</div>
		
		<table class="table table-striped">
			<thead>
				<tr style="font-size: 15px">
					<th style="width: 75%">Product name</th>
					<th style="width: 15%; text-align: center;">Position</th>	
					<th style="width: 10%; text-align: center;">Position</th>				
				</tr>
			</thead>
					
			<tbody id="subcat" class="sorted_table">';			        
		$prod=array();
		if($cats_product!='' && $category!=0)
		{
			$ind=json_decode($cats_product);
			foreach($ind as $id)
			{
				$prod[]=$id;
			}
			
		}
		foreach($products as $product)
		{			
			if(!in_array($product['id'], $prod)){
				$prod[]=$product['id'];
			}
		}
		$num=1;
		foreach($prod as $pt) { 
			$product=$this->position_model->identify_product($pt);
			if ( $product['deleted'] == 0 && $product['status'] == 1) {
			$out .= '			
			<tr class="tr_cat" id="cat-'.$product['id'].'">
				<td>'.$product['title'].' '.$product['short_desc'].'</td>
				<td style="text-align: center;">
					&nbsp; <a href="#" onclick="change_position('.$product['id'].')"><i class="icon-list-ol"></i></a>  &nbsp;
				</td>
				<td style="text-align: center;"><span class="badge badge-info">'.$num.'</span>
					
				</td>
			</tr> 
			
			'; $num++;
            	} 
			
			}
		$out .= '
			</tbody>		
			</table>
		
    	
    	</form>
    	';
		print $out;
		
/*
		<!--<div class="box">
    		
        	<div style="clear:both; float:none;">
			<h2 style="padding-left:7px;float:left;">Products List</h2><div id="notes" style="float:left;margin-top:22px;margin-left:20px;"></div><button class="btn btn-primary" type="button"  style="float:right;margin-top:15px;" onClick="update_product();">Update Products</button>
			</div>
			<div style="clear:both;"></div>
        	<div style="margin-top: 10px;" class="list_line"></div>
			
			
			
			
	
			<p align="right">
				
				<button class="btn btn-primary" type="button" onClick="update_product();">Update Products</button>
			</p>        
			
    	</div>-->*/

	}
	function update_order()
	{
		$category=$this->input->post('category');
		$index = $this->input->post('indx');
		$ind2=json_encode($index);
		$data=array('order_position'=>$ind2);
		$this->position_model->update_category($category,$data);
		
	}
}