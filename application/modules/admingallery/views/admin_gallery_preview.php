<!--
<link class="jsbin" href="<?=base_url()?>css/jquery-ui-1-7-2.css" rel="stylesheet" type="text/css"></link>

<script src="<?=base_url()?>js/jquery.min-1-8-0.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/jquery-ui-1-8-23.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="<?=base_url()?>js/nailthumb/jquery.nailthumb.1.1.js"></script>-->
<script>
jQuery(document).ready(function() {
//		jQuery('.nailthumb-container').nailthumb({width:175,height:100, fitDirection:'center center'});
//		jQuery('.nailthumb-container2').nailthumb({width:175,height:100, fitDirection:'center center'});
		//jQuery('.nailthumb-container').nailthumb({width:140,height:100,fitDirection:'center center'});
});
</script>
<script>

//var j = jQuery.noConflict();




jQuery(function() {

	
	//j('.img_display').lightBox();   
	jQuery('.item').first().toggleClass("active");
	var id= jQuery('.item').first().attr("id");
	var n=id.split("#");			
	idstory = n[1];
	if(idstory==0)
	{
		jQuery('#cat1').toggleClass("active");
		jQuery('#cat2').hide();
		jQuery('#divider1').hide();
	}else
	{
		//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
		//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
		//jQuery('#cat2').html('aa');
		jQuery('#cat1').removeClass('active');
		jQuery('#cat2').removeClass('active');

		jQuery('#cat2').toggleClass("active");
		
		jQuery('#cat2').show();
		jQuery('#divider1').show();
	}
	jQuery('.item').each(function () {
		if (jQuery(this).hasClass('active')) {			
			var id= jQuery(this).attr("id");
			var n=id.split("#");
			idp=n[0].replace('id','');
			var ids = parseInt(idp);
			jQuery('.actt').html(ids);
			
		}
	});
	<?
	
	if($slide > -1)
	{
	?>
		jQuery('.item').each(function () {
		if (jQuery(this).hasClass('active')) {			
			jQuery(this).removeClass('active');
		}
		});
		
		jQuery('.item').each(function () {			
			var id=jQuery(this).attr("id");
			var n=id.split("#");
			idp=n[1];			
			if(idp==<?=$slide?>)
			{
				jQuery(this).toggleClass("active");				
				idps=n[0].replace('id','');
				idstory = n[1];
				var ids = parseInt(idps);
				jQuery('.actt').html(ids);
				
				//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
				//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
				jQuery('#cat1').removeClass('active');
				jQuery('#cat2').removeClass('active');
		
				jQuery('#cat2').toggleClass("active");
				
				jQuery('#cat2').show();
				jQuery('#divider1').show();
			}
		});
		
	<? } ?>
	jQuery('[id^="myCarousel"]').carousel('pause');
});
function check_html()
{
	var idsp=1;
	jQuery('.item').each(function () {
		if (jQuery(this).hasClass('active')) {			
			var id= jQuery(this).attr("id");
			var n=id.split("#");
			idp=n[0].replace('id','');
			var ids = parseInt(idp)-1;
			
			if(ids==0){
				
				idsp=0;
				cat = '<?=$cat?>';				
				ids=<?=$index?>;
				
			}
			jQuery('.actt').html(ids);
		}
	});
	
	if(idsp==1)
	{
		jQuery('.item').each(function () {
			if (jQuery(this).hasClass('active')) {								
				var id= jQuery(this).prev().attr("id");
				var n=id.split("#");			
				idstory = n[1];
				if(idstory==0)
				{
					jQuery('#cat1').toggleClass("active");
					jQuery('#cat2').hide();
					jQuery('#divider1').hide();
				}else
				{
					//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
					//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
					jQuery('#cat1').removeClass('active');
					jQuery('#cat2').removeClass('active');
			
					jQuery('#cat2').toggleClass("active");
					
					jQuery('#cat2').show();
					jQuery('#divider1').show();
					
					//update header on page slide
					//jQuery('#story_header').html(jQuery('#title_story_parent'+idstory).val());
				}
			}
		});
	}
	else{
		var id=jQuery('.item').last().attr("id");
		var n=id.split("#");			
		idstory = n[1];
	

		/*
		jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
		jQuery('#cat1').removeClass('active');
		jQuery('#cat2').removeClass('active');

		jQuery('#cat2').toggleClass("active");
		
		jQuery('#cat2').show();
		jQuery('#divider1').show();
		*/
		if(idstory==0)
		{
			jQuery('#cat1').toggleClass("active");
			jQuery('#cat2').hide();
			jQuery('#divider1').hide();
		}else
		{
			//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
			//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
			jQuery('#cat1').removeClass('active');
			jQuery('#cat2').removeClass('active');
	
			jQuery('#cat2').toggleClass("active");
			
			jQuery('#cat2').show();
			jQuery('#divider1').show();
			
			//update header on page slide
			//jQuery('#story_header').html(jQuery('#title_story_parent'+idstory).val());
		}
	}
	
}
function check_html_right()
{

	var idsp=1;
	jQuery('.item').each(function () {
		if (jQuery(this).hasClass('active')) {			
			var id= jQuery(this).attr("id");
			var n=id.split("#");			
			idp=n[0].replace('id','');
			var ids = parseInt(idp);
			ids=ids+1;

			cat = '<?=$cat?>';
			idsps=<?=$index?>;
			

			if(ids > idsps){idsp=0;ids=1;}			
			jQuery('.actt').html(ids);			
		}
	});
	/*
	$('.item').each(function () {
		if (jQuery(this).hasClass('active')) {			
			var id= $(this).next().attr("id");
			var n=id.split("#");
			idstory = n[1];
			if(idstory==0)
			{
				jQuery('#cat1').toggleClass("active");
				jQuery('#cat2').hide();
				jQuery('#divider1').hide();
			}else
			{
				jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
				jQuery('#cat1').removeClass('active');
				jQuery('#cat2').removeClass('active');
				jQuery('#cat2').toggleClass("active");
				jQuery('#cat2').show();
				jQuery('#divider1').show();
			}
		}
	});
	*/
	if(idsp==1)
	{
		jQuery('.item').each(function () {
			if (jQuery(this).hasClass('active')) {								
				var id= jQuery(this).next().attr("id");
				var n=id.split("#");			
				idstory = n[1];
				if(idstory==0)
				{
					jQuery('#cat1').toggleClass("active");
					jQuery('#cat2').hide();
					jQuery('#divider1').hide();
				}else
				{
					//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
					//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
					jQuery('#cat1').removeClass('active');
					jQuery('#cat2').removeClass('active');
			
					jQuery('#cat2').toggleClass("active");
					
					jQuery('#cat2').show();
					jQuery('#divider1').show();
					
					//update header on page slide
					//jQuery('#story_header').html(jQuery('#title_story_parent'+idstory).val());
				}
			}
		});
	}
	else
	{
		var id=jQuery('.item').first().attr("id");
		var n=id.split("#");			
		idstory = n[1];
	

		if(idstory==0)
		{
			jQuery('#cat1').toggleClass("active");
			jQuery('#cat2').hide();
			jQuery('#divider1').hide();
		}else
		{
			//jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
			//jQuery('#cat3').html(jQuery('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
			jQuery('#cat1').removeClass('active');
			jQuery('#cat2').removeClass('active');
			jQuery('#cat2').toggleClass("active");
			jQuery('#cat2').show();
			jQuery('#divider1').show();
			
			//update header on page slide
			//jQuery('#story_header').html(jQuery('#title_story_parent'+idstory).val());
		}
		
		/*jQuery('#cat2').html(jQuery('#title_story'+idstory).val());
		jQuery('#cat1').removeClass('active');
		jQuery('#cat2').removeClass('active');

		jQuery('#cat2').toggleClass("active");
		
		jQuery('#cat2').show();
		jQuery('#divider1').show();*/
	}

}


