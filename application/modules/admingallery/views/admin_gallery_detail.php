<!--<link href="<?=base_url()?>assets/frontend-assets/tablelist/css/table.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/tablelist/js/function.js"></script>



<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/uploader/plupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/backend-assets/uploader/jquery.plupload.queue.js"></script>
-->






<link class="jsbin" href="<?=base_url()?>assets/css/jquery-ui-1-7-2.css" rel="stylesheet" type="text/css"></link>

<script src="<?=base_url()?>assets/js/jquery.min-1-8-0.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/jquery-ui-1-8-23.min.js" type="text/javascript"></script>


<!--<script type="text/javascript" src="<?=base_url()?>assets/nailthumb/jquery.nailthumb.1.1.js"></script>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"></link>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>


<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/jquery.lightbox-0.5.css" media="screen" />-->

<link href="<?=base_url()?>assets/css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/js/bootstrap-fileupload.js"></script>



<script>
jQuery(document).ready(function() {
//		jQuery('.nailthumb-container').nailthumb({width:175,height:100, fitDirection:'center center'});
//		jQuery('.nailthumb-container2').nailthumb({width:175,height:100, fitDirection:'center center'});
		//jQuery('.nailthumb-container').nailthumb({width:140,height:100,fitDirection:'center center'});
		
$j('#myTab a:first').tab('show');
$j('#username').editable({
    type: 'text',
    url: '<?=base_url()?>admin/gallery/ajax/update_gallery_detail',    
    pk: <?=$gallery['id']?>,    
    title: 'Enter username',
    ajaxOptions: {
        type: 'POST'
    }        
});

/*$("#uploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : '<?=base_url()?>assets/frontend-assets/tablelist/php/upload.php',
		max_file_size : '100kb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	});
*/
});
//ajax emulation
var j = jQuery.noConflict();
function modal_addimage()
{
	//jQuery('#id_story').val(jQuery('#update_id').val());
	$j('#storyTile').modal('show');
}

function add_image(){
	$('#addimage').show();$('#addvideo').hide();
}

function add_video()
{
	$('#addimage').hide();
	$('#addvideo').show();
	$('#addvideo').removeClass('hide');
}
var imgOrder = '';

jQuery(function() {
  //$j('.img_display').lightBox();
    
  jQuery("#sortable").sortable({
    update: function(event, ui) {
      imgOrder = j("#sortable").sortable('toArray').toString();
	  jQuery("#textorder").val(imgOrder);
       //document.orderimage.submit(); 
	   jQuery.ajax({
				url: '<?=base_url();?>admin/gallery/ajax/update_gallery_order',
				type: 'POST',
				data: {img_order:imgOrder},
				success: function(html) {
					if(html != 'failed'){
						location.reload();
					}else{
						alert('Failed to add new category! Please try again!!!');
						
					}
				},
				error:function(){
					alert('Something went wrong! Please try again!!!');
				}
			});	
    }
  });
  jQuery("#sortable").disableSelection();
    
});

jQuery(document).ready(function(){
  jQuery("#btnshoworder").click(function(){
      jQuery("#textorder").val(imgOrder);
       document.orderimage.submit();  
    
  });
  <? if($gallery['active_preview']==1){?>
  		$('.addthumbnails').toggle();
  <? }?>
});


</script>

 <script>
        var choose = 0;
        function deletephoto(id)
        {
        	choose = id;
        	$j('#deleteModal').modal('show');
        }
		function delete_photo(id)
		{
				var url = "<?=base_url()?>/admin/gallery/delete_photo/";
				url = url + id;
				window.location = url;
		}
		function delete_thumb(id)
		{
				var url = "<?=base_url()?>/admin/gallery/update_gallery_thumb/";
				url = url + id;
				window.location = url;
		}
		
		
		function link_change()
		{
			var ori = $('#youtube_link').val();
			var len = ori.length;
			//alert(ori);
			//alert(len);
			var backtext = ori.substr(ori.indexOf('src="')+5,len - ori.indexOf('src="'));
			//alert(backtext);
			var len_back = backtext.length;
			var middle = backtext.substr(0,backtext.indexOf('"'));
			//alert(middle);
			
			var text_link = '<iframe class="youtube-player" width="196" height="144" src="http:' + middle + '" frameborder="0" allowfullscreen></iframe>';
			//var text_link = middle;
			//alert(text_link);
			$('#youtube_preview').html(text_link);
		} 
		
		function set_thumbnail(name)
		{
			jQuery.ajax({
				url: '<?=base_url();?>admin/gallery/ajax/setthumbnail',
				type: 'POST',
				data: {gallery_id:<?=$gallery['id']?>,name:name},
				success: function(html) {
					location.reload();
				}
			});	
		}
		
		function check_preview()
		{
			$('.addthumbnails').toggle();
			jQuery.ajax({
				url: '<?=base_url();?>admin/gallery/ajax/switchstatuspreview',
				type: 'POST',
				data: {gallery_id:<?=$gallery['id']?>},
				success: function(html) {
					if(html==1){}
					else
					{
					
					}
				}
			});	
		}
		</script>
