<link href="<?=base_url()?>assets/lightbox/magnific-popup.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/lightbox/jquery.magnific-popup.js"></script>
<script>
$j(function(){

	$j('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	
	
});//ready

</script>
<div class="container margin-top-10">
	<div class="wrap page-wrap">
        <div class="row">
            <div class="col-lg-12">
            	<div class="col-md-12">
                     <span class="page-title"><?=$page->title?></span>
                 </div>
            </div>
        </div><!--row-->	
        
        
		<div class="row margin-top-5">
            <div class="col-lg-12">
            	<div class="col-md-8 secondary-pages">
                     <?=$page->content?>
                		
                     <?php if($page->gallery){?>   
                     <?php
                        //get gallery here
                        $setting = $this->page_model->get_gallery_setting(1);
                        if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}
                        $gallery = $this->page_model->get_gallery($page->gallery);
                        $dir = $this->page_model->get_gallery_folder($page->gallery);
                    ?>
                        
						<link rel="stylesheet" href="<?=base_url()?>assets/frontend-assets/flexjs/flexslider.css" type="text/css" media="screen" />
                        <script src="<?=base_url()?>assets/frontend-assets/flexjs/modernizr.js"></script>
                        <script defer src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.flexslider.js"></script>
                        <script>
						jQuery(window).load(function() {
						  // The slider being synced must be initialized first
						  jQuery('#carousel').flexslider({
							animation: "slide",
							controlNav: false,
							animationLoop: false,
							slideshow: false,
							itemWidth: <?=$setting['width']?>+10,
							itemMargin: 5,
							asNavFor: '#slider'
						  });
						   
						/*  jQuery('#slider').flexslider({
							animation: "slide",
							controlNav: false,
							animationLoop: false,
							slideshow: false,
							sync: "#carousel"
						  });*/
						});
						</script>
                        
                        <style>
						.popup-gallery {
							border:none!important;
						}
						.slides li:before {
							content:""!important;
						}
						
						.flex-direction-nav li:before{
							content:""!important;
						}
						.slides{
							padding: 0!important;
						}
						.flex-direction-nav{
							padding: 0!important;
							height: 0!important;
						}
						</style>
                        
                        <div class="gallery-box" style="width:100%!important;">
                            <span>Click Image For Larger View</span>
                            <div class="gallery-img-box">           
                        <div id="carousel" class="flexslider">
                          <ul class="slides popup-gallery">
                            <? if($gallery){
                                foreach($gallery as $photo){
                                    $photo_src_full = base_url().'uploads/galleries/'.$dir.'/'.$photo->name;                                    
                                    $thumb_src = base_url().'uploads/'.$folder_init.'/'.$dir.'/'.$folder_pic.'/'.$photo->name;
                                ?>
                                    <li><a title="<?=$photo->name;?>" href="<?=$photo_src_full?>"><img style="width:auto!important;" src="<?=$thumb_src;?>" /></a></li>
                                <?
                                }
                             }?>
                            <!-- items mirrored twice, total of 12 -->
                          </ul>
                        </div>
                        </div>
                        </div>
	                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
			 	<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>
                <!-- Syntax Highlighter -->
				<script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shCore.js"></script>
                <script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shBrushXml.js"></script>
                <script type="text/javascript" src="<?=base_url()?>assets/frontend-assets/flexjs/shBrushJScript.js"></script>
                
                <!-- Optional FlexSlider Additions -->
                <script src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.easing.js"></script>
                <script src="<?=base_url()?>assets/frontend-assets/flexjs/jquery.mousewheel.js"></script>
                <script defer src="<?=base_url()?>assets/frontend-assets/flexjs/demo.js"></script>   
                 <?php }?>                           
                </div>
                
                <?=$this->load->view('page_right_bar');?>
            </div>
        </div><!--row-->	
        
        
	</div><!--product-wrap-->
</div>