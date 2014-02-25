<script src="<?=base_url()?>assets/backend/highcart/highcharts.js"></script>
<script src="<?=base_url()?>assets/backend/highcart/modules/exporting.js"></script>

<div class="row">
	<div class="col-md-12">
		<div class="title-page">SALES REPORTS <a style="font-size:13px" href="<?=base_url()?>/admin/order/all_sales_report">Update Data</a></div>
		<div class="subtitle-page">Total Income : $<?=number_format($sales_all,2,'.',',')?></div>
		<div class="row" style="border: 4px solid #ccc; border-radius: 10px">
			<div class="col-md-1 col-sm-1">&nbsp;</div>
			<div class="col-md-3 col-sm-3">
				<div style="height: 10px"></div>
				<div>
					<span class="income-today">$<?=number_format($order_detail['today_income'],2,'.',',')?></span> 
					<a href="<?=base_url()?>admin/order/show_stat/today">Today</a>
				</div>
				<div style="height: 20px; line-height: 20px">Prev. $ <?=number_format($order_detail['yesterday_income'],2,'.',',')?></div>
				<div style="height: 10px"></div>
			</div>
			<div class="col-md-1 col-sm-1">
				<div style="height: 10px"></div>
					<div style="border-left: 1px solid #ccc; height: 50px;">&nbsp;</div>
				<div style="height: 10px"></div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div style="height: 10px"></div>
					<div>
						<span class="income-today">$<?=number_format($order_detail['this_month_income'],2,'.',',')?></span> 
						<a href="<?=base_url()?>admin/order/show_stat/month">Month</a>
					</div>
					<div style="height: 20px; line-height: 20px">Prev. $ <?=number_format($order_detail['last_month_income'],2,'.',',')?></div>
					<div style="height: 10px"></div>
			</div>
			<div class="col-md-1 col-sm-1">
				<div style="height: 10px"></div>
					<div style="border-left: 1px solid #ccc; height: 50px;">&nbsp;</div>
				<div style="height: 10px"></div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div style="height: 10px"></div>
					<div>
						<span class="income-today">$<?=number_format($order_detail['this_year_income'],2,'.',',')?></span> 
						<a href="<?=base_url()?>admin/order/show_stat/year">Year</a>
					</div>
					<div style="height: 20px; line-height: 20px">Prev. $ <?=number_format($order_detail['last_year_income'],2,'.',',')?></div>
					<div style="height: 10px"></div>
			</div>
		</div>
		<div class="common-gap"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php
						if($this->session->userdata('stat_type'))
						{
							$type = $this->session->userdata('stat_type');
							if($type == 'month')
							{
							?>
								<div id="container_month" style="height: 400px; margin: 0 auto; "></div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="m_f" value="1"/>
										<div class="subtitle-page">Filter</div>
										<div class="form-search-label">State</div>
										<div class="form-search-input">
											<select class="selectpicker" name="mstate_f">
												<option value="-1">All States</option>
												<?php
												foreach($states as $state)
												{
												?>
													<option value="<?=$state['id']?>"><?=$state['name']?></option>
												<?
												}
												?>
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">Month</div>
										<div class="form-search-input">
											<?php
												$m = date('m');
											?>
											<select class="selectpicker" name="mmonth_f">
												<option <?php if($m == '01') {echo "selected = 'selected'";}?> value="01">January</option>
												<option <?php if($m == '02') {echo "selected = 'selected'";}?> value="02">February</option>
												<option <?php if($m == '03') {echo "selected = 'selected'";}?> value="03">March</option>
												<option <?php if($m == '04') {echo "selected = 'selected'";}?> value="04">April</option>
												<option <?php if($m == '05') {echo "selected = 'selected'";}?> value="05">May</option>
												<option <?php if($m == '06') {echo "selected = 'selected'";}?> value="06">June</option>
												<option <?php if($m == '07') {echo "selected = 'selected'";}?> value="07">July</option>
												<option <?php if($m == '08') {echo "selected = 'selected'";}?> value="08">August</option>
												<option <?php if($m == '09') {echo "selected = 'selected'";}?> value="09">September</option>
												<option <?php if($m == '10') {echo "selected = 'selected'";}?> value="10">October</option>
												<option <?php if($m == '11') {echo "selected = 'selected'";}?> value="11">November</option>
												<option <?php if($m == '12') {echo "selected = 'selected'";}?> value="12">December</option>
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">Year</div>
										<div class="form-search-input">
											
											<select class="selectpicker" name="myear_f">
												<?php
													$y = date('Y');
													for($i = $y-5; $i<=$y+5; $i++)
													{
														?>
														<option <?php if($y == $i) {echo "selected = 'selected'";}?> value="<?=$i?>"><?=$i?></option>
														<?
													}
												?>
												
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							<?
							}
							if($type == 'year')
							{
							?>
								<div id="container_year" style="height: 400px; margin: 0 auto; "></div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="y_f" value="1"/>
										<div class="subtitle-page">Filter</div>
										
										<div class="form-search-label">Year</div>
										<div class="form-search-input">
											
											<select class="selectpicker" name="yyear_f">
												<?php
													$y = date('Y');
													for($i = $y-5; $i<=$y+5; $i++)
													{
														?>
														<option <?php if($y == $i) {echo "selected = 'selected'";}?> value="<?=$i?>"><?=$i?></option>
														<?
													}
												?>
												
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							<?
							}
							if($type == 'today')
							{
							?>
								<div id="container_today" style="height: 400px; margin: 0 auto;">
									<div style="font-size: 16px; line-height:32px;font-weight: 400; text-align: center;">Today's Income</div>
									<table class="table table-hover">
										<thead>
											<tr>
												<th style="width: 20%">ID</th>
												<th style="width: 50%">Customer Name</th>
												<th style="width: 30%">Total Order</th>
											</tr>
										</thead>
										<tbody>
											<?php
											foreach($list_order_today as $list)
											{
												$cust = $this->customer_model->identify($list['customer_id']);
												$user = $this->user_model->identify_cust_id($list['customer_id']);
												?>
												<tr>
													<td><a href="<?=base_url()?>admin/order/list_all/view/<?=$list['id']?>"><?=$list['id']?></a></td>
													<td><a href="<?=base_url()?>admin/customer/list_all/edit/<?=$user['id']?>"><?=$cust['firstname']?> <?=$cust['lastname']?></a></td>
													<td>$ <?=number_format($list['total'],2,'.',',')?></td>
												</tr>
												<?
											}
											?>
										</tbody>
									</table>
								</div>
							<?
							}
							if($type == 'customer')
							{
							?>
								<div id="container_today" style="height: 400px; margin: 0 auto;">
									<div style="font-size: 16px; font-weight: 400; text-align: center;">Best Customers<?=$h_cust?></div>
									<table class="table table-hover">
								    	<thead>
								    		<tr>
								    			<th style="width: 10%">Id</th>
								    			<th style="width: 60%">Customer Name</th>
								    			<th style="width: 30%">Total Spend</th>
								    		</tr>
								    	</thead>
								    	<tbody>
								    		<?php
								    		foreach($best_customers as $bc)
											{
												$cust = $this->customer_model->identify($bc['customer_id']);
												?>
												<tr>
													<td><?=$bc['customer_id']?></td>
													<td><?=$cust['firstname']?> <?=$cust['lastname']?></td>
													<td>$<?=number_format($bc['total'],2,'.',',')?></td>
												</tr>
												<?
											}
								    		?>
								    	</tbody>
								    </table>
								</div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="filter_cust" value="1">
										<div class="subtitle-page">Filter</div>
										<div class="form-search-label">From Date</div>
										<div class="form-search-input">
											
											<input class="form-control input-text" type="text" id="from_date_cust" name="from_date_cust" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#from_date_cust').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
											
											
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">To Date</div>
										<div class="form-search-input">
											<input class="form-control input-text" type="text" id="to_date_cust" name="to_date_cust" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#to_date_cust').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
											
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-info">Update</button>
										</div>
									</form>
								</div>
							<?
							}
							if($type == 'cat')
							{
							?>
								<div id="container_month_category" style="height: 400px; margin: 0 auto;"></div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="filter_bcat" value="1">
										<div class="subtitle-page">Filter</div>
										<div class="form-search-label">From Date</div>
										<div class="form-search-input">
											<input class="form-control input-text" type="text" id="from_date_bcat" name="from_date_bcat" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#from_date_bcat').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">To Date</div>
										<div class="form-search-input">
											<input class="form-control input-text" type="text" id="to_date_bcat" name="to_date_bcat" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#to_date_bcat').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							<?
							}
							if($type == 'prod')
							{
							?>
								<div id="container_best_prod" style="height: 400px; margin: 0 auto;"></div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="filter_prod" value="1">
										<div class="subtitle-page">Filter</div>
										<div class="form-search-label">From Date</div>
										<div class="form-search-input">
											<input class="form-control input-text" type="text" id="from_date_prod" name="from_date_prod" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#from_date_prod').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">To Date</div>
										<div class="form-search-input">
											<input class="form-control input-text" type="text" id="to_date_prod" name="to_date_prod" readonly style="cursor: pointer; background: #fff"></input>
											<script type="text/javascript">
											  $(function() {
											    $('#to_date_prod').datepicker({
											    	 dateFormat: "dd-mm-yy",
													 todayBtn: "linked"
											    });
											  });
											</script>
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							<?
							}
							if($type == 'lmonth')
							{
							?>
								<div id="container_best_prod_lmonth" style="height: 400px; margin: 0 auto;"></div>
							<?
							}
							
						}
						else 
						{
						?>
							<div id="container_month" style="height: 400px; margin: 0 auto; "></div>
								<div>
									<form method="post" action="<?=base_url()?>admin/order/salesreport">
										<input type="hidden" name="m_f" value="1"/>
										<div class="subtitle-page">Filter</div>
										<div class="form-search-label">State</div>
										<div class="form-search-input">
											<select class="selectpicker" name="mstate_f">
												<option value="-1">All States</option>
												<?php
												foreach($states as $state)
												{
												?>
													<option value="<?=$state['id']?>"><?=$state['name']?></option>
												<?
												}
												?>
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">Month</div>
										<div class="form-search-input">
											<?php
												$m = date('m');
											?>
											<select class="selectpicker" name="mmonth_f">
												<option <?php if($m == '01') {echo "selected = 'selected'";}?> value="01">January</option>
												<option <?php if($m == '02') {echo "selected = 'selected'";}?> value="02">February</option>
												<option <?php if($m == '03') {echo "selected = 'selected'";}?> value="03">March</option>
												<option <?php if($m == '04') {echo "selected = 'selected'";}?> value="04">April</option>
												<option <?php if($m == '05') {echo "selected = 'selected'";}?> value="05">May</option>
												<option <?php if($m == '06') {echo "selected = 'selected'";}?> value="06">June</option>
												<option <?php if($m == '07') {echo "selected = 'selected'";}?> value="07">July</option>
												<option <?php if($m == '08') {echo "selected = 'selected'";}?> value="08">August</option>
												<option <?php if($m == '09') {echo "selected = 'selected'";}?> value="09">September</option>
												<option <?php if($m == '10') {echo "selected = 'selected'";}?> value="10">October</option>
												<option <?php if($m == '11') {echo "selected = 'selected'";}?> value="11">November</option>
												<option <?php if($m == '12') {echo "selected = 'selected'";}?> value="12">December</option>
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div class="form-search-label">Year</div>
										<div class="form-search-input">
											
											<select class="selectpicker" name="myear_f">
												<?php
													$y = date('Y');
													for($i = $y-5; $i<=$y+5; $i++)
													{
														?>
														<option <?php if($y == $i) {echo "selected = 'selected'";}?> value="<?=$i?>"><?=$i?></option>
														<?
													}
												?>
												
											</select>
										</div>
										<div class="form-search-gap"></div>
										<div>
											<button type="submit" class="btn btn-info">Update</button>
										</div>
									</form>
								</div>
						<?
						}
					?>
			</div>
		</div>
		<div class="common-gap"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="subtitle-page">Quick Facts</div>
				<div class="well">
					<div style="width: 20%; float: left; font-weight: 700">
						Best Products
					</div>
					<div style="width: 80%; float: left;">
						<!-- <div style="cursor: pointer;" onclick="$('#categoryModal').modal('show');">show chart</div> -->
						<a href="<?=base_url()?>admin/order/show_stat/prod"><?=$order_detail['best_product']?></a>
					</div>
					<div style="clear: both; height: 15px"></div>
					<div style="width: 20%; float: left; font-weight: 700">
						Best Categories
					</div>
					<div style="width: 80%; float: left; cursor: pointer">
						<!-- <div style="cursor: pointer;" onclick="$('#categoryModal').modal('show');">show chart</div> -->
						<a href="<?=base_url()?>admin/order/show_stat/cat"><?=$order_detail['best_category']?></a>
					</div>
					<div style="clear: both; height: 15px"></div>
					<div style="width: 20%; float: left; font-weight: 700">
						Best Customers
					</div>
					<div style="width: 80%; float: left; cursor: pointer">
						<!-- <div style="cursor: pointer;" onclick="$('#categoryModal').modal('show');">show chart</div> -->
						<a href="<?=base_url()?>admin/order/show_stat/customer"><?=$order_detail['best_customer']?></a>
					</div>
					<div style="clear: both; height: 15px"></div>
					<div style="width: 20%; float: left; font-weight: 700">
						What's Selling
					</div>
					<div style="width: 80%; float: left; cursor: pointer">
						<a href="<?=base_url()?>admin/order/show_stat/lmonth">View</a>
					</div>
					<div style="clear: both; height: 15px"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="categoryModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

