<!--
<?
	$menu = array(
		array(
			'path' => 'dashboard',
			'label' => 'Dashboard'
		),
		array(
			'path' => 'product',
			'label' => 'Manage Products',
			'sub' => array(
				'category' => 'Categories',
				'brand' => 'Brands'
			)
		),
		array(
			'path' => 'order',
			'label' => 'Orders'
		),
		array(
			'path' => 'user',
			'label' => 'Manage Users',
		),
		array(
			'path' => 'resource',
			'label' => 'Resources Management'
		),
		array(
			'path' => 'page',
			'label' => 'Content Management'
		)
	);
	
	$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 'dashboard';
	$sec = $this->uri->segment(3);
?>
<ul class="nav nav-tabs nav-stacked">
	<? foreach($menu as $link) { ?>
	<li<?=($page == $link['path']) ? ' class="active"' : '';?>>
		<a href="<?=base_url() . 'admin/' . $link['path'];?>">
			<? if (isset($link['sub']) && ($page == $link['path'])) { ?>
			<i class="icon-chevron-down<?=($page == $link['path']) ? ' icon-white' : '';?>"></i>
			<? } else { ?>
			<i class="icon-chevron-<?=($page == $link['path']) ? 'right icon-white' : 'left';?>"></i> 
			<? } ?>
			<?=$link['label'];?></a>
		<? if (isset($link['sub']) && ($page == $link['path'])) { ?>
			<ul class="nav nav-tabs nav-stacked nav-sub">
				<? foreach($link['sub'] as $key => $value) { ?>
				<li<?=($sec == $key) ? ' class="active"' : '';?>><a href="<?=base_url() . 'admin/' . $link['path'] . '/' . $key;?>"><i class="icon-chevron-<?=($sec == $key) ? 'right' : 'left';?> icon-white"></i> <?=$value;?></a></li>
				<? } ?>
			</ul>
		<? } ?>
	</li>
	<? } ?>
</ul>
-->



<style>
.black-source{
	font-family: 'Source Sans Pro', sans-serif;
	color:#222222;
}
.white-source{
	font-family: 'Source Sans Pro', sans-serif;
	color:#fff!important;
}
.nav-font{
	font-size:15px;
	font-weight:700;
	text-decoration:none;
}
.nav-font-semi{
	font-size:15px;
	font-weight:400;
	text-decoration:none;
	display: block;
}
.accordion-inner >a:hover, a:focus{
	text-decoration:none!important;
	
}

.bs-docs-sidenav.affix {
    top: 207px;
}
.bs-docs-sidenav {
    width: 258px;
}
.affix {
    position: fixed;
}
.bs-docs-sidenav > .active > a {
    border: 0 none;
    box-shadow: 1px 0 0 rgba(0, 0, 0, 0.1) inset, -1px 0 0 rgba(0, 0, 0, 0.1) inset;
    padding: 9px 15px;
    position: relative;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.15);
    z-index: 2;
}
.bs-docs-sidenav {
    background-color: #FFFFFF;
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);
    margin: 30px 0 0;
    padding: 0;
    width: 228px;
}
.bs-docs-sidenav > li > a {
    border: 1px solid #E5E5E5;
    display: block;
    margin: 0 0 -1px;
    padding: 8px 14px;
}
.bs-docs-sidenav > li:first-child > a {
    border-radius: 6px 6px 0 0;
}
.bs-docs-sidenav > li:last-child > a {
    border-radius: 0 0 6px 6px;
}
.bs-docs-sidenav > .active > a {
    border: 0 none;
    box-shadow: 1px 0 0 rgba(0, 0, 0, 0.1) inset, -1px 0 0 rgba(0, 0, 0, 0.1) inset;
    padding: 9px 15px;
    position: relative;
    text-shadow: 0 1px 0 rgba(0, 0, 0, 0.15);
    z-index: 2;
}
.bs-docs-sidenav .icon-chevron-right {
    float: right;
    margin-right: -6px;
    margin-top: 2px;
    opacity: 0.25;
}
.accordion-toggle .icon-chevron-down {
    float: right;
    margin-right: -6px;
    margin-top: 2px;
    opacity: 0.25;
}
.accordion-toggle .icon-chevron-right {
    float: right;
    margin-right: -6px;
    margin-top: 2px;
    opacity: 0.25;
}
.accordion-inner .icon-chevron-right {
    float: right;
    margin-right: -6px;
    margin-top: 2px;
    opacity: 0.25;
}

