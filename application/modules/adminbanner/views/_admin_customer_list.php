<script>

jQuery(function() {
	jQuery('.edit-cust').tooltip({
		showURL: false
	});
	
});

var choose = 0;

function export_csv() {
	if (confirm('This will export the customers list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/customer/ajax/export';
	}
}
function export_csv_myob() {
	if (confirm('This will export the customers list to a csv file. Do you want to continue?')) {
		//var type=document.customerform.type.value;
		window.location = '<?=base_url()?>admin/customer/export_cust_for_MYOB';
	}
}
function deletesubscribe(id) {
	if (confirm('You are about to delete this subscribe from the system? Are you sure you want to do this?')) {
		window.location = '<?=base_url()?>admin/customer/deletesubscribe/' + id;
	}
}
function delete_customer(id)
{
	choose = id;
	//alert(id);
	$('#deleteModal').modal('show');
}
function deletecustomer(id)
{
	$('#deleteModal').modal('hide');
	//alert(id);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/customer/delete/'+id,
		type: 'POST',	
		dataType: "html",
		success: function(html) {
			jQuery('#user'+id).fadeOut('slow');
			jQuery('#any_message').html("This customer has been successfully deleted");
			$('#anyModal').modal('show');
			
		}
	})
}
function set_sort(input)
{
	/*
	 * input = 0 = none
	 * input = 1 = by customer name
	 * input = 2 = by customer email
	 */
	jQuery.ajax({
		url: '<?=base_url()?>admin/customer/set_sort_cust/'+input,
		type: 'POST',	
		dataType: "html",
		success: function(html) {
			
			//j//Query('#user'+id).fadeOut('slow');
			//jQuery('#any_message').html("This customer has been successfully deleted");
			//$('#anyModal').modal('show');
			location.reload(); 
		}
	})
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="title-page">MANAGE CUSTOMERS</div>
		<div class="subtitle-page">Search Customers</div>
		<form name="customerform" method="post" action="<?=base_url()?>admin/customer/search">
			<div class="form-search-label">Keyword</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="keyword" value=""/>
			</div>
            
			<div class="form-search-gap"></div>
            
			<!--<div class="form-search-label">Type</div>-->
            <div class="form-search-label"></div>
			<div class="form-search-input">
				<select class="selectpicker" id="cat" name="type" style="display:none;">
						<option <? if($this->session->userdata('type')==0){echo "selected=selected";}?> value="0">All</option>
                        <!--						
                        <option <? if($this->session->userdata('type')==1){echo "selected=selected";}?> value="1">Retailer</option>
						<option <? if($this->session->userdata('type')==5){echo "selected=selected";}?> value="5">Subscriber</option>                        
                        <option <? if($this->session->userdata('type')==2){echo "selected=selected";}?> value="2">Trade</option>
						<option <? if($this->session->userdata('type')==5){echo "selected=selected";}?> value="5">Subscribers</option>                        
                        -->
				</select>
	            <script>//jQuery(".selectpicker").selectpicker();</script>
	            <div class="form-search-gap"></div>
	            <button class="btn btn-info" onclick="">Search</button>
			</div>
		</form>
		<div style="clear: both"></div>
		<div id="top-table">
			<div style="float: left">
				<div id="top-table-title">Customer List</div>
				
			</div>
			
			<!-- <div id="top-table-button-group">
				<button class="btn btn-info" onclick="export_csv();">Export To CSV</button>
			</div> -->
            
            <!-- <div id="top-table-button-group" style="margin-right:25px;">
				<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/customer/add/'">Add Customer</button>
			</div> -->
			<div style="clear: both">
			</div>
		</div>
		
		<?php
		if($type==5)
		{
			
		?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width: 80%">Email</th>
					<th style="width: 20%; text-align: center">Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($subscribers as $s) 
					{
					?>
					<tr id="user<?=$s['id']?>">
						<td><?=$s['email']?></td>
						<td style="text-align: center">
							<span style="cursor: pointer" onclick="deletesubscribe(<?=$s['id']?>);">
		    					<i style="color: #c70520" class="fa fa-trash-o blue-icon"></i>
	    					</span>
						</td>
					</tr>
					<?php
					}
				?>
			</tbody>
		</table>
		<?php
		}
		elseif($this->session->userdata('type')==2)
		{
		?>
		<table class="table table-hover">
			<thead>
				<tr >
					<th style="width: 40%">Customer Name <i class="fa fa-sort-alpha-asc"></i></th>
					<th style="width: 20%">Email</th>
					<th style="width: 10%">Orders</th>
					<th style="width: 10%; text-align: center;">Status</th>
					<th style="width: 10%; text-align: center;">Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($users as $user) 
					{
						$customer = $this->customer_model->identify($user['customer_id']);
					?>
					<tr id="user<?=$user['id']?>">
						<td><?=$customer['firstname'].' '.$customer['lastname']?></td>
						<td><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></td>
						<td>
							<?=$this->customer_model->total_orders($customer['id'],'')?>
							&nbsp;
							(<span style="color: green"><?=$this->customer_model->total_orders($customer['id'],'successful')?></span>/<span style="color: red"><?=$this->customer_model->total_orders($customer['id'],'failed')?></span>)
						</td>
						<td style="text-align: center;">
							<?php if($user['activated']) { ?>
	    						<span ><i style="color: #00c717" class="fa fa-check-circle"></i></span>
	    					<?php 
							}
	    					else
	    					{
	    					?>
	    						<span ><i style="color: #d6d6d6" class="fa fa-check-circle"></i></span>
	    					<?php	
	    					}
	    					?>
						</td>
						<td style="text-align: center;">
							<span class="edit-cust" data-toggle="tooltip" title="Edit Customer" style="cursor: pointer" onclick="edit_cust(<?=$user['id']?>,2)">
	    						<i class="fa fa-edit blue-icon"></i>
	    					</span>
						</td>
					</tr>
					<?php
					} 
				?>
			</tbody>
		</table>
		<?php
		}
		else 
		{
		?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width: 50%">CUSTOMER NAME <i onclick="set_sort(1);" class="fa fa-sort-alpha-asc sort-icon"></i></th>
					<th style="width: 20%">EMAIL <i onclick="set_sort(2);" class="fa fa-sort-alpha-asc sort-icon"></i></th>
					<th style="width: 10%">ORDERS</th>
					<th style="width: 10%; text-align: center;">EDIT</th>
                    <th style="width: 10%; text-align: center;">DELETE</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($users as $user) 
					{
						$customer = $this->customer_model->identify($user['customer_id']);
					?>
					<tr id="user<?=$user['id']?>">
						<td><?=$customer['firstname'].' '.$customer['lastname']?></td>
						<td><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></td>
						<td>
							<?=$this->customer_model->total_orders($customer['id'],'')?>
							&nbsp;
							(<span style="color: green"><?=$this->customer_model->total_orders($customer['id'],'successful')?></span>/<span style="color: red"><?=$this->customer_model->total_orders($customer['id'],'failed')?></span>)
						</td>
						<!-- <td style="text-align: center;">
							<?php if($user['activated']) { ?>
	    						<span ><i style="color: #00c717" class="icon-ok-circle icon-2x"></i></span>
	    					<?php 
							}
	    					else
	    					{
	    					?>
	    						<span ><i style="color: #d6d6d6" class="icon-ok-circle icon-2x"></i></span>
	    					<?php	
	    					}
	    					?>
						</td> -->
						<td style="text-align: center;">
							<span class="edit-cust" data-toggle="tooltip" title="Edit Customer" style="cursor: pointer" onclick="edit_cust(<?=$user['id']?>,<?=$user['level']?>)">
	    						<i class="fa fa-edit blue-icon"></i>
	    					</span>
						</td>
                        <td style="text-align: center;">
		    				<div class="all_tt" data-toggle="tooltip" title="Delete Customer" style="cursor: pointer; text-align: center" onclick="delete_customer(<?=$user['id']?>);">
		    					<i class="fa fa-trash-o blue-icon"></i>
		    				</div>
		    			</td>
					</tr>
                    
					<?php
					} 
				?>
			</tbody>
		</table>
		<?
		}
		?>
	</div>
</div>






<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Delete Customer</h3>
</div>
<div class="modal-body">
    <p>Are you sure to delete this customer?</p>
</div>
<div class="modal-footer">
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="deletecustomer(choose)">Delete</button>
</div>
</div>

</div>
</div>
<script>
function edit_cust(id,type)
{
	//alert(id);
	if(type == 1)
	{
		window.location = "<?=base_url()?>admin/customer/detail/"+id;
	}
	else
	{
		window.location = "<?=base_url()?>admin/customer/detail/"+id;
	}
}
</script>