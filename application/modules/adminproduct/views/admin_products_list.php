<script>
jQuery(function() {
	jQuery('.all_tt').tooltip({
		showURL: false
	});
});

function open_gallery(product_id) {
	day = new Date();
	id = day.getTime();
	URL = '<?=base_url()?>admin/product/gallery/' + product_id;
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=825,height=600,left = 240,top = 125');");
}
function checker_checked(id)
{
	jQuery( "#spanchecker"+id ).toggleClass( "checked" );
	if(jQuery('.checker'+id).is(':checked')){
		jQuery('.checker'+id).attr('checked', false);
	}else
	{
		jQuery('.checker'+id).attr('checked', true);
	}
}
</script>
<style>
h1{
	font-weight : 900;
	font-size:20px!important;
}
.center_icon{
	cursor: pointer; text-align: center;
}
.caret{
	border-left: 4px solid transparent!important;
    border-right: 4px solid transparent!important;
    border-bottom: 4px solid #000!important;
	border-bottom:none!important;
    border-top: 4px solid #000!important;
}
</style>
<script>
var choose = 0;
var check = 0;
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div>
			<!-- start here -->
			<?php if($this->session->flashdata('upload_csv_er')) { ?>
			    <div class="alert alert-error">
			    	<button type="button" class="close" onclick="$('.alert-error').fadeOut('slow');">&times;</button>
					<strong>ERROR! </strong><?=$this->session->flashdata('upload_csv_er')?>
				</div>
			<?php }?>
			<?php if($this->session->flashdata('upload_csv_sc')) { ?>
			    <div class="alert alert-success">
			    	<button type="button" class="close" onclick="$('.alert-success').fadeOut('slow');">&times;</button>
					<strong>SUCCESS! </strong><?=$this->session->flashdata('upload_csv_sc')?>
				</div>
			<?php }?>
			
		</div>
		<div class="title-page">MANAGE PRODUCTS</div>
        <div class="grey-box">
			<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/product/add';"><i class="fa fa-plus"></i> Add New Product</button>
        </div>
		<!-- <button class="btn btn-info" onclick="export_csv();"><i class="icon-upload"></i>&nbsp;Export Product</button>
		<button class="btn btn-info" onclick="$('#importModal').modal('show');"><i class="icon-download"></i>&nbsp;Import Product</button> -->
		<div class="subtitle-page">Search Products</div>
		<form id="addProduct" method="post" action="<?=base_url()?>admin/product/search">
			<div class="form-search-label">Keyword</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="keyword" value=""/>
			</div>
			
			<div class="form-search-gap"></div>
			<div class="form-search-label">Status</div>
			<div class="form-search-input">
				<select class="selectpicker" id="cat" name="status">
	            	<option value="all">All</option>
	            	<option value="active">Active</option>
	            	<option value="inactive">Inactive</option>		
	            </select>
			</div>
			<div class="form-search-gap"></div>
			<div class="form-search-label">Sort By</div>
			<div class="form-search-input">
				<select class="selectpicker" id="cat" name="sort">
	            	<option value="title">Name</option>	
	            	<option value="date">Recently Added</option>		
	            </select>
	            <script>jQuery(".selectpicker").selectpicker();</script>
	            <div class="form-search-gap"></div>
	            <button class="btn btn-info" onclick=""><i class="fa fa-search"></i> Search Products</button>
			</div>
		</form>
		<div style="clear: both"></div>
		<form method="post" action="<?=base_url()?>admin/product/actionall" id="action_all_form">
		<div id="top-table">
			<div style="float: left">
				<div id="top-table-title">Product List</div>
				<?php if($links) { ?>
					<div class="pagination"><?=$links?></div>
				<?php } ?>
			</div>
			
			<div id="top-table-button-group">
				<!--<button type="button" onclick="check_all();" id="btn_select_all" class="btn btn-info">Select All</button>&nbsp;&nbsp;-->
				<select class="selectpicker" id="cat" name="action" >
					<option value="0">Choose Action</option>
					<option value="1">Activate All</option>
					<option value="2">Deactive All</option>
					<option value="3">Delete All</option>
				</select>&nbsp;&nbsp;
				<button type="button" onclick="$('#action_all_form').submit();" class="btn btn-info">Submit</button>
				<script>jQuery(".selectpicker").selectpicker();</script>
			</div>
			<div style="clear: both">
			</div>
		</div>
		
		<table class="table table-hover">
	    	<thead>
	    		<tr class="list-tr" style="font-size: 12px" id="list-header-title">
					<th style="width: 4%; font-size: 12px !important; text-align:center;"><button type="button" onclick="check_all();" id="btn_select_all" class="btn btn-info sml-btn">Select</button></th>
	    			<th style="width: 59.5%; font-size: 12px !important">PRODUCT NAME </th>
	    			<!-- <th style="width: 6.25%; text-align: center; font-size: 12px !important">Stock</th> -->
	    			<th style="width: 6.25%; text-align: center; font-size: 12px !important">CLONE</th>
	    			<!-- <th style="width: 6.25%; text-align: center; font-size: 12px !important">Crosssale</th> -->
	    			<th style="width: 6.25%; text-align: center; font-size: 12px !important">CATEGORIES</th>
	    			<th style="width: 6.25%; text-align: center; font-size: 12px !important">IMAGES</th>
	    			<!-- <th style="width: 6.25%; text-align: center; font-size: 12px !important">SALE</th> -->
	    			<th style="width: 6.25%; text-align: center; font-size: 12px !important">ACTIVE</th>
	    			<!--<th style="width: 6.25%; text-align: center; font-size: 12px !important">Trade</th>-->
	    			<th style="width: 6.25%; text-align: center; font-size: 12px !important">DELETE</th>
	    			<!-- <th style="width: 60%; text-align: center;" colspan="6">Quick Functions</th> -->
	    		</tr>
	    		
	    	</thead>
	    	<tbody>
	    		<?php foreach($products as $product) { if($product['deleted'] == 0){?>
	    		<tr class="list-tr" id="product-<?=$product['id']?>">
	    			<td style="width: 4%; text-align:center;" align="center">
	    				<!--<input type="checkbox" class="check_product" name="check_ed[]" value="<?=$product['id']?>"/>-->
                        <div id="uniform-check2S" class="checker" style="margin-left:25px;margin-top:14px;" onclick="checker_checked(<?=$product['id']?>)">
                            <span class="spancheck_product" id="spanchecker<?=$product['id']?>">
                                <input type="checkbox" id="check2S" name="check_ed[]"  class="check check_product checker<?=$product['id']?>" />
                            </span>
                        </div>
                    	<!--<label for="check2S"  class="nopadding">Checkbox checked</label>-->
	    			</td>
	    			<td style="width: 47%; ">
                    
                    	<?
                        $num_desc = strlen($product['short_desc']);
						if($num_desc==''){$word_desc='';}
						$word_desc='- '.$product['short_desc'];
						if($num_desc > 20)
						{
							$word_desc='- '.substr($product['short_desc'],0, 15).'...';	
						}
						?>
	    				<a style="color:#3d3d3d;" href="<?=base_url()?>admin/product/details/<?=$product['id']?>"><?=$product['title']?> <?=$word_desc?></a>
	    				<!--<a target="_blank" style="text-decoration: none" href="<?=base_url()?>store/detail_product/preview/<?=$product['id_title']?>"><i class="fa fa-search blue-icon"></i></a>-->
	    			</td>
	    			<!-- <td style="width: 6.25%; text-align: center">
	    				<div id="stock<?=$product['id']?>" class="all_tt center_icon" data-toggle="tooltip" title="Update Stock" onclick="update_stock(<?=$product['id']?>);"><?=$product['stock']?></div>
	    			</td> -->
	    			<td style="width: 6.25%; ">
	    				<div class="all_tt center_icon" data-toggle="tooltip" title="Duplicate" onclick="copy_product(<?=$product['id']?>);"><i class="fa fa-files-o blue-icon"></i></div>
	    			</td>
	    			<!-- <td style="width: 6.25%; ">
	    				<div class="all_tt center_icon" data-toggle="tooltip" title="Edit Cross Sale" onclick="crosssale(<?=$product['id']?>);"><i class="icon-paper-clip icon-2x"></i></div>
	    			</td> 
                    -->
	    			<td style="width: 6.25%; ">
	    				<div class="all_tt center_icon" data-toggle="tooltip" title="Edit Category" onclick="show_category(<?=$product['id']?>);"><i class="fa fa-folder-open blue-icon"></i></div>
	    			</td>
	    			<td style="width: 6.25%; ">
	    				<div class="all_tt center_icon" data-toggle="tooltip" title="Edit Gallery"><a onclick="open_gallery(<?=$product['id'];?>)"><i class="fa fa-picture-o blue-icon"></i></a></div>
                        
	    			</td>
	    			<!-- <td style="width: 6.25%; ">
	    				<div class="all_tt center_icon" data-toggle="tooltip" title="Sale Price"  onclick="sale_click(<?=$product['id']?>);">
	    					<i style=" <?php if($product['price'] > $product['sale_price']) {echo "color:#C70520;";}?>" class="fa fa-tag blue-icon"></i>
	    				</div>
	    			</td> -->
	    			<td style="width: 6.25%; ">
	    				<?php if($product['status'] == 1) { ?>
    						<div class="all_tt center_icon" data-toggle="tooltip" title="De-actived Product" onclick="window.location = '<?=base_url()?>admin/product/switch/<?=$product['id']?>'">
                            	<i style="color: #00c717" class="fa fa-check-circle"></i>
                            </div>
    					<?php 
						}
    					else
    					{
    					?>
    						<div class="all_tt center_icon" data-toggle="tooltip" title="Actived Product" onclick="window.location = '<?=base_url()?>admin/product/switch/<?=$product['id']?>'">
                            	<i style="color: #d6d6d6" class="fa fa-check-circle"></i>
                            </div>
    					<?php	
    					}
    					?>
	    			</td>
                    <!--
	    			<td style="width: 6.25%; ">
	    				<?php if($product['status_trade'] == 1) { ?>
    						<div class="all_tt center_icon" data-toggle="tooltip" title="De-actived Product" onclick="window.location = '<?=base_url()?>admin/product/switch_trade/<?=$product['id']?>'">
                            	<i style="color: #00c717" class="icon-ok-circle icon-2x"></i>
                             </div>
    					<?php 
						}
    					else
    					{
    					?>
    						<div class="all_tt center_icon" data-toggle="tooltip" title="Actived Product" onclick="window.location = '<?=base_url()?>admin/product/switch_trade/<?=$product['id']?>'">
                            	<i style="color: #d6d6d6" class="icon-ok-circle icon-2x"></i>
                            </div>
    					<?php	
    					}
    					?>
	    			</td>
                    -->
	    			<td style="width: 6.25%; ">
	    				<div class="all_tt center_icon " data-toggle="tooltip" title="Delete Product" onclick="delete_product(<?=$product['id']?>);">
	    					<i class="fa fa-trash-o blue-icon"></i>
	    				</div>
	    			</td>
	    		</tr>
	    		<?php }}?>
	    	</tbody>
	</table>
	
			
			
			
	</form>
    
    <div class="hprint" id="print_area" style="display:none; font-size: 9px;">
    </div>
	
    </div>