<h3 id="myModalLabel">Best Categories</h3>

</div>

<div class="modal-body">
	<!-- <?php echo "<pre>".print_r($listincome_arr,true)."</pre>";?> -->
    <!-- <div id="container_month_category" style="min-width: 530px; height: 400px; margin: 0 auto"></div> -->

</div>

<div class="modal-footer">

<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>

</div>
</div>
</div>
</div>



<div id="bestcustModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

<h3 id="myModalLabel">Best Customers</h3>

</div>

<div class="modal-body">
	
    

</div>

<div class="modal-footer">

<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>


</div>
</div>
</div>
</div>

<script type="text/javascript">
<?php

if(!$this->session->userdata('stat_type'))
{
	$type = 'month';
}

?>


<?php
if($type == 'month'){
?>
$(function () {
        $('#container_month').highcharts({
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: "<?=$mfilter_header?><?=$mstate_f?>",
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: <?=$listdate_month?>
            },
            yAxis: {
                title: {
                    text: 'Sales ($)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valuePrefix: '$'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Income This Month',
                data: <?=$listincome_month?>
            }]
        });
        
        
    });
<?php }?>
  
<?php
if($type == 'cat'){
?>
$(function () {
        $('#container_month_category').highcharts({
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Best Categories<?=$h_bcat?>',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: <?=$listdate_month_bcat?>
            },
            yAxis: {
                title: {
                    text: 'Sales ($)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valuePrefix: '$'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [
            <?php
            $cc = 0;
            foreach($listincome_arr as $la)
			{
				if($cc == 0)
				{
				?>
				{
					name: '<?=$la['cat_title']?>',
	                data: <?=$la['income']?>
				},
				<?	
				}
				else 
				{
				?>
				
				 {
					name: '<?=$la['cat_title']?>',
	                data: <?=$la['income']?>
				},
				<?
				}
			}
			$cc++;
            ?>
            
            
            ]
        });
        
        
    });
<?php }?>