<style>
  
  #reorder-gallery {padding:0px; margin-top:20px;}
  #order-buttons {background-color:#eee; padding:10px;}
  #sortable { list-style-type: none; margin: 0; padding: 0; }
  #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: auto; height: auto; font-size: 12px; }
  #sortable li img {padding:1px; cursor: pointer; /*width:138px; height:112px;*/}
  #sortable .action-icons{padding:4px; background:#f6f6f6; border:1px solid #cdcdcd; margin-top:3px;}
  #sortable .action-icons .fa{ padding:0 10px; cursor:pointer;}
  .ui-state-default, .ui-widget-content .ui-state-default{border:none; background:none;}
  
  .clear {clear:both;}
  .fileupload {
    	margin-bottom: 0px!important;
  }
  .tab-div{
	  border-right:1px solid#ddd;
	  border-left:1px solid#ddd;
	  border-bottom:1px solid#ddd;
	  border-bottom-left-radius:3px;
	  border-bottom-right-radius:3px;
	  padding-left:15px;
	  padding-bottom:15px;
  }
  .hide{
  	display:none;
  }
  .editable-click, a.editable-click{
  	/*border-bottom:1px dashed#000;*/
	border-bottom:none!important;
  }
  .editable-click, a.editable-click, a.editable-click:hover {
  	/*border-bottom:1px dashed#000;*/
	border-bottom:none!important;
  }
  .btn-primary {
    background-color: #000;    
  }
  .btn-primary:hover {
	  background-color: #c3c3c3;    
  }
  .form-control :focus{
  		border-color:inherit!important;
  }
