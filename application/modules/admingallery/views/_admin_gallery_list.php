<script type="text/javascript" src="<?=base_url()?>js/nailthumb/jquery.nailthumb.1.1.js"></script>
<script>
jQuery(document).ready(function() {
//		jQuery('.nailthumb-container').nailthumb({width:175,height:100, fitDirection:'center center'});
//		jQuery('.nailthumb-container2').nailthumb({width:175,height:100, fitDirection:'center center'});
		//jQuery('.nailthumb-container').nailthumb({width:140,height:100,fitDirection:'center center'});
});
jQuery(function() {
	jQuery('.galleries-thumb *').tooltip({
		showURL: false
	});
	
	
});
jQuery(function() {
	jQuery('.all_tt').tooltip({
		showURL: false
	});
});
var choose = 0;
function deletegallery(id)
{
	//alert(id);
	choose = id;
	$('#deleteModal').modal('show');
}
function delete_gallery(id)
{
	var url = "<?=base_url()?>admin/gallery/delete_gallery/";
		url = url + id;
		//alert(url);
		
		jQuery.ajax({
		url: url,
		success: function(html) {
			if (html == 'Ok') {
				jQuery("#gallery-" + id).fadeOut("normal");
				$('#deleteModal').modal('hide');
			}
			else {
				alert("There was an error when deleting this gallery");
			}
			
		}
	})
}
</script>
<style>
.gallery-thumbs
{
	clear:both;
}
.galleries-thumb
{
	float: left; height: 175px;
    /*margin: 10px 10px 0 0;*/
    opacity: 0.8;
    text-align: center;
    width: 140px;
}
.galleries-thumb:hover
{
	opacity: 1;
}
hr
{
	margin-top:10px!important;
	margin-bottom:10px!important;
}
</style>
<div class="span9">

	<div style="min-height: 433px; border: 1px solid #d6d6d6; border-radius: 5px; margin-right: 19px;">

		<div style="padding: 20px">

			<!-- start here -->

			<h1 style="padding-left: 7px;">Create Image Galleries</h1>
			<hr>
            <a href="<?=base_url()?>admin/gallery/preview/all" target="_blank" style="text-decoration:none;"><i class="icon icon-search"></i> <b>Preview</b> your image gallery colllection page</a>
            <hr>
            <i class="icon-plus"></i> <b>Create</b> a new image gallery
            
            <form style="margin-left:6px; margin-top:20px;" name="createGalleryForm" method="post" action="<?=base_url()?>admin/gallery/create_gallery">
				<?php if ($this->session->flashdata('error_cg')) {
                    print '<span class="error">ERROR: Please enter a name for new gallery</span>';
                } ?>
                <div>
                	<div style="width: 20%; float: left; height: 30px; line-height: 30px;">Image Gallery Name</div>
                    <div style="width: 80%; float: right">						                        
                        <input style="width: 75%" class="textfield rounded" type="text" name="title" /><button style="margin-top:-10px;" class="btn btn-primary" type="button" onclick="document.createGalleryForm.submit()">Create</button>
                    </div>
            	</div>
            	<div style="height:1px;clear: both">&nbsp;</div>                
                
            </form>
            <hr>
            <div style="height: 10px; clear: both">&nbsp;</div>                
            <i class="icon-picture"></i> <b>Your Image Galleries</b> manage your image galleries via the list below
            <hr style="margin-bottom:0px!important;">
            <table class="table table-hover">
			    	<thead>
			    		<tr >
			    			<th style="width: 10%">Preview</th>
			    			<th style="width: 20%;">Name</th>
			    			<th style="width: 20%; text-align: center;">Active In Preview</th>
			    			<th style="width: 20%; text-align: center;">Active On Page</th>
			    			<th style="width: 15%; text-align: center;">View - Edit</th>
                            <th style="width: 15%; text-align: center;">Delete</th>
			    		</tr>
			    	</thead>
			    	<tbody id="all_page">
		    			<?php foreach($galleries as $gallery)
		                { ?>
                        <tr id="gallery-<?=$gallery['id']?>">
                        	<td>                                        
<?
                            $photos = $this->Gallery_model->get_photos($gallery['id']);
                            if (count($photos) == 0 && $gallery['thumbnail']==0) {
                                echo '<a  href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><div class="nailthumb-container"><img  src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></div></a>';
                            } 
                            else if($gallery['thumbnail']==1)
                            {
                                echo'<a href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><img style="width:95%;" src="'.base_url().'uploads/galleries/'.md5("cdkgallery".$gallery['id']).'/thumb_gal/thumb'.$gallery['thumb_img'].'" title="'.$gallery['title'].'" /></a>';
                            }
                            else {
                                $thumbnail = $this->Gallery_model->get_gallery_thumbnail($gallery['id']);
                                echo'<a href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><img style="width:95%;" src="'.base_url().'uploads/galleries/'.md5("cdkgallery".$gallery['id']).'/thumbnails/'.$thumbnail.'" title="'.$gallery['title'].'" /></div></a>';
                            }
			
?>                           
                            </td>
                            <td valign="middle" style="vertical-align:middle;"><?=$gallery['title']?></td>
                            <td valign="middle" style="vertical-align:middle;">
                            	<?php if($gallery['active_preview'] == 1) { ?>
		    						<div class="all_tt" data-toggle="tooltip" title="De-actived On Preview" style="text-align: center; cursor: pointer;" onclick="window.location = '<?=base_url()?>admin/gallery/switchstatuspreview/<?=$gallery['id']?>'">
                                    	<i style="color: #00c717" class="icon-ok-circle icon-2x"></i>
                                    </div>
		    					<?php 
								}
		    					else
		    					{
		    					?>
		    						<div class="all_tt" data-toggle="tooltip" title="Actived On Preview" style="text-align: center; cursor: pointer" onclick="window.location = '<?=base_url()?>admin/gallery/switchstatuspreview/<?=$gallery['id']?>'">
                                    	<i style="color: #d6d6d6" class="icon-ok-circle icon-2x"></i>
                                    </div>
		    					<?php	
		    					}
		    					?>
                            </td>
                            <td valign="middle" style="vertical-align:middle;">
                            	<?php if($gallery['active_page'] == 1) { ?>
		    						<div class="all_tt" data-toggle="tooltip" title="De-actived On Page" style="text-align: center; cursor: pointer;">
                                    	<i style="color: #00c717" class="icon-ok-circle icon-2x"></i>
                                    </div>
		    					<?php 
								}
		    					else
		    					{
		    					?>
		    						<div class="all_tt" data-toggle="tooltip" title="Active On Page" style="text-align: center; cursor: pointer">
                                    	<i style="color: #d6d6d6" class="icon-ok-circle icon-2x"></i>
                                    </div>
		    					<?php	
		    					}
		    					?>
                            </td>
                            <td valign="middle" style="vertical-align:middle; text-align:center;">
                            	<div class="all_tt" data-toggle="tooltip" title="Edit Gallery">
                                <a  style="text-decoration: none" href="<?=base_url()?>admin/gallery/galleries/<?=$gallery['id']?>"><i class="icon icon-search"></i></a>
                                </div>
                            </td>
                            <td valign="middle" style="vertical-align:middle;">
                            	<div class="all_tt" data-toggle="tooltip" title="Delete Gallery" style="cursor: pointer; text-align: center" onclick="return deletegallery(<?=$gallery['id']?>);">
			    					<i style="color: #c70520" class="icon-remove-circle icon-2x"></i>
			    				</div>
                            </td>
                        </tr>
                        <? } ?>
			    	</tbody>
			    	
			 </table>
            
           
            </div>
          
            
			<!-- end here -->

		</div>

	</div>

</div>

<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Delete Gallery</h3>
</div>
<div class="modal-body">
    <p>It will delete all photos and videos of this gallery. Are you sure you want to do this?</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" onclick="delete_gallery(choose)">Delete</button>

</div>
</div>