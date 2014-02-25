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
			<?php if($this->session->flashdata('error_upload')) { ?>
			    <div class="alert alert-error">
			    	<button type="button" class="close" onclick="$('.alert-error').fadeOut('slow');">&times;</button>
					<strong>ERROR! </strong><?=$this->session->flashdata('error_upload')?>
				</div>
			<?php }?>
			<?php if($this->session->flashdata('upload_csv_sc')) { ?>
			    <div class="alert alert-success">
			    	<button type="button" class="close" onclick="$('.alert-success').fadeOut('slow');">&times;</button>
					<strong>SUCCESS! </strong><?=$this->session->flashdata('upload_csv_sc')?>
				</div>
			<?php }?>
			
		</div>
		<div class="title-page">MANAGE FILES</div>
        <div class="sub-title">Upload new file or edit and manage existing files.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="$j('#newpageModal').modal('show');"><i class="fa fa-plus"></i> Add New Files</button>
        </div>
		<!-- <button class="btn btn-info" onclick="export_csv();"><i class="icon-upload"></i>&nbsp;Export Product</button>
		<button class="btn btn-info" onclick="$('#importModal').modal('show');"><i class="icon-download"></i>&nbsp;Import Product</button> -->
		<!-- <div class="subtitle-page">Search Files</div> -->
		<!-- <form id="addProduct" method="post" action="<?=base_url()?>admin/file/search">
			<div class="form-search-label">File Name</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="keyword" value=""/>
				
			</div>
			
			
			<div class="form-search-gap"></div>
			
			<div class="form-search-label">&nbsp;</div>
			<div class="form-search-input">
				<button class="btn btn-info" onclick=""><i class="fa fa-search"></i> Search</button>
			</div>
			
			
			<div class="form-search-gap"></div>
			
		</form> -->
		<div style="clear: both"></div>
		
		
		<div id="tablelist">
        <!-- Table List START -->
        <div id="content">            
            <!-- Main content -->
            <div class="wrapper">                            
                <!-- Table with hidden toolbar -->
                <div class="widget">
                    <div class="whead"><h6>FILE LIST</h6></div>
                    <div id="dyn" class="hiddenpars">
                        <a class="tOptions" title="Options"><i class="fa fa-cogs fa-4 black" style="font-size:23px;"></i></a>
                        <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            <th>FILE NAME <i class="fa fa-sort-alpha-asc sort-icon" ></i><span class="sorting" style="display: block;"></span></th>
                            <th style="text-align:center;">PREVIEW </th>
                            <th style="text-align:center;">EDIT </th>
                            <th style="text-align:center;">DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? foreach($files as $file) {
                            	
                            ?>
                                <tr class="gradeA" id="file<?=$file['id']?>">
                                    <td><?=$file['name']?> (<a href="<?=base_url()?>uploads/files/<?=$file['url']?>"><?=$file['url']?></a>)</td>
                                    <td>
                                    	<div class="all_tt center_icon" data-toggle="tooltip" title="Preview" onclick=""><a target="_blank" href="<?=base_url()?>uploads/files/<?=$file['url']?>"><i class="fa fa-search blue-icon"></i></a></div>
                                    </td>
                                    <td style="text-align:center;">
                                    	<div class="all_tt center_icon" data-toggle="tooltip" title="Edit" onclick=""><a href="javascript:edit_file(<?=$file['id']?>);"><i class="fa fa-edit blue-icon"></i></a></div>
				    				</td>
                                    <td class="center" style="text-align:center;">
                                    	<div onclick="delete_file(<?=$file['id']?>);" class="all_tt center_icon" data-toggle="tooltip" title="Delete" onclick=""><i class="fa fa-trash-o blue-icon"></i></div>
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

	    		<tr class="list-tr" style="font-size: 12px" id="list-header-title">
					<th style="width: 3%; font-size: 12px !important">&nbsp;</th>
	    			<th style="width: 69.5%; font-size: 12px !important">FILE NAME</th>
	    			<th style="width: 7.25%; text-align: center; font-size: 12px !important">PREVIEW</th>
	    			<th style="width: 7.25%; text-align: center; font-size: 12px !important">EDIT</th>
	    			<th style="width: 7.25%; text-align: center; font-size: 12px !important">DELETE</th>
	    		</tr>
	    		
	    	</thead>
	    	<tbody>
	    		<?
	    		foreach($files as $file)
				{
				?>
				<tr class="list-tr" id="page-<?=$file['id']?>">
					<td>&nbsp;</td>
					<td>
						<?=$file['name']?> (<a href="<?=base_url()?>uploads/files/<?=$file['url']?>"><?=$file['url']?></a>)
					</td>
					<td>
						<div class="all_tt center_icon" data-toggle="tooltip" title="Preview" onclick=""><a href="<?=base_url()?>uploads/files/<?=$file['url']?>"><i class="fa fa-search blue-icon"></i></a></div>
					</td>
					<td>
						<div class="all_tt center_icon" data-toggle="tooltip" title="Edit" onclick=""><a href="javascript:edit_file(<?=$file['id']?>);"><i class="fa fa-edit blue-icon"></i></a></div>
					</td>
					
					<td>
						<div onclick="delete_file(<?=$file['id']?>);" class="all_tt center_icon" data-toggle="tooltip" title="Delete" onclick=""><i class="fa fa-trash-o blue-icon"></i></div>
					</td>
				</tr>
				<?
				}
	    		?>
	    	</tbody>
	</table> -->
    
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
		dataType: "html",
		success: function(html) {
			//getpages();
			$j('#newpageModal').modal('hide');
			//getpages();
			
			location.reload(); 
		}
	})	
}