</div>
<!-- <div class="span9">
	<div style="min-height: 365px;  border-radius: 5px; margin-right: 19px;">
		<div>
			
			<?php if($this->session->flashdata('upload_csv_er')) { ?>
			    <div class="alert alert-error">
			    	<button type="button" class="close" onclick="$('.alert-error').fadeOut('slow');">&times;</button>
					<strong>ERROR! </strong><?=$this->session->flashdata('upload_csv_er')?>
				</div>
			<?php }?>
			<?php if($this->session->flashdata('upload_csv_sc')) { ?>
			    <div class="alert alert-success">
			    	<button type="button" class="close" onclick="$('.alert-success').fadeOut('slow');">&times;</button>
					<strong>SUCCESS! </strong><?=$this->session->flashdata('upload_csv_sc')?>
				</div>
			<?php }?>
			
		</div>
	</div>
</div> -->
<script>
function check_all()
{
	if(check == 0)
	{
		//alert('check');
		check = 1;
		$('#btn_select_all').text('Unselect');
		$('.check_product').each(function () { 						
			jQuery(this).attr('checked', true);
			
		});
		$('.spancheck_product').each(function () { 			
			jQuery(this).addClass( "checked" );						
		});
	}
	else
	{
		//alert('uncheck');
		check = 0;
		$('#btn_select_all').text('Select');
		$('.check_product').each(function () { this.click();});
	}
}
function uncheck_all()
{
	
}
function update_stock(product_id)
{
	choose = product_id;
	var stock = $('#stock'+product_id).text();
	$('#new_stock').val(stock);
	$j('#stockModal').modal('show');
}
function updatestock()
{
	$j('#stockModal').modal('hide');
	var new_stock = $('#new_stock').val();
	
	if(isNaN(new_stock))
	{
		jQuery('#any_message').html("Please insert a number");
		$j('#anyModal').modal('show');
	}
	else
	{
		jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/update_stock/',
		type: 'POST',
		data: ({id:choose,stock:new_stock}),
		dataType: "html",
		success: function(html) {
			$('#stock'+choose).text(new_stock);
		}
	});
	}
}
function copy_product(product_id)
{
	choose = product_id;
	$('#new_product_name').val('');
	$j('#copyModal').modal('show');
}
function duplicate_product()
{
	$j('#copyModal').modal('hide');
	var new_name = $('#new_product_name').val();
	//alert(new_name);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/duplicate/',
		type: 'POST',
		data: ({id:choose,name:new_name}),
		dataType: "html",
		success: function(html) {
			if(html != 0)
			{
				window.location = "<?=base_url()?>admin/product/details/"+html;
			}
			else
			{
				jQuery('#any_message').html("This name has already exist in the list");
				$j('#anyModal').modal('show');
			}
		}
	});
}
function crosssale(product_id) {
	day = new Date();
	id = day.getTime();
	URL = '<?=base_url()?>admin/store/productcrosssale/' + product_id;
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=640,height=700,left = 240,top = 125');");
}
function gallery(product_id) {
	day = new Date();
	id = day.getTime();
	URL = '<?=base_url()?>admin/product/ajax/product_gallery/' + product_id;
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=825,height=600,left = 240,top = 125');");
	
}
function nothing()
{
	
}
function show_category(id)
{
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/get_product_category/',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			jQuery('#list_cat').html(html);
			jQuery('#c_pid').val(id);
			$j('#categoryModal').modal('show');
		}
	});
	//$('#categoryModal').modal('show');
}
function setsale()
{
	$j('#saleModal').modal('hide');
	var saleprice = jQuery('#saleprice').val();
	var saletradeprice = jQuery('#saletradeprice').val();
	jQuery.ajax({
	url: '<?=base_url()?>admin/product/ajax/updatesale',
	type: 'POST',
	data: ({id:choose,saleprice:saleprice,saletradeprice:saletradeprice}),
	dataType: "html",
	success: function(html) {
		//jQuery('#saletradeprice').val(html);
		//$('#saleModal').modal('show');
		//jQuery('#any_message').html("This new sale price has been set");
		//$('#anyModal').modal('show');
		
		location.reload();
		}
	});
}
function sale_click(id)
{
	
	choose = id;
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/get_product_saleprice/',
		type: 'POST',
		data: ({id:id}),
		dataType: "json",
		cache: false,
		success: function(html) {
			//alert(html.length);
			jQuery('#saleprice').val(html[0]);
			jQuery.ajax({
			url: '<?=base_url()?>admin/product/ajax/get_product_saletradeprice/',
			type: 'POST',
			data: ({id:id}),
			dataType: "html",
			success: function(html) {
				jQuery('#saletradeprice').val(html);
				
				jQuery.ajax({
				url: '<?=base_url()?>admin/product/ajax/get_product_price/',
				type: 'POST',
				data: ({id:id}),
				dataType: "json",
				cache: false,
				success: function(html) {
					jQuery('#normalprice').html(html[0]);
					
					jQuery.ajax({
					url: '<?=base_url()?>admin/product/ajax/get_product_tradeprice/',
					type: 'POST',
					data: ({id:id}),
					dataType: "html",
					success: function(html) {
						jQuery('#normaltradeprice').html(html);																		
						$j('#saleModal').modal('show');
					}
				});
				}
			});
			
			}
		});
			
		}
	});
	
}
function export_csv() {
	$j('#csvModal').modal('show');
}
function exportcsv() {
	$j('#csvModal').modal('hide');
	window.location = '<?=base_url()?>admin/product/ajax/exportproduct/';
}
function delete_product(id)
{
	choose = id;	
	$j('#deleteModal').modal('show');
}
function deleteproduct(id)
{
	$j('#deleteModal').modal('hide');	
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/delete/'+id,
		type: 'POST',
		//data: (),
		dataType: "html",
		success: function(html) {
			jQuery('#product-'+id).fadeOut('slow');
			jQuery('#any_message').html("This product has been successfully deleted");
			$j('#anyModal').modal('show');
			
		}
	})
}
</script>
<div id="categoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h1 id="myModalLabel" class="title-page">Product Categories</h1>
</div>
<form id="addProduct" method="post" action="<?=base_url()?>admin/product/updatecategories">
<input type="hidden" id="c_pid" name="product_id" value="">
<div class="modal-body" >
    <div style="height: 300px; overflow: auto;  overflow-x: hidden;" id="list_cat" >
    </div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info">Set Category</button>
