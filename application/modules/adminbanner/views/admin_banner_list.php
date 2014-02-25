<link class="jsbin" href="<?=base_url()?>assets/css/jquery-ui-1-7-2.css" rel="stylesheet" type="text/css"></link>

<script>

var imgOrder = '';

$(function() {
 // j('.img_display').lightBox();
  //j('footer') .hide(); 
  $j("#sortable").sortable({  	
  	revert: true,
    cancel: "#sortable li input",
	update: function(event, ui) {
      imgOrder = j("#sortable").sortable('toArray').toString();
	  $("#textorder").val(imgOrder);
       document.orderimage.submit(); 
    }
  });
  //j("#sortable").disableSelection();
    
});

$(document).ready(function(){
  $("#btnshoworder").click(function(){
      $("#textorder").val(imgOrder);
       document.orderimage.submit();  
    
  });
  //jQuery('#sortable').sortable("disable");
});
function remove_banner(id)
{
	jQuery.ajax({
		url: '<?=base_url()?>admin/banner/ajax/delete',	
		type: 'POST',	
		data: ({id:id}),	
		dataType: "html",
		success: function(html) {
			jQuery('#'+id).fadeOut();
		}
	});
}

function toggle_banner(id)
{
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/banner/ajax/toggle',	
		type: 'POST',	
		data: ({id:id}),	
		dataType: "html",
		success: function(html) {
			if(html==1){
				jQuery('#status'+id).addClass('active-banner');
				jQuery('#status'+id).removeClass('nonactive-banner');
			}
			else
			{
				jQuery('#status'+id).addClass('nonactive-banner');
				jQuery('#status'+id).removeClass('active-banner');
			}

		}
	});
}

function edit()
{
	jQuery('.sortable').disableSelection();
	alert('test');
}

