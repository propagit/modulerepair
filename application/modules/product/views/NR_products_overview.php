<link href="<?=base_url()?>assets/lightbox/magnific-popup.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/lightbox/jquery.magnific-popup.js"></script>
<script>
$j(function(){
	help.my_accordion('.my-accordion');
	
	
	
});//ready

$j(document).ready(function() {
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
}); 

</script>
<div class="container margin-top-10">
	<div class="wrap page-wrap">
        <div class="row">
            <div class="col-xs-12">
            	<div class="col-xs-12">
                     <span class="page-title">OUR PRODUCTS</span>
                     <ul class="page-inner-menu">
                        <?=$category_crumb;?>
                     </ul>
                 </div>
            </div>
        </div><!--row-->	
        
        <div class="row">
            <div class="col-xs-12">              
               <div class="col-xs-6">
                  <h1><?=$product->title;?></h1>
                  <h2><?=$category->name;?></h2>
                  <p>
                  <?=$product->long_desc;?>
                  </p>
                    
                    <!--begin accordion -->
                    <div class="my-accordion">
                        <h3 class="active">Product Features <i class="fa fa-angle-double-down pull-right"></i></h3>   
                        <?php if($product->features){?>
                        <div class="accordion-item active-item">
                        	<?=$this->product_model->format_product_features($product->features,false);?>
                        </div>
                    	<?php }?>
                        <?php if($product->technical_information){?>
                        <h3>Technical Information <i class="fa fa-angle-double-up pull-right"></i></h3>
                        <div class="accordion-item">
                        	<?=$this->product_model->format_product_features($product->technical_information,false);?>
                        </div>
                        <?php }?>
                    </div>
                  <!-- end accordion -->
               </div>
               
               <div class="col-xs-6">
               <?php
			   		$dir = md5('mbb'.$product->id);
			   		$hero = $this->product_model->get_product_hero_image($product->id);
			   		$img_src_full = '';
					if(!$hero){
						$img_src = base_url().'assets/frontend-assets/img/core/no-image-thumb.jpg';	
						$img_src_full = base_url().'assets/frontend-assets/img/core/no-image-thumb.jpg';
					}else{
						$img_src = base_url().'uploads/products/'.$dir.'/thumb1/'.$hero;
						$img_src_full = base_url().'uploads/products/'.$dir.'/'.$hero;
					}
			   ?>
               		
               		<div class="popup-gallery">
               			<a title="<?=$hero?>" href="<?=$img_src_full?>"><img class="product-hero-img" src="<?=$img_src;?>" /></a>
               			<?php
               			if($photos)
						{
							
							foreach($photos as $photo)
							{
								$photo_src_full = base_url().'uploads/products/'.$dir.'/'.$photo['name'];
							?>
								<a title="<?=$photo['name']?>" style="display: none" href="<?=$photo_src_full?>"><?=$photo_src_full?></a>
							<?
							}
						}
               			?>
               		</div>
                    <span class="gallery-open">Click Image For larger View & Additional Images</span>
                    <!-- <div id="demoLightbox" class="lightbox fade" tabindex="-1" role="dialog" aria-hidden="true">
					    <div class='lightbox-content'>
						    <img src="<?=$img_src?>">
						    <div class="lightbox-caption"><p>Your caption here</p></div>
					    </div>
				    </div> -->
               </div> 

            </div>
        </div><!--row-->
        
        <div class="row margin-top-60">
			<div class="col-xs-12">
               <div class="col-xs-6">
               	   <?php
				   		$status = 'hidden';
						$href = '';	
				   		if(trim($product->pdf_url) != ''){
							$status = '';
							$href = 'href="'.base_url().'uploads/products/'.$dir.'/doc/'.$product->pdf_url.'"';	
						}
				   ?>
                   <a class="no-text-decoration <?=$status;?>" <?=$href;?> target="_blank">
                   <div class="shadow-box">
                        <div class="shadow-box-inner">
                        	<span class="head">DOWNLOAD</span>
                            <p>The product brochure for more information</p>
                            <i class="fa fa-download"></i>
                        </div>	
                   </div>
                   </a>
               </div>
               <div class="col-xs-6">
               	   <a class="no-text-decoration" href="mailto:<?=sales_email;?>">
                   <div class="shadow-box">
                        <div class="shadow-box-inner">
                        	<span class="head">REQUEST A QUOTE</span>
                            <p>Need a quote, contact our sales team</p>
                            <i class="fa fa-envelope"></i>
                        </div>	
                   </div>
                   </a>
               </div>
            </div>
        </div>	

        
        
	</div><!--product-wrap-->
</div>