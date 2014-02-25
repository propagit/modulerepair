<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @class_name: Cart
 * 
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('cart_model');
		$this->load->model('product/product_model');
	}
	
	/**
	*	@name addtocart
	*	@access public
	*	@return add item to cart
	*/
	function addtocart()
  	{
		//maintain_ssl(FALSE);
		$session_id = $this->session->userdata('session_id');
		$product_id = $this->input->post('product_id',true);
		$quantity = $this->input->post('quantity',true);
		$product = $this->Product_model->identify($product_id);
		if ($product['sale_price'] > 0){
			$price = $product['sale_price'];
		}else{
			$price = $product['price'];
		}
		/* attributes not currently used */
		$attributes = $this->Product_model->get_attributes($product_id);
		$str = '';
		$selected_attributes = explode('~', $this->input->post('attributes',true));
		for ($i = 0; $i < count($attributes); $i++){
		  $str .= $attributes[$i]['name'] . ':' . $selected_attributes[$i] . '~';
		}
		$data = array(
			'session_id' => $session_id,
			'product_id' => $product_id,
			'price' => $price,
			'quantity' => $quantity,
			'attributes' => $str
		);
		$status = $this->Cart_model->add($data);
		$msg = '';
		if ($status <= -2){
		  $msg = "Sorry this item has low stock levels, however we still may be able to fill you order. Please contact us at sales@clothesline.com.au to enquiry about the availability, please be sure to let us know how many units you require. We will be in contact shortly.";
		}else if ($status == -1){
		  $msg =  "You have already added this item to your shopping trolly. The quantity you would like to purchase can be modified at checkout or while viewing your shopping trolly.";
		}else if ($status > 0){
		  $msg =  "You successfully have added ".$quantity." product to your cart!";
		}else{
		  $msg =  "There was an error when trying to add product to your cart. Please try again later!";
		}
		echo '<div id="cart-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-header rmv-btm-border">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				  </div>
				  <div class="modal-body">
					<p>'.$msg.'</p>
				  </div>
			   </div>';
  	}
	
	/**
	*	@name updatecart
	*	@access public
	*	@return update current cart
	*/
	function updatecart() 
	{
		//maintain_ssl(FALSE);
		$session_id = $this->session->userdata('session_id');
		$cart = $this->Cart_model->all($session_id);
		$total = 0;
		$quantity = 0;
		foreach ($cart as $item){
		  $total += $item['price'] * $item['quantity'];
		  $quantity += $item['quantity'];
		}
		if (count($cart) < 2){
		  $s1 = 'item';
		}else{
		  $s1 = 'items';
		}
		
		if ($quantity < 2){
		  $s2 = 'item';
		}else{
		  $s2 = 'items';
		}
		
		echo count($cart).'#'.$total;
	 }
	 
	 /**
	 *	@name removeitem
	 *	@access public
	 *	@return remove item from cart
	 */
	 function removeitem()
     {
		//maintain_ssl(FALSE);
    	$id = $this->input->post('id',true);
    	$this->Cart_model->delete($id);
     }
	 
	 /**
	 *	@name subtotal
	 *	@access public
	 *	@return get cart subtotal
	 */
	 function subtotal() 
	 {
		//maintain_ssl(FALSE);
		$session_id = $this->session->userdata('session_id');
		$cart = $this->Cart_model->all($session_id);
		$total = 0;
		foreach ($cart as $item){
		  $total += $item['price'] * $item['quantity'];
		}
		printf('%01.2f', $total);
	 }
	
	
}