<?php
	$client_logos = $this->home_model->create_logo_sets();
?>
<script>
var logos = {
	interval_id:'',
	rotate:function(){
		var timeout = 5000;
		
		logos.interval_id = setInterval(function(){
							var cur_set = $j('.client-logos ul').first();	
							var last_set = $j('.client-logos ul').last();
							cur_set.animate({
								'marginTop':'-95px'
								},1000,function(){
								//Animation complete
								//reset top
								$j(cur_set).css({'marginTop':'0px'});
								//append to bottom of the list
								cur_set.insertAfter(last_set);	
								});
						},timeout);	
	},
	
	pause:function(){
		clearInterval(logos.interval_id);	
	}
	

};//logos

$j(function(){
	help.unify_height('.home-box-txt-wrap p');
	
	//begin brands logo rotations
	<?php if($client_logos['total'] > 5 ){ ?>
	logos.rotate();
	<?php }?>
	
	$j('.client-logos').mouseenter(function(){
		logos.pause();	
	}).mouseleave(function(){
		<?php if($client_logos['total'] > 5 ){ ?>
		logos.rotate();
		<?php }?>
	});
	
});//ready

$j(window).resize(function(){
	help.unify_height('.home-box-txt-wrap p');
	
	setTimeout(function(){
		help.unify_height('.home-box-txt-wrap p');	
	},250)
});//resize
	
	


	
</script>
<?php $this->load->view('banner/banners');?>
<div class="container">
	<div class="wrap">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-sm-4 home-box">
                    <div class="img-wrap"><img src="<?=base_url();?>assets/frontend-assets/img/icons/icon-mobile.png" alt="icon-mobile" /></div>
                    <div class="home-box-txt-wrap">
                        <h1>WHY WAVE1?</h1>
                        <h2>CASE STUDIES</h2>
                        <p>In the 30 years of providing high quality wireless microwave systems, we have collected many case studies. Here is a selection of our case studies that show how Wave1 has consistently met our clients business objectives. </p>
                    </div>
                    <button type="button" class="button" onclick="javascript:window.location.href='<?=base_url();?>case-studies'"><i class="fa fa-angle-double-right"></i> READ CASE STUDIES</button>
                </div>
                <div class="col-sm-4 home-box">
                    <div class="img-wrap"><img src="<?=base_url();?>assets/frontend-assets/img/icons/icon-wifi.png" alt="icon-wifi" /></div>
                    <div class="home-box-txt-wrap">
                        <h1>WANT A FAST NETWORK?</h1>
                        <h2>OUR PRODUCTS</h2>
                        <p>Wave1 products bridge the gap between all areas of industry. Supplying high quality wireless microwave solutions to corporate, health, education & government departments</p>
                    </div>
                    <button type="button" class="button" onclick="javascript:window.location.href='<?=base_url();?>products'"><i class="fa fa-angle-double-right"></i> VIEW PRODUCTS</button>
                </div>
                <div class="col-sm-4 home-box">
                    <div class="img-wrap"><img src="<?=base_url();?>assets/frontend-assets/img/icons/icon-phone.png" alt="icon-phone" /></div>
                    <div class="home-box-txt-wrap">
                        <h1>24 - 365 REAL SUPPORT</h1>
                        <h2>OUR SERVICES</h2>
                        <p>Wave1 gives you "total peace of mind" from initial supply of equipment to 24 hour, 7 day a week year round maintenance and critical link monitoring</p>
                    </div>
                    <button type="button" class="button" onclick="javascript:window.location.href='<?=base_url();?>contact-us';"><i class="fa fa-angle-double-right"></i> LODGE SUPPORT</button>
                </div>
            </div>
        </div>
        
 			      
        <!-- Need to be hided first until the client okay with this feature
        <div class="row">
            <div class="col-lg-12">
            	<div class="client-logo-wrap">
                    <div class="client-logos-head">
                        <div class="col-sm-4 client-logo-strips hidden-xs"></div>
                        <div class="col-sm-3 hidden-sm"><span class="client-logo-head">trusts & uses wave1 technology</span></div>
                        <div class="col-sm-4 visible-sm"><span class="client-logo-head">trusts & uses wave1 technology</span></div>
                        <div class="col-sm-4 client-logo-strips hidden-xs"></div>
                    </div>
                    <div class="client-logos">
                    	<?=$client_logos['logos'];?>
                    </div>
                </div>
            </div> 
        </div>
        -->
	</div>
</div><!-- end page container-->