.accordion-inner a:hover .icon-chevron-right {
    opacity: 0.5;
}

.bs-docs-sidenav > li > a:hover {
    background-color: #F5F5F5;
}
.bs-docs-sidenav a:hover .icon-chevron-right {
    opacity: 0.5;
}
.bs-docs-sidenav .active .icon-chevron-right, .bs-docs-sidenav .active a:hover .icon-chevron-right {
    background-image: url("../img/glyphicons-halflings-white.png");
    opacity: 1;
}
.accordion-toggle .active .icon-chevron-right, .accordion-toggle .active a:hover .icon-chevron-right {
    background-image: url("../img/glyphicons-halflings-white.png");
    opacity: 1;
}
.accordion-inner .active .icon-chevron-right, .accordion-inner .active a:hover .icon-chevron-right {
    background-image: url("../img/glyphicons-halflings-white.png");
    opacity: 1;
}
.bs-docs-sidenav.affix {
    top: 207px;
}
.bs-docs-sidenav.affix-bottom {
    bottom: 270px;
    position: absolute;
    top: auto;
}
.bs-docs-container {
    max-width: 970px;
}
.bs-docs-sidenav {
    width: 258px;
}
.bs-docs-sidenav > li > a {
}

.accordion-heading > a {
    border: 1px solid #E5E5E5;
    display: block;
    margin: 0 0 -1px;
    padding: 8px 14px;
	text-decoration:none;
	background-color: #f1f1f1;   
}
.accordion-heading > a:hover{
    border: 1px solid #E5E5E5;
    display: block;
    margin: 0 0 -1px;
    padding: 8px 14px;
	background-color:#f5f5f5;
	text-decoration:none;
}
.inner-active > a:focus{
	color: #ffffff;
	 
}
a:hover, a:focus{
	color:#222222;
}


</style>
<script>
 var active_head = 0;
