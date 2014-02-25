
<script>
	$j(function(){
		help.unify_height('.prod-top-box');
	});//ready
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
                 <div class="col-xs-12 margin-top-30">
                 	 <h1 class="thick-h1"><?=$category->name;?></h1>
                  	 <h2 class="thin-h2"><?=$category->subname;?></h2>
                 </div>
            </div>
        </div><!--row-->	
        
        
		<div class="row margin-top-10">
            <div class="col-xs-12">
            	<?php 
				if($products){	
					foreach($products as $p){
					$hero = $this->product_model->get_product_hero_image($p->id);
					if(!$hero){
						$img_src = base_url().'assets/frontend-assets/img/core/no-image-thumb.jpg';	
					}else{
						$img_src = base_url().'uploads/products/'.md5('mbb'.$p->id).'/thumb1/'.$hero;
					}
				?>
            	<div class="col-xs-3 product-box">
                	<div class="product-thumb-box">
                		<a href="<?=base_url();?>products/<?=$category->id_title;?>/<?=$p->id_title;?>"><img src="<?=$img_src?>" /></a>
            		    
                    </div>
                    <div class="product-info-box">
                    	<div class="prod-top-box">
                            <h3><?=$p->title;?></h3>
                            <p><?=$p->short_desc;?></p>
                        </div>
                        <a href="<?=base_url();?>products/<?=$category->id_title;?>/<?=$p->id_title;?>"><button type="button" class="button more-info-btn"><i class="fa fa-search"></i> MORE INFO</button></a>
                    </div>
                </div>
                <?php 
					}
				} 
				?>

            </div>
        </div><!--row-->	
        
        
	</div><!--product-wrap-->
</div>