<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {
	function get_country_id_by_name($name)
	{
		$this->db->where('name',$name);
		$query = $this->db->get('countries');
		$result = $query->first_row('array');
		return $result['id'];
	}
	
	function check_valid_shipping_country($id)
	{
		$this->db->where('country_id',$id);
		$query = $this->db->get('shippings_countries');
		$result = $query->result_array();
		if(count($result) > 0)
		{
			return $id;
		}
		else 
		{
			return 0;
		}
	}
	
	/* Archive Module */
	
	function search_story_archive($keyword)
	{
		$sql = "select a.*, b.title from story_archive a, story b where b.archive_id = a.id and b.title like '%$keyword%' or a.name like '%$keyword%'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function search_archive($keyword)
	{
		// $this->db->like('name', $keyword, 'both'); 
		// $this->db->order_by('id','asc');
		// $query = $this->db->get('story_archive');
		// return $query->result_array();
		
		$sql = "select distinct a.* from story_archive a, story b where b.archive_id = a.id and b.title like '%$keyword%' or a.name like '%$keyword%'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function add_archive($data) {
		$this->db->insert('story_archive',$data);
		return $this->db->insert_id();
	}
	
	function update_archive($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('story_archive',$data);
	}
	
	function get_all_archive() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('story_archive');
		return $query->result_array();
	}
	
	function identify_archive($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('story_archive');
		return $query->first_row('array');
	}
	
	function get_archive($id) {
		
		$this->db->where('archive_id',$id);
		$this->db->order_by('order','asc');
		$query = $this->db->get('story');
		return $query->result_array();
	}
	
	function delete_archive($id) {
		$this->db->where('id',$id);
		$this->db->delete('story_archive');
	}
	
	/* Stockist Module */
	function add_stockist($data) {
		$this->db->insert('stockist',$data);
	}
	
	function delete_all_stockist() {
		$sql = "delete from stockist";
		$query = $this->db->query($sql);
		//return $query->result_array();
	}
	
	function next_step_by_step1($keyword)
	{
		if($keyword == 'AU')
		{
			$sql = "SELECT DISTINCT `state` as `result` from stockist where `country` = 'Australia' and `status` = 'A' order by `state`";
		}
		if($keyword == 'NZ')
		{
			$sql = "SELECT DISTINCT `suburb` as `result` from stockist where `country` = 'NZ' or `country` = 'NEW ZEALAND' and `status` = 'A' order by `suburb`";
		}
		if($keyword == 'OT')
		{
			$sql = "SELECT DISTINCT `country` as `result` from stockist where `country` != 'Australia' and `country` != '' and `country` != 'NZ' and `country` != 'NEW ZEALAND' and `status` = 'A' order by `country`";
		}
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function next_step_by_step2($keyword)
	{
		$sql	= "SELECT DISTINCT `suburb` as `result` from stockist where `state` = '$keyword' and `status` = 'A' order by `suburb`";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/* Attribute Module */
	function add_attribute($data) {
		$this->db->insert('attributes',$data);
	}
	function delete_attribute($id) {
		$this->db->where('id',$id);
		$this->db->delete('attributes');
	}
	function get_attributes() {
		$attributes = array();
		$this->db->order_by('id','asc');
		$query = $this->db->get('attributes');
		return $query->result_array();
		//$result = $query->result_array();
		/*
		foreach($result as $row)
	    {
			
			//$value = explode("~",$row['value']);
			//$options = array();
			//for($i=0;$i<count($value)-1;$i++) {
				//$options[] = $value[$i];
			//}
			
			$options = array();
			if($row['value'] != '')
			{
				$options = json_decode($row['value'], true);
			}
			$attributes[] = array(
				'id' => $row['id'],
				'name' => $row['name'],

				'options' => $options
			);			
		}
		return $attributes;
		*/
	}
	
	function get_attribute($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('attributes');
		$result = $query->first_row('array');
		//$value = explode("~",$result['value']);
		
		$options = array();
		$options = json_decode($result['value'],true);
		/*
		for($i=0;$i<count($value)-1;$i++) {
			$options[] = $value[$i];
		}
		*/
		return array(
			'id' => $result['id'],
			'name' => $result['name'],
			'options' => $options
		);
	}
	function update_attribute($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('attributes',$data);
	}
	
	/* Shipping Module */
	function get_countries() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('countries');
		return $query->result_array();
	}
	function get_states() {
		$this->db->order_by('name','asc');
		$query = $this->db->get('state');
		return $query->result_array();
	}
	function get_state($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('state');
		$result = $query->first_row('array'); 
		return $result['name'];
	}
	function get_state_code($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('state');
		$result = $query->first_row('array'); 
		return $result['code'];
	}
	function get_country1($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('countries');
		return $query->first_row('array'); 
		//return $result['name'];
	}
	function get_country($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('countries');
		$result = $query->first_row('array'); 
		return $result['name'];
	}
	function get_shipping_countries() {
		# this is for get all countries that available for shipping
		
		$sql = "SELECT DISTINCT `countries`.* FROM `countries`,`shippings_countries`,`shippings`
				WHERE `countries`.`id` = `shippings_countries`.`country_id`
				AND `shippings_countries`.`shipping_id` = `shippings`.`id`
				AND `shippings`.`actived` = 1 ORDER BY `countries`.`id`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_shippings_country($country_id) {
		$sql = "SELECT `shippings`.* FROM `shippings`,`shippings_countries`
				WHERE `shippings`.`id` = `shippings_countries`.`shipping_id`
				AND `shippings_countries`.`country_id` = $country_id
				AND `shippings`.`actived` = 1
				ORDER BY `default` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_shippings_country_state($country_id,$state_id) {
		$sql = "SELECT `shippings`.* FROM `shippings`,`shippings_countries`
				WHERE `shippings`.`id` = `shippings_countries`.`shipping_id`
				AND `shippings_countries`.`country_id` = $country_id
				AND `shippings_countries`.`state_id` = $state_id
				AND `shippings`.`actived` = 1
				Group by `shippings_countries`.shipping_id
				ORDER BY `default` DESC";
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_shippings_country_state_suburb($country_id,$state_id,$postcode) {
		$sql = "SELECT `shippings`.* FROM `shippings`,`shippings_countries`,`suburbs_zone`,`suburbs`
				WHERE `shippings`.`id` = `shippings_countries`.`shipping_id`
				AND `shippings`.`id` = `suburbs_zone`.`shipping_id`
				AND `suburbs_zone`.`suburb_id` = `suburbs`.`id`
				AND `suburbs`.`postcode` = $postcode
				AND `shippings_countries`.`country_id` = $country_id
				AND `shippings_countries`.`state_id` = $state_id
				AND `shippings`.`actived` = 1
				Group by `shippings_countries`.shipping_id
				ORDER BY `default` DESC";

		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function add_shipping($data) {
		$this->db->insert('shippings',$data);
		return $this->db->insert_id();
	}
	function add_shipping_v2($data) {
		$this->db->insert('shippings_v2',$data);
		return $this->db->insert_id();
	}
	function add_shipping_condition($data) {
		$this->db->insert('shippings_conditions',$data);
	}
	function get_shipping_conditions($shipping_id) {
		$this->db->where('shipping_id',$shipping_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('shippings_conditions');
		return $query->result_array();
	}
	function get_shipping_countries_all($shipping_id)
	{
		$this->db->where('shipping_id',$shipping_id);		
		$query = $this->db->get('shippings_countries');
		return $query->result_array();
	}
	function get_last_zone()
	{
		$this->db->order_by('zone','desc');		
		$query = $this->db->get('shippings');
		return $query->first_row('array');
	}
	function get_shipping_countries_all_detail($shipping_id)
	{
		$this->db->where('shipping_id',$shipping_id);		
		$query = $this->db->get('shippings_countries');
		return $query->first_row('array');
	}
	function add_shipping_country($data) {
		$this->db->insert('shippings_countries',$data);
	}
	function get_shippings() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('shippings');
		return $query->result_array();
	}
	function get_shipping($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('shippings');
		return $query->first_row('array');
	}
	function get_shipping_v2($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('shippings_v2');
		return $query->first_row('array');
	}
	function update_shipping($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('shippings',$data);
	}
	function update_shipping_v2($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('shippings_v2',$data);
	}
	function shipping_country($shipping_id,$country_id) {
		$this->db->where('shipping_id',$shipping_id);
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('shippings_countries');
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	function shipping_state($shipping_id,$state_id) {
		$this->db->where('shipping_id',$shipping_id);
		$this->db->where('state_id',$state_id);
		$query = $this->db->get('shippings_countries');
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	function remove_shipping_countries($shipping_id) {
		$this->db->where('shipping_id',$shipping_id);
		$this->db->delete('shippings_countries');
	}
	function remove_shipping_conditions($shipping_id) {
		$this->db->where('shipping_id',$shipping_id);
		$this->db->delete('shippings_conditions');
	}
	function default_shipping($id) {
		$sql = "UPDATE `shippings` SET `default` = 0";
		$this->db->query($sql);
		$sql = "UPDATE `shippings` SET `default` = 1, `actived` = 1 WHERE `id` = $id";
		$this->db->query($sql);
	}
	function active_shipping($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('shippings');
		$shipping = $query->first_row('array');
		$this->db->where('id',$id);
		if ($shipping['actived'] == 0) {			
			$this->db->update('shippings',array('actived' => 1));
		} else if ($shipping['actived'] == 1) {
			$this->db->update('shippings',array('actived' => 0));
		}
		
	}
	function active_shipping_v2($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('shippings_v2');
		$shipping = $query->first_row('array');
		//echo $this->db->last_query();
		$this->db->where('id',$id);
		if ($shipping['actived'] == 0) {			
			$this->db->update('shippings_v2',array('actived' => 1));
		} else if ($shipping['actived'] == 1) {
			$this->db->update('shippings_v2',array('actived' => 0));
		}
		
	}
	function delete_shipping($id) {
		$this->db->where('id',$id);
		$this->db->delete('shippings');
	}
	
	function delete_shipping_country($id) {
		$this->db->where('shipping_id',$id);
		$this->db->delete('shippings_countries');
	}
	
	function delete_shipping_v2($id) {
		$this->db->where('id',$id);
		$this->db->delete('shippings_v2');
	}
	function get_suburbs($state)
	{
		$this->db->where('state',$state);
		$this->db->order_by('id','asc');
		$query = $this->db->get('suburbs');
		return $query->result_array();
	}
	function get_suburbs_postcode($postcode)
	{
		$sql = "SELECT `suburbs`.* FROM `suburbs`,`suburbs_zone`,`shippings` WHERE `suburbs`.`postcode`=$postcode and `suburbs`.`id`=`suburbs_zone`.`suburb_id` and `suburbs_zone`.`shipping_id`=`shippings`.`id` and `shippings`.`actived` = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_suburb_detail($suburb_id)
	{
		$this->db->where('id',$suburb_id);
		$query = $this->db->get('suburbs');
		return $query->first_row('array');
	}
	
	function get_country_zone($shipping_id)
	{
		$this->db->where('shipping_id',$shipping_id);
		$this->db->order_by('shipping_id','asc');
		$query = $this->db->get('shippings_countries');
		return $query->result_array();
	}
	
	function get_suburbs_zone($shipping_id)
	{
		$this->db->where('shipping_id',$shipping_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('suburbs_zone');
		return $query->result_array();
	}
	function add_zone_suburb($data)
	{
		$this->db->insert('suburbs_zone',$data);
		return $this->db->insert_id();
	}
	function check_suburb($suburb_id,$shipping_id)
	{
		$this->db->where('shipping_id',$shipping_id);
		$this->db->where('suburb_id',$suburb_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('suburbs_zone');
		return $query->result_array();
	}
	function delete_zone_suburb($shipping_id,$suburb_id)
	{
		$this->db->where('shipping_id',$shipping_id);
		$this->db->where('suburb_id',$suburb_id);
		$this->db->delete('suburbs_zone');
	}

	function delete_zone_country($shipping_id,$suburb_id)
	{
		$this->db->where('shipping_id',$shipping_id);
		$this->db->where('country_id',$suburb_id);
		$this->db->delete('shippings_countries');
	}
	
	/* Coupon Module */
	function add_coupon($data) {
		$this->db->insert('coupons',$data);
		return $this->db->insert_id();
	}
	function add_coupon_condition($data)
	{
		$this->db->insert('conditions',$data);
		return $this->db->insert_id();
	}
	function check_coupon_code($code) {
		$this->db->where('code',$code);
		$query = $this->db->get('coupons');
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		}
		return false;
	}
	function check_coupon_code_update($id,$code) {
		$this->db->where('id != ',$id);
		$this->db->where('code',$code);
		$query = $this->db->get('coupons');
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	function get_coupon_cond($code)
	{
		$this->db->where('value',$code);
		$query = $this->db->get('conditions');
		if ($query->num_rows() > 0) {
			return $query->first_row('array');
		}
		return false;
	}
	function get_coupon($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('coupons');
		return $query->first_row('array');
	}
	function check_category_coupon($id,$idc)
	{
		if($idc>0){$this->db->where('id_coupon != ',$idc);}
		
		$this->db->where('type',2);
		$query = $this->db->get('conditions');
		$cons= $query->result_array();
		$true=0;
		foreach($cons as $cs)
		{
			$temp=explode(',',$cs['categories']);
			if(in_array($id,$temp))
			{
				$true=1;
			}
		}
		return $true;
	}
	function check_product_coupon($id,$idc)
	{
		if($idc>0){$this->db->where('id_coupon !=',$idc);}
		$this->db->where('type',3);
		$query = $this->db->get('conditions');
		$prods= $query->result_array();
		$true=0;
		foreach($prods as $ps)
		{
			$temp=explode(',',$ps['products']);
			if(in_array($id,$temp))
			{
				$true=1;
			}
		}
		return $true;
	}
	function get_coupon_condition($id) {
		$this->db->where('id_coupon',$id);
		$query = $this->db->get('conditions');
		return $query->result_array();
	}
	function get_coupons_active() {
		
		$this->db->where('actived',1);
		$this->db->where('type_cond >',0);
		$this->db->order_by('id','asc');
		$query = $this->db->get('coupons');
		return $query->result_array();
	}
	function get_coupons() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('coupons');
		return $query->result_array();
	}
	function active_coupon($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('coupons');
		$coupon = $query->first_row('array');
		$this->db->where('id',$id);
		if ($coupon['actived'] == 0) {			
			$this->db->update('coupons',array('actived' => 1));
		} else if ($coupon['actived'] == 1) {
			$this->db->update('coupons',array('actived' => 0));
		}
	}
	function update_coupon($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('coupons',$data);
	}
	function delete_coupon($id) {
		$this->db->where('id',$id);
		$this->db->delete('coupons');
	}
	function check_coupon_period($code,$from_date,$to_date) {
		$sql = "SELECT * FROM `coupons` WHERE `code` = '$code'
				AND DATEDIFF(CURDATE(),DATE('$from_date')) >= 0
				AND DATEDIFF(CURDATE(),DATE('$to_date')) <= 0";
		//print_r($sql);
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	
	function check_coupon_period_cond($code,$from_date,$to_date,$now) {
		$sql = "SELECT * FROM `coupons` WHERE `code` = '$code'
				AND from_date <= '$now' 
				AND to_date >= '$now'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	function update_coupon_condition($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('conditions',$data);
	}
	function remove_condition_coupon($id)
	{
		$this->db->where('id_coupon',$id);
		$this->db->delete('conditions');
	}
	function remove_condition($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('conditions');
	}
	function get_all_conditions($coupon_id)
	{
		$this->db->where('id_coupon',$coupon_id);
		$this->db->order_by('id','asc');
		$query = $this->db->get('conditions');
		return $query->result_array();	
	}
	function get_category($product_id)
	{
		
		$this->db->where('id',$product_id);
		$query = $this->db->get('products');
		$prod=$query->first_row('array');
		
		$this->db->where('id_menu',0);
		$query = $this->db->get('categories');
		$cats=$query->result_array();
		$categories='';
		foreach ($cats as $ct)
		{
			/*$this->db->where('id',$ct['parent_id']);
			$query = $this->db->get('category_menu');
			$cat2 = $query->first_row('array');
		
			$keyword= explode(",",$cat2['keywords']);
		
			foreach($keyword as $key)
			{
				$this->db->or_like('short_desc',trim($key));
				$this->db->or_like('long_desc',trim($key));
				
			}*/
			
			if(strpos($prod['short_desc'], $ct['title']))
			{
				$categories=$categories.$ct['id'].',';
			}
			else
			{
				if(strpos($prod['long_desc'], $ct['title']))
				{
					$categories=$categories.$ct['id'].',';
				}
			}
		}
		
		return $categories;	
	}
	
	function coupon_products($prod_id)
	{
		#check product id in condition		
		$this->db->where('type',3);
		$query = $this->db->get('conditions');
		$prods= $query->result_array();
		$coupon_id=0;
		foreach($prods as $ps)
		{
			$temp=explode(',',$ps['products']);
			if(in_array($prod_id,$temp))
			{
				if($ps['cond_prod']=='in')
				{
					$coupon_id= $ps['id_coupon'];
					break;
				}
			}
		}
		$this->db->where('id',$coupon_id);
		$query = $this->db->get('coupons');
		return $query->first_row('array');
		
		
	}
	
	function check_conditions($coupon_id,$session_id)
	{
		$conditions = $this->get_all_conditions($coupon_id);
		$tot_conditions =count($conditions);
		$cond_true=0;
		$product_id='';
		$category_id='';
		$cart = $this->Cart_model->all($session_id);
		$total=0;
		$quantity=0;
		
		foreach($cart as $item)
		{
			$total += $item['price']*$item['quantity'];
			$quantity += $item['quantity'];
			$product_id = $product_id.$item['product_id'].',';
			$category_id =$category_id.$this->get_category($item['product_id']).',';
		}
		foreach ($conditions as $cond)
		{
			if($cond['type']==1) #spend amount
			{								
				if($total >= $cond['value'])
				{
					$cond_true+=1;
				}
			}
			if($cond['type']==2) #category of product
			{								
				
				$cat_id_cart=explode(',',$category_id);
				$cat_id_cond=explode(',',$cond['categories']);
				if(in_array($cat_id_cart,$cat_id_cond))
				{
					if($cond['cond_cat']=='in')
					{
						$cond_true+=1;
					}
				}
				else
				{
					if($cond['cond_cat']=='out')
					{
						$cond_true+=1;
					}
				}

			}
			if($cond['type']==3) #product
			{								
				
				$prod_id_cart=explode(',',$product_id);
				$prod_id_cond=explode(',',$cond['products']);
				
				if(in_array($prod_id_cart,$prod_id_cond))
				{
					if($cond['cond_prod']=='in')
					{
						$cond_true+=1;
					}
				}
				else
				{
					if($cond['cond_prod']=='out')
					{
						$cond_true+=1;
					}
				}
			}
			if($cond['type']==4) #number of product
			{								
				if($quantity >= $cond['value'])
				{
					$cond_true+=1;
				}
			}
			
		}
		if($cond_true==$tot_conditions){ return 1; }
		if($cond_true==0){return 2;} 
		if($cond_true>0 && $cond_true < $tot_conditions){return 3;} 
	}
	/* Keyword */
	function add_keyword($data) {
		$this->db->insert('keywords',$data);
	}
	function get_keyword($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('keywords');
		return $query->first_row('array');
	}
	function most_keyword() {
		$sql = "SELECT id, COUNT(*) as `total` FROM `keywords` GROUP BY `keyword` ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['id']);
			$query = $this->db->get('keywords');
			$row = $query->first_row('array');
			return to_short($row['keyword'],33).' ('.$result['total'].' times)';
		}
		return 'N/A';
	}
	function most_keywords() {
		$sql = "SELECT id, COUNT(*) as `total` FROM `keywords` GROUP BY `keyword` ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/* Stats */
	function best_customer() {
		$sql = "SELECT `customer_id`, sum(`total`) as `total` 
				FROM `orders` 
				WHERE `status` = 'successful'
				GROUP BY `customer_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['customer_id']);
			$query = $this->db->get('customers');
			$row = $query->first_row('array');
			if ($row) {
				return to_short($row['firstname'].' '.$row['lastname'],33).' ($'.number_format($result['total'],2,'.',',').')';
			}
		}
		return 'N/A';
	}
	function best_customers() {
		$sql = "SELECT `customer_id`, sum(`total`) as `total` 
				FROM `orders` 
				WHERE `status` = 'successful'
				GROUP BY `customer_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function best_customers_between_date($datefrom,$dateto) {
		$today = date('Y-m-d H:i:s',strtotime($dateto));
		$lastm = date('Y-m-d H:i:s',strtotime($datefrom));
		$sql = "SELECT `customer_id`, sum(`total`) as `total` 
				FROM `orders` 
				WHERE `status` = 'successful'
				AND `orders`.`order_time` <= '$today'
				AND `orders`.`order_time` >= '$lastm'
				GROUP BY `customer_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function best_category() {
		$sql = "SELECT `products_categories`.`category_id`, count(`products_categories`.`category_id`) as `total`
				FROM `orders`,`carts`,`products_categories` 
				WHERE `orders`.`session_id` = `carts`.`session_id` 
				AND `orders`.`status` = 'successful'
				AND `carts`.`product_id` = `products_categories`.`product_id`
				GROUP BY `carts`.`product_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		$this->db->where('id',$result['category_id']);
		$query = $this->db->get('categories');
		$row = $query->first_row('array');
		return $row['title'].' ('.$result['total'].' items ordered)';
	}
	function best_categories() {
		$sql = "SELECT DISTINCT `products_categories`.`category_id`
				FROM `orders`,`carts`,`products_categories` 
				WHERE `orders`.`session_id` = `carts`.`session_id` 
				AND `orders`.`status` = 'successful'
				AND `carts`.`product_id` = `products_categories`.`product_id`
				";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function best_product() {
		$sql = "SELECT `carts`.`product_id`,sum(`carts`.`quantity`) as `total` 
				FROM `orders`,`carts` 
				WHERE `orders`.`session_id` = `carts`.`session_id` and `orders`.`status` = 'successful'
				GROUP BY `carts`.`product_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['product_id']);
			$query = $this->db->get('products');
			$row = $query->first_row('array');
			return to_short($row['title'],33).' ('.$result['total'].')';
		}
		return 'N/A';
	}
	function best_products() {
		$sql = "SELECT `carts`.`product_id`,sum(`carts`.`quantity`) as `total` 
				FROM `orders`,`carts` 
				WHERE `orders`.`session_id` = `carts`.`session_id` and `orders`.`status` = 'successful'
				GROUP BY `carts`.`product_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function best_products_between_date($datefrom,$dateto) {
		$today = date('Y-m-d H:i:s',strtotime($dateto));
		$lastm = date('Y-m-d H:i:s',strtotime($datefrom));
		$sql = "SELECT `carts`.`product_id`,sum(`carts`.`quantity`) as `total` 
				FROM `orders`,`carts` 
				WHERE `orders`.`session_id` = `carts`.`session_id` and `orders`.`status` = 'successful'
				AND `orders`.`order_time` <= '$today'
				AND `orders`.`order_time` >= '$lastm'
				GROUP BY `carts`.`product_id` 
				ORDER BY `total` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function best_products_last_month() {
		$today = date('Y-m-d H:i:s');
		$lastm = date('Y-m-d H:i:s',strtotime('-30 days'));
		//echo $today."<br/>".$lastm;
		$sql = "SELECT `carts`.`product_id`,sum(`carts`.`quantity`) as `total` 
				FROM `orders`,`carts` 
				WHERE `orders`.`session_id` = `carts`.`session_id` and `orders`.`status` = 'successful'
				AND `orders`.`order_time` <= '$today'
				AND `orders`.`order_time` >= '$lastm'
				GROUP BY `carts`.`product_id` 
				ORDER BY `total` DESC";
		//echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
	}	
	function total_prod_per_day($prod_id,$date)
	{
		$sql = "SELECT sum( b.`price` ) AS `ttl`
				FROM `orders` a, `carts` b
				WHERE a.`session_id` = b.`session_id`
				AND b.`product_id` = '$prod_id'
				AND a.`status` = 'successful'
				AND a.order_time LIKE '$date%'";
		$query = $this->db->query($sql);
		$r = $query->result_array();
		if(count($r) >0 )
		{
			$query = $this->db->query($sql);
			$row = $query->first_row('array');
			return $row['ttl'];
		}
		else
		{
			return 0;
		}
	}
	function worst_product() {
		$sql = "SELECT DISTINCT `products`.`id`
				FROM `products` LEFT JOIN (`orders` , `carts`) 
				ON `products`.`id` = `carts`.`product_id`
				AND `carts`.`session_id` = `orders`.`session_id`
				AND `orders`.`status` = 'successful'
				ORDER BY `carts`.`quantity` ASC";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if ($result) {
			$this->db->where('id',$result['id']);
			$query = $this->db->get('products');
			$product = $query->first_row('array');
			
			$sql = "SELECT sum(`carts`.`quantity`) as `total` 
					FROM `carts`,`orders` 
					WHERE `carts`.`product_id` = ".$result['id']." 
					AND `carts`.`session_id` = `orders`.`session_id` 
					AND `orders`.`status` = 'successful'";
			$query = $this->db->query($sql);
			$row = $query->first_row('array');
			$times = 0;
			if ($row['total'] != NULL) { $times = $row['total']; }
			$s = 'time';
			if ($times > 1) { $s .= 's'; }
			return to_short($product['title'],33).' ('.$times.' '.$s.')';
		}
		return 'N/A';
	}
	function worst_products() {
		$sql = "SELECT DISTINCT `products`.`id`
				FROM `products` LEFT JOIN (`orders` , `carts`) 
				ON `products`.`id` = `carts`.`product_id`
				AND `carts`.`session_id` = `orders`.`session_id`
				AND `orders`.`status` = 'successful'
				ORDER BY `carts`.`quantity` ASC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	/* Email Module */
	function get_email($field,$value) {
		$this->db->where($field,$value);
		$query = $this->db->get('emails');
		return  $query->first_row('array');
	}
	function update_email($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('emails',$data);
	}
	function add_email($data) {
		$this->db->insert('emails',$data);
		return $this->db->insert_id();
	}
	function delete_emails($field,$value) {
		$this->db->where($field,$value);
		$this->db->delete('emails');
	}
	
	/* Tax Module */
	function add_tax($data) {
		$this->db->insert('taxes',$data);
		return $this->db->insert_id();
	}
	function add_tax_country($data) {
		$this->db->insert('taxes_countries',$data);
		return $this->db->insert_id();
	}	
	function country_has_tax($country_id) {
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('taxes_countries');
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}
	function country_tax($country_id,$tax_id) {
		$this->db->where('country_id',$country_id);
		$this->db->where('tax_id',$tax_id);
		$query = $this->db->get('taxes_countries');
		if ($query->num_rows() > 0) {
			return true;
		}
		return false;
	}	
	function get_taxes() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('taxes');
		return $query->result_array();
	}
	function get_tax($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('taxes');
		return $query->first_row('array');
	}
	function get_tax_country($country_id) {
		$sql = "SELECT `taxes`.* FROM `taxes`,`taxes_countries`
				WHERE `taxes`.`id` = `taxes_countries`.`tax_id`
				AND `taxes`.`actived` = 1
				AND `taxes_countries`.`country_id` = $country_id";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	function delete_tax($id) {
		$this->db->where('id',$id);
		$this->db->delete('taxes');
	}
	function remove_tax_countries($tax_id) {
		$this->db->where('tax_id',$tax_id);
		$this->db->delete('taxes_countries');
	}
	function update_tax($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('taxes',$data);
	}
	function active_tax($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('taxes');
		$tax = $query->first_row('array');
		$this->db->where('id',$id);
		if ($tax['actived'] == 0) {			
			$this->db->update('taxes',array('actived' => 1));
		} else if ($tax['actived'] == 1) {
			$this->db->update('taxes',array('actived' => 0));
		}
	}
	
	
	function update_currency($data) {
		$this->db->where('id',1);
		return $this->db->update('currency',$data);
	}
	
	function get_currency() {
		$this->db->where('id',1);
		$query = $this->db->get('currency');
		return $query->first_row('array');
	}
	
	function search_story($keyword,$status)
	{
		$sql = "select * from story where status = $status and (title like '%$keyword%' or category like '%$keyword%')";
		// $this->db->like('title', $keyword, 'both'); 
		// $this->db->or_like('category', $keyword, 'both'); 
		// $this->db->where('status',$status);
		// $this->db->order_by('id','asc');
		// $query = $this->db->get('story');
		// return $query->result_array();
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	
	function get_all_story()
	{
		$this->db->order_by('created','desc');
		$this->db->order_by('id','desc');
		$query = $this->db->get('story');
		return $query->result_array();	
	}

	function get_story() {
		$this->db->order_by('created','desc');
		$this->db->order_by('id','desc');
		$query = $this->db->get('story');
		return $query->result_array();
	}
	function get_story_id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('story');
		return $query->first_row('array');
	}
	function get_active_home_stories()
	{
		$this->db->order_by('home_order','asc');
		$this->db->where('status',1);
		$this->db->where('home',1);
		$query = $this->db->get('story');
		return $query->result_array();	
	}
	function get_active_stories()
	{
		$this->db->order_by('created','desc');
		$this->db->order_by('id','desc');
		$this->db->where('status',1);
		$query = $this->db->get('story');
		return $query->result_array();	
	}
	function active_story($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('story');
		$coupon = $query->first_row('array');
		$this->db->where('id',$id);
		if ($coupon['status'] == 0) {			
			$this->db->update('story',array('status' => 1));
		} else if ($coupon['status'] == 1) {
			$this->db->update('story',array('status' => 0));
		}
	}
	function home_story($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('story');
		$coupon = $query->first_row('array');
		
		if ($coupon['home'] == 0) {
			//get order
			$this->db->where('id',1);
			$query = $this->db->get('system_save');
			$ss = $query->first_row('array');
			//save story
			$data['home'] = 1;
			$data['home_order'] = $ss['order_home']; 
			$this->db->where('id',$id);
			$this->db->update('story',$data);
			//update_order
			$ndata['order_home'] = $ss['order_home'] + 1;
			$this->db->where('id',1);
			$this->db->update('system_save',$ndata);
		} else if ($coupon['home'] == 1) {
			$this->db->where('id',$id);
			$this->db->update('story',array('home' => 0));
		}
	}
	function update_story($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('story',$data);
	}
	function delete_story($id) {
		$this->db->where('id',$id);
		$this->db->delete('story');
	}
	function delete_story_product($id)
	{
		$this->db->where('story_id',$id);
		$this->db->delete('story_products');
	}
	function add_story($data) {
		$this->db->insert('story',$data);
		return $this->db->insert_id();
	}
	function add_story_product($data)
	{
		$this->db->insert('story_products',$data);
		return $this->db->insert_id();
	}
	function get_all_products($id)
	{
		$this->db->where('story_id',$id);
		$query = $this->db->get('story_products');
		return $query->result_array();
	}
	function get_all_products_promotion($id)
	{
		$this->db->where('promotion_id',$id);
		$query = $this->db->get('promotions_product');
		return $query->result_array();
	}
	function add_story_detail($data){
		$this->db->insert('story_image',$data);
		return $this->db->insert_id();
	}
	function update_story_detail($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('story_image',$data);
	}
	function check_image($id,$type)
	{
		$this->db->where('story_id',$id);
		$this->db->where('type',$type);
		$query = $this->db->get('story_image');
		return $query->first_row('array');
	}
	
	function get_all_promotions()
	{
		$this->db->order_by('id','asc');
		$query = $this->db->get('promotions');
		return $query->result_array();	
	}
	function get_active_home_promotions()
	{
		$this->db->order_by('promotion_order','asc');
		$this->db->where('status',1);
		$this->db->where('home',1);
		$query = $this->db->get('promotions');
		return $query->result_array();	
	}
	function get_active_promotions()
	{
		$this->db->order_by('id','asc');
		$this->db->where('status',1);
		$query = $this->db->get('promotions');
		return $query->result_array();	
	}
	function get_promotions() {
		$this->db->order_by('id','asc');
		$query = $this->db->get('promotions');
		return $query->result_array();
	}
	function get_promotions_id($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('promotions');
		return $query->first_row('array');
	}
	function active_promotions($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('promotions');
		$coupon = $query->first_row('array');
		$this->db->where('id',$id);
		if ($coupon['status'] == 0) {			
			$this->db->update('promotions',array('status' => 1));
		} else if ($coupon['status'] == 1) {
			$this->db->update('promotions',array('status' => 0));
		}
	}
	function home_promotions($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('promotions');
		$coupon = $query->first_row('array');
		
		if ($coupon['home'] == 0) {
			//get order
			$this->db->where('id',1);
			$query = $this->db->get('system_save');
			$ss = $query->first_row('array');
			//save story
			$data['home'] = 1;
			$data['promotion_order'] = $ss['order_promotion']; 
			$this->db->where('id',$id);
			$this->db->update('promotions',$data);
			//update_order
			$ndata['order_promotion'] = $ss['order_promotion'] + 1;
			$this->db->where('id',1);
			$this->db->update('system_save',$ndata);
		} else if ($coupon['home'] == 1) {
			$this->db->where('id',$id);
			$this->db->update('promotions',array('home' => 0));
		}
		
		
		// $this->db->where('id',$id);
		// $query = $this->db->get('promotions');
		// $coupon = $query->first_row('array');
		// $this->db->where('id',$id);
		// if ($coupon['home'] == 0) {			
			// $this->db->update('promotions',array('home' => 1));
		// } else if ($coupon['home'] == 1) {
			// $this->db->update('promotions',array('home' => 0));
		// }
	}
	function update_promotions($id,$data) {
		$this->db->where('id',$id);
		return $this->db->update('promotions',$data);
	}
	function delete_promotions($id) {
		$this->db->where('id',$id);
		$this->db->delete('promotions');
	}
	function add_promotions($data) {
		$this->db->insert('promotions',$data);
		return $this->db->insert_id();
	}
	function add_promotions_detail($data){
		$this->db->insert('promotions_image',$data);
		return $this->db->insert_id();
	}
	function update_promotions_detail($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('promotions_image',$data);
	}
	function check_image_promotions($id,$type)
	{
		$this->db->where('promo_id',$id);		
		$this->db->where('type',$type);		
		$this->db->order_by('id','desc');		
		$query = $this->db->get('promotions_image');
		return $query->first_row('array');
	}
	
	function delete_promotion_product($id)
	{
		$this->db->where('promotion_id',$id);
		$this->db->delete('promotions_product');
	}
	function add_promotion_product($data)
	{
		$this->db->insert('promotions_product',$data);
		return $this->db->insert_id();
	}
	
	
	
	
	
	
	
	
	function update_order_detail($data) {
		$this->db->where('id',1);
		return $this->db->update('order_detail',$data);
	}
	
	function get_order_detail() {
		$this->db->where('id',1);
		$query = $this->db->get('order_detail');
		return $query->first_row('array');
	}
	
	function get_banner($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		return $query->first_row('array');
	}
	
	function update_banner($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('banners',$data);
	}
	/*
	function get_banners() {
		$query = $this->db->get('banners');
		return $query->result_array();
	}
	function get_banner($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		return $query->first_row('array');
	}
	function get_active_banners()
	{
		$this->db->where('actived','1');
		$query = $this->db->get('banners');
		
		return $query->result_array();
	}
	function add_banner($data) {
		$this->db->insert('banners',$data);
		return $this->db->insert_id();	
	}
	function active_banner($id) {
		$this->db->where('id',$id);
		$query = $this->db->get('banners');
		$banner = $query->first_row('array');
		$this->db->where('id',$id);
		if ($banner['actived'] == 0) {			
			$this->db->update('banners',array('actived' => 1));
		} else if ($banner['actived'] == 1) {
			$this->db->update('banners',array('actived' => 0));
		}
	}
	function update_banner($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('banners',$data);
	}
	function delete_banner($id) {
		$this->db->where('id',$id);
		$this->db->delete('banners');
	}
	function min_lru() {
		$sql = "SELECT min(`lru`) as `min` FROM `banners`";
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		$lru = $result['min'];
		if ($lru != NULL) { return $lru; }
		return 0;
	}
	function get_random_banner() {
		$sql = "SELECT * FROM `banners` WHERE `actived` = 1 ORDER BY RAND()";
		$query = $this->db->query($sql);
		return $query->first_row('array');
	}
	function update_lru($banner_id) {
		$this->db->where('id',$banner_id);
		$query = $this->db->get('banners');
		$banner = $query->first_row('array');
		$lru = $banner['lru'] + 1;
		$this->db->where('id',$banner_id);
		$this->db->update('banners',array('lru' => $lru));		
	}
	*/
	function add_everyday_income($data) {
		$this->db->insert('everyday_income',$data);
	}

	function get_ealiest_income()
	{
		$this->db->order_by('date');
		$query = $this->db->get('everyday_income');
		$data = $query->first_row('array');
		
		return $data['date'];
	}
	
	function get_all_income()
	{
		$this->db->order_by('date');
		$query = $this->db->get('everyday_income');
		return $query->result_array();
	}
	
	function sales_date_per_cat($date,$cat_id) {

		$sql = "SELECT sum(`total`) as `sales` FROM `orders`, `carts` 
				WHERE (`status` = 'successful' or status = '30 days trade')
				And `orders`.`session_id` = `carts`.`session_id`
				AND date_format(`order_time`, '%Y-%m-%d') = '$date'
				and `carts`.`product_id` in (select `product_id` from `products_categories` where `category_id` = $cat_id)";
		
		$query = $this->db->query($sql);
		$result = $query->first_row('array');
		if($result['sales'] != NULL) {
			return $result['sales'];
		}
		
		return '0.00';
	}
	function get_webstat()
	{
		$this->db->where('id',1);
		$query = $this->db->get('webstat');
		return $query->first_row('array');
		
		
	}
	function update_webstat($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('webstat',$data);
	}
	function add_htmlpage($data)
	{
		$this->db->insert('story_page',$data);
	}
	function get_storypage($story_id)
	{
		$this->db->order_by('order','asc');		
		$this->db->where('story_id',$story_id);
		$query = $this->db->get('story_page');
		return $query->result_array();	
	}
	function get_detailhtml($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('story_page');
		return $query->first_row('array');
	}
	function update_html($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('story_page',$data);
	}
	function delete_html($id) {
		$this->db->where('id',$id);
		$this->db->delete('story_page');
	}
}