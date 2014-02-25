<link href="<?=base_url()?>assets/backend-assets/template/css/table.css" rel="stylesheet" type="text/css" />

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/tablelist/js/function.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/forms/jquery.uniform.js"></script>


<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.resizable.js"></script>

<style>
.wrapper{
	margin:0px!important;
}
#tablelist #content{

margin-left:0px!important}
</style>

<script>

jQuery(function() {
	$j('.edit-cust').tooltip({
		showURL: false
	});
	
	$j('#export').click(function(){
		$j('#export-components').modal('show');
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
	$j('#deleteModal').modal('show');
}
function deletecustomer(id)
{
	$j('#deleteModal').modal('hide');
	//alert(id);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/customer/delete/'+id,
		type: 'POST',	
		dataType: "html",
		success: function(html) {
			jQuery('#user'+id).fadeOut('slow');
			jQuery('#any_message').html("This customer has been successfully deleted");
			$j('#anyModal').modal('show');
			
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
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">MANAGE CUSTOMERS</div>
		<div class="sub-title">Create new customer or edit and manage existing customers.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="window.location='<?=base_url()?>admin/customer/add'" ><i class="fa fa-plus"></i> Add New Customer</button>
            <button class="btn btn-info" type="button" id="export"><i class="fa fa-download"></i> Export</button>
        </div>
		
        <div id="tablelist">
        <!-- Table List START -->
        <div id="content">            
            <!-- Main content -->
            <div class="wrapper">                            
                <!-- Table with hidden toolbar -->
                <div class="widget">
                    <div class="whead"><h6>CUSTOMER LIST</h6></div>
                    <div id="dyn" class="hiddenpars">
                        <a class="tOptions" title="Options"><i class="fa fa-cogs fa-4 black" style="font-size:23px;"></i></a>
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            <th>CUSTOMER NAME <i class="fa fa-sort-alpha-asc sort-icon" ></i><span class="sorting" style="display: block;"></span></th>
                            <th>EMAIL<i class="fa fa-sort-alpha-asc sort-icon"></i><span class="sorting" style="display: block;"></span></th>
                            <th class="center">EDIT </th>
                            <th class="center">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach($users as $user) {
                            	$customer = $this->customer_model->identify($user['customer_id']);
                            ?>
                                <tr class="gradeA" id="user<?=$user['id']?>">
                                    <td><?=strtoupper($customer['firstname'].' '.$customer['lastname'])?></td>
                                    <td><span class="red"><a href="mailto:<?=$customer['email']?>"><?=$customer['email']?></a></span></td>
                                    <td style="text-align:center;"><span class="edit-cust" data-toggle="tooltip" title="Edit Customer" style="cursor: pointer" onclick="edit_cust(<?=$user['id']?>,<?=$user['level']?>)">
	    						<i class="fa fa-edit blue-icon"></i>
	    					</span></td>
                                    <td class="center" style="text-align:center;"><div class="all_tt" data-toggle="tooltip" title="Delete Customer" style="cursor: pointer; text-align: center" onclick="delete_customer(<?=$user['id']?>);">
		    					<i class="fa fa-trash-o blue-icon"></i>
		    				</div></td>
                                </tr>
                            
                            <?	
                        }
                        ?>                       
                        </tbody>
                        </table> 
                    </div>
                </div>             
            </div>
            <!-- Main content ends -->            
        </div>        
        <!-- Table List END -->  
		</div>
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

function reload_page(){
	if($('#data_exported').val() == 1){
		location.reload();	
	}
}

function export_data(){
	$('#data_exported').val(1);
	$('#customer_export').submit();
}
 
</script>

<!--begin export settings-->
<div id="export-components" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form id="customer_export" method="post" action="<?=base_url();?>admin/customer/export_csv">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="reload_page();"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Configure Export</h3>
            </div>
            <div class="modal-body">
                <p>Tick the fields you would like to export.</p>
                <?=$this->customer_model->get_export_settings();?>
            </div>
            <div class="modal-footer">
            <?php if(0){ ?>
            <div class="checker">
                <span>
                    <input type="checkbox"  class="check" name="remember_this"/>
                </span>
            </div>
			<?php } ?>
             
            <input type="hidden" id="data_exported" value="0" />                 
            <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="reload_page();">Close</button>
            <button type="button" class="btn btn-info" onclick="export_data();"><i class="fa fa-download"></i> Export</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--end export settings-->