function update_link(id)
{
	var url = jQuery('#url'+id).val();
	jQuery.ajax({
		url: '<?=base_url()?>admin/banner/ajax/update',	
		type: 'POST',	
		data: ({id:id,url:url}),	
		dataType: "html",
		success: function(html) {
			jQuery('#url'+id).animate({ backgroundColor: "#00c717" }, 250,
	function(){

		jQuery( "#url"+id ).animate({ backgroundColor: "#FFF" }, 250);
	});
		}
	});
}
</script>
<style>
  
  #reorder-gallery {padding:0px;  margin-top:20px;}
  #order-buttons {background-color:#eee; padding:10px;}
  #sortable { list-style-type: none; margin: 0; padding: 0; }
  #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; font-size: 12px; text-align: center; }
  #sortable li img {padding:1px; cursor: pointer; width:100%;/*width:138px; height:112px;*/}
  
  .ui-state-default, .ui-widget-content .ui-state-default{border:none; background:none;}
  
  .clear {clear:both;}
  .fileupload {
    	margin-bottom: 0px!important;
  }
  .article-input{width:45%;}
  .article-txt-box {width:33%;}
  .active-banner{ color: #00c717;}
  .nonactive-banner{ color: #D6D6D6;}
  
  .article-txt-box {
    border: 1px solid #CCCCCC;
    height: 32px;
    padding: 4px;
    width: 80%;
	margin-left:20px;
	margin-top:8px;
	float:left;
  }
  .add-on {margin-left:-40px; float:left;margin-top:9px;background-color: #e9e9e9;padding: 7px 14px 6px 14px;}
	
</style>

<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div>
			<!-- start here -->
			<?php if($this->session->flashdata('error_upload')) { ?>
			    <div class="alert alert-error">
			    	<button type="button" class="close" onclick="$j('.alert-error').fadeOut('slow');">&times;</button>
					<strong>ERROR! </strong><?=$this->session->flashdata('error_upload')?>
				</div>
			<?php }?>					
		</div>
		<div class="title-page">MANAGE BANNERS</div>
        <div class="sub-title">Add a new image banner by browsing your computer and uploading a file. The image files accepted for upload include, (.jpg , .gif , .png) 
Enter a web link in the space provided to create a click through for you image. Images can be published and unpublished by clicking the tick icon. To delete a banner click the trash can icon.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="$j('#newbannerModal').modal('show');"><i class="fa fa-plus"></i> ADD NEW BANNER</button>
        </div>		
		<div style="clear: both"></div>
        <div class="grey-box">
        	<div class="title-page">YOUR BANNERS</div>
        </div>	
        <div class="sub-title">Drag and drop by holding the <i class="fa fa-move blue-icon "></i> icon to change the order the images are displayed.</div>
        <br>
        <div id="reorder-gallery">
        <ul id="sortable" class="items">
		<?
        	foreach($banners as $banner)
			{
				?>
                <li class="ui-state-default" id="<?=$banner['id']?>">
                    <div style="float:left; border:1px solid #cccccc; padding:15px; background:#fdfdfd;">
                        <img src="<?=base_url()?>uploads/banners/<?=$banner['name']?>">
                    	<div style="float:left; margin-top:15px;">
                        	<i class="fa fa-move blue-icon" style="margin-right:15px;"></i>
                            <a style="cursor:pointer;" onclick="remove_banner('<?=$banner['id']?>');"><i class="fa fa-trash-o blue-icon" style="margin-right:15px;"></i></a>
                            <a style="cursor:pointer;" onclick="toggle_banner('<?=$banner['id']?>');"><i id="status<?=$banner['id']?>" class="fa fa-check-circle <? if($banner['actived']==1){ echo " active-banner ";}else {echo " nonactive-banner ";}?> "></i></a>
                        </div>
                        <div style="clear:both;"></div>
                        <div style="float:left;margin-top:15px;">Web Link (URL)	 </div>
                        
                        <div class="article-input" style="float:left;">
                            <input id="url<?=$banner['id']?>" name="url" class="article-txt-box " type="text" value="<?=$banner['url']?>" >
                            <a style="cursor:pointer;" onclick="update_link(<?=$banner['id']?>)"><span class="add-on grey-bg"><i class="fa fa-floppy-o"></i></span></a>
                            
                        </div>
                        
                        <div style="float:right; margin-top:15px;"><i class="fa fa-eye"></i>  Banner Views  <span style="font-weight:800; margin-right:20px;"><?=$banner['view']?></span><i class="fa fa-hand-o-up"></i> Banner Clicks <span style="font-weight:800; margin-right:20px;"><?=$banner['hit']?></span></div>
                    </div>
                    <div style="clear:both;"></div>
                </li>
                <?
			}
		?>
        </ul>
        <form name="orderimage" id="orderimage" method="post" action="<?=base_url()?>admin/banner/listorder" ><input type="hidden" name="textorder" id="textorder"></form>
        </div>
    </div>	   
</div>
<script>
function check_add_banner()
{
	jQuery('#add-banner-form').submit();	
}
</script>

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

<div id="newbannerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            	<h3 id="myModalLabel">Add New Banner</h3>
            </div>
            <div class="modal-body">
                <form id="add-banner-form" enctype="multipart/form-data" method="post" action="<?=base_url()?>/admin/banner/add">
                    <div class="left-side modal-label">Web Link (URL)</div>
                    <div class="left-side" style="width: 70%"><input class="form-control input-text" type="text" id="web_link" name="web_link" value="http://"/></div>
                    <div class="cleardiv" style="height:10px"></div>
                    
                    <div class="left-side modal-label">Upload File</div>
                    <div class="left-side" style="width: 70%">                    
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
            	<button class="btn btn-info" onclick="check_add_banner();">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="editbannerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    	        <h3 id="myModalLabel">Edit File</h3>
            </div>
            <div class="modal-body">
                <form id="edit-banner-form" enctype="multipart/form-data" method="post" action="<?=base_url()?>/admin/banner/update">
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
            	<button class="btn btn-info" onclick="jQuery('#edit-banner-form').submit();">Edit</button>
            </div>
        </div>
    </div>
</div>

<div id="deletebannerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
    	        <h3 id="myModalLabel" class="title-page">Delete Banner</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this bannner?</p>
            </div>
            <div class="modal-footer">
        	    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            	<button class="btn btn-info" onclick="deletebanner(choose)">Delete</button>
            </div>
        </div>
    </div>
</div>
