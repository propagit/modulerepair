<script>
function export_csv(type) {
	if (confirm('This will export the order list to a csv file. Do you want to continue?')) {
		window.location = '<?=base_url()?>admin/order/ajax/exportorder';
	}
}
function deleteorder(id) {
	if (confirm('Are you sure you want to delete this order?')) {
		window.location = '<?=base_url()?>admin/order/deleteorder/' + id;
	}
}

jQuery(function() {
	jQuery('.view-order').tooltip({
		showURL: false
	});
	
	jQuery('.delete-order').tooltip({
		showURL: false
	});
	
});


function change_status(id)
{	
	var status = $('#status'+id).val();

	jQuery.ajax({
		url: '<?=base_url()?>admin/order/change_order_status',
		type: 'POST',
		data: ({id:id,status:status}),
		dataType: "html",
		success: function(html) {
			if(html != '')
			{
				//alert(html);
				if(status == 'shipped')
				{
					$('#any_message').html('Error - The order tracking URL is blank');
					$('#anyModal').modal('show');
				}
				//location.reload();
				$('#status'+id).val(html);
			}
			else
			{
				if(status == 'shipped')
				{
					$('#any_message').html('An automated email has been sent to this customer with ship tracking information');
					$('#anyModal').modal('show');
				}
			}
		}
	})
}
function change_status_cust(id)
{
	if(jQuery('#status_cust'+id).val()==2)
	{
		if (confirm('Are you sure you want to finish this order?')) {
			jQuery.ajax({
				url: '<?=base_url()?>admin/order/finish_order',
				type: 'POST',
				data: ({id:id}),
				dataType: "html",
				success: function(html) {
					location.reload();
				}
			})
		}
	}
}
function process_all()
{
	if (confirm("Are you sure you want to process all customer's order?")) {
		jQuery.ajax({
				url: '<?=base_url()?>admin/order/ajax/finish_all_order',
				type: 'POST',
				dataType: "html",
				success: function(html) {
					location.reload();
				}
		})
	}
}
</script>

