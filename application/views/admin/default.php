<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?> &middot; Admin Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap3/css/fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/jQuery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/date-picker/css/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/css/backend.css" rel="stylesheet" media="screen">
    
  </head>
  <body>
  	
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap3/js/fileupload.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/date-picker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/scripts/admin-helper.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/config.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/styles.js"></script>
    <script src="<?=base_url()?>assets/ckfinder/ckfinder.js"></script>
    <script src="<?=base_url()?>assets/ckfinder/config.js"></script>
    
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="//vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js"></script>
    
    
    
    <script>
    var $j = jQuery.noConflict();
	jQuery(document).ready(function() {

        jQuery('.btnpop').popover();
		help.go_to_top('#go-to-top');
		set_footer();
    });
	
	jQuery(window).resize(function(){
		set_footer();
	});
	
	function set_footer(){
		var dh = 63; //default height
		var sh = jQuery(window).height(); //screen height
		var mt = 0; //margin top
		var fh = 0; //fixed height of the header
		var apm = 58; //any padding or margin at top or bottom of containers that will affect the height of the page 
		//ideal height - header height + (body height  + footer default height)
		var ih = jQuery('header').height() + jQuery('#content').height() + dh + fh + apm;//ideal height
		if(sh > ih){
			//resize height
			//screen height - (header height + body height  + footer height)
			mt =  sh - ih;
			jQuery('footer').css('margin-top',mt);
	
		}
	}
	
	
	
	</script>
    
    
    <?php
	    			
	$url_pages=$_SERVER['REQUEST_URI'];
	$ex_pages=explode("/",$url_pages);
	if(isset($ex_pages[3]))
	{
		$curr_page=$ex_pages[3];
	}
	else {
		$curr_page = '';
	}
	
	?>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <style>
	/*
	header{
		background:url('<?=base_url()?>assets/backend-assets/img/bg-nav.jpg');
		background-repeat:repeat-x;
		height:130px;
	}
	footer{
		
		#bottom:0; 
		#position:fixed; 
		z-index:150;
		position:absolute;
		#top:expression(eval(document.documentElement.scrollTop+
			(document.documentElement.clientHeight-this.offsetHeight))); 
		background:url('<?=base_url()?>assets/backend-assets/img/bg-footer.jpg');
		background-repeat:repeat-x;
		height:63px;
		font-family: 'Raleway', sans-serif;
		font-size:12px;
		font-weight:500;
		color:#fff;
		line-height:60px;
		width:100%;
		margin-top:35px;
		
	}
	.rale_heavy{font-weight:900;}
	body{
		background-image: url("<?=base_url()?>assets/backend-assets/img/login/page-bg.jpg");
    	background-repeat: repeat;
	}
	#top-gap{
		height:15px!important;
	}
	header #company-name {
		line-height:20px!important;
	}
	header .menu-wrap {
		font-family: 'Raleway', sans-serif;
		font-weight:700;
		letter-spacing:2.2px;
		font-size:12px;
		line-height:13px!important;
		height:42px;
	}
	
	
	#logout-btn{position: fixed;right:0;top: 230px;background: #2d2d2d;border-radius: 4px 0 0 4px;height: 40px;width: 40px;color: #fff;}
	#logout-btn a{ color:#fff; text-decoration:none;}
	#logout-btn .fa{ font-size:20px; margin:11px 0 0 13px ;}
	
	.nav-pills > li{ }
	.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{color: #ffffff;}
	.nav li a{ }
	.nav .open > a, .nav .open > a:hover, .nav .open > a:focus{ #background-color:#f67e7c; background:none!important; background-color:transparent!important;}
	.nav > li > a:hover, .nav > li > a:focus{  #background-color:#f46562; background:none!important; background-color:transparent!important;}
	.nav-pills > li > a{ border-radius:0; padding-bottom:10px;}
	.nav-pills li a:last-child{ padding-bottom:10px;}
	.menu-item{
		font-size:12px!important;
		text-transform:uppercase!important;
		font-family: 'Raleway', sans-serif!important;
		font-weight:600!important;
		letter-spacing:0px!important;
	}
	header .list-menu-wrapper{
		#position:relative!important;
		top:auto!important;
	}
	.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus{
		background-color:transparent!important;
		background : none!important;
	}
	.dropdown-menu > li > a {
		line-height:2;
	}
	.popover {
		font-size:12px;
		font-family: 'Raleway', sans-serif!important;
		font-weight:600!important;
		text-align:center;
	}
	.navbar-header
	{
		background:#302F2F;
	}
	.navbar-collapse ul
	{
		background:#302F2F;
		margin: 0 -15px;
	}

	#firefox css 
	@-moz-document url-prefix() {
		#content-menu{ left:12%;}
		#product-menu{ left:23%;}
		#customer-menu{ left:48%;}
		#marketing-menu{ left:63%;}
		#web-stats-menu{ left:76%;}
	}
	
	@media (min-width: 992px) and (max-width: 1199px)#medium
	{
		header .menu-wrap 
		{
			font-size:11px;
			letter-spacing:normal;
		}
	}
	
	@media (min-width: 768px) and (max-width: 991px)#small
	{
		header .menu-wrap 
		{
			font-size:9px;
			letter-spacing:normal;
		}
	}*/

	</style>
    
    <header class="navbar navbar-inverse bs-docs-nav" role="banner">
    	<div id="logout-btn"><a href="<?=base_url();?>admin/logout"><i class="fa fa-power-off"></i></a></div>
    	<div class="container">
	    	<div class="row">
	    		<div class="col-xs-12 col-sm-12">
	    			<div id="company-name">
                    	<img src="<?=base_url()?>assets/backend-assets/img/login/admin-logo.png">                        
                        <div style="margin-top:3px;">WAVE1 - ADMIN</div>
                    </div>	    			
	    		</div>

	    	</div>
	    	<div id="middle-gap">&nbsp;</div>
	    	<div class="row hidden-xs" id="menu">
            	
            	<div class="col-sm-12">
                    <ul class="nav nav-pills nav-justified">
                    	<li class="menu-wrap" style="padding-left:0px!important;"><a href="<?=base_url()?>admin" style="padding-left:0px!important;text-align:left!important;" class="dropdown-toggle"><i class="fa fa-tachometer "></i>&nbsp;&nbsp;DASHBOARD</a></li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-pencil"></i></i>&nbsp;&nbsp;CONTENT</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="content-menu">
                                <li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item second-child"><a href="<?=base_url()?>admin/navigation">Manage Navigation</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/case_studies">Manage Case Studies</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/news">Manage News Articles</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/page">Manage Pages</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/gallery">Manage Galleries</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/file">Manage Files</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/banner">Manage Banners</a></li>
                            </ul>
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-tags"></i>&nbsp;&nbsp;PRODUCTS</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="product-menu">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                                <li class="menu-item second-child"><a href="<?=base_url()?>admin/product">Manage Products</a></li>    	
                                <li class="menu-item"><a href="<?=base_url()?>admin/position">Manage Product Position</a></li>   								
                                <li class="menu-item"><a href="<?=base_url()?>admin/product/category">Manage Product Categories</a></li>
                            </ul>
                        </li>
                        
                        <li class="menu-wrap"><a rel="popover" class="dropdown-toggle btnpop" data-content="The orders module is deactivated on your admin panel. To start selling online lodge a support ticket via the support menu" data-placement="bottom" data-toggle="popover" data-container="header" data-trigger="hover" ><i class="fa fa-stack-overflow"></i>&nbsp;&nbsp;ORDERS</a>

                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-user"></i>&nbsp;&nbsp;CUSTOMERS</a>
                        	
                            <ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="customer-menu">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item second-child"><a href="<?=base_url()?>admin/customer">Manage Customers</a></li>      
                            </ul>
                           
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;MARKETING</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="marketing-menu">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item second-child"><a href="<?=base_url()?>admin/marketing/call_email" target="_blank" >Email Marketing</a></li>      
                                <li class="menu-item"><a href="<?=base_url()?>admin/marketing/call_sms" target="_blank">SMS Marketing</a></li>      
                                <li class="menu-item"><a href="<?=base_url()?>admin/marketing/call_survey" target="_blank">Online Surveys</a></li>      
                            </ul>
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-wrench"></i>&nbsp;&nbsp;SETTINGS</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="web-stats-menu">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item second-child"><a href="<?=base_url()?>admin/googlestats">Google Web Stats (Anaylitics)</a></li>      
                            </ul>
                        </li>
                        <li class="menu-wrap" style="padding-right:0px!important;"><a style="padding-right:0px!important;text-align:right!important;" class="dropdown-toggle"><i class="fa fa-phone"></i>&nbsp;&nbsp;SUPPORT</a></li>
                    </ul>
                </div>
               
	    	</div>
            <div style="clear:both;"></div>
	    	<div class="row visible-xs" style="margin-top:-9px;">
	    		<div class="container">
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu menu-wrap" href="<?=base_url()?>admin">MENU</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse collapse" role="navigation" >
						<ul class="nav navbar-nav">
							<li class="menu-wrap">
								<a href="<?=base_url()?>admin" class="phone-menu"><i class="fa fa-tachometer"></i>&nbsp;&nbsp;&nbsp;&nbsp;DASHBOARD</a>
							</li>
							<li class="menu-wrap">
								<a href="<?=base_url()?>admin/banner" class="phone-menu"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;&nbsp;CONTENT</a>
							</li>
							<li class="menu-wrap">
								<a href="<?=base_url()?>admin/product" class="phone-menu"><i class="fa fa-tags"></i>&nbsp;&nbsp;&nbsp;&nbsp;PRODUCTS</a>
							</li>
                            <li class="menu-wrap">
								<a href="#" class="phone-menu"><i class="fa fa-stack-overflow"></i>&nbsp;&nbsp;&nbsp;&nbsp;ORDERS</a>
							</li>
                            
							<li class="menu-wrap">
								<a href="<?=base_url()?>admin/customer" class="phone-menu"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;CUSTOMERS</a>
							</li>
                            <li class="menu-wrap">
								<a href="<?=base_url()?>admin/product" class="phone-menu"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;&nbsp;&nbsp;MARKETING</a>
							</li>
                            <li class="menu-wrap">
								<a href="<?=base_url()?>admin/googlestats" class="phone-menu"><i class="fa fa-wrench"></i>&nbsp;&nbsp;&nbsp;&nbsp;SETTINGS</a>
							</li>
                            <li class="menu-wrap">
								<a href="<?=base_url()?>admin/product" class="phone-menu"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;&nbsp;SUPPORT</a>
							</li>
						</ul>
					</nav>
	    		</div>
	    		<div class="container">
	    			
	    			
	    			<!-- content start -->
	    			<?php if($curr_page == 'page' || $curr_page == 'navigation' || $curr_page == 'case_studies' || $curr_page == 'gallery' || $curr_page == 'file' || $curr_page == 'banner'){?>
	    			<div class="navbar-header secondheader">
		    			<button class="navbar-toggle mobile_button" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<!--<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>-->
                            <a class="navbar-brand phone-menu">CONTENTS - SUBMENU</a>
						</button>
						
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
                        	<li ><a class="phone-menu" href="<?=base_url()?>admin/navigation">Manage Navigation</a></li>
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/case_studies">Manage Case Studies</a></li>
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/page">Manage Pages</a></li>
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/gallery">Manage Galleries</a></li>
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/file">Manage Files</a></li>
						</ul>
					</nav>
	    			<?php }?>
	    			<!-- content end -->
                    
	    			<!-- product & position start -->
	    			<?php if($curr_page == 'product' || $curr_page == 'position'){?>
	    			<div class="navbar-header secondheader">
		    			<button class="navbar-toggle mobile_button" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<!--<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>-->
                            <a class="navbar-brand phone-menu">PRODUCTS - SUBMENU</a>
						</button>
						<!--<a class="navbar-brand phone-menu" href="<?=base_url()?>admin/product">Products - Submenu</a>-->
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">

							<li ><a class="phone-menu" href="<?=base_url()?>admin/product">Manage Products</a></li>    									
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/position">Manage Product Position</a></li>   				
                            <li ><a class="phone-menu" href="<?=base_url()?>admin/product/category">Manage Product Categories</a></li>
						</ul>
					</nav>
	    			<?php }?>
	    			<!-- product & position end -->

	    		</div>
	    	</div>
	    	<div id="bottom-gap">&nbsp;</div>
    	</div>
    </header>
   	
    <div id="content">
    	<div class="container">
    	<?=$content?>
        </div>
    </div><!-- content -->
    
    <footer>
    	<div style="clear: both;text-align:center;letter-spacing:1px;">
    		Copyright &copy; <span class="rale_heavy">FLARE</span>RETAIL, all rights reserved.
    	</div>
        <div id="go-to-top" class="hidden"><i class="fa fa-angle-up"></i> TOP</div>

    </footer><!-- footer -->


  </body>
</html>
