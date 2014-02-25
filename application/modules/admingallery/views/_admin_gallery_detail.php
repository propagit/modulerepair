<link class="jsbin" href="<?=base_url()?>css/jquery-ui-1-7-2.css" rel="stylesheet" type="text/css"></link>

<script src="<?=base_url()?>js/jquery.min-1-8-0.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery-ui-1-8-23.min.js" type="text/javascript"></script>


<script type="text/javascript" src="<?=base_url()?>js/nailthumb/jquery.nailthumb.1.1.js"></script>
<!--<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"></link>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>
-->
<script type="text/javascript" src="<?=base_url()?>js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.lightbox-0.5.css" media="screen" />

<link href="<?=base_url()?>css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>js/bootstrap-fileupload.js"></script>

<script>
jQuery(document).ready(function() {
//		jQuery('.nailthumb-container').nailthumb({width:175,height:100, fitDirection:'center center'});
//		jQuery('.nailthumb-container2').nailthumb({width:175,height:100, fitDirection:'center center'});
		//jQuery('.nailthumb-container').nailthumb({width:140,height:100,fitDirection:'center center'});
});


var j = jQuery.noConflict();

var imgOrder = '';

j(function() {
  j('.img_display').lightBox();
    
  j("#sortable").sortable({
    update: function(event, ui) {
      imgOrder = j("#sortable").sortable('toArray').toString();
	  j("#textorder").val(imgOrder);
       document.orderimage.submit(); 
    }
  });
  j("#sortable").disableSelection();
    
});

j(document).ready(function(){
  j("#btnshoworder").click(function(){
      j("#textorder").val(imgOrder);
       document.orderimage.submit();  
    
  });
});

</script>
<style>
  
  #reorder-gallery {padding:0px; border:1px solid #eee; margin-top:20px;}
  #order-buttons {background-color:#eee; padding:10px;}
  #sortable { list-style-type: none; margin: 0; padding: 0; }
  #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 273px; height: 150px; font-size: 12px; text-align: center; }
  #sortable li img {padding:1px; cursor: pointer; /*width:138px; height:112px;*/}
  
  .ui-state-default, .ui-widget-content .ui-state-default{border:none; background:none;}
  
  .clear {clear:both;}
  .fileupload {
    	margin-bottom: 0px!important;
  }
</style>