</form>
</div>
</div>
</div>
</div>
<div id="saleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h1 id="myModalLabel" class="title-page">Sale Price</h1>
</div>
<div class="modal-body">
	<table style="width: 70%">
		<tr>
			<td style="width: 30%">&nbsp;
				
			</td>
			<td style="width: 30%; font-weight: 700">
				RRP 
			</td>
			<td style="width: 30%; font-weight: 700">
				Sale Price
			</td>
		</tr>
		<tr>
			<td>
				Price 
			</td>
			<td>
				$ <span id="normalprice"></span>
			</td>
			<td>
				<div class="input-group">
				  <span class="input-group-addon">$</span>
				  <input type="text" class="form-control" id="saleprice">
				</div>		
			</td>
		</tr>
        
		
	</table>
    
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="setsale(choose)">Set Price</button>
</div>
</div>
</div>
</div>
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Delete Product</h3>
</div>
<div class="modal-body">
    <p>Are you sure to delete this Product?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="deleteproduct(choose)">Delete</button>
</div>
</div>
</div>
</div>
<div id="csvModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Export CSV Product</h3>
</div>
<div class="modal-body">
    <p>This will export the stock product list to a csv file. Do you want to continue?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="exportcsv();">Export</button>
</div>
</div>
</div>
</div>
<div id="anyModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Message</h3>
</div>
<div class="modal-body">
    <p id="any_message"></p>
</div>
<div class="modal-footer">
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>
<div id="importModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Import Product</h3>
</div>
<form method="post" action="<?=base_url()?>admin/product/importproduct" enctype="multipart/form-data">
<div class="modal-body">
    <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append">
                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                    <span class="btn btn-file"><span class="fileupload-new">Select File</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                </div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" type="submit">Upload</button>
</div>
</form>
</div>
</div></div>
<div id="copyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Duplicate Product</h3>
</div>
<div class="modal-body">
	<div class="left-side modal-label">
    	New Product Name
    </div>
    <div class="left-side">
    	<input class="form-control input-text" type="text" id="new_product_name"/>
    </div>
    <div class="cleardiv"></div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="duplicate_product();">Copy</button>
</div>
</div>
</div>
</div>
<div id="stockModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Update Stock</h3>
</div>
<div class="modal-body">
	<div>
    	New Stock
    </div>
    <div>
    	<input type="text" id="new_stock"/>
    </div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" onclick="updatestock();">Update</button>
</div>
</div>