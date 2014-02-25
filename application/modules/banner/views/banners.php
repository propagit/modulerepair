<script>
$j(function(){
	//update banner count for first banner
	banner.update_view_count();
	$j('.carousel').carousel({
       interval: 7000
   	}).on('slid.bs.carousel', function () {
		banner.update_view_count();
	});
});

var banner = {
	update_view_count:function(){
		var active_banner_id = $j('.carousel-inner').find('.active').attr('data');
		$j.ajax({
		  type:'post',
		  url:'<?=base_url();?>home/ajax/update_view_count',
		  data:{banner_id:active_banner_id},
		  success:function(data){
				
		  },error:function(){
			  //error
		  }
	  });	
	}
};

</script>
<?php
	$banners = $this->home_model->all_files_active();
?>
<div class="container margin-top-10">
	<div class="wrap">
        <div class="row banner-wrap">
            <div class="col-lg-12">
                <div id="site-banners" class="carousel slide">
                   <? if(count($banners)>1){?>
                   
                     <ol class="carousel-indicators">
					    <?
                        $i=0;
                        foreach($banners as $banner){
						?>
                            <li class="<?=($i==0 ? 'active' : '');?>" data-slide-to="<?=$i?>" data-target="#site-banners"></li>
                        <? 
                        $i++;
                        }?>                                         
                    </ol>
                    <? } ?>
                    <div class="carousel-inner">
                    	<? $i=0; ?>
                        <? foreach($banners as $banner){?>     
								<div class="item <?=($i==0 ? 'active' : '');?>" data="<?=$banner['id'];?>">                                                               
                                	<a href="<?=base_url()?>home/link/<?=$banner['id']?>"><img src="<?=base_url()?>uploads/banners/<?=$banner['name']?>" alt="" /></a>                           
                            	</div> 
                            <? 
                            $i++;
						}
                           ?>                        
                    </div>                   
                    <? if(count($banners)>1){?>
                   		<a class="left carousel-control" data-slide="prev" href="#site-banners"><i class="fa fa-angle-left"></i></a>
                    	<a class="right carousel-control" data-slide="next" href="#site-banners"><i class="fa fa-angle-right"></i></a>
                    <? } ?>                    
                </div>
            </div>
        </div>
    </div>
</div><!-- end banner container -->