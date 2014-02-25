<link href="<?=base_url()?>assets/backend-assets/template/css/table.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/tablelist/js/function.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/forms/jquery.select2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/forms/jquery.uniform.js"></script>


<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/template/js/plugins/tables/jquery.resizable.js"></script>

<script>

</script>
<style>
.wrapper{
	margin:0px!important;
}
#tablelist #content{

margin-left:0px!important}
</style>
<script>
jQuery(function() {
	jQuery('.all_tt').tooltip({
		showURL: false
	});
});
</script>
<style>
h1{
	font-weight : 900;
	font-size:20px!important;
}
.center_icon{
	cursor: pointer; text-align: center;
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
		<div class="title-page">MANAGE PAGES</div>
        <div class="sub-title">Create new page or edit and manage existing pages.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="$j('#newpageModal').modal('show');"><i class="fa fa-plus"></i> Add New Pages</button>
        </div>
		<!-- <button class="btn btn-info" onclick="export_csv();"><i class="icon-upload"></i>&nbsp;Export Product</button>
		<button class="btn btn-info" onclick="$('#importModal').modal('show');"><i class="icon-download"></i>&nbsp;Import Product</button> -->
		
		<div id="tablelist">
        <!-- Table List START -->
        <div id="content">            
            <!-- Main content -->
            <div class="wrapper">                            
                <!-- Table with hidden toolbar -->
                <div class="widget">
                    <div class="whead"><h6>PAGE LIST</h6></div>
                    <div id="dyn" class="hiddenpars">
                        <a class="tOptions" title="Options"><i class="fa fa-cogs fa-4 black" style="font-size:23px;"></i></a>
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            <th>PAGE TITLE <i class="fa fa-sort-alpha-asc sort-icon" ></i><span class="sorting" style="display: block;"></span></th>
                            <th style="text-align:center;">PREVIEW </th>
                            <th style="text-align:center;">EDIT </th>
                            <th style="text-align:center;">COPY </th>
                            <th style="text-align:center;">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach($pages as $page) {
                            ?>
                                <tr class="gradeA" id="page<?=$page['id']?>">
                                    <td><?=$page['title']?></td>
                                    <td style="text-align:center;">
                                    	<div class="all_tt center_icon" data-toggle="tooltip" title="Preview" onclick=""><a target="_blank" href="<?=base_url()?>page/<?=$page['id_title']?>"><i class="fa fa-search blue-icon"></i></a></div>
                                    </td>
                                    <td style="text-align:center;">
                                    	<div class="all_tt center_icon" data-toggle="tooltip" title="Edit" onclick=""><a href="<?=base_url()?>admin/page/edit/<?=$page['id']?>"><i class="fa fa-edit blue-icon"></i></a></div>
                                    </td>
                                    <td style="text-align: center;">
				    					<div onclick="copy_page(<?=$page['id']?>);" class="all_tt center_icon" data-toggle="tooltip" title="Copy" onclick=""><i class="fa fa-share blue-icon"></i></div>
				    				</td>
                                    <td style="text-align: center;">
				    					<div onclick="delete_page(<?=$page['id']?>);" class="all_tt center_icon" data-toggle="tooltip" title="Delete" onclick=""><i class="fa fa-trash-o blue-icon"></i></div>
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
var choose=0;
function addnewpage()
{
	var title = $('#name_new').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/page/add',
		type: 'POST',
		data: ({title:title}),
		success: function(html) {
			//getpages();
			$j('#newpageModal').modal('hide');
			//getpages();
			
			location.reload(); 
		}
	})	
}

function delete_page(id)
{
	choose = id;	
	$j('#deleteModal').modal('show');
}
function deletepage(id)
{
	$j('#deleteModal').modal('hide');	
	jQuery.ajax({
		url: '<?=base_url()?>admin/page/delete/'+id,
		type: 'POST',
		//data: (),
		dataType: "html",
		success: function(html) {
			jQuery('#page-'+id).fadeOut('slow');
			//jQuery('#any_message').html("This product has been successfully deleted");
			//$('#anyModal').modal('show');
			
		}
	})
}

function copy_page(product_id)
{
	choose = product_id;
	$('#new_product_name').val('');
	$j('#copyModal').modal('show');
}

function duplicate_page()
{
	$j('#copyModal').modal('hide');
	var new_name = $('#new_product_name').val();
	//alert(new_name);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/page/duplicate/',
		type: 'POST',
		data: ({id:choose,name:new_name}),
		dataType: "html",
		success: function(html) {
			if(html != 0)
			{
				//window.location = "<?=base_url()?>admin/product/details/"+html;
				location.reload(); 
			}
			else
			{
				jQuery('#any_message').html("This name has already exist in the list");
				$j('#anyModal').modal('show');
			}
		}
	});
}
</script>

<div id="newpageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel">Add New Page</h3>
</div>
<div class="modal-body">
    
	<div class="left-side modal-label">
    	Page Title
    </div>
    <div class="left-side">
    	<input class="form-control input-text" type="text" id="name_new" value=""/>
    </div>
    <div class="cleardiv"></div>
   
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="addnewpage();">Save</button>
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
<button class="btn btn-info" onclick="deletepage(choose)">Delete</button>
</div>
</div>
</div>
</div>

<div id="copyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Copy Page</h3>
</div>
<div class="modal-body">
	<div class="left-side modal-label">
    	New Page Title
    </div>
    <div class="left-side">
    	<input class="form-control input-text" type="text" id="new_product_name"/>
    </div>
    <div class="cleardiv"></div>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="duplicate_page();">Copy</button>
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