<?php
if($type == 'prod'){
?>
$(function () {
        $('#container_best_prod').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?=$ttl_prod?> Best Products <?=$h_prod?>'
            },
            subtitle: {
                
            },
            xAxis: {
                categories: [
                    <?=$prod_list?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Purchased'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total Purchased',
                data: [<?=$prod_count?>]
    
            }]
        });
    });
<?php }?>

<?php
if($type == 'year'){
?>
    $(function () {
        $('#container_year').highcharts({
            chart: {
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: "<?=$header_year_f?>"
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 14 * 24 * 3600000, // fourteen days
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Income in AU$'
                }
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                type: 'area',
                name: 'Income',
                pointInterval: 24 * 3600 * 1000,
                pointStart: Date.UTC(<?=$yyear_f?>, 0, 1),
                data: [
                   <?=$all_income?>
                ]
            }]
        });
    });
<?php }?>  


<?php
if($type == 'lmonth'){
?>
    $(function () {
        $('#container_best_prod_lmonth').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: "What's Selling"
            },
            subtitle: {
                
            },
            xAxis: {
                categories: [<?=$list_date_lmonth?>]
            },
            yAxis: {
                title: {
                    text: 'Sold'
                },
                labels: {
                    formatter: function() {
                        return '$'+this.value
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
            
            <?php
            $cc = 0;
            foreach($list_lmonth_income_arr as $la)
			{
				if($cc<20)
				{
					if($cc == 0)
					{
					?>
					{
						name: '<?=$la['prod_title']?>',
		                data: <?=$la['income']?>
					},
					<?	
					}
					else 
					{
					?>
					
					 {
						name: '<?=$la['prod_title']?>',
		                data: <?=$la['income']?>
					},
					<?
					}
				}
				$cc++;
			}
			
            ?>
            
            ]
        });
    });
<?php }?>  

		</script>

<script>jQuery(".selectpicker").selectpicker();</script>