function edit_file(id)
{
	choose = id;	
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/file/ajax/get_name',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			$('#edit_name').val(html);
			
		}
	});
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/file/ajax/get_url',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			$('#edit_filename').html('<a href="<?=base_url()?>uploads/files/'+html+'">'+html+'</a>');
			
		}
	});
	$('#file_id').val(id);
	$j('#editfileModal').modal('show');
}

function delete_file(id)
{
	choose = id;	
	$j('#deleteModal').modal('show');
}
function deletepage(id)
{
	$j('#deleteModal').modal('hide');	
	jQuery.ajax({
		url: '<?=base_url()?>admin/file/delete/'+id,
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

function check_add_file()
{
	var name = jQuery('#name_new').val();
	if(name == '')
	{
		jQuery('#any_message').html('Please insert a file name');
		$j('#anyModal').modal('show');
	}
	else
	{
		jQuery('#add-file-form').submit();
	}
}
</script>

<div id="newpageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel">Add New File</h3>
</div>
<div class="modal-body">
    <form id="add-file-form" enctype="multipart/form-data" method="post" action="<?=base_url()?>/admin/file/add">
		<div class="left-side modal-label">
	    	File Name
	    </div>
	    <div class="left-side" style="width: 70%">
	    	<input class="form-control input-text" type="text" id="name_new" name="filename" value=""/>
	    </div>
	    <div class="cleardiv" style="height:10px"></div>
	    
	    <div class="left-side modal-label">
	    	Upload File
	    </div>
	    <div class="left-side" style="width: 70%">
	    	<!-- <div class="fileupload fileupload-new" data-provides="fileupload">
		    <div class="input-append">
		    <div class="uneditable-input span3"><i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
		    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
		    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		    </div>
		    </div> -->
		    
		    <div class="fileupload fileupload-new article-upload-field" data-provides="fileupload" style="width: 100%">
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile"/>
                    </span>
                    <span class="fileupload-preview" style="margin-right: 10px; width:210px"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
               	    </div>
	    </div>
	    <div class="cleardiv"></div>
    </form>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="check_add_file();">Save</button>
</div>
</div>
</div>
</div>

<div id="editfileModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel">Edit File</h3>
</div>
<div class="modal-body">
    <form id="edit-file-form" enctype="multipart/form-data" method="post" action="<?=base_url()?>/admin/file/update">
    	<input type="hidden" name="file_id" id="file_id" >
		<div class="left-side modal-label">
	    	File Name
	    </div>
	    <div class="left-side" style="width: 70%">
	    	<input class="form-control input-text" type="text" id="edit_name" name="filename" value=""/>
	    </div>
	    <div class="cleardiv" style="height:10px"></div>
	    
	    <div class="left-side modal-label">
	    	Current File
	    </div>
	    <div class="left-side" style="width: 70%" id="edit_filename">
	    	
	    </div>
	    <div class="cleardiv" style="height:10px"></div>
	    
	    <div class="left-side modal-label">
	    	Upload File
	    </div>
	    <div class="left-side" style="width: 70%">
	    	<div class="fileupload fileupload-new" data-provides="fileupload">
		    <div class="input-append">
		    <div class="uneditable-input span3"><i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
		    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
		    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
		    </div>
		    </div>
	    </div>
	    <div class="cleardiv"></div>
    </form>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-info" onclick="jQuery('#edit-file-form').submit();">Edit</button>
</div>
</div>
</div>
</div>

<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Delete File</h3>
</div>
<div class="modal-body">
    <p>Are you sure to delete this file?</p>
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