</style>
<? if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}?>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page"> CREATE - EDIT GALLERY</div>
        <p style="font-size:13px; font-weight:400;line-height:20px;">
        Edit existing image galleries below. You can set thumbnails, add images, remove images and add YouTube videos, <br />
		Use the <i class="fa fa-arrows"></i>  icon to drag and drop the order of images.
        </p>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/gallery';"><i class="fa fa-hand-o-left"></i> Back To Gallery List</button>
        </div>
        <!--<div class="title-page">IMAGE GALLERY DETAILS</div>-->
        
        <span class="title-page">GALLERY NAME </span> <a id="username" class="editable editable-click title-page" data-title="Enter Gallery Name" data-pk="<?=$gallery['id']?>" data-type="text" href="#" style="display: inline;margin-left:20px;"><span class="title-page" style="margin-right:10px;"><?=$gallery['title']?></span></a>
        
        (click title to edit name)
        <!--
		<form style="margin-top:20px;" name="createGalleryForm" method="post" action="<?=base_url()?>admin/gallery/update_gallery">
			<?php if ($this->session->flashdata('error_cg')) {
	            print '<span class="error">ERROR: Please enter a name for new gallery</span>';
	        } ?>
	        <input type="hidden" name="update_id" value="<?=$gallery['id']?>" />
	        <div>
				<div class="form-common-label">Image Gallery Name</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text sml-txt-box" id="title" name="title" value="<?=$gallery['title']?>"/>
					<button style="margin-top:5px;" class="btn btn-info" type="button" onclick="document.createGalleryForm.submit()">Update</button>
				</div>

			</div>
			<div class="form-common-gap">&nbsp;</div>
	                   
	        
	    </form>
	    -->
        <div style="clear:both;"></div>
        <br />
        <input type="checkbox" name="check_thumb" id="check_thumb" style="margin-top:2px;float:left; margin-right:10px;" onclick="check_preview();" <? if($gallery['active_preview']==1){echo 'checked=checked';}?>>
        <div style="float:left;margin-bottom:0px; font-weight:400; letter-spacing:normal; text-transform:none;margin-top:0px;" class="subtitle-page"> Do you want to show this gallery on the image collection page? 
        	<div style="height:8px;"></div>
        	<a href="<?=base_url()?>gallery" target="_blank"><i class="fa fa-eye"></i> Preview your <b>IMAGE GALLERY COLLECTION</b> page </a>
        </div>
        <div style="clear:both;"></div>
        
        <div class="row addthumbnails" style="display:none;">
        	<hr style="border-top:1px solid #CFCFCF;" />
			<div class="col-md-8">
                <div class="title-page" style="margin-top:0px!important;">Gallery Thumbnail</div>
                
                This thumbnail will appear on the Image Gallery Collection Page<br />
                
                <br />
                <form name="addthumbForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/gallery/add_photo">
                <input type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
                <input type="hidden" name="type" value=1 />
                <div class="subtitle-page" style="float:left;font-weight:700; letter-spacing:1.2pt;">ADD THUMBNAIL</div>
                <div class="fileupload fileupload-new" data-provides="fileupload" style="float:left; margin-top:7px; margin-left:20px;width:320px;">
                    
                    
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile"/>
                    </span>
                    <span class="fileupload-preview"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
                </div> 
                <button class="btn btn-info" type="submit" style="float:left; margin-top:7px;margin-left:10px;">
                        <i class="fa fa-plus-circle"></i> Add IMAGE
                    </button>       
                </form>
                <div style="clear:both;"></div> 
                
                	<div class="subtitle-page" style="font-weight:700; letter-spacing:1.2pt;"><i style="color: #00c717" class="fa fa-check-circle"></i> THIS GALLERY IS ACTIVE IN THE IMAGE GALLERY COLLECTION</div>
                
			</div>        
        	<div class="col-md-4" >
            	<div style="padding:8px; background:#ececec; border:1px solid #ccc; float:right;">
                	<? if($gallery['thumbnail']==0){?>
                    	<div style="width:230px;height:114px; background:#b8b7b7; border:1px solid #ccc; margin:0 auto; margin-top:10px; line-height:114px;text-align:center;"><b>NO THUMBNAIL</b>	</div>
                    <? }else{ ?>                    	
                        <div style="width:auto;height:auto; border:1px solid #ccc; margin:0 auto;"class="nailthumb-container"><img src="<?=base_url()?>uploads/<?=$folder_init?>/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$folder_pic?>/<?php print $gallery['thumb_img'];?>" /></div>                        
                    <? }?>
                </div>
                <div style="clear:both;"></div> 
                <div style="float:right; margin-top:10px;">
                	<a href="#" onclick="delete_thumb('<?=$gallery['id']?>');"><i class="fa fa-trash-o"></i> &nbsp;&nbsp;<span style="font-size:13px; font-weight:700;">REMOVE</span></a>
                </div>
                <div style="clear:both;"></div> 
            </div>
        </div>
        <div class="grey-box">
	    <button class="btn btn-info" type="button" onclick="modal_addimage()">
            <i class="fa fa-plus-circle"></i> Add IMAGE to Gallery
        </button>
        </div>
        

        <!--
        <div id="tile-home">
           <? 	
                if($gallery['thumbnail']==1)
                {
                        ?>
                            <img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" >
                        <?
                    
                }
            ?>
            
        </div>
        <div style="height: 10px; clear: both">&nbsp;</div>
        <div class="subtitle-page">Add Image</div>
        <script>
        var choose = 0;
        function deletephoto(id)
        {
        	choose = id;
        	$('#deleteModal').modal('show');
        }
		function delete_photo(id)
		{
				var url = "<?=base_url()?>/admin/gallery/delete_photo/";
				url = url + id;
				window.location = url;
		}
		</script>
		
		<div class="box">
           <?php $pid = $this->session->flashdata('addphoto_id');		        
			if ($pid) 
			{ 
			?> 
			<p>The image has been uploaded successfully!</p>
			 <?
			}
			?>
            <form name="addPhotoForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>/admin/gallery/add_photo">
	            <?php
	                if ($this->session->flashdata('error_addphoto')) 
	                {
	                    print $this->session->flashdata('error_addphoto');
	                }
	            ?>
	            <input type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
	         	Add a new photo by browsing your computer and uploading a file. <BR />The image files accepted for upload include, (.jpg , .gif , .png) ( 712 x 356 )<br>
	            The image uploaded for this gallery will not be resized<br>
	            
	            </p> 
                
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile"/>
                    </span>
                    <span class="fileupload-preview"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
               	</div>           
                <div class="grey-box">
				<button class="btn btn-info" type="button" onclick="document.addPhotoForm.submit()">Add Image</button>
            	</div>
            
            </form>
            <div style="clear:both; height:20px;"></div>
            <script>
            function link_change()
            {
                var ori = $('#youtube_link').val();
                var len = ori.length;
                //alert(ori);
                //alert(len);
                var backtext = ori.substr(ori.indexOf('src="')+5,len - ori.indexOf('src="'));
                //alert(backtext);
                var len_back = backtext.length;
                var middle = backtext.substr(0,backtext.indexOf('"'));
                //alert(middle);
                
                var text_link = '<iframe width="196" height="144" src="' + middle + '" frameborder="0" allowfullscreen></iframe>';
                //alert(text_link);
                $('#youtube_preview').html(text_link);
            } 
            </script>
            <div class="subtitle-page">Add Video</div>
            Please insert the new embed style of your youtube video
            <div style="height: 5px; clear: both">&nbsp;</div>
            <form name="addVideoForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>/admin/gallery/add_video">
                <table>
                    <tbody>
                        <tr>
                            <td><textarea class="form-control input-text" id="youtube_link" style="width:300px; height:80px;" name="link" onchange="link_change();"></textarea></td>
                            <td valign="top" style="font-size:10px; "><div id="youtube_preview">

                            </div></td>
                        </tr>
                    </tbody>
                </table>
                
                <input  type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
                <div class="grey-box">
                <button class="btn btn-info" type="button" onclick="document.addVideoForm.submit()">Add Video</button>
               	</div>
            </form>
            -->
            <div style="clear:both;"></div>
            
        	<div class="title-page" >Gallery Contents</div>
            
            
        	<div id="reorder-gallery">
            <ul id="sortable">
                <?php 
				$limit=2;
				if($setting['width']<272){$limit=3;}
                $dtphoto=array();
                if (count($photos) == 0) { print "<p>There is no photo yet</p>"; }
                else{
                for($i=0;$i<count($photos);$i++) { ?>
                <li class="ui-state-default" id="<?=$photos[$i]['id']?>" <? if($i > $limit){echo "style='margin-top:50px!important;'";}?>>
                    
                    <div style="background-color:#e8e8e8;  border:1px solid #ccc;  padding:8px;">   
                    <?php
						if($photos[$i]['video'] == 0)
						{
						?>
                        <a title="<?=$photos[$i]['title'];?>" class="img_display" href="#" style="margin:0 auto;">
                            <div class="nailthumb-container" style="margin:0 auto;width:100%;text-align:center;"><img style="margin:0 auto;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$folder_pic?>/<?php print $photos[$i]['name'];?>" /></div></a>
                        <?php
						}
						else
						{
						?>
                        	<iframe width="262" height="132" src="<?php print $photos[$i]['name'];?>" frameborder="0" allowfullscreen></iframe>
                        <?php
						}
                    ?>                	
                      </div>  
                        <div class="action-icons" style="font-size:11px;">						                   	
                            <a data-toggle="tooltip" title="Move Image">                             
                                <i class="fa fa-arrows"></i>POSITION
                            </a>                            
                            <a href="javascript:deletephoto(<?=$photos[$i]['id']?>)" data-toggle="tooltip" title="Delete Image" >                            
                                <i class="fa fa-trash-o" ></i>REMOVE
                            </a>                            
                            <a href="javascript:set_thumbnail('<?=$photos[$i]['name']?>')" data-toggle="tooltip" title="Set as Thumbnail" >                            
                                <? if($photos[$i]['name']==$gallery['thumb_img']){?> <i style="color: #00c717" class="fa fa-check-circle"></i><? }else{ ?><i style="color: #d6d6d6" class="fa fa-check-circle"></i> <? }?>THUMBNAIL
                            </a>                         
                        </div>
                         
                        
                    
                </li>                
                <?php 
                
                } }?>
            </ul>
             <div class="clear"></div>
             <br /><br /><br />
    
            <div class="clear"></div>
            <br /><br />
       
        </div>
        
        <form name="orderimage" id="orderimage" method="post" action="<?=base_url()?>admin/gallery/listorder" onsubmit="return showmessage()">
         <input type="hidden" name="idgallery" id="idgallery" value="<?=$gallery['id']?>">
        <input type="hidden" name="textorder" id="textorder">
        </form>
       <!-- </div>-->
        <div class="gallery-end"></div>
            </div>
		
	</div>
