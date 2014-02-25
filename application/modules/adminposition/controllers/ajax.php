<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('position_model');

	}
	
	function searchproductposition() {
		
		$category = $_POST['category'];
		$keyword='';
		$products = $this->position_model->search($keyword,$category,true);		
		//<input type="checkbox" value="'.$product['id'].'" name="products[]" />
		$cats_product='';
		//if($category!=0)
		//{
			$cats = $this->position_model->identify_category($category);
			
			if(isset($cats['order_position'])){
				$cats_product=$cats['order_position'];
			}
			else{$cats_product='';}
			
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
			<div id="notes-position" ></div>
			<div id="top-table-button-group">
				<button class="btn btn-info" type="button"  onClick="update_product();">Update Products</button>
			</div>
			<div style="clear: both">&nbsp;</div>
		</div>
		
		<table class="table table-striped table-hover table-height">
			<thead>
				<tr style="font-size: 15px" class="list-tr">
					<th style="width: 75%">PRODUCT NAME</th>
					<th style="width: 15%; text-align: center;">POSITION</th>	
					<th style="width: 10%; text-align: center;">POSITION</th>				
				</tr>
			</thead>
					
			<tbody id="subcat" class="sorted_table">';			        
		$prod=array();
		if($cats_product!='')
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
		$ind2=json_encode($prod);
		$data=array('order_position'=>$ind2);
		$this->position_model->update_category($category,$data);
		foreach($prod as $pt) { 
			$product=$this->position_model->identify_product($pt);
			if($category > 0){
				$checker = $this->position_model->check_category($pt,$category);
				$tot_checker=count($checker);
			}
			else {$tot_checker=1;}
			if(count($product)>0)
			{
				if ( $product['deleted'] == 0 && $tot_checker>0) {
				$out .= '			
				<tr class="tr_cat list-tr" id="cat-'.$product['id'].'">
					<td>'.$product['title'].' '.$product['short_desc'].'</td>
					<td style="text-align: center;">
						&nbsp; <a href="#" onclick="change_position('.$product['id'].')"><i class="fa fa-list-ol"></i></a>  &nbsp;
					</td>
					<td style="text-align: center;"><span class="badge badge-info">'.$num.'</span>
						
					</td>
				</tr> 
				
				'; $num++;
					} 
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
	
	function _searchproductposition() {
		
		$category = $_POST['category'];
		$keyword='';
		$products = $this->position_model->search($keyword,$category,true);		
		//<input type="checkbox" value="'.$product['id'].'" name="products[]" />
		$cats_product='';
		if($category!=0)
		{
			$cats = $this->position_model->identify_category($category);
			
			if(isset($cats['order_position'])){
				$cats_product=$cats['order_position'];
			}
			else{$cats_product='';}
			
		}
		$out = '
    	<div class="box">
    		<form name="featureForm" method="post" action="'.base_url().'admin/position/updatefeature">
        	<div style="clear:both; float:none;">
			<h2 style="padding-left:7px;float:left;">Products List</h2><div id="notes" style="float:left;margin-top:22px;margin-left:20px;"></div><button class="btn btn-primary" type="button"  style="float:right;margin-top:15px;" onClick="update_product();">Update Products</button>
			</div>
			<div style="clear:both;"></div>
        	<div style="margin-top: 10px;" class="list_line"></div>
			
			<input type="hidden" name="pos_cat" id="pos_cat" value="'.$category.'">
			
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
				if(in_array($id, $products)){
					$prod[]=$id;
				}
			}
			
		}
		foreach($products as $product)
		{			
			if(!in_array($product['id'], $prod)){
				$prod[]=$product['id'];
			}
		}
		$num=1;
		$ind2=json_encode($prod);
		$data=array('order_position'=>$ind2);
		$this->position_model->update_category($category,$data);
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
	
			<p align="right">
				
				<button class="btn btn-primary" type="button" onClick="update_product();">Update Products</button>
			</p>        
			</form>
    	</div>
    	';
		print $out;
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