</script> 
<style>
.thumbnails > li{
	margin-bottom:0px!important;
}

.thumbnails > ul{
	margin-bottom:0px!important;
}
a {
    color: #222;
    text-decoration: none;
	

}
a:hover, a:focus {
	color: #222;
    text-decoration: none;
	
	
}
.text-bagazine{
	text-align:center;
	font-size:26px;
	font-family: 'Lato', sans-serif;
}
[class^="icon-"], [class*=" icon-"]
{
	vertical-align:bottom!important;
}
@media (min-width: 1200px) {
.indi{
right:590px; top: 375px;
}
.span4 {
    width: 383px;
}
[class*="span"] {

    margin-left: 10px;
}
.row [class*="span"]:first-child {
    margin-left: 30px;
}
.nav1{
	margin-left:36%;
}
#center_pointer { margin:0 auto; margin-left:30%; }
.all_s{margin-left: -10px;}
}

@media (min-width: 979px) and (max-width:1200px){
.indi{
right:444px; top: 360px;
}
.hidden-div{
	width:0px!important;
}
.span4 {
    width: 306px;
}
[class*="span"] {

    margin-left: 10px;
}
.row [class*="span"]:first-child {
    margin-left: 20px;
}
.big-font{
	font-size:20px;
	line-height : 20px;
}
.nav1{
	margin-left:36%;
}
.text-bagazine{
	text-align:center;
	font-size:26px;
	font-family: 'Lato', sans-serif;;
}
#center_pointer
{
	margin:0 auto; margin-left:28%;
}
.all_s{margin-left: -10px;}
}
@media (max-width: 979px) {
	.indi{
right:345px; top: 230px;
}
.nav1{
	margin-left:25%;
}
.text-bagazine{
	text-align:center;
	font-size:26px;
	font-family: 'Lato', sans-serif;;
}
#center_pointer
{
	margin:0 auto; margin-left:7%;
}
.all_s{margin-left: 10px;}
}
@media (max-width: 767px) {
.indi{
right:46%; top: 70%;
}	
.span4{
	margin-top:10px;
}
.big-font{
	font-size:14px;
	line-height : 10px;
}
.nav1{
	margin-left:22%;
}
.text-bagazine{
	text-align:center;
	font-size:26px;
	font-family: 'Lato', sans-serif;;
}
#center_pointer
{
	margin:0 auto; margin-left:18%;
}
.all_s{margin-left: 0px;}
}
@media (max-width: 480px) {
.indi{
right:63%; top: 42%;
}	
.span4{
	margin-top:10px;
}
.big-font{
	font-size:14px;
	line-height : 15px;
}
.nav1{
	margin-left:20%;
}
.text-bagazine{
	text-align:center;
	font-size:26px;
	font-family: 'Lato', sans-serif;;
}
.all_s{margin-left: 0px;}
}	
.breadcrumb {
    background-color: transparent;
	padding-left:0px;
	font-size:12px;
	margin-bottom:0px!important;
	font-weight:600;
}
.breadcrumb > .active {
    color: #222222;
	font-weight:400;
}


