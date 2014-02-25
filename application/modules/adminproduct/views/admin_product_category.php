<link href="<?=base_url()?>assets/backend-assets/template/css/table.css" rel="stylesheet" type="text/css" />
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
	jQuery('.edit-cp').tooltip({
		showURL: false
	});
	
	jQuery('.delete-cp').tooltip({
		showURL: false
	});
	
	jQuery('.active-cp').tooltip({
		showURL: false
	});
	
	jQuery('.de-active-cp').tooltip({
		showURL: false
	});
	
});
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">Manage Product Categories</div>
		<p>Add product categories that you can assign your product to. To ensure you can add products to a product category you create ensure that the active state is set to on (Green)</p>
		<div id="tablelist">
        <!-- Table List START -->
        <div id="content">            
            <!-- Main content -->
            <div class="wrapper">                            
                <!-- Table with hidden toolbar -->
                <div class="widget">
                    <div class="whead"><h6>PRODUCT CATEGORY LIST</h6></div>
                    <div id="dyn" class="hiddenpars">
                        <a class="tOptions" title="Options"><i class="fa fa-cogs fa-4 black" style="font-size:23px;"></i></a>
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            <th>CATEGORY NAME <i class="fa fa-sort-alpha-asc sort-icon" ></i><span class="sorting" style="display: block;"></span></th>
                            <th>CATEGORY SHORT DESCRIPTION<i class="fa fa-sort-alpha-asc sort-icon"></i><span class="sorting" style="display: block;"></span></th>
                            <th style="text-align:center;">EDIT </th>
                            <th style="text-align:center;">ACTIVE </th>
                            <th style="text-align:center;">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach($categories as $category) {
                            ?>
                                <tr class="gradeA" id="category<?=$category['id']?>">
                                    <td><?=$category['name']?></td>
                                    <td><?=substr($category['subname'], 0,20) ?></td>
                                    <td style="text-align:center;">
                                    	<div class="edit-cp" data-toggle="tooltip" title="Edit Category" style="cursor: pointer" onclick="update_category('<?=$category['id']?>');">
				    						<i class="fa fa-edit blue-icon"></i>
				    					</div>
                                    </td>
                                    <td style="text-align: center;">
				    					<?php if($category['active'] == 1) { ?>
				    						<div class="de-active-cp" data-toggle="tooltip" title="Deactivate Category" style="cursor: pointer;" onclick="window.location = '<?=base_url()?>admin/product/categoryactive/<?=$category['id']?>'">
				                            	<i style="color: #00c717" class="fa fa-check-circle"></i>
				                            </div>
				    					<?php 
										}
				    					else
				    					{
				    					?>
				    						<div class="active-cp" data-toggle="tooltip" title="Activate Category" style="cursor: pointer" onclick="window.location = '<?=base_url()?>admin/product/categoryactive/<?=$category['id']?>'">
				                            	<i style="color: #d6d6d6" class="fa fa-check-circle"></i>
				                            </div>
				    					<?php	
				    					}
				    					?>
				    				</td>
                                    <td style="text-align: center;">
				    					<div class="delete-cp" data-toggle="tooltip" title="Delete Category" style="cursor: pointer" onclick="delete_category(<?=$category['id']?>);">
				    						<i class="fa fa-trash-o blue-icon"></i>
				    					</div>
				    				</td>
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
		
		<!-- <table class="table table-hover">
	
	    	<thead>
	
	    		<tr style="font-size: 15px" class="list-tr">
	
	    			<th style="width: 30%">Category Name</th>		
	    			<th style="width: 40%">Category Short Description</th>			    			
	    			<th style="width: 10%; text-align: center;">Edit</th>
	    			<th style="width: 10%; text-align: center;">Active</th>
	    			<th style="width: 10%; text-align: center;">Delete</th>
	
	    		</tr>
	
	    	</thead>
			
	    	<tbody>
	
	    		<?php foreach($categories as $category) { ?>
	
	    			<tr class="list-tr" id="category-<?=$category['id']?>">
	
	    				<td><?=$category['name']?> </td>
	    				<td><?=substr($category['subname'], 0,20) ?> </td>
	    				
	    				<td style="text-align: center;">
	    					<div class="edit-cp" data-toggle="tooltip" title="Edit Category" style="cursor: pointer" onclick="update_category('<?=$category['id']?>');">
	    						<i class="fa fa-edit blue-icon"></i>
	    					</div>
	    				</td>
	    				<td style="text-align: center;">
	    					<?php if($category['active'] == 1) { ?>
	    						<div class="de-active-cp" data-toggle="tooltip" title="Deactived Category" style="cursor: pointer;" onclick="window.location = '<?=base_url()?>admin/product/categoryactive/<?=$category['id']?>'">
	                            	<i style="color: #00c717" class="fa fa-check-circle"></i>
	                            </div>
	    					<?php 
							}
	    					else
	    					{
	    					?>
	    						<div class="active-cp" data-toggle="tooltip" title="Actived Category" style="cursor: pointer" onclick="window.location = '<?=base_url()?>admin/product/categoryactive/<?=$category['id']?>'">
	                            	<i style="color: #d6d6d6" class="fa fa-check-circle"></i>
	                            </div>
	    					<?php	
	    					}
	    					?>
	    				</td>
	
	    				<td style="text-align: center;">
	    					<div class="delete-cp" data-toggle="tooltip" title="Delete Category" style="cursor: pointer" onclick="delete_category(<?=$category['id']?>);">
	    						<i class="fa fa-trash-o blue-icon"></i>
	    					</div>
	    				</td>
	
	    			</tr>
	
	    		<?php }?>
	
	    	</tbody>
			
	    </table> -->
	    
	    <div style="height: 20px"></div>
	    <button class="btn btn-info" onclick="add_category()">Create A Category</button>
	</div>
</div>


<script>
function delete_category(id)
{
	choose = id;
	//alert(id);
	$j('#deleteModal').modal('show');
}
function deletecategory(id)
{
	$j('#deleteModal').modal('hide');
	//alert(id);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/deletecategory/',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			jQuery('#category-'+id).fadeOut('slow');
			jQuery('#any_message').html("This category has been successfully deleted");
			$('#anyModal').modal('show');
			
		}
	})
}