<div class="row">
	<div class="col-md-12">
		<div class="title-page">MANAGE ORDERS</div>
		<div class="subtitle-page">Search Products</div>
		<form method="post" action="<?=base_url()?>admin/order/search">
			<div class="form-search-label">Customer Name</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="customer_name" value=""/>
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">Customer ID</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="customer_id" value=""/>
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">Order ID</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="order_id" value=""/>
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">From Date</div>
			<div class="form-search-input">
				<input class="form-control input-text" type="text" id="from_date" name="from_date" readonly style="cursor: pointer; background: #fff"></input>
				<script type="text/javascript">
				  jQuery(function() {
				    jQuery('#from_date').datepicker({
				    	 dateFormat: "dd-mm-yy",
						 todayBtn: "linked"
				    });
				  });
				</script>				
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">To Date</div>
			<div class="form-search-input">
				<input class="form-control input-text" type="text" id="to_date" name="to_date" readonly style="cursor: pointer; background: #fff"></input>
				<script type="text/javascript">
				  jQuery(function() {
				    jQuery('#to_date').datepicker({
				    	 dateFormat: "dd-mm-yy",
						 todayBtn: "linked"
				    });
				  });
				</script>								
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">By Order Status</div>
			<div class="form-search-input">
				<select class="selectpicker" id="stat" name="by_status">
					<option value="All" <? if($this->session->userdata('by_status')=='All'){echo 'selected="selected"';}?>>All</option>					
					<option value="open" <? if($this->session->userdata('by_status')=='success'){echo 'selected="selected"';}?> >Success</option>
                    <option value="closed" <? if($this->session->userdata('by_status')=='fail'){echo 'selected="selected"';}?>>Fail</option>
				</select>
				
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">By Keyword</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="by_keyword" value=""/>
				<div class="form-search-gap"></div>
				<button class="btn btn-info" onclick="">Search</button>
			</div>
			<div class="form-search-gap"></div>
		</form>
		<div id="top-table">
			<div style="float: left">
				<div id="top-table-title">Order List</div>
				
			</div>
			
			<!-- <div id="top-table-button-group">
				<button class="btn btn-info" onclick="export_csv();">Export To CSV</button>
			</div>
            <div id="top-table-button-group" style="margin-right:15px;">
				<button class="btn btn-info" onclick="process_all();">Process All Orders</button>
			</div> -->
			<div style="clear: both">
			</div>
            
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width: 15%"><span class="order-name-class">ORDER ID</span></th>
					<th style="width: 30%"><span class="order-name-class">CUSTOMER NAME</span></th>
					<th style="width: 20%"><span class="order-name-class">ORDER DATE</span></th>
					<th style="width: 10%"><span class="order-name-class">TOTAL</span></th>
					<th style="width: 10%"><span class="order-name-class">STATUS</span></th>
					<th style="width: 15%; text-align: center" colspan="2"><span class="order-name-class">FUNCTIONS</span></th>
				</tr>
			</thead>
                       
			<tbody>
				<?php
					if(isset($customers)&& count($customers) > 0)
					{
						if($this->session->userdata('by_status')!='processed'){
							$status_cart=-1;							
							foreach($customers as $custs) { 							
								if($this->session->userdata('customer_id')==$custs['id'] || $this->session->userdata('customer_id')==''){
									$cust_ord = $this->order_model->upcoming_orders($custs['id']);																						
									foreach($cust_ord as $co)
									{
										$status_cart = $co['lock'];
										
										$date_ord = $co['created'];
									}
									$tot_ord = count($cust_ord);
									if($status_cart==0){$status_cart_text='open';}
									if($status_cart==1){$status_cart_text='closed';}
									if($tot_ord > 0 && ($this->session->userdata('by_status')==$status_cart_text || $this->session->userdata('by_status')=='All' || $this->session->userdata('by_status')=='' ))
									{									
										?>																		
										<tr>
											<td>-</td>
											<td>
												<span class="order-name-class"><?=$custs['firstname'].' '.$custs['lastname']?> </span> 
											</td>
											<td>-</td>
											<td>-</td>
											
											<td>
												<select class="selectpicker" id="status_cust<?=$custs['id']?>" onchange="change_status_cust(<?=$custs['id']?>);">
													<option value="0" <? if($status_cart==0){echo "selected = 'selected'";}?>>Open</option>
													<option value="1" <? if($status_cart==1){echo "selected = 'selected'";}?>>Closed</option>
													<option value="2">Processed</option>                                
												</select>
											</td>
											<td style="text-align: center" colspan="2">
												<button class="btn btn-info" onclick="window.location='http://propatest.com/fruitopia/store/admin_login/<?=$custs['id']?>' ">Login as Customer</button>
											</td>										
										</tr>
								<? } 
								}
							}
						}
					}
					
					if(count($orders)==0){ $curttl=0; ?>
                    
                            <tr><td colspan="6"> Sorry, there are no results </td></tr>
                    
                    <? }else{
					
					$curttl = 0; 
					foreach($orders as $order) { ?>
					<tr>
						<td><span class="order-name-class"><?=$order['id']?></span></td>
						<td>
							<?php
							if($this->session->userdata('by_typecustomer')==4){
								$customer = $this->customer_model->identify($order['customer_id']);
								?>
								<a href="<?=base_url()?>admin/customer/list_all/edit/<?=$order['customer_id']?>"><span class="order-name-class"><?=$customer['company']?></span></a>
								<?php
							}
							else
							{
								$cust = $this->customer_model->identify($order['customer_id']);								
							?>
							<a href="<?=base_url()?>admin/customer/list_all/edit/<?=$cust['id']?>"><span class="order-name-class"><?=$cust['firstname'].' '.$cust['lastname']?> (<?=$order['customer_id']?>) </span></a>
							<?php
							}
							?>
						</td>
						<td><span class="order-name-class"><?=date('d-m-Y',strtotime($order['order_time']))?>&nbsp;&nbsp;<span style="font-size:10px;"><?=date('H:i:s',strtotime($order['order_time']))?></span></span></td>
						<td><span class="order-name-class">$<?=number_format($order['total'],2,'.',',')?></span></td>
						<td>
							<select class="selectpicker" id="status<?=$order['id']?>" onchange="change_status(<?=$order['id']?>);">								
								<option value="processed" <?php if($order['order_status'] == 'processed'){echo "selected='selected'";}?>>Processed</option>									
							</select>
						</td>
						<td style="text-align: center">
							<span class="view-order" data-toggle="tooltip" title="View Order" style="cursor: pointer" onclick="window.location='<?=base_url().'admin/order/view_order/'.$order['id']?>'">
	    						<i class="fa fa-search blue-icon"></i>
	    					</span>
						</td>
						<!--
                        <td style="text-align: center">
							
                            <span class="delete-order" data-toggle="tooltip" title="Delete Order" style="cursor: pointer" onclick="deleteorder(<?=$order['id']?>);">
	    						<i class="fa fa-trash-o blue-icon"></i>
	    					</span>
                           
                            &nbsp;&nbsp;
						</td>
                        -->
                        <td style="text-align: center">
							<span class="delete-order" data-toggle="tooltip" title="Print Order" style="cursor: pointer" onclick="printinvoice(<?=$order['id']?>);">
	    						<i class="fa fa-print blue-icon"></i>
	    					</span>
						</td>
					</tr>
				<?php
				if($order['order_status']=='completed' || $order['order_status']=='processed'){	
				 $curttl += $order['total'];
				}
				} ?>
			</tbody>
            <? } ?>
		</table>
		<script>
			jQuery('#cur_ttl').text('$<?=number_format($curttl,2,'.',',')?>');
		</script>
        
        <div class="hprint table1" id="print_area" style="display:none;">
        </div>
        
	</div>
</div>


<div id="anyModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Message</h3>
</div>
<div class="modal-body">
    <p id="any_message"></p>
</div>
<div class="modal-footer">
<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>

</div>
</div>
<script>jQuery(".selectpicker").selectpicker();</script>

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/js/jquery.jqprint.0.3.js"></script>
<script>

function print_results() {
	jQuery('.table1').css({"font-size":"9px"});
	//j('#print_area').css({"background":"#fff"});
	jQuery('#print_area').css({"display":"block"});	
	jQuery('#print_area').jqprint();
	jQuery('#print_area').css({"display":"none"});
	jQuery('.table1').css({"font-size":"12px"});
}
function printinvoice(id)
{
	jQuery.ajax({
		url: '<?=base_url()?>admin/order/ajax/print_invoice',
		type: 'POST',
		data: ({order_id:id}),
		dataType: "html",
		success: function(html) {
			jQuery('#print_area').html(html);
			print_results();
		}
	})
}
</script>