</div>





<!--begin delete -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Image / Video</h3>
            </div>
            <div class="modal-body">
                
                <p>Are you sure to delete this image/video?</p>
                <div class="cleardiv"></div>
               
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="delete_photo(choose);"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete -->

<div id="storyTile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">ADD AN IMAGE OR VIDEO TO THIS GALLERY</h3>
            </div>
            <div class="modal-body">
               
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#profile" data-toggle="tab" onclick="add_image();">ADD IMAGE</a></li>
                  <li><a href="#home" data-toggle="tab" onclick="add_video();">ADD VIDEO</a></li>
                </ul>
               <div id="addimage" class="tab-div">
               		
                    <br />
                    Add a new photo by browsing your computer and uploading a file.<br />
                    The images files accepted for upload include (.jpg, .gif, .png)<br />
                    Recommended minimum image size is 712PX wide.
                    <br />
                    <form name="addthumbForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/gallery/add_photo_ratio">
                    <input type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
                    <input type="hidden" name="type" value=0 />
                    <div class="subtitle-page" style="float:left;">ADD IMAGE</div>
                    <div class="fileupload fileupload-new" data-provides="fileupload" style="float:left; margin-top:7px; margin-left:20px;width:200px;">
                        
                        
                        <span class="btn btn-file">
                            <i class="fa fa-cloud-upload"></i>
                            <span class="fileupload-new">Select file</span>
                            <span class="fileupload-exists">Change</span>         
                            <input type="file" name="userfile"/>
                        </span>
                        <span class="fileupload-preview"></span>
                        <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
                    </div>        
                    <button class="btn btn-info" type="submit" style="float:left; margin-top:7px;margin-left:10px;">
                        <i class="fa fa-plus-circle"></i> Add IMAGE
                    </button>
                    </form>
                    <div style="clear:both;"></div> 
                    <!--
                    <div class="widget">    
                        <div class="whead"><h6>Multiple files uploader</h6></div>
                        <div id="uploader">You browser doesn't have HTML 4 support.</div>                    
                    </div>
                    -->

                    
                    
               </div>
               
               <div id="addvideo" class="tab-div hide">
            
                    <br />
                    Insert the embed code of YouTube video in the below box to add a YouTube video to this gallery
                    <br /><br />
                    <form name="addVideoForm" method="post" action="<?=base_url()?>/admin/gallery/add_video">
                        <input  type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
                        <table>
                            <tbody>
                                <tr>
                                    <td><textarea class="form-control input-text" id="youtube_link" style="width:300px; height:80px;" name="link" ></textarea></td>
                                    <td valign="top" style="font-size:10px; "><div id="youtube_preview">
        
                                    </div></td>
                                </tr>
                            </tbody>
                        </table>                                            
                        <br />
                        <button class="btn btn-info" type="submit"><i class="fa fa-plus-circle"></i>  Add Video</button>               	
            		</form>
                    <div style="clear:both;"></div> 
                    <!--
                    <div class="widget">    
                        <div class="whead"><h6>Multiple files uploader</h6></div>
                        <div id="uploader">You browser doesn't have HTML 4 support.</div>                    
                    </div>
                    -->

                    
                    
               </div>
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="delete_photo(choose);"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>




<!--
<div id="storyTile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h2 id="myModalLabel">ADD AN IMAGE OR VIDEO TO THIS GALLERY </h2>
</div>
<form name="addthumbForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/gallery/add_thumbnail">
<div class="modal-body" >

    <input type="hidden" name="id_gallery_thumb" id="id_gallery_thumb"  value="<?=$gallery['id']?>" />
    <div style="height: 5px; clear: both">&nbsp;</div>
    <div>
        <ul class="nav nav-tabs">
              <li><a href="#home" data-toggle="tab">Home</a>
              		
              </li>
              <li><a href="#profile" data-toggle="tab">Profile</a></li>
              <li><a href="#messages" data-toggle="tab">Messages</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
		</ul>
        
    </div>
    
    <div>
        
        <div style="width: 80%; float: left">						
            <button class="btn btn-primary" type="button" onclick="document.addthumbForm.submit()">Add Image</button>
        </div>
    </div>
</div>
<div class="modal-footer">
<button class="btn btn-primary" type="submit" >Save</button>
<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>

</div>
</form>
</div>
-->