jQuery(function() {

    jQuery('.accordion').on('show', function (e) {
         jQuery(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');
    });
    
    jQuery('.accordion').on('hide', function (e) {
        jQuery(this).find('.accordion-toggle').not(jQuery(e.target)).removeClass('active');
    });
    
   
    
	//getcats2(); 
});

function heading_click(id)
{
	jQuery('.aheading').each(function(e){
    	if (jQuery(this).hasClass('header-bg-color')) {			
			jQuery(this).removeClass('header-bg-color');
			//jQuery(this).parent().find('.white-source').removeClass('white-source');
			
    	}
	});
	
	if(active_head != id)
	{
		jQuery('.accordion-heading').children().css('background-color','#f1f1f1');
		jQuery('.accordion-heading').children().css('color','#222');
		jQuery('.arrow').html('<i class="icon-chevron-right"></i>');
		//jQuery('#heading'+id).css('background-color','rgba(32,132,206,0.25)');
		jQuery('#heading'+id).css('background-color','rgba(228,0,111,0.25)');
		jQuery('#heading'+id).css('color','#222');
		jQuery('#arrow'+id).html('<i class="icon-chevron-down"></i>');
		active_head = id;
	}
	else
	{
		jQuery('.accordion-heading').children().css('background-color','#f1f1f1');
		jQuery('.accordion-heading').children().css('color','#222');
		jQuery('.arrow').html('<i class="icon-chevron-right"></i>');
		//$('#heading'+id).css('background-color','#2084ce');
		//$('#heading'+id).css('color','#fff');
		//$('#arrow'+id).html('<i class="icon-chevron-down"></i>');
		active_head = 0;
	}
}

function click_active(id)
{
	jQuery('.accordion-inner').each(function(e){
    	if (jQuery(this).hasClass('inner-active')) {			
			jQuery(this).removeClass('inner-active');
			jQuery(this).parent().find('.white-source').removeClass('white-source');
			
    	}
	});
	
	jQuery('#inner-'+id).toggleClass("inner-active");
	jQuery('#inner-'+id+ ' a').toggleClass('white-source');
	

}

</script>

<?php
	$url_pages=$_SERVER['REQUEST_URI'];
	$ex_pages=explode("/",$url_pages);
	if(isset($ex_pages[4]))
	{
		$curr_page=$ex_pages[4];
	}
	else {
		$curr_page = '';
	}
	//echo $curr_page;
	if(isset($ex_pages[3]))
	{
		$curr_head=$ex_pages[3];
	}
	else
	{
		$curr_head='';
	}
	$not_active_page = 'class="black-source nav-font-semi"';
	$active_page = 'class="white-source nav-font-semi"';
	
	$not_active_page2 = '';
	$active_page2 = 'inner-active';
	
	
?>
<div class="span3 bs-docs-sidebar">
	<!--
    <ul class="nav nav-list bs-docs-sidenav affix">
      <li><a href="#built-with-less"><i class="icon-chevron-right"></i> Built with LESS</a></li>
      <li><a href="#compiling"><i class="icon-chevron-right"></i> Compiling Bootstrap</a></li>
      <li><a href="#static-assets"><i class="icon-chevron-right"></i> Use as static assets</a></li>
    </ul>
    -->
  <div style="margin-left: 19px; margin-bottom: 0px" class="accordion hidden-phone" id="accordion2">
	<!-- 
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(10);" >
      <a id="heading10" class="accordion-toggle black-source nav-font <?php if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='page_category'|| $curr_page=='galleries' || $curr_page=='category'|| $curr_page=='homepage')){echo "header-bg-color";}?> aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        <span class="arrow" id="arrow10">
        	<?php
        		if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='page_category' || $curr_page=='galleries' || $curr_page=='category' || $curr_page=='homepage'))
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>CREATE CONTENT
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse <?php if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='page_category' || $curr_page=='galleries' || $curr_page=='category' || $curr_page=='homepage')){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_page == 'banner'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1">
        <a href="<?=base_url()?>admin/cms/banner" <?php if($curr_page == 'banner'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Banners</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'stories'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2">
        <a href="<?=base_url()?>admin/cms/stories" <?php if($curr_page == 'stories'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Stories</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'promotions'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-7">
        <a href="<?=base_url()?>admin/cms/promotions" <?php if($curr_page == 'promotions'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Promotions</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'page_category' ||$curr_page == 'page' || $curr_page == 'editpage'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
        <a href="<?=base_url()?>admin/cms/page" <?php if($curr_page == 'page_category' || $curr_page == 'page' || $curr_page == 'editpage'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Pages</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'galleries'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4">
        <a href="<?=base_url()?>admin/cms/galleries" <?php if($curr_page == 'galleries'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Image Galleries</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'category'){echo $active_page2;} else {echo $not_active_page2;}?>">
        <a href="<?=base_url()?>admin/cms/category" <?php if($curr_page == 'category'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Categories</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'homepage'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5">
        <a href="<?=base_url()?>admin/cms/homepage" <?php if($curr_page == 'homepage'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Homepage</a>
      </div>     
    </div>
  </div>
  -->
  
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(1);" >
      <a id="heading1" class="accordion-toggle black-source nav-font <?php if(($curr_head == 'product' && ($curr_page=='' || $curr_page=='feature' || $curr_page=='category')) ||$curr_head == 'position'){echo "header-bg-color";}?> aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseTen">
        <span class="arrow" id="arrow1">
        	<?php
        		if(($curr_head == 'product' && ($curr_page=='' || $curr_page=='feature' || $curr_page=='category')) ||$curr_head == 'position')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE PRODUCTS
      </a>
    </div>
    <div id="collapseTen" class="accordion-body collapse <?php if(($curr_head == 'product' && ($curr_page=='' || $curr_page=='feature' || $curr_page=='category')) ||$curr_head == 'position'){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_page == 'category'){echo $active_page2;} else {echo $not_active_page2;}?>" class="accordion-inner" id="inner-6">
        <a href="<?=base_url()?>admin/product/category" <?php if($curr_page == 'category'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Categories</a>
      </div>
      <div class="accordion-inner <?php if($curr_head == 'product' && $curr_page == ''){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5">
        <a href="<?=base_url()?>admin/product" <?php if($curr_head == 'product' && $curr_page == ''){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Products</a>
      </div>
      <div class="accordion-inner <?php if($curr_head == 'product' && $curr_page == 'feature'){echo $active_page2;} else {echo $not_active_page2;}?>" class="accordion-inner" id="inner-6">
        <a href="<?=base_url()?>admin/product/feature" <?php if($curr_page == 'feature'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Feature Products</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == '' && $curr_head == 'position'){echo $active_page2;} else {echo $not_active_page2;}?>" class="accordion-inner" id="inner-6">
        <a href="<?=base_url()?>admin/position" <?php if($curr_page == '' && $curr_head == 'position'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Products Position</a>
      </div>
    </div>
  </div>
  
  
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(2);">
      <a id="heading2" class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        <span class="arrow" id="arrow2">
        	<?php
        		if($curr_head == 'order')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE ORDERS
      </a>
    </div>
    
    <div id="collapseTwo" class="accordion-body collapse <?php if($curr_head == 'order'){echo "in";}?>">
    	<div class="accordion-inner <?php if($curr_head == 'order'&&$curr_page == 'list_all'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1" >
	    	<a style="display: block" href="<?=base_url()?>admin/order/list_all" <?php if($curr_head == 'order' && $curr_page == 'list_all'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Orders</a>
		</div>
		<div class="accordion-inner <?php if($curr_page == 'statistic'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
	    	<a style="display: block" href="<?=base_url()?>admin/order/statistic" <?php if($curr_page == 'statistic'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Sales Reports</a>
		</div>   
    </div>
    
  </div>
  <div class="accordion-group" >
    <div class="accordion-heading" onclick="heading_click(3);">
      <a id="heading3" class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
        <span class="arrow" id="arrow3">
        	<?php
        		if($curr_head == 'customer')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE CUSTOMERS
      </a>
    </div>
    
    <div id="collapseFour" class="accordion-body collapse <?php if($curr_head == 'customer'){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_head == 'customer'&&$curr_page == 'list_all'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1" >
      	<a style="display: block" href="<?=base_url()?>admin/customer/list_all" <?php if($curr_head == 'customer'&&$curr_page == 'list_all'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customers</a>
      </div>
      <!--
      <div class="accordion-inner <?php if($curr_page == 'survey'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
      	<a target="_blank" style="display: block" href="<?=base_url()?>admin/cms/call_survey" <?php if($curr_page == 'survey'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Survey</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'email'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
      	<a target="_blank" style="display: block" href="<?=base_url()?>admin/cms/call_email" <?php if($curr_page == 'email'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customer Email</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'sms'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4" >
      	<a target="_blank" style="display: block" href="<?=base_url()?>admin/cms/call_sms" <?php if($curr_page == 'sms'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customer SMS</a>
      </div>
     -->
    </div>
   
  </div>
  <!--
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(4);">
      <a id="heading4"  class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
        <span class="arrow" id="arrow4">
        	<?php
        		if($curr_head == 'system')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>SYSTEM SETTINGS
      </a>
    </div>
    
    
    <div id="collapseThree" class="accordion-body collapse <?php if($curr_head == 'system'){echo "in";}?>">
     
      <div class="accordion-inner <?php if($curr_page == 'shipping'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
        <a href="<?=base_url()?>admin/system/shipping" <?php if($curr_page == 'shipping'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Shipping Methods</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'coupon'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
        <a href="<?=base_url()?>admin/system/coupon" <?php if($curr_page == 'coupon'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Coupons &amp; Discounts</a>
      </div>
     
      <div class="accordion-inner <?php if($curr_page == 'tax'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4" >
        <a href="<?=base_url()?>admin/system/tax" <?php if($curr_page == 'tax'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Taxes</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'email'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5" >
        <a href="<?=base_url()?>admin/system/email" <?php if($curr_page == 'email'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Email Forwardings</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'currency'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5" >
        <a href="<?=base_url()?>admin/system/currency" <?php if($curr_page == 'currency'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Currency</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'webstat'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-6" >
        <a href="<?=base_url()?>admin/system/webstat" <?php if($curr_page == 'webstat'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Web Stats</a>
      </div>
    </div>
  </div>
  -->
</div>

<div style="margin-left: 0px; margin-bottom: 0px" class="accordion visible-phone" id="accordion2">
  <!--
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(10);" >
      <a id="heading10" class="accordion-toggle black-source nav-font <?php if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='galleries' || $curr_page=='category')){echo "header-bg-color";}?> aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        <span class="arrow" id="arrow10">
        	<?php
        		if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='galleries' || $curr_page=='category'))
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>CREATE CONTENT
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse <?php if($curr_head == 'cms' && ($curr_page=='banner' || $curr_page=='stories' || $curr_page=='promotions' || $curr_page=='page' || $curr_page=='galleries' || $curr_page=='category')){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_page == 'banner'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1">
        <a href="<?=base_url()?>admin/cms/banner" <?php if($curr_page == 'banner'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Banners</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'stories'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2">
        <a href="<?=base_url()?>admin/cms/stories" <?php if($curr_page == 'stories'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Stories</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'promotions'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-7">
        <a href="<?=base_url()?>admin/cms/promotions" <?php if($curr_page == 'promotions'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Promotions</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'page' || $curr_page == 'editpage'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
        <a href="<?=base_url()?>admin/cms/page" <?php if($curr_page == 'page' || $curr_page == 'editpage'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Pages</a>
      </div>
      
      <div class="accordion-inner <?php if($curr_page == 'galleries'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4">
        <a href="<?=base_url()?>admin/cms/galleries" <?php if($curr_page == 'galleries'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Create Image Galleries</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'category'){echo $active_page2;} else {echo $not_active_page2;}?>">
        <a href="<?=base_url()?>admin/cms/category" <?php if($curr_page == 'category'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Categories</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'homepage'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5">
        <a href="<?=base_url()?>admin/cms/homepage" <?php if($curr_page == 'homepage'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Homepage</a>
      </div>
     
    </div>
  </div>
  -->
  
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(1);" >
      <a id="heading1" class="accordion-toggle black-source nav-font <?php if($curr_head == 'cms' && ($curr_page=='product' || $curr_page=='feature') || ($curr_head == 'store' && $curr_page=='feature') ){echo "header-bg-color";}?> aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseTen">
        <span class="arrow" id="arrow1">
        	<?php
        		if($curr_head == 'cms' && ($curr_page=='product' || $curr_page=='feature') || ($curr_head == 'store' && $curr_page=='feature'))
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE PRODUCTS
      </a>
    </div>
    <div id="collapseTen" class="accordion-body collapse <?php if($curr_head == 'cms' && ($curr_page=='product' || $curr_page=='feature') || ($curr_head == 'store' && $curr_page=='feature')){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_page == 'product'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5">
        <a href="<?=base_url()?>admin/cms/product" <?php if($curr_page == 'product'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Manage Products</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'feature'){echo $active_page2;} else {echo $not_active_page2;}?>" class="accordion-inner" id="inner-6">
        <a href="<?=base_url()?>admin/cms/feature" <?php if($curr_page == 'feature'){echo $active_page;} else {echo $not_active_page;}?>><i class="icon-chevron-right"></i>Feature Products</a>
      </div>
      
    </div>
  </div>
  
  
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(2);">
      <a id="heading2" class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        <span class="arrow" id="arrow2">
        	<?php
        		if($curr_head == 'order')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE ORDERS
      </a>
    </div>
    
    <div id="collapseTwo" class="accordion-body collapse <?php if($curr_head == 'order'){echo "in";}?>">
    	<div class="accordion-inner <?php if($curr_head == 'order'&&$curr_page == 'list_all'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1" >
	    	<a style="display: block" href="<?=base_url()?>admin/order/list_all" <?php if($curr_head == 'order' && $curr_page == 'list_all'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Orders</a>
		</div>
		<div class="accordion-inner <?php if($curr_page == 'statistic'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
	    	<a style="display: block" href="<?=base_url()?>admin/order/statistic" <?php if($curr_page == 'statistic'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Sales Reports</a>
		</div>
      
    </div>
    
  </div>
  <div class="accordion-group" >
    <div class="accordion-heading" onclick="heading_click(3);">
      <a id="heading3" class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
        <span class="arrow" id="arrow3">
        	<?php
        		if($curr_head == 'customer')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>MANAGE CUSTOMERS
      </a>
    </div>
    
    <div id="collapseFour" class="accordion-body collapse <?php if($curr_head == 'customer'){echo "in";}?>">
      <div class="accordion-inner <?php if($curr_head == 'customer'&&$curr_page == 'list_all'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-1" >
      	<a style="display: block" href="<?=base_url()?>admin/customer/list_all" <?php if($curr_head == 'customer'&&$curr_page == 'list_all'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customers</a>
      </div>
      <!--
      <div class="accordion-inner <?php if($curr_page == 'survey'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
      	<a style="display: block" href="http://www.simplysuite.com.au/beta/?p=suite&s=survey" <?php if($curr_page == 'survey'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Survey</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'email'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
      	<a style="display: block" href="http://www.simplysuite.com.au/beta/?p=suite&s=email" <?php if($curr_page == 'email'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customer Email</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'sms'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4" >
      	<a style="display: block" href="http://www.simplysuite.com.au/beta/?p=suite&s=sms" <?php if($curr_page == 'sms'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Customer SMS</a>
      </div>
      -->
    </div>
   
  </div>
  <!--
  <div class="accordion-group">
    <div class="accordion-heading" onclick="heading_click(4);">
      <a id="heading4"  class="accordion-toggle black-source nav-font aheading" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
        <span class="arrow" id="arrow4">
        	<?php
        		if($curr_head == 'system')
				{
				?>
					<i class="icon-chevron-down"></i>
				<?
				}
				else 
				{
				?>
					<i class="icon-chevron-right"></i>
				<?	
				}
        	?>
        </span>SYSTEM SETTINGS
      </a>
    </div>
    
    
    <div id="collapseThree" class="accordion-body collapse <?php if($curr_head == 'system'){echo "in";}?>">
     
      <div class="accordion-inner <?php if($curr_page == 'shipping'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-2" >
        <a href="<?=base_url()?>admin/system/shipping" <?php if($curr_page == 'shipping'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Shipping Methods</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'coupon'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-3" >
        <a href="<?=base_url()?>admin/system/coupon" <?php if($curr_page == 'coupon'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Coupons &amp; Discounts</a>
      </div>
     
      <div class="accordion-inner <?php if($curr_page == 'tax'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-4" >
        <a href="<?=base_url()?>admin/system/tax" <?php if($curr_page == 'tax'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Manage Taxes</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'email'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5" >
        <a href="<?=base_url()?>admin/system/email" <?php if($curr_page == 'email'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Email Forwardings</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'currency'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-5" >
        <a href="<?=base_url()?>admin/system/currency" <?php if($curr_page == 'currency'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Currency</a>
      </div>
      <div class="accordion-inner <?php if($curr_page == 'webstat'){echo $active_page2;} else {echo $not_active_page2;}?>" id="inner-6" >
        <a href="<?=base_url()?>admin/system/webstat" <?php if($curr_page == 'webstat'){echo $active_page;} else {echo $not_active_page;}?>> <i class="icon-chevron-right"></i>Web Stats</a>
      </div>
    </div>
  </div>
  -->
</div>

</div>

   
     
    