<script>
jQuery(function() {
	jQuery('.all_tt').tooltip({
		showURL: false
	});
});
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
</style>
<script>
var choose = 0;
var check = 0;
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div>
			<!-- start here -->
			<?php if($this->session->flashdata('update_error')) { ?>
			    
				<div class="alert alert-danger alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>ERROR! </strong><?=$this->session->flashdata('update_error')?>
				</div>

			<?php }?>
			<?php if($this->session->flashdata('upload_csv_sc')) { ?>
			    <div class="alert alert-success">
			    	<button type="button" class="close" onclick="$('.alert-success').fadeOut('slow');">&times;</button>
					<strong>SUCCESS! </strong><?=$this->session->flashdata('upload_csv_sc')?>
				</div>
			<?php }?>
			
		</div>
		<div class="title-page">EDIT PAGE</div>
        <div class="grey-box">
		<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/page';"><i class="fa fa-hand-o-left"></i> Back To Page List</button>
        </div>
		<div class="subtitle-page">Basic Detail</div>
		<form id="addProduct" method="post" action="<?=base_url()?>admin/page/update_page/<?=$page['id'];?>">
			<input type="hidden" name="id" value="<?=$page['id']?>" />
			<div>
				<div class="form-common-label">Title</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="title" name="title" value="<?=$page['title']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Link Title <span style="font-size: 10px">(No space,'/','&amp;')</span></div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="id_title" name="id_title" value="<?=$page['id_title']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Meta Title</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="meta_title" name="meta_title" value="<?=$page['meta_title']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Meta Description</div>
				<div class="form-common-input">
					
					<textarea class="form-control input-text" id="meta_description" name="meta_description" rows="3"><?=$page['meta_description']?></textarea>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <div>
            	<div class="form-common-label">Gallery</div>
				<div class="form-common-input">
					<select class="custom-select" id="gallery_id" name="gallery_id">
	                   <?=$this->page_model->load_gallery_options($page['gallery']);?>
					</select>  
				</div>
            </div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Right Bar</div>
				<div class="form-common-input">
					<input type="checkbox" value="1" name="right_bar" <?php if($page['right_bar'] == 1) {echo "checked='checked'";}?>/>
                    
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            <div class="form-common-gap">&nbsp;</div>
            <div class="form-common-gap">&nbsp;</div>
            <textarea style="height: 1000px" class="ckeditor" name="content_text"><?=$page['content']?></textarea>
            <div class="form-common-gap">&nbsp;</div>
            <div class="form-common-gap">&nbsp;</div>
            <div class="form-common-gap">&nbsp;</div>
            
            <button class="btn btn-info" type="submit">Update</button>

		</form>
	
    </div>
</div>


<script>

	var editor = CKEDITOR.replace( 'content_text' );

	CKFinder.setupCKEditor( editor, '<?=base_url()?>assets/ckfinder/' );

</script>

<script>
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
			$('#newpageModal').modal('hide');
			location.reload(); 
		}
	})	
}

function delete_page(id)
{
	choose = id;	
	$('#deleteModal').modal('show');
}
function deletepage(id)
{
	$('#deleteModal').modal('hide');	
	jQuery.ajax({
		url: '<?=base_url()?>admin/page/delete/'+id,
		type: 'POST',		
		dataType: "html",
		success: function(html) {
			jQuery('#page-'+id).fadeOut('slow');
		
			
		}
	})
}

function copy_page(product_id)
{
	choose = product_id;
	$('#new_product_name').val('');
	$('#copyModal').modal('show');
}

function duplicate_page()
{
	$('#copyModal').modal('hide');
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
				$('#anyModal').modal('show');
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