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
               	<span class="page-title inline">RECENT NEWS</span>
                <ul class="page-inner-menu news-crumb">
                    <li><a href="<?=base_url();?>recent-news">BACK TO SEARCH</a></li>
                    <?php
						$next = $this->news_model->get_next_link($news->id,$news->news_date);
						$prev = $this->news_model->get_previous_link($news->id,$news->news_date);
						$next_link = "#";
						$prev_link = "#";
						$next_class = 'class="inactive-link"';
						$prev_class = 'class="inactive-link"';
						if($next){
							$next_link = base_url().'recent-news/'.$next;	
							$next_class = '';
						}
						
						if($prev){
							$prev_link = base_url().'recent-news/'.$prev;	
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
			$dir = $this->news_model->get_directory($news->id);
			$src = '';
			if(trim($news->image)){
				$src = $this->news_model->get_image_path($news->id,$news->image);	
			}else{
				$src = base_url().'assets/frontend-assets/img/core/no-image-case-study-thumb.jpg';
			}
			$doc_path = '';
			if(trim($news->doc)){
				$doc_path = $this->news_model->get_doc_path($news->id,$news->doc);	
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
                      <p>This news</p>
                    </div>
                    </a>
                    <?php }?>
                </div>
                <div class="col-md-9">
                	<h2 class="normal-h2 case-story-h2"><?=$news->title;?></h2>
                     <span class="article-info">
                        <strong>CATEGORY: </strong> <?=$this->news_model->get_news_categories($news->id);?>
                        <strong>DATE: </strong><?=date('d <\s\u\p>S</\s\u\p> F Y',strtotime($news->news_date));?>
                     </span>
                     <?=$news->content;?>
                    
                    <?php if($news->gallery){?>
                    <?php
						//get gallery here
						$gallery = $this->news_model->get_gallery($news->gallery);
						$dir = $this->news_model->get_gallery_folder($news->gallery);
					?>
                    <div class="gallery-box">
                    	<span>Click Image For Larger View</span>
                        <div class="gallery-img-box">                            
                              <div class="popup-gallery case-study-gallery">
                                <?php
                                if($gallery){
                                    foreach($gallery as $photo){
                                        $photo_src_full = base_url().'uploads/galleries/'.$dir.'/'.$photo->name;
										$thumb_src = base_url().'uploads/galleries/'.$dir.'/thumbnails2/'.$photo->name;
                                    ?>
                                        <a title="<?=$photo->name;?>" href="<?=$photo_src_full?>"><img src="<?=$thumb_src;?>" /></a>
                                    <?
                                    }
                                }
                                ?>
                             </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div><!--row-->


        
        
	</div><!--page-wrap-->
</div><!--container-->
