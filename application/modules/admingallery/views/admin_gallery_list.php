<script type="text/javascript" src="<?=base_url()?>assets/nailthumb/jquery.nailthumb.1.1.js"></script>
<script>
jQuery(document).ready(function() {


		

		
		jQuery('#config-records-gallery').click(function(){
			$j('#record-gallery').modal('show'); 
		});
		

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
	$j('#deleteModal').modal('show');
}
function delete_gallery(id)
{
	var url = "<?=base_url()?>admin/gallery/ajax/delete_gallery";
		//url = url + id;
		//alert(url);
		
		jQuery.ajax({
		url: url,
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			if (html == 'Ok') {
				jQuery("#gallery-" + id).fadeOut("normal");
				$j('#deleteModal').modal('hide');
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
.border_setting_thumbnail{
	float:left;margin-right:5px;width:124px; height:84px; background:#f2f2f2; border:1px solid #cccccc;
}
.square
{
	background:#cecece; height:62px; width:62px; margin:0 auto; margin-top:11px;
}
.portrait
{
	background:#cecece; height:62px; width:44px; margin:0 auto; margin-top:11px;
}
.landscape
{
	background:#cecece; height:62px; width:84px; margin:0 auto; margin-top:11px;
}
.panoramic
{
	background:#cecece; height:62px; width:100px; margin:0 auto; margin-top:11px;
}
.wide_angle
{
	background:#cecece; height:62px; width:100px; margin:0 auto; margin-top:11px;
}
.option_thumbnail{
	float:left;height:40px; line-height:14px; background:#f2f2f2; border:1px solid #cccccc; width:124px;margin-top:5px; margin-right:5px;
}

</style>
<? if($setting['cron']==2||$setting['cron']==3){?>
<div style="bottom: 0;display: none;left: 0;overflow-x: auto;overflow-y: scroll; position: fixed;right: 0;top: 0;z-index: 1040;opacity: 0.96; background:#000; transition: opacity 0.15s linear 0s; display:block;">
	<div style="background-clip: padding-box;    background-color: #FFFFFF;    border: 1px solid rgba(0, 0, 0, 0.2);    border-radius: 6px;    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);    outline: medium none;    position: relative; 
    padding-bottom: 30px; padding-top: 30px;  margin-top:220px; right: auto; width: 600px;margin-left: auto; margin-right: auto; z-index: 1050; text-align:center;">
    	This function can take some time to complete as all your images need to be resized. 
        <br />
        Please check back shortly and the function will have completed. 
		<br />
		You can continue to work on your site while this function completes. 
        <br />
        Click the below button to return to the dashboard.
        <br /><br />
        <button class="btn btn-info" onclick="window.location='<?=base_url()?>admin'"><i class="fa fa-hand-o-left"></i>  Return To Dashboard</button>
    </div>
</div>
<? } ?>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		<span style="color:#f00; font-size:14px;"><?=$this->session->flashdata('cron_job')?></span>
        
        <div class="title-page">MANAGE IMAGE GALLERIES</div>
        <div class="sub-title">You can create image galleries and attach the galleries to pages on your website. Your current image galleries are displayed below <br />or you can click the "Create Image Gallery" button below to create a new gallery.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="$j('#addgalleryModal').modal('show');"><i class="fa fa-plus-circle"></i> CREATE IMAGE GALLERY</button>
        </div>
        
        <div style="height: 10px; clear: both">&nbsp;</div>     
        <div class="sub-title">
        	All your galleries can be viewed on one page via your image gallery collection page. <br />
			You can activate which galleries you would like to appear on this page by clicking the "Active In Collection" button next to your galleries<br /><br />
			<a href="<?=base_url()?>gallery" target="_blank"><i class="fa fa-eye"></i> Preview your Image Gallery Colllection page </a>
        </div>
       <!-- <i class="fa fa-picture-o"></i> <b>Your Image Galleries</b> manage your image galleries via the list below-->
        <div style="height: 50px; clear: both">&nbsp;</div>     
        
        <table class="table table-hover">
	    	<thead>
	    		<tr class="list-tr">
	    			<th style="width: 10%">Preview</th>
	    			<th style="width: 20%;">Name</th>
	    			<th style="width: 20%; text-align: center;">Active In Preview</th>
	    			<th style="width: 20%; text-align: center;">Active On Page</th>
	    			<th style="width: 15%; text-align: center;">View - Edit</th>
                    <th style="width: 15%; text-align: center;">Delete</th>
	    		</tr>
	    	</thead>
	    	<tbody id="all_page">
    			<?php 
				if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}
				foreach($galleries as $gallery)
                { ?>
                <tr class="list-tr" id="gallery-<?=$gallery['id']?>">
                	<td>                                        
<?
                    $photos = $this->gallery_model->get_photos($gallery['id']);
                    if (count($photos) == 0 && $gallery['thumbnail']==0) {
                        //echo '<a  href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><div class="nailthumb-container"><img  src="'.base_url().'assets/img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></div></a>';
						echo'
						<div style="width:200px;height:100px; background:#ececec; border:1px solid #ccc; float:right;">
							
								<div style="width:180px;height:80px; background:#b8b7b7; border:1px solid #ccc; margin:0 auto; margin-top:10px; line-height:80px;text-align:center;"><b>NO THUMBNAIL</b>	</div>
							
						</div><div style="clear:both;"></div>';
                    } 
                    else if($gallery['thumbnail']==1)
                    {
                        echo'<a href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><img style="width:100%;" src="'.base_url().'uploads/'.$folder_init.'/'.md5("cdkgallery".$gallery['id']).'/'.$folder_pic.'/'.$gallery['thumb_img'].'" title="'.$gallery['title'].'" /></a>';
                    }
                    else {
                        $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                        echo'<a href="'.base_url().'admin/gallery/galleries/'.$gallery['id'].'"><img style="width:100%;" src="'.base_url().'uploads/'.$folder_init.'/'.md5("cdkgallery".$gallery['id']).'/'.$folder_pic.'/'.$thumbnail.'" title="'.$gallery['title'].'" /></div></a>';
                    }
	
?>                           
                    </td>
                    <td valign="middle" style="vertical-align:middle;"><?=$gallery['title']?></td>
                    <td valign="middle" style="vertical-align:middle;">
                    	<?php if($gallery['active_preview'] == 1) { ?>
    						<div class="all_tt" data-toggle="tooltip" title="De-actived On Preview" style="text-align: center; cursor: pointer;" onclick="window.location = '<?=base_url()?>admin/gallery/switchstatuspreview/<?=$gallery['id']?>'">
                            	<i style="color: #00c717" class="fa fa-check-circle"></i>
                            </div>
    					<?php 
						}
    					else
    					{
    					?>
    						<div class="all_tt" data-toggle="tooltip" title="Actived On Preview" style="text-align: center; cursor: pointer" onclick="window.location = '<?=base_url()?>admin/gallery/switchstatuspreview/<?=$gallery['id']?>'">
                            	<i style="color: #d6d6d6" class="fa fa-check-circle"></i>
                            </div>
    					<?php	
    					}
    					?>
                    </td>
                    <td valign="middle" style="vertical-align:middle;">
                    	<?php 
							$pg = $this->gallery_model->get_gallery_from_page($gallery['id']);
							$cs = $this->gallery_model->get_gallery_from_casestudy($gallery['id']);
							$pages='';
							if(count($cs)>0)
							{								
								foreach($cs as $item)
								{
									if($pages!=''){$add=' ,';}else{$add='';}
									$pages.=$add.$item['title'];
								}
							}
							
							if(count($pg)>0)
							{								
								foreach($pg as $item)
								{
									if($pages!=''){$add=' ,';}else{$add='';}
									$pages.=$add.$item['title'];
								}
							}
							
							if($pages!='') { ?>
    						<div class="all_tt" data-toggle="tooltip" title="<?=$pages?>" style="text-align: center; cursor: pointer;">
                            	<i style="color: #00c717" class="fa fa-check-circle"></i>
                            </div>
    					<?php 
						}
    					else
    					{
    					?>
    						<div class="all_tt" data-toggle="tooltip" title="Active On Page" style="text-align: center; cursor: pointer">
                            	<i style="color: #d6d6d6" class="fa fa-check-circle"></i>
                            </div>
    					<?php	
    					}
    					?>
                    </td>
                    <td valign="middle" style="vertical-align:middle; text-align:center;">
                    	<div class="all_tt" data-toggle="tooltip" title="Edit Gallery">
                        <a  style="text-decoration: none" href="<?=base_url()?>admin/gallery/galleries/<?=$gallery['id']?>"><i class="fa fa-search blue-icon"></i></a>
                        </div>
                    </td>
                    <td valign="middle" style="vertical-align:middle;">
                    	<div class="all_tt" data-toggle="tooltip" title="Delete Gallery" style="cursor: pointer; text-align: center" onclick="return deletegallery(<?=$gallery['id']?>);">
	    					<i class="fa fa-trash-o blue-icon"></i>
	    				</div>
                    </td>
                </tr>
                <? } ?>
	    	</tbody>
	    	
	 </table>
        
	</div>
</div>

<div id="config-records-gallery" class="config-btn"><i class="fa fa-cogs"></i></div>

<div id="addgalleryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel">Create Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form style="margin-left:6px; margin-top:20px;" name="createGalleryForm" method="post" action="<?=base_url()?>admin/gallery/create_gallery">
                <?php if ($this->session->flashdata('error_cg')) {
                print '<span class="error">ERROR: Please enter a name for new gallery</span>';
                } ?>
                <div class="form-search-label">Image Gallery Name</div>
                <div class="form-search-input">
                <input  class="form-control input-text" type="text" name="title" value=""/>
               
                </div>
                <div class="form-search-gap"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                 <button class="btn btn-info" type="button" onclick="document.createGalleryForm.submit()"><i class="fa fa-plus"></i> Create</button>
            </div>
        </div>
    </div>
</div>


<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel">Delete Gallery</h3>
            </div>
            <div class="modal-body">
                <p>It will delete all photos and videos of this gallery. Are you sure you want to do this?</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-info" onclick="delete_gallery(choose)">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--begin record gallery-->
<div id="record-gallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:690px;">
        	<form method="post" action="<?=base_url();?>admin/gallery/update_setting_gallery">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Configure Image Gallery Thumbnails</h3>
            </div>
            <div class="modal-body">
             	<p>You can change the size the thumbnail preview images display on your website <br />by selecting your desiered file size.<br /></p>                
                
                <div class="cleardiv"></div>
                <div style="float:none;">
                	<? $setting = $this->gallery_model->get_gallery_setting(1);?>
                    
                    <div class="border_setting_thumbnail">
                    	<div class="square"></div>                        
                    </div>
                    <div class="border_setting_thumbnail">
                    	<div class="portrait"></div>
                        
                    </div>
                    <div class="border_setting_thumbnail">
                    	<div class="landscape"></div>
                        
                    </div>
                    <div class="border_setting_thumbnail">
                    	<div class="panoramic"></div>
                        
                    </div>
                    <div class="border_setting_thumbnail">
                    	<div class="wide_angle"></div>
                        
                    </div>
                    <div class="cleardiv"></div>
                    
                    <div class="option_thumbnail" >
                        <div style="margin-left:7px;margin-right:7px; margin-top:5px;">
                        	<input type="radio" value="1" name="size"  <? if($setting['size']==1){echo "checked=checked";}?> style="float:left;margin-top:7px;"> 
                            <span style="font-size:12px;float:left; margin-left:10px; font-weight:600;">SQUARE <br />RATIO 1x1</span>
                            <div class="cleardiv"></div>
                        </div>
                    </div>
                    <div class="option_thumbnail" >
                        <div style="margin-left:7px;margin-right:7px; margin-top:5px;">
                        	<input type="radio" value="2" name="size"  <? if($setting['size']==2){echo "checked=checked";}?> style="float:left;margin-top:7px;"> 
                            <span style="font-size:12px;float:left; margin-left:10px; font-weight:600;">PORTRAIT <br />RATIO 2x3</span>
                            <div class="cleardiv"></div>
                        </div>
                    </div>
                    <div class="option_thumbnail" >
                        <div style="margin-left:7px;margin-right:7px; margin-top:5px;">
                        	<input type="radio" value="3" name="size"  <? if($setting['size']==3){echo "checked=checked";}?> style="float:left;margin-top:7px;"> 
                            <span style="font-size:12px;float:left; margin-left:10px; font-weight:600;">LANDSCAPE <br />RATIO 4x3</span>
                            <div class="cleardiv"></div>
                        </div>
                    </div>
                    <div class="option_thumbnail" >
                        <div style="margin-left:7px;margin-right:7px; margin-top:5px;">
                        	<input type="radio" value="4" name="size"  <? if($setting['size']==4){echo "checked=checked";}?> style="float:left;margin-top:7px;"> 
                            <span style="font-size:12px;float:left; margin-left:10px; font-weight:600;">PANORAMIC <br />RATIO 5x3</span>
                            <div class="cleardiv"></div>
                        </div>
                    </div>
                    <div class="option_thumbnail" >
                        <div style="margin-left:7px;margin-right:7px; margin-top:5px;">
                        	<input type="radio" value="5" name="size"  <? if($setting['size']==5){echo "checked=checked";}?> style="float:left;margin-top:7px;"> 
                            <span style="font-size:12px;float:left; margin-left:10px; font-weight:600;">WIDE ANGLE <br />RATIO 16x9</span>
                            <div class="cleardiv"></div>
                        </div>
                    </div>
                    <div class="cleardiv"><br /></div>
                    <div class="left-side modal-label">
                    Height
                    </div>
                    <div class="left-side">
                        <input class="form-control input-text" type="text" name="height" value="<?=$setting['height']?>"/>
                    </div>
                    
                </div>
                <div class="cleardiv"></div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-info"><i class="fa fa-floppy-o"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--end record per page config-->