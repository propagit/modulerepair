<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*	@class_desc Category Model. 
*	@class_comments 
*	
*
*/

class Category_model extends CI_Model {

	/**
	*	@desc Gets all category based
	*	
	*	@name products_overview
	*	@access public
	*	@param [bool]status
	*	@return all category or all active category based on status
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	function get_all_category($active = true)
	{
		$sql = "select * from category_products where id != 0";	
		if($active){
			$sql .= " and active = 1"; 
		}
		//$sql .= " order by order_position asc";
		$sql .= " order by id desc";
		
		return $this->db->query($sql)->result();
	}
	
	/**
	*	@desc Gets all category based
	*	
	*	@name products_overview
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	function get_category_by_id($id="")
	{
		
	}
	
	
	/**
	*	@desc Gets category id based on perma link
	*	
	*	@name products_overview
	*	@access public
	*	@param 
	*	@return 
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	function get_category_by_link($id_title="")
	{
		$sql = "select * from category_products where id != 0";
		if($id_title){
			$sql .= " and id_title = '".$id_title."'";	
		}
		
		$sql .= " limit 1";
		$category = $this->db->query($sql)->row();
		
		if($category){
			return $category;
		}else{
			redirect('products');	
		}
	}
	
	
	/**
	*	@desc Gets all products by category
	*	
	*	@name products_overview
	*	@access public
	*	@param [bool]status
	*	@return all category or all active category based on status
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	* 
	*/
	
	/**
	*	@desc Shows the product overview
	*	
	*	@name products_overview
	*	@access public
	*	@param [string]category perma link, [bool] return type
	*	@return list of links or will echo the output based on return type
	*	@author Propagate Dev Team - KG
	*	@version 1.0
	*	@comment if return type is true it returns the list of links otherwise simply prints the list
	* 
	*/
	function get_category_bread_crumbs($category_id_title,$return = false)
	{
		$categories = $this->get_all_category();
		$default_category_id_title = $category_id_title;
		if(!$category_id_title){
			$category_info = $this->get_category_by_link();	
			$default_category_id_title = $category_info->id_title;	
		}
		$links = '';
		if($categories){
			foreach($categories as $cat){
				$links .= '<li><a '.($cat->id_title == $default_category_id_title ? 'class="active-category"' : '').' href="'.base_url().'products/'.$cat->id_title.'">'.$cat->name.'</a></li>';	
			}

		}

		if($return){
			return $links;
		}else{
			echo $links;
		}
	}

	

}

?>