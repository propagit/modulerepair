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
               <div class="col-md-12 case-story-head-wrap">
               	<span class="page-title inline">CASE STUDIES</span>
                <ul class="page-inner-menu case-studies-crumb">
                    <li><a href="<?=base_url();?>case-studies">BACK TO SEARCH</a></li>
                    <?php
						$next = $this->case_studies_model->get_next_link($case_story->id,$case_story->study_date);
						$prev = $this->case_studies_model->get_previous_link($case_story->id,$case_story->study_date);
						$next_link = "#";
						$prev_link = "#";
						$next_class = 'class="inactive-link"';
						$prev_class = 'class="inactive-link"';
						if($next){
							$next_link = base_url().'case-studies/'.$next;	
							$next_class = '';
						}
						
						if($prev){
							$prev_link = base_url().'case-studies/'.$prev;	
							$prev_class = '';
						}
					?>
                    <li><a <?=$prev_class;?> href="<?=$prev_link;?>"><i class="fa fa-angle-double-left"></i> PREVIOUS</a></li>
                    <li><a <?=$next_class;?> href="<?=$next_link;?>">NEXT <i class="fa fa-angle-double-right"></i></a></li>
                 </ul>
                 <hr class="page-top-hr" />
               </div>
            </div>
        </div><!--row-->	
        <?php
			$dir = $this->case_studies_model->get_directory($case_story->id);
			$src = '';
			if(trim($case_story->image)){
				$src = $this->case_studies_model->get_image_path($case_story->id,$case_story->image);	
			}else{
				$src = base_url().'assets/frontend-assets/img/core/no-image-case-study-thumb.jpg';
			}
			$doc_path = '';
			if(trim($case_story->doc)){
				$doc_path = $this->case_studies_model->get_doc_path($case_story->id,$case_story->doc);	
			}
		?>
        <div class="row margin-top-20">
            <div class="col-lg-12 case-story-body-wrap">   
            	<div class="col-md-3 case-story-md-3">
                	<div class="case-studies-img-box case-story-img-box">
                         <img src="<?=$src;?>" />
                    </div>
                    <?php if($doc_path){ ?>
                    <a class="no-text-decoration" href="<?=$doc_path;?>" target="_blank">
                    <div class="normal-shadow-box">
                      <span class="head">DOWNLOAD <i class="fa fa-download"></i></span>
                      <p>This case study</p>
                    </div>
                    </a>
                    <?php }?>
                </div>
                <div class="col-md-9">
                	<h2 class="normal-h2 case-story-h2"><?=$case_story->title;?></h2>
                     <span class="article-info">
                        <strong>INDUSTRY: </strong> <?=$this->case_studies_model->get_case_studies_categories($case_story->id);?>
                        <strong>DATE: </strong><?=date('d <\s\u\p>S</\s\u\p> F Y',strtotime($case_story->study_date));?>
                     </span>
                     <?=$case_story->content;?>
                    
                    <?php if($case_story->testimonial){?>
                    <div class="testimonial-box">
                    	<h3>Testimonial</h3>
                    	<?=$case_story->testimonial;?>
                    </div>
                    <?php } ?>
                    
                    <?php if($case_story->gallery){?>
                    <?php
						//get gallery here
						$setting = $this->case_studies_model->get_gallery_setting(1);
						if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}
						$gallery = $this->case_studies_model->get_gallery($case_story->gallery);
						$dir = $this->case_studies_model->get_gallery_folder($case_story->gallery);
					?>
                    <!--
                    <div class="gallery-box">
                    	<span>Click Image For Larger View</span>
                        <div class="gallery-img-box">                            
                              <div class="popup-gallery case-study-gallery">
                                <?php
                        /*        if($gallery){
                                    foreach($gallery as $photo){
                                        $photo_src_full = base_url().'uploads/galleries/'.$dir.'/'.$photo->name;
										//$thumb_src = base_url().'uploads/galleries/'.$dir.'/thumbnails2/'.$photo->name;
										$thumb_src = base_url().'uploads/'.$folder_init.'/'.$dir.'/'.$folder_pic.'/'.$photo->name;
                                    ?>
                                        <a title="<?=$photo->name;?>" href="<?=$photo_src_full?>"><img src="<?=$thumb_src;?>" /></a>
                                    <?
                                    }
                                }
                          */      ?>
                             </div>
                        </div>
                    </div>-->
                    
                    
                    
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
            </div>
        </div><!--row-->


        
        
	</div><!--page-wrap-->
</div><!--container-->