function add_category(id)
{	
	$j('#addModal').modal('show');
}
function addcategory(id)
{
	$j('#addModal').modal('hide');	
	var name_category=jQuery('#name_category').val();
	var subname_category=jQuery('#subname_category').val();
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/addcategory/',
		type: 'POST',
		data: ({name_category:name_category,subname_category:subname_category}),
		dataType: "html",
		success: function(html) {						
			window.location = '<?=base_url()?>admin/product/category';
		}
	})
}


function update_category(id)
{	
	$j('#updateModal').modal('show');
	var text ='';
	//var myTextArea = document.getElementById('update_subname_category');
	jQuery('#update_id_category').val(id);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/get_name_product_category',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {						
			jQuery('#update_name_category').val(html);
		}
	});
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/ajax/get_subname_product_category',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {						
			//jQuery('#update_subname_category').val(html);
			//myTextArea.innerHTML = html;
			text = '<textarea style="width:400px" class="form-control input-text" id="update_subname_category">'+html+'</textarea>';
			jQuery('#textarea_place').html(text);
		}
	});
}
function updatecategory()
{
	$j('#updateModal').modal('hide');	
	var name_category=jQuery('#update_name_category').val();
	var subname_category=jQuery('#update_subname_category').val();
	var id=jQuery('#update_id_category').val();
	jQuery.ajax({
		url: '<?=base_url()?>admin/product/updatecategory/',
		type: 'POST',
		data: ({id:id,name_category:name_category,subname_category:subname_category}),
		dataType: "html",
		success: function(html) {						
			window.location = '<?=base_url()?>admin/product/category';
		}
	})
}
</script>
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Delete Category</h3>
</div>
<div class="modal-body">
    <p>Are you sure to delete this category?</p>
</div>
<div class="modal-footer">
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="deletecategory(choose)">Delete</button>
</div>
</div>
</div>
</div>


<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Add Category</h3>
</div>
<div class="modal-body">
	<div class="left-side modal-label">
    	Name
    </div>
    <div class="left-side">
    	<input class="form-control input-text" type="text" id="name_category"/>
    </div>
    <div class="cleardiv" style="height:10px;"></div>
    <div class="left-side modal-label">
    	Short Description
    </div>
    <div class="left-side">
    	<textarea class="form-control input-text" id="update_subname_category"></textarea>
    </div>
    <div class="cleardiv"></div>
    
</div>
<div class="modal-footer">
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="addcategory()">Add</button>
</div>
</div>
</div>
</div>


<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Update Category</h3>
</div>
<div class="modal-body">
	<div class="left-side modal-label">
    	Name
    </div>
    <div class="left-side">
    	<input style="width:400px" class="form-control input-text" type="text" id="update_name_category"/>
    	<input style="width:400px" type="hidden" class="textfield rounded" id="update_id_category" name="update_id_category" value=""/>
    </div>
    <div class="cleardiv" style="height:10px;"></div>
    <div class="left-side modal-label">
    	Short Description
    </div>
    <div class="left-side" id="textarea_place">
    	<!-- <input class="form-control input-text" type="text" id="update_subname_category"/> -->
    	
    </div>
    <div class="cleardiv"></div>
</div>
<div class="modal-footer">
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="updatecategory()">Update</button>
</div>
</div>
</div>
</div>

<div id="anyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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