.breadcrumb > li > .divider2 {
    color: #000000;
    padding: 0 5px;
}



</style>

	<div class="row">
		<div style="height: 10px;"></div>
        <ul class="breadcrumb" style="font-size: 11px; text-transform: uppercase">
        		<!-- <?=$cat?> -->
			    <li><a href="<?=base_url()?>">HOME</a> <span class="divider">></span></li>
                <li id="cat1"><a href="#">GALLERY</a> <span class="divider" id="divider1" style="display:none;">></span></li>
        </ul>
        <div style="height: 10px;"></div>
        
        <div style="height: 50px;"></div>
		<div class="row">
			<div class="col-md-12" style="background:#fafafa;">
				<div id="myCarousel2" class="carousel slide" style="padding:10px;">                    
                    <div class="carousel-inner">
                        <? 	$i=1;
						
							$k=1;
							$j=1;
							
							foreach($galleries as $st){  								
								
								
								$data_story[$k][]=$st['id'];
								if($j % 6 == 0){$k++;}
								$j++;
							}							

						if($cat='all'){

                        for($m=1; $m<=$k; $m++)
						{
							
						?>
                        
						<div class="item" id="id<?=$i?>#0">

						<div class="row">
                            <div class="col-md-12" style="background:#fafafa;">
                               <div class="row-fluid all_s">
                               <div class="col-md-12">
								<div style="height:8px; clear:both"></div>
							   <? 
							   $now=1;
							  
							   foreach($data_story[$m] as $st){  
							    $gallery = $this->gallery_model->get_gallery($st);
								
							   	if($now == 4){echo '</div>';$now = 1;}
								
							   	if($now == 1){   ?> 
                                		<div style="height:20px; clear:both"></div>
                                        <div class="row-fluid" >                                                                                                         
                                        
                                        <div class="col-md-4" style="margin-left:0px!important;">
                                            <div style="text-align: center;" class="gallery slideshow">                                            	                                                                                                
                                                    <? 
													 $photos = $this->gallery_model->get_photos($gallery['id']);
													 //echo $gallery['id'];
													if (count($photos) == 0 && $gallery['thumbnail']==0) {
													   echo '<a class="img_display" href="'.base_url().'img/thumbnail-no-image.jpg"><img width="30%" src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></a>';
													   
													   } else{ ?>
                                                    
                                                                                                
														<? if($gallery['thumbnail']==1){?>
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/thumb_gal/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                                	<img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? }else{ 
                                                            $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                        <? } ?>
                                                    
                                                    <? } ?>
                                                    <?
                                                        for($i=0;$i<count($photos);$i++) {                                                         
														if($photos[$i]['video'] == 0){?>
                                                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
                        									<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
                                                        </a>
                                                        <? }} ?>     
                                                  <br />                                                                                   	                                                
                                                <div style="margin-top:10px;font-family: buenard;font-size: 14px;text-align: center;font-weight:600;"><?=$gallery['title']?></div>
                                            </div>
                                        </div>  
                                <? }                                                                                                            
                                
                                if($now == 2){   ?>                                                                                                           
                                        <div class="col-md-4" style="margin-left:0px!important;">
                                            <div style="text-align: center;">
                                            		<? 
													 $photos = $this->gallery_model->get_photos($gallery['id']);
													if (count($photos) == 0 && $gallery['thumbnail']==0) {
													   echo '<a class="img_display" href="'.base_url().'img/thumbnail-no-image.jpg"><img width="30%" src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></a>';
													   
													   } else{ ?>
                                                
														<? if($gallery['thumbnail']==1){?>
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/thumb_gal/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                                	<img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                            </a>
                                                            
                                                        <? }else{ 
                                                            $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                               <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? } ?>
                                                    <? } ?>
                                                    <? 
														for($i=0;$i<count($photos);$i++) {                                                         
														if($photos[$i]['video'] == 0){?>
                                                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
                        									<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
                                                        </a>
                                                        <? }} ?>
                                                	 <br />
                                                <div style="margin-top:10px;font-family: buenard;font-size: 14px;text-align: center;font-weight:600;"><?=$gallery['title']?></div>
                                            </div>                                            
                                        </div>  
                                <? }                                                                                                           
                                if($now == 3){   ?>                                                                                                           
                                        <div class="col-md-4" style="float:left;margin-left:0px!important;">
                                            <div style="text-align: center;">
                                            		<? 
													 $photos = $this->gallery_model->get_photos($gallery['id']);
													if (count($photos) == 0 && $gallery['thumbnail']==0) {
													   echo '<a class="img_display" href="'.base_url().'img/thumbnail-no-image.jpg"><img width="30%" src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></a>';
													   
													   } else{ ?>
                                                                                             
														<? if($gallery['thumbnail']==1){?>
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/thumb_gal/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? }else{ $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                               <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumbnails/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                        <? } ?>
                                                    <? } ?>    
                                                	<? 
                                                        for($i=0;$i<count($photos);$i++) { 
                                                        if($photos[$i]['video'] == 0){?>
                                                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
                        									<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
                                                        </a>
                                                        <? }} ?>
                                                         <br />
                                                <div style="margin-top:10px;font-family: buenard;font-size: 14px;text-align: center;font-weight:600;"><?=$gallery['title']?></div>
                                            </div>                                            
                                        </div>  
                                   		
                                <? }                                                                                                             
                                $now++;
                                } 
									if($now-1 % 3 > 0){echo '</div>';}
								?>
                            	</div>
                                <div style="height:8px; clear:both"></div>
                                </div>
                            </div>                         
                        </div>
                        </div>
                        
						<?
						$i++;
						}
						}
						
						?>                               
                    </div>
                    
                    <div style="clear:both"></div>
                    
                    <a class="left carousel-control" data-slide="prev" href="#myCarousel2" style="background: none; border: none; opacity: 1" onclick="check_html()">
						<img src="<?=base_url()?>img/white-left-arrow.png"/>
					</a>
					<a class="right carousel-control" data-slide="next" href="#myCarousel2" style="background: none; border: none; opacity: 1" onclick="check_html_right()">
						<img src="<?=base_url()?>img/white-right-arrow.png"/>
					</a>
				</div>
                <div style="height: 20px;"></div>
                <div style="float:none">
                            
				<? $num=$index;?>
                               
                <table class="hidden-xs" width="5%" style="font-size: 11px; text-transform: uppercase;font-weight:600; " align="center">
                	<tr>
                		
                		<td style=" text-align: center; line-height: 11px">
                			<a class="left" data-slide="prev" href="#myCarousel2" style="background: none; border: none; opacity: 1;" onclick="check_html()">
                    			<i class="icon icon-angle-left icon-2x" style="line-height:10px!important;"></i>
                			</a>
                            <span class="actt"></span> / <?=$num?>
                            <a class="right" data-slide="next" href="#myCarousel2" style="background: none; border: none; opacity: 1;" onclick="check_html_right()">
                            	<i class="icon icon-angle-right icon-2x" style="line-height:10px!important;"></i>
                            </a>
                		</td>
                		
                		
                		
                		
                	</tr>
                </table>
                
                <div class="visible-xs" style="padding-left:5%; padding-right: 5%; width:90%">
                	
                    <div style="float: left; width: 33.5%; text-align: left; font-size: 9px; line-height:20px;">
                		
                	</div>
                	<div style="float: left; width: 33%; text-align: center; font-size: 9px;">
                		<a class="left" data-slide="prev" href="#myCarousel2" style="background: none; border: none; opacity: 1;" onclick="check_html()">
                			<i class="icon icon-angle-left icon-2x" style=""></i>
            			</a>
            			&nbsp;
                        <span class="actt"></span> / <?=trim($num)?>
                        &nbsp;
                        <a class="right" data-slide="next" href="#myCarousel2" style="background: none; border: none; opacity: 1;" onclick="check_html_right()">
                        	<i class="icon icon-angle-right icon-2x" style=""></i>
                        </a>
                	</div>
                	<div style="float: left; width: 33.5%; text-align: right; font-size: 9px;">
                		
                	</div>
                	<div style="clear: both">
                	</div>
                </div>
                                              
                </div> 
                <div style="clear:both;height:10px;"></div>                                             
			</div>
		</div>
        <div style="clear:both;height:20px;"></div>                                             
        
   