<div class="span9">

	<div style="min-height: 433px; border: 1px solid #d6d6d6; border-radius: 5px; margin-right: 19px;">

		<div style="padding: 20px">

			<!-- start here -->
			<h1>Edit Gallery</h1>
            <button class="btn btn-primary" onclick="window.location = '<?=base_url()?>admin/gallery/galleries';">Back To Gallery List</button>
			<form style="margin-top:20px;" name="createGalleryForm" method="post" action="<?=base_url()?>admin/gallery/update_gallery">
				<?php if ($this->session->flashdata('error_cg')) {
                    print '<span class="error">ERROR: Please enter a name for new gallery</span>';
                } ?>
                <input type="hidden" name="update_id" value="<?=$gallery['id']?>" />
                <div>
                	<div style="width: 20%; float: left; height: 30px; line-height: 30px;">Image Gallery Name</div>
                    <div style="width: 80%; float: right">						                        
                        <input style="width: 75%" class="textfield rounded" type="text" name="title" value="<?=$gallery['title']?>" />
                        <button style="margin-top:-10px;" class="btn btn-primary" type="button" onclick="document.createGalleryForm.submit()">Update</button>
                    </div>
            	</div>
            	<div style="height:1px;clear: both">&nbsp;</div>                
                
            </form>
            
            <div style="float:none;">
                        <div style="float:left;">
                           <h2>Add Thumbnail Gallery </h2>
                           The image uploaded for this gallery will be a thumbnail <br><br>
                            <button class="btn btn-primary" type="button" onclick="modal_tile()">
                                Add Thumbnail
                            </button>
                        </div>
                        <div style="float:right; margin-top:20px;">
                            
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
                        </div>
            </div>
            <div style="height:10px;clear: both">&nbsp;</div> 
            <h2>Add Image</h2>
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
            <div style="height: 5px; clear: both">&nbsp;</div>
            <div>
                
                <div style="width: 80%; float: left">                    
                    <!--<input style="width: 97%" class="textfield rounded" type="file" name="userfile" />-->
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append">
                    <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
                    <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
                    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                    </div>
                    </div>
                </div>
            </div>

            <div>
                
                <div style="width: 80%; float: left">						
                    <button class="btn btn-primary" type="button" onclick="document.addPhotoForm.submit()">Add Image</button>
                </div>
            </div>
            <!--<a href="#"><input type="button" class="button rounded" value="Add Image" onClick="document.addPhotoForm.submit()" /></a>-->
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
            <h2>Add Video</h2>
            Please insert the new embed style of your youtube video
            <div style="height: 5px; clear: both">&nbsp;</div>
            <form name="addVideoForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>/admin/gallery/add_video">
                <table>
                    <tbody>
                        <tr>
                            <td><textarea id="youtube_link" style="width:300px; height:80px;" name="link" onchange="link_change();"></textarea></td>
                            <td valign="top" style="font-size:10px; "><div id="youtube_preview">

                            </div></td>
                        </tr>
                    </tbody>
                </table>
                
                <input  type="hidden" name="gallery_id" value="<?=$gallery['id']?>" />
                <div style="clear:both;"></div>
                <div>
                    
                    <div style="width: 80%; float: left">						
                        <button class="btn btn-primary" type="button" onclick="document.addVideoForm.submit()">Add Video</button>
                    </div>
            	</div>
               
            </form>
            <div style="clear:both; height:15px;"></div>
            
         	<div class="divide-hr-line"></div>  
        	
        	<div id="reorder-gallery">
            <ul id="sortable">
                <?php 
                $dtphoto=array();
                if (count($photos) == 0) { print "<p>There is no photo yet</p>"; }
                else
                for($i=0;$i<count($photos);$i++) { ?>
                <li class="ui-state-default" id="<?=$photos[$i]['id']?>" <? if($i > 1){echo "style='margin-top:70px!important;'";}?>>
                    
                    <div style="background-color:#fff;  border:1px solid #ccc;  padding:3px;">   
                    <?php
						if($photos[$i]['video'] == 0)
						{
						?>
                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display">
                        	<!--<img src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" /></a>-->
                            <div class="nailthumb-container"><img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/thumbnails/<?php print $photos[$i]['name'];?>" /></div>
                        <?php
						}
						else
						{
						?>
                        	<iframe width="140" height="120" src="<?php print $photos[$i]['name'];?>" frameborder="0" allowfullscreen></iframe>
                        <?php
						}
                    ?>                	
                        
                        <div style="padding-top:10px;">						                   	
                        <a data-toggle="tooltip" title="Move Image">                             
                            <i class="icon-move icon-3x" style="border:1px solid #ccc;width:35px; height:41px; padding-left:15px;padding-right:15px; padding-top:6px; padding-bottom:6px;"></i>
                        </a>
                        
                        <a href="javascript:deletephoto(<?=$photos[$i]['id']?>)"  data-toggle="tooltip" title="Delete Image">                            
                            <i class="icon-trash icon-3x" style=" border:1px solid #ccc;width:35px; height:41px; padding-left:15px;padding-right:15px; padding-top:6px; padding-bottom:6px;"></i>
                        </a>
                         
                        </div>
                         Drag to change order of images
                        
                    </div>
                </li>                
                <?php 
                
                } ?>
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
            <!-- end here -->
        </div>
        
            
    </div>
</div>


<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Delete Image / Video</h3>
</div>
<div class="modal-body">
    <p>Are you sure to delete this image/video?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" onclick="delete_photo(choose)">Delete</button>

</div>
</div>
<div id="storyTile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h2 id="myModalLabel">Add Gallery Thumbnail</h2>
</div>
<div class="modal-body" >
     <form name="addthumbForm" method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/gallery/add_thumbnail">
    <input type="hidden" name="id_gallery_thumb" id="id_gallery_thumb"  value="<?=$gallery['id']?>" />
    <div style="height: 5px; clear: both">&nbsp;</div>
    <div>
        
        <div style="width: 80%; float: left">                    
            <!--<input style="width: 97%" class="textfield rounded" type="file" name="userfile" />-->
            <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-append">
            <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
            <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span>
            <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
            </div>
        </div>
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
</form>
</div>
</div>
<script>

function modal_tile()
{
	jQuery('#id_story').val(jQuery('#update_id').val());
	$('#storyTile').modal('show');
}
</script>