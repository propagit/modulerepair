<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?> &middot; Admin Portal</title>
	<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link href="<?=base_url()?>assets/backend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/date-picker/css/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/css/backend.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/backend-assets/jQuery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/bootstrap/js/bootstrap-fileupload.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/date-picker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/backend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/config.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/styles.js"></script>
    <script src="<?=base_url()?>assets/ckfinder/ckfinder.js"></script>
    <script src="<?=base_url()?>assets/ckfinder/config.js"></script>
    <script>
	jQuery(document).ready(function() {

        jQuery('.btnpop').popover();

    });

    
	function set_footer()
	{
	 	var dh = 63; //default height
        var sh = jQuery(window).height(); //screen height
		var nh = 0; //new height
		var lmtm = 0;//lawn mower top margin
		//ideal height - header height + (body height  + quick links height + footer graphics default height)
		var ih =jQuery('header').height() + jQuery('#content').height() + 25 + dh;//ideal height
		if(sh > ih)
		{
						//resize height
						//screen height - (header height + body height  + #footer .content .top's top margin)
						nh =  sh - (jQuery('header').height() + jQuery('#content').height() + 59);
						//jQuery('#graphics').css('height',nh);
						//jQuery('.set_gh').css('height',nh);//get height of graphics components such as paint bucket and toolbox
					   
						//set lawn mower height
						//lmtm = nh-(183+10);//new height - (height of lawnmower + 10)
						//jQuery('.set_ltm').css('margin-top',lmtm)//since lawn mower height is bigger. set its top margin instead of heigh
		}
		else
		{
						//jQuery('#graphics').css('height',dh);
						//jQuery('.set_gh').css('height',dh);//get height of graphics components such as paint bucket and toolbox
						jQuery('footer').css('margin-top','-82px')//since lawn mower height is bigger. set its top margin instead of height
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
	header{
		background:url('<?=base_url()?>assets/backend-assets/img/bg-nav.jpg');
		background-repeat:repeat-x;
		height:130px;
	}
	footer{
		
		bottom:0;
		position:fixed;
		z-index:150;
		_position:absolute;
		_top:expression(eval(document.documentElement.scrollTop+
			(document.documentElement.clientHeight-this.offsetHeight)));
		background:url('<?=base_url()?>assets/backend-assets/img/bg-footer.jpg');
		background-repeat:repeat-x;
		height:63px;
		font-family: 'Raleway', sans-serif;
		font-size:12px;
		font-weight:500px;
		color:#fff;
		line-height:63px;
		width:100%;
		
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
	
	
	#logout-btn{position: absolute;right: -1px;top: 178px;background: #2d2d2d;border-radius: 4px 0 0 4px;height: 40px;width: 40px;color: #fff;}
	#logout-btn a{ color:#fff; text-decoration:none;}
	#logout-btn a i{ font-size:20px; margin:11px 0 0 13px ;}
	
	.nav-pills > li{ }
	.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{color: #ffffff;}
	.nav li a{ }
	.nav .open > a, .nav .open > a:hover, .nav .open > a:focus{ /*background-color:#f67e7c;*/ background:none!important; background-color:transparent!important;}
	.nav > li > a:hover, .nav > li > a:focus{  /*background-color:#f46562;*/ background:none!important; background-color:transparent!important;}
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
		/*position:relative!important;*/
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
	</style>
    
    <header class="navbar navbar-inverse bs-docs-nav" role="banner">
    	<div id="logout-btn"><a href="<?=base_url();?>admin/logout"><i class="fa fa-power-off"></i></a></div>
    	<div class="container">
	    	<!--<div id="top-gap">&nbsp;</div>-->
	    	<div class="row">
	    		<div class="col-md-6 col-sm-6">
	    			<div id="company-name">
                    	<img src="<?=base_url()?>assets/backend-assets/img/login/admin-logo.png">                        
                        <div style="margin-top:3px;">WAVE1 - ADMIN</div>
                    </div>	    			
	    		</div>
	  			<div class="col-md-6 col-sm-6">
	  				<div class="row">
	  					<div class="col-md-5 col-sm-5">
	  						&nbsp;
	  					</div>
	  					<div class="col-md-7 col-sm-7">	  						
	  					</div>
	  				</div>
	  			</div>
	    	</div>
	    	<div id="middle-gap">&nbsp;</div>
	    	<div class="row hidden-xs" id="menu">
            	
            	<div class="col-lg-12">
                    <ul class="nav nav-pills nav-justified">
                    	<li class="menu-wrap" style="padding-left:0px!important;"><a style="padding-left:0px!important;text-align:left!important;" class="dropdown-toggle"><i class="fa fa-tachometer "></i>&nbsp;&nbsp;DASHBOARD</a></li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-pencil"></i></i>&nbsp;&nbsp;CONTENT</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" id="content_menu" style="left:11%;">
                            	<li style="display:none;"></li>
                                <li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item"><a href="<?=base_url()?>admin/navigation">Manage Navigation</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/case_studies">Manage Case Studies</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/page">Manage Pages</a></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/gallery">Manage Galleries</a></li>
                            </ul>
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-tags"></i>&nbsp;&nbsp;PRODUCTS</a>
                        	<ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" style="left:21%;">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                                <li class="menu-item"><a href="<?=base_url()?>admin/product">Manage Products</a></li>    									
                                <li class="menu-item"><a href="<?=base_url()?>admin/product/category">Manage Product Categories</a></li>
                            </ul>
                        </li>
                        
                        <li class="menu-wrap"><a rel="popover" class="dropdown-toggle btnpop" data-content="The orders module is deactivated on your admin panel. To start selling online lodge a support ticket via the support menu" data-placement="bottom" data-toggle="popover" data-container="header" data-trigger="hover" ><i class="fa fa-stack-overflow"></i>&nbsp;&nbsp;ORDERS</a>
                        	<!--
                            <ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" style="left:37%;" >
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item"><a href="#">Manage Orders</a></li>
    							<li class="menu-item"><a href="#">Sales Reports</a></li>
                            </ul>
                            -->
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-user"></i>&nbsp;&nbsp;CUSTOMERS</a>
                        	<!--
                            <ul class="menu-inner-wrap list-menu-wrapper dropdown-menu" style="left:48%;">
                            	<li class="triangle-menu" style="text-align:center;"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></li>
                            	<li class="menu-item"><a href="<?=base_url()?>admin/customer">Manage Customers</a></li>      
                            </ul>
                            -->
                        </li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-bullhorn"></i>&nbsp;&nbsp;MARKETING</a></li>
                        <li class="menu-wrap"><a class="dropdown-toggle"><i class="fa fa-wrench"></i>&nbsp;&nbsp;SETTINGS</a></li>
                        <li class="menu-wrap" style="padding-right:0px!important;"><a style="padding-right:0px!important;text-align:right!important;" class="dropdown-toggle"><i class="fa fa-phone"></i>&nbsp;&nbsp;SUPPORT</a></li>
                    </ul>
                </div>
                <!--
	    		<div class="col-md-6 col-sm-6" >
	    			<div class="row">	    
                    					
                        <div class="col-md-3 col-sm-3 <?php if($curr_page == 'dashboard'  ){?> header-active-hide<? }?>" >
	    					<div class="menu-wrap <?php if($curr_page == '' || $curr_page == 'dashboard'  ){?> header-menu-active-hide<? }?>"><a href="<?=base_url()?>admin/dashboard" class="<?php if($curr_page == '' || $curr_page == 'dashboard'  ){?> header-menu-active-hide<? }?>"><i class="fa fa-tachometer "></i>&nbsp;DASHBOARD</a></div>
	    				</div>
                         
	    				<div class="col-md-3 col-sm-3 <?php if($curr_page == 'content' ){?> header-active-hide<? }?>">
	    					<div class="menu-wrap <?php if($curr_page == 'content'){?> header-menu-active-hide<? }?>"><i class="fa fa-pencil"></i>&nbsp;CONTENT
	    						<div  class="menu-inner-wrap">
	    							<div class="triangle-menu"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></div>
	    							<div id="contents-menu" class="list-menu-wrapper">
    									<div class="menu-item"><a href="<?=base_url()?>admin/navigation">Manage Navigations</a></div>
    									<div class="menu-item"><a href="<?=base_url()?>admin/case_studies">Manage Case Studies</a></div>
    									<div class="menu-item"><a href="<?=base_url()?>admin/page">Manage Pages</a></div>
    									<div class="menu-item"><a href="<?=base_url()?>admin/gallery">Manage Galleries</a></div>
    									
	    							</div>	
	    						</div>
	    					</div>
	    				</div>
                        
                       
                        
	    				<div class="col-md-3 col-sm-3 <?php if($curr_page == 'product' || $curr_page == 'position'  ){?> header-active-hide<? }?>">
	    					<div class="menu-wrap <?php if($curr_page == 'product' || $curr_page == 'position'  ){?> header-menu-active-hide<? }?>"><i class="fa fa-tags"></i>&nbsp;PRODUCTS
	    						<div  class="menu-inner-wrap">
	    							<div class="triangle-menu"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></div>
	    							<div id="products-menu" class="list-menu-wrapper">
    									<div class="menu-item"><a href="<?=base_url()?>admin/product">Manage Products</a></div>
    									
                                        <div class="menu-item"><a href="<?=base_url()?>admin/product/category">Manage Product Categories</a></div>
    									
	    							</div>	
	    						</div>
	    					</div>
	    				</div>
	    				<div class="col-md-3 col-sm-3 <?php if($curr_page == 'order' ){?> header-active-hide<? }?>">
	    					<div class="menu-wrap <?php if($curr_page == 'order' ){?> header-menu-active-hide<? }?>"><i class="fa fa-stack-overflow"></i>&nbsp;ORDERS
	    						<div  class="menu-inner-wrap">
	    							<div class="triangle-menu"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></div>
	    							<div id="orders-menu" class="list-menu-wrapper">
    									<div class="menu-item"><a href="<?=base_url()?>admin/order">Manage Orders</a></div>
    									<div class="menu-item"><a href="<?=base_url()?>admin/order/salesreport">Sales Reports</a></div>
	    							</div>	
	    						</div>
	    					</div>	    					
	    				</div>
                        
                        
	    			</div>
	    		</div>
	  			<div class="col-md-6 col-sm-6" >
	  				<div class="row">
	    				
                        <div class="col-md-3 col-sm-3 <?php if($curr_page == 'customer' || $curr_page == 'picker' ){?> header-active-hide<? }?>" id="special-ipad">
	    					<div class="menu-wrap <?php if($curr_page == 'customer' || $curr_page == 'picker' ){?> header-menu-active-hide<? }?>"><i class="fa fa-user"></i>&nbsp;CUSTOMERS
	    						<div  class="menu-inner-wrap">
	    							<div class="triangle-menu"><img alt="" src="<?=base_url()?>assets/backend-assets/img/menu-triangle.png"/></div>
	    							<div id="customers-menu" class="list-menu-wrapper">
    									<div class="menu-item"><a href="<?=base_url()?>admin/customer">Manage Customers</a></div>                                        
	    							</div>	
	    						</div>
	    					</div>
	    					
	    				</div>
	    				<div class="col-md-3 col-sm-3">
	    					<div class="menu-wrap "><i class="fa fa-bullhorn"></i>&nbsp;MARKETING</div>
	    				</div>
	    				<div class="col-md-3 col-sm-3">
	    					<div class="menu-wrap "><i class="fa fa-wrench"></i>&nbsp;SETTINGS</div>
	    				</div>
	    				<div class="col-md-3 col-sm-3" >
	    					<div class="menu-wrap" ><i class="fa fa-phone"></i>&nbsp;SUPPORT</div>
	    				</div>
	    			</div>
	  			</div>
                -->
	    	</div>
            <div style="clear:both;"></div>
	    	<div class="row visible-xs">
	    		<div class="container">
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu" href="<?=base_url()?>">MENU</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
							<li>
								<a href="#" class="phone-menu"><i class="fa fa-tachometer"></i>&nbsp;DASH</a>
							</li>
							<li>
								<a href="<?=base_url()?>admin/content/global_message" class="phone-menu"><i class="fa fa-pencil"></i>&nbsp;CONTENT</a>
							</li>
							<li>
								<a href="<?=base_url()?>admin/product" class="phone-menu"><i class="fa fa-tags"></i>&nbsp;PRODUCTS</a>
							</li>
							<li>
								<a href="<?=base_url()?>admin/order" class="phone-menu"><i class="fa fa-stack-overflow"></i>&nbsp;ORDERS</a>
							</li>
							<li>
								<a href="<?=base_url()?>admin/customer" class="phone-menu"><i class="fa fa-user"></i>&nbsp;CUSTOMERS</a>
							</li>
						</ul>
					</nav>
	    		</div>
	    		<div class="container">
	    			
	    			
	    			<!-- content start -->
	    			<?php if($curr_page == 'content'){?>
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu" href="<?=base_url()?>admin/content/global_message">Contents - Submenu</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/content/global_message"><i class="fa fa-globe"></i> Update Global Message</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/content/order_closing_message"><i class="fa fa-clock-o"></i> Update Order Closing Message</a>
							</li>
							
						</ul>
					</nav>
	    			<?php }?>
	    			<!-- content end -->
	    			<!-- product & position start -->
	    			<?php if($curr_page == 'product' || $curr_page == 'position'){?>
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu" href="<?=base_url()?>admin/product">Products - Submenu</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/product"><i class="fa fa-tags"></i> Manage Products</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/product/feature"><i class="fa fa-trophy"></i> Feature Products</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/position"><i class="fa fa-list-ol"></i> Manage Product Positions</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/product/category"><i class="fa fa-folder-open"></i> Manage Product Categories</a>
							</li>
						</ul>
					</nav>
	    			<?php }?>
	    			<!-- product & position end -->
	    			<!-- order & salesreport start -->
	    			<?php if($curr_page == 'order' || $curr_page == 'salesreport'){?>
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu" href="<?=base_url()?>admin/order">Orders - Submenu</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/order"><i class="fa fa-stack-overflow"></i> Manage Orders</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/salesreport"><i class="fa fa-bar-chart-o"></i> Sales Reports</a>
							</li>

						</ul>
					</nav>
	    			<?php }?>
	    			<!-- order & salesreport end -->
	    			<!-- customer & picker start -->
	    			<?php if($curr_page == 'customer' || $curr_page == 'picker'){?>
	    			<div class="navbar-header">
		    			<button class="navbar-toggle" data-target=".bs-navbar-collapse1" data-toggle="collapse" type="button">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand phone-menu" href="<?=base_url()?>admin/customer">Customers - Submenu</a>
					</div>
					<nav class="navbar-collapse bs-navbar-collapse1 collapse" role="navigation" style="height: auto;">
						<ul class="nav navbar-nav">
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/customer"><i class="fa fa-group "></i> Manage Customers</a>
							</li>
							<li>
								<a class="phone-menu" href="<?=base_url()?>admin/picker"><i class="fa fa-hand-o-up"></i> Manage Pickers</a>
							</li>
						</ul>
					</nav>
	    			<?php }?>
	    			<!-- customer & picker end -->
	    			
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
<!--
<div id="main-header" class="footer navbar-fixed-bottom" style="z-index: 0">
    <div style="height: 268px; background: url('<?=base_url()?>assets/backend/img/new_admin/footer-bg.png'); background-position:center">
        
    </div>
</div>
-->
    </footer><!-- footer -->
  </body>
</html>
