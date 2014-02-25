<link href="<?=base_url()?>assets/lightbox/magnific-popup.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/lightbox/jquery.magnific-popup.js"></script>
<script>
$j(function() {
	
	/* begin - popup gallery */
	$j('.gallery').each(function() { // the containers for all your galleries
		$j(this).magnificPopup({
			delegate: 'a', // the selector for gallery item
			type: 'image',
			gallery: {
			  enabled:true
			}
		});
	}); 
	/* end - popup gallery */
	 
	$j('.item').first().toggleClass("active");
	var id= $j('.item').first().attr("id");
	var n=id.split("#");			
	idstory = n[1];
	if(idstory==0)
	{
		$j('#cat1').toggleClass("active");
		$j('#cat2').hide();
		$j('#divider1').hide();
	}else
	{
		//$j('#cat2').html($j('#title_story'+idstory).val());
		//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
		//$j('#cat2').html('aa');
		$j('#cat1').removeClass('active');
		$j('#cat2').removeClass('active');

		$j('#cat2').toggleClass("active");
		
		$j('#cat2').show();
		$j('#divider1').show();
	}
	$j('.item').each(function () {
		if ($j(this).hasClass('active')) {			
			var id= $j(this).attr("id");
			var n=id.split("#");
			idp=n[0].replace('id','');
			var ids = parseInt(idp);
			$j('.actt').html(ids);
			
		}
	});
	<?
	
	if($slide > -1)
	{
	?>
		$j('.item').each(function () {
		if ($j(this).hasClass('active')) {			
			$j(this).removeClass('active');
		}
		});
		
		$j('.item').each(function () {			
			var id=$j(this).attr("id");
			var n=id.split("#");
			idp=n[1];			
			if(idp==<?=$slide?>)
			{
				$j(this).toggleClass("active");				
				idps=n[0].replace('id','');
				idstory = n[1];
				var ids = parseInt(idps);
				$j('.actt').html(ids);
				
				//$j('#cat2').html($j('#title_story'+idstory).val());
				//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
				$j('#cat1').removeClass('active');
				$j('#cat2').removeClass('active');
		
				$j('#cat2').toggleClass("active");
				
				$j('#cat2').show();
				$j('#divider1').show();
			}
		});
		
	<? } ?>
	$j('[id^="myCarousel"]').carousel('pause');
});
function check_html()
{
	var idsp=1;
	$j('.item').each(function () {
		if ($j(this).hasClass('active')) {			
			var id= $j(this).attr("id");
			var n=id.split("#");
			idp=n[0].replace('id','');
			var ids = parseInt(idp)-1;
			
			if(ids==0){
				
				idsp=0;
				cat = '<?=$cat?>';				
				ids=<?=$index?>;
				
			}
			$j('.actt').html(ids);
		}
	});
	
	if(idsp==1)
	{
		$j('.item').each(function () {
			if ($j(this).hasClass('active')) {								
				var id= $j(this).prev().attr("id");
				var n=id.split("#");			
				idstory = n[1];
				if(idstory==0)
				{
					$j('#cat1').toggleClass("active");
					$j('#cat2').hide();
					$j('#divider1').hide();
				}else
				{
					//$j('#cat2').html($j('#title_story'+idstory).val());
					//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
					$j('#cat1').removeClass('active');
					$j('#cat2').removeClass('active');
			
					$j('#cat2').toggleClass("active");
					
					$j('#cat2').show();
					$j('#divider1').show();
					
					//update header on page slide
					//$j('#story_header').html($j('#title_story_parent'+idstory).val());
				}
			}
		});
	}
	else{
		var id=$j('.item').last().attr("id");
		var n=id.split("#");			
		idstory = n[1];
	

		/*
		$j('#cat2').html($j('#title_story'+idstory).val());
		$j('#cat1').removeClass('active');
		$j('#cat2').removeClass('active');

		$j('#cat2').toggleClass("active");
		
		$j('#cat2').show();
		$j('#divider1').show();
		*/
		if(idstory==0)
		{
			$j('#cat1').toggleClass("active");
			$j('#cat2').hide();
			$j('#divider1').hide();
		}else
		{
			//$j('#cat2').html($j('#title_story'+idstory).val());
			//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
			$j('#cat1').removeClass('active');
			$j('#cat2').removeClass('active');
	
			$j('#cat2').toggleClass("active");
			
			$j('#cat2').show();
			$j('#divider1').show();
			
			//update header on page slide
			//$j('#story_header').html($j('#title_story_parent'+idstory).val());
		}
	}
	
}
function check_html_right()
{

	var idsp=1;
	$j('.item').each(function () {
		if ($j(this).hasClass('active')) {			
			var id= $j(this).attr("id");
			var n=id.split("#");			
			idp=n[0].replace('id','');
			var ids = parseInt(idp);
			ids=ids+1;

			cat = '<?=$cat?>';
			idsps=<?=$index?>;
			

			if(ids > idsps){idsp=0;ids=1;}			
			$j('.actt').html(ids);			
		}
	});
	/*
	$('.item').each(function () {
		if ($j(this).hasClass('active')) {			
			var id= $(this).next().attr("id");
			var n=id.split("#");
			idstory = n[1];
			if(idstory==0)
			{
				$j('#cat1').toggleClass("active");
				$j('#cat2').hide();
				$j('#divider1').hide();
			}else
			{
				$j('#cat2').html($j('#title_story'+idstory).val());
				$j('#cat1').removeClass('active');
				$j('#cat2').removeClass('active');
				$j('#cat2').toggleClass("active");
				$j('#cat2').show();
				$j('#divider1').show();
			}
		}
	});
	*/
	if(idsp==1)
	{
		$j('.item').each(function () {
			if ($j(this).hasClass('active')) {								
				var id= $j(this).next().attr("id");
				var n=id.split("#");			
				idstory = n[1];
				if(idstory==0)
				{
					$j('#cat1').toggleClass("active");
					$j('#cat2').hide();
					$j('#divider1').hide();
				}else
				{
					//$j('#cat2').html($j('#title_story'+idstory).val());
					//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
					$j('#cat1').removeClass('active');
					$j('#cat2').removeClass('active');
			
					$j('#cat2').toggleClass("active");
					
					$j('#cat2').show();
					$j('#divider1').show();
					
					//update header on page slide
					//$j('#story_header').html($j('#title_story_parent'+idstory).val());
				}
			}
		});
	}
	else
	{
		var id=$j('.item').first().attr("id");
		var n=id.split("#");			
		idstory = n[1];
	

		if(idstory==0)
		{
			$j('#cat1').toggleClass("active");
			$j('#cat2').hide();
			$j('#divider1').hide();
		}else
		{
			//$j('#cat2').html($j('#title_story'+idstory).val());
			//$j('#cat3').html($j('#title_story_parent'+idstory).val()+ '<span class="divider"> > </span>');
			$j('#cat1').removeClass('active');
			$j('#cat2').removeClass('active');
			$j('#cat2').toggleClass("active");
			$j('#cat2').show();
			$j('#divider1').show();
			
			//update header on page slide
			//$j('#story_header').html($j('#title_story_parent'+idstory).val());
		}
		
		/*$j('#cat2').html($j('#title_story'+idstory).val());
		$j('#cat1').removeClass('active');
		$j('#cat2').removeClass('active');

		$j('#cat2').toggleClass("active");
		
		$j('#cat2').show();
		$j('#divider1').show();*/
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

.front-gallery-slide-control{ color:#f02e2a !important; margin-top:190px !important;}
.gallery a img{ position:relative; left:0; right:0; margin:auto;}
.gallery a img:hover{-webkit-box-shadow: 0 0 6px rgba(0, 0, 0, 0.75);box-shadow: 0 0 6px rgba(0, 0, 0, 0.75);}
.gallery-title{margin-top: 10px;font-family: 'Raleway', sans-serif;font-size: 13px;text-align: center;font-weight: 700; text-transform:uppercase;}
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
<? if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}?>
<div class="container margin-top-10">
  	<div class="wrap page-wrap">
    	
        
        <!--<ul class="breadcrumb" style="font-size: 11px; text-transform: uppercase">
        
			    <li><a href="<?=base_url()?>">HOME</a> <span class="divider">></span></li>
                <li id="cat1"><a href="#">GALLERY</a> <span class="divider" id="divider1" style="display:none;">></span></li>
        </ul>
        <div style="height: 10px;"></div>
        
        <div style="height: 50px;"></div>
        -->
		<div class="row">
        	<div class="col-lg-12" >
            	<div class="col-md-12" >
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
                            <div class="col-md-12">
                               <div class="row-fluid">
                               <div class="col-md-12">
								<div style="height:8px; clear:both"></div>
							   <? 
							   $now=1;
							  
							   foreach($data_story[$m] as $st){  
							    $gallery = $this->gallery_model->get_gallery($st);
								
							   	if($now == 4){echo '</div>';$now = 1;}
								
							   	if($now == 1){   ?> 
                                		<div style="clear:both"></div>
                                        <div class="hidden-xs" style="height:26px;"></div>
                                        <div class="visible-xs" style="height:25px;"></div>
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
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                                	<img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? }else{ 
                                                            $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                        <? } ?>
                                                    
                                                    <? } ?>
                                                    <?
                                                        for($i=0;$i<count($photos);$i++) {                                                         
														if($photos[$i]['video'] == 0 && $photos[$i]['thumbnail'] == 0 && ($photos[$i]['name']!=$gallery['thumb_img'] || $photos[$i]['name']!=$thumbnail)){?>
                                                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
                        									<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
                                                        </a>
                                                        <? }
														if($photos[$i]['videos']==1)
															{
																?><a href="http:<?=$photos[$i]['name']?>" class="mfp-iframe">Youtube Video</a> <?
															}
														} ?>     
                                                  <br />                                                                                   	                                                
                                                <div class="gallery-title"><?=$gallery['title']?></div>
                                            </div>
                                        </div>  
                                <? }                                                                                                            
                                
                                if($now == 2){   ?>                                                                                                           
                                        <div class="visible-xs" style="height:25px;"></div>
                                        <div class="col-md-4" style="margin-left:0px!important;">
                                            <div style="text-align: center;" class="gallery slideshow">
                                            		<? 
													 $photos = $this->gallery_model->get_photos($gallery['id']);
													if (count($photos) == 0 && $gallery['thumbnail']==0) {
													   echo '<a class="img_display" href="'.base_url().'img/thumbnail-no-image.jpg"><img width="30%" src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></a>';
													   
													   } else{ ?>
                                                
														<? if($gallery['thumbnail']==1){?>
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                                	<img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                            </a>
                                                            
                                                        <? }else{ 
                                                            $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                               <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? } ?>
                                                    <? } ?>
                                                    <? 
														for($i=0;$i<count($photos);$i++) {                                                         
														if($photos[$i]['video'] == 0 && $photos[$i]['thumbnail'] == 0 && ($photos[$i]['name']!=$gallery['thumb_img'] || $photos[$i]['name']!=$thumbnail)){?>
                                                        <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
                        									<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
                                                        </a>
                                                        <? }
														if($photos[$i]['videos']==1)
															{
																?><a href="http:<?=$photos[$i]['name']?>" class="mfp-iframe">Youtube Video</a> <?
															}
														
														} ?>
                                                	 <br />
                                                <div class="gallery-title"><?=$gallery['title']?></div>
                                            </div>                                            
                                        </div>  
                                <? }                                                                                                           
                                if($now == 3){   ?>                                                                                                           
                                        <div class="visible-xs" style="height:25px;"></div>
                                        <div class="col-md-4" style="margin-left:0px!important;">
                                            <div style="text-align: center;" class="gallery slideshow">
                                            		<? 
													 $photos = $this->gallery_model->get_photos($gallery['id']);
													if (count($photos) == 0 && $gallery['thumbnail']==0) {
													   echo '<a class="img_display" href="'.base_url().'img/thumbnail-no-image.jpg"><img width="30%" src="'.base_url().'img/thumbnail-no-image.jpg" title="'.$gallery['title'].'" /></a>';
													   
													   } else{ ?>
                                                                                             
														<? if($gallery['thumbnail']==1){?>
                                                            <a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$gallery['thumb_img']?>" class="img_display" >
                                                                <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/thumb_gal/<?=$gallery['thumb_img']?>" title="<?=$gallery['title']?>" />-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$gallery['thumb_img']?>"  alt="" />
                                                                
                                                            </a>
                                                            
                                                        <? }else{ $thumbnail = $this->gallery_model->get_gallery_thumbnail($gallery['id']);
                                                        ?>
                                                            <a title="<?=$gallery['title']?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?=$thumbnail?>" class="img_display" >
                                                               <!--<img width="65%" src="<?=base_url()?>uploads/galleries/<?=md5("cdkgallery".$gallery['id'])?>/<?=$thumbnail?>" title="<?=$gallery['title']?>" />	-->
                                                                
                                                                	<img class="hidden-xs" style="max-width:85%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                    <img class="visible-xs" style="width:100%;" src="<?=base_url()?>uploads/<?=$folder_init?>/<?=md5("cdkgallery".$gallery['id'])?>/<?=$folder_pic?>/<?=$thumbnail?>"  alt="" />
                                                                
                                                            </a>
                                                        <? } ?>
                                                    <? } ?>    
                                                	<? 
                                                        for($i=0;$i<count($photos);$i++) { 
															if($photos[$i]['video'] == 0 && $photos[$i]['thumbnail'] == 0 && ($photos[$i]['name']!=$gallery['thumb_img'] || $photos[$i]['name']!=$thumbnail)){?>
															<a title="<?=$photos[$i]['title'];?>" href="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" class="img_display" style="display:none;">
																<img  src="<?=base_url()?>uploads/galleries/<?php print md5("cdkgallery".$gallery['id']); ?>/<?php print $photos[$i]['name'];?>" />
															</a>
															<? }
															if($photos[$i]['videos']==1)
															{
																?><a href="http:<?=$photos[$i]['name']?>" class="mfp-iframe">Youtube Video</a> <?
															}
														} ?>
                                                         <br />
                                                <div class="gallery-title"><?=$gallery['title']?></div>
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
						<i class="fa fa-angle-left front-gallery-slide-control"></i>
					</a>
					<a class="right carousel-control" data-slide="next" href="#myCarousel2" style="background: none; border: none; opacity: 1" onclick="check_html_right()">
						<i class="fa fa-angle-right front-gallery-slide-control"></i>
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
                
                <div class="visible-xs" style="padding-left:5%; padding-right: 5%; ">
                	
                    <div style="float: left; width: 33.5%; text-align: left; font-size: 9px; line-height:20px;">
                		
                	</div>
                	<div style="  text-align: center; font-size: 9px;">
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
            </div>
        </div>
        
    </div>
</div>
		