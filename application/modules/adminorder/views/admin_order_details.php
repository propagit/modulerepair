

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/js/jquery.jqprint.0.3.js"></script>
<script>

function print_results() {
	jQuery('.table1').css({"font-size":"9px"});
	//j('#print_area').css({"background":"#fff"});
	jQuery('#print_area').css({"display":"block"});	
	jQuery('#print_area').jqprint();
	//j('#print_area').css({"display":"none"});
	jQuery('.table1').css({"font-size":"12px"});
}

</script>

<style>
.table1
{
	font-size:12px;
}
.order-label

{

	font-weight: 700;

}

</style>

<div class="row">
	<div class="col-md-12">
		<div class="title-page">VIEW ORDER DETAILS</div>		        
        <button style="margin-right:20px;" onclick="print_results();" type="button" class="btn btn-info">Print Invoice</button>        
        <div class="subtitle-page">Order Details</div>

		
		<div>
			<div class="form-common-label">Order Number</div>
			<div class="form-common-input">
				<?=$order['id']?> / <?=date('H:i:s',strtotime($order['order_time']))?> on the <?=date('jS, F Y',strtotime($order['order_time']))?>
			</div>
		</div>
		
        <div class="form-common-gap">&nbsp;</div>
        <div>
			<div class="form-common-label">Customer Name</div>
			<div class="form-common-input">
				<?
				$cust = $this->customer_model->identify($order['customer_id']);
				?>
				<a href="<?=base_url()?>admin/customer/list_all/edit/<?=$cust['id'] ?>"><?=$cust['firstname'].' '.$cust['lastname']?> (<?=$order['customer_id']?>)</a>
			</div>
		</div>
		
		<!--
        <div class="form-common-gap">&nbsp;</div>
		<div>
			<div class="form-common-label">Order Status</div>
			<div class="form-common-input">
				<?=$order['order_status']?>
			</div>
		</div>
        -->
		<div class="form-common-gap">&nbsp;</div>
		<div>
			<div class="form-common-label">Payment Method</div>
			<div class="form-common-input">
				30 Days Invoice
			</div>
		</div>
		<div class="form-common-gap">&nbsp;</div>
		<!--
        <div>
			<div class="form-common-label">Purchased Items</div>
			<div class="form-common-input">
				<?php
				foreach($cart as $cr)
				{
					$pro = $this->product_model->identify($cr['product_id']);
					?>
					<div class="order-cart-left"><?=$cr['quantity']?> x <?=$pro['title']?></div>
					<div class="order-cart-right">$<?=$cr['price']?></div>
					<div class="form-common-gap"></div>
					<?
				}
				?>
				<hr class="order-cart-hr"/>
				<div class="order-cart-left">Subtotal</div>
				<div class="order-cart-right">$<?=$order['subtotal']?></div>
				<div class="form-common-gap"></div>
				<div class="order-cart-left">Discount</div>
				<div class="order-cart-right">- $<?=$order['discount']?></div>
				<div class="form-common-gap"></div>
				<div class="order-cart-left">Shipping Cost</div>
				<div class="order-cart-right">$<?=$order['shipping_cost']?></div>
				<div class="form-common-gap"></div>
				<div class="order-cart-left">Tax</div>
				<div class="order-cart-right">$<?=$order['tax']?></div>
				<div class="form-common-gap"></div>
				<hr class="order-cart-hr"/>
				<div class="order-cart-left">Total</div>
				<div class="order-cart-right">$<?=$order['total']?></div>
				<div class="form-common-gap"></div>
			</div>
		</div>
        -->

		<hr />
		
		<div class="hprint table1" id="print_area">
		<table class="table1" width="1000">
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
                        <?=$cust['firstname'].' '.$cust['lastname']?><br />
                        <?=$cust['address'].' '.$cust['address2']?><br />
                      	<?=$cust['suburb']?><br />
                        <?=$this->system_model->get_state($cust['state'])?> <?=$cust['postcode']?><br />
                    </td>
                    <td>&nbsp;</td>
                    <td align="right" valign="top">
                    	<table width="100%" class="table1">
                        	<tr style="border:1px solid #999;">
                            	<td>INVOICE #:</td>
                                <td>&nbsp;</td>
                                <td align="right"><?=$order['id']?></td>
                            </tr>

                            <tr style="border:1px solid #999;">
                            	<td>DATE :</td>
                                <td>&nbsp;</td>
                                <td align="right"><?=date('d/M/Y',strtotime($order['order_time']))?></td>
                            </tr>
                            
                            <tr style="border:1px solid #999;">
                            	<td>AMOUNT :</td>
                                <td>&nbsp;</td>
                                <td align="right">$<?=$order['total']?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>

                <tr>
                	<td colspan="3">
                    <table width="100%" class="table1">
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
                            	+ <?=$price_guide['price_guide_1']?>%
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	+ <?=$price_guide['price_guide_2']?>%
                            </td>
                        </tr>
                        <?
                        foreach($cart as $cr)
						{
							$pro = $this->product_model->identify($cr['product_id']);
						?>
                        <tr>
                        	<td style="border:1px solid #000;"> 
                            	<?=strtoupper($pro['title'].' '.$pro['short_desc'])?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<?=$cr['quantity']?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
								<?
                                	
									echo '$'.sprintf("%01.2f", $cr['price']);
								?>
                            </td>
                            <td style="border:1px solid #000;" align="center">
                            	
                            		<?
									if($cr['updown'] == 'up')
									{
										?>
										<i class="fa fa-long-arrow-up"></i>
										<?
									}
									if($cr['updown'] == 'down')
									{
										?>
										<i class="fa fa-long-arrow-down"></i>
										<?
									}
									if($cr['updown'] == 'same')
									{
										?>
										-
										<?
									}
                            		?>
									
								
                            </td >
                            <td style="border:1px solid #000;" align="right">
                            	<?=strtoupper($pro['unit_of_sale'])?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<?=strtoupper($pro['pack'])?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<? 
									$price_unit = round($cr['price']/$pro['pack'],2);
									echo '$'.sprintf("%01.2f", $price_unit);
								?>
                                
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<? 
									$price_unit = round($cr['price']*$cr['quantity'],2);
									echo '$'.sprintf("%01.2f", $price_unit);
								?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<?
                            		$price_unit = round($cr['price']/$pro['pack'],2);
									$price_guide1 = $price_unit + round($price_unit/100*$price_guide['price_guide_1'],2);
									echo '$'.sprintf("%01.2f", $price_guide1).' / UNIT';
                            	?>
                            </td>
                            <td style="border:1px solid #000;" align="right">
                            	<?
                            		$price_unit = round($cr['price']/$pro['pack'],2);
									$price_guide2 = $price_unit + round($price_unit/100*$price_guide['price_guide_2'],2);
									echo '$'.sprintf("%01.2f", $price_guide2).' / UNIT';
                            	?>
                            </td>
                        </tr>
                        <?
						}
						?>
                    </table>
                   </td>
                </tr>
            </table>
            </div>
	</div>
</div>



	




<script>

function addcomment()

{

	var comment = $('#admin_comment').val();

	var cust_id = <?=$order['customer_id']?>;

	

	$.ajax({ 

			url: '<?=base_url()?>admin/customer/add_comment',

			type: 'POST',

			data: ({comment:comment,cust_id:cust_id}),

			dataType: "html",

			success: function(html) {

				$('#all_comment').html(html);

			}

		})	

	

	//alert(comment);

}

</script>



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