<script>
$(function() {       	
<?php if($product['multiplesize']==1){?>

jQuery('#multi_stock').show(); 
jQuery('#single_stock').hide();
<? } else {?>
jQuery('#multi_stock').hide(); 
jQuery('#single_stock').show();
<? } ?>
});
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">EDIT PRODUCT</div>
        <div class="grey-box">
			<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/product';">Back To Product List</button>
        </div>
		<div class="subtitle-page">Basic Detail</div>
		<form id="addProduct" enctype="multipart/form-data" method="post" action="<?=base_url()?>admin/product/details/<?=$product['id'];?>">
			<input type="hidden" name="id" value="<?=$product['id']?>" />
			<div>
				<div class="form-common-label">Name</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="title" name="title" value="<?=$product['title']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Short Description</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="short_desc" name="short_desc" value="<?=$product['short_desc']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Long Description</div>
				<div class="form-common-input">
					
					<textarea class="form-control input-text" id="long_desc" name="long_desc" rows="3"><?=$product['long_desc']?></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			
			<div>
				<div class="form-common-label">Features</div>
				<div class="form-common-input">
					
					<textarea class="form-control input-text" id="features" name="features" rows="3"><?=$product['features']?></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Technical Informations</div>
				<div class="form-common-input">
					
					<textarea class="form-control input-text" id="tech_info" name="tech_info" rows="3"><?=$product['technical_information']?></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            
            
			<div>
				<div class="form-common-label">Available <?=$product['status']?></div>
				<div class="form-common-input">
					<!--<input type="checkbox" class="textfield rounded" id="status" name="status" value="1" <? if($product['status']==1){?> checked="checked"<? }?> />-->
                    <div id="uniform-check2S" class="checker" style="margin-top:8px;" onclick="checker_checked(<?=$product['id']?>)">
                            <span class="spancheck_product <? if($product['status']==1){?> checked<? }?>" id="spanchecker<?=$product['id']?>">
                                <input type="checkbox" id="status" name="status" value="1" class="check check_product checker<?=$product['id']?>" <? if($product['status']==1){?> checked="checked"<? }?> />
                            </span>
                     </div>
				</div>
				
			</div>
            
            <div class="form-common-gap">&nbsp;</div>
            
            <div>
				<div class="form-common-label">Current Document</div>
				<div class="form-common-input">
					
					<?=$product['pdf_url']?>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            
            <div>
				<div class="form-common-label">Replace Document</div>
				<div class="form-common-input">
					
					<div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append">
                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                    </div>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            
            
            <button class="btn btn-info" type="submit">Update</button>
		</form>
	</div>
</div>



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
function nothing()
{
	
}
function remove_att(id)
{
	$('#att-'+id).remove();
}
function add_att()
{
	var id = $('#attribute').val();
	var out = '';
	$.ajax({
			url: '<?=base_url()?>admin/cms/get_product_att/',
			type: 'POST',
			data: ({id:id}),
			dataType: "html",
			success: function(html) {
				//alert(html);
				out += '<div id="att-'+id+'" style="margin-bottom:1px" class="alert alert-info">';
				out += '<input type="hidden" name="attributes[]" value="'+id+'">';
				out += '<button onclick="remove_att('+id+')" type="button" class="close">&times;</button>';
				out += html;
				out += '</div>';
				$('#all_att').append(out);
			}
	});
}
</script>