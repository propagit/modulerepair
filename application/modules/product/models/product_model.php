<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	@class_desc Product Model. 
*	@class_comments 
*	
*
*/
class Product_model extends CI_Model {

	
	/**
	*	@desc Gets product by category id title or perma link
	*	
	*	@name get_products_by_category
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	function get_products_by_category($id_title = "",$status = 1)
	{
		$category_info = $this->category_model->get_category_by_link($id_title);

		$sql = "select products.* from products,products_categories where products.id = products_categories.product_id and products_categories.category_id = ".$category_info->id." and status = ".$status." order by products.title";	
		$products = $this->db->query($sql)->result();
		if($products){
			return $products;	
		}

		return false;
		
	}
	
	/**
	*	@desc Gets product hero image
	*	
	*	@name get_product_hero_image
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	function get_product_hero_image($product_id)
	{
		$hero = $this->db->select('name')->where('product_id',$product_id)->where('hero',1)->get('products_photos')->row();
		if($hero){
			return $hero->name;	
		}
		return false;
	}
	
	/**
	*	@desc Gets product by its link
	*	
	*	@name get_product_by_link
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	function get_product_by_link($id_title)
	{
		$product = $this->db->where('id_title',$id_title)->get('products')->row();
		if($product){
			return $product;	
		}else{
			redirect('products');	
		}
	}
	
	/**
	*	@desc Gets product by its id
	*	
	*	@name get_product_by_id
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	function get_product_by_id($id)
	{
		$product = $this->db->where('id',$id)->get('products')->row();
		if($product){
			return $product;	
		}else{
			redirect('products');	
		}
	}
	
	/**
	*	@desc Gets product by its link
	*	
	*	@name get_product_by_link
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 	@comment returns list if return parameter is set as true or empty, if return is false then it prints the list 
	*/
	
	function format_product_features($feature,$return = true)
	{
		if($feature){
			$arr = explode(';',$feature);
			$list = '';
			foreach($arr as $a){
				$list .= '<li><span class="list-dot">&bull;</span><span class="feature-list">'.trim($a).'</span></li>';	
			}
			if($return){
				return '<ul>'.$list.'</ul>';	
			}else{
				echo '<ul>'.$list.'</ul>';	
			}
		}
	}
	
	
	/**
	*	@desc Gets product by its link
	*	
	*	@name get_all_photos
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 	@comment returns list if photos exclude her
	*/
	
	function get_all_photos($product_id) {
		$this->db->where('product_id',$product_id);
		$this->db->where('hero',0);
		$this->db->order_by('order','asc');
		$query = $this->db->get('products_photos');
		return $query->result_array();
	}
	
	


	


}