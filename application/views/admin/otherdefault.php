<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$title;?> &middot; Admin Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--
	<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url();?>assets/js/bootstrap-fileupload.min.js"></script>
	<script src="<?=base_url();?>assets/js/jquery.form.js"></script>
	<script src="<?=base_url();?>assets/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	-->
    <!-- Bootstrap 
	<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?=base_url();?>assets/css/smoothness/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" media="screen" />
	<link href="<?=base_url();?>assets/css/bootstrap-fileupload.min.css" rel="stylesheet">
	<link href="<?=base_url();?>assets/css/admin.css" rel="stylesheet" media="screen">
	-->

	<link href="<?=base_url()?>assets/backend/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/backend/css/admin.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="<?=base_url()?>assets/backend/font-awesome/css/font-awesome.css">
	<link href="<?=base_url()?>assets/backend/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/backend/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/backend/bootstrap/css/bootstrap-tree.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/backend/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link href="<?=base_url()?>assets/backend/bootstrap/css/jasny-bootstrap.css" rel="stylesheet" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>	
	
    <script src="<?=base_url()?>assets/backend/js/jquery-1.9.1.min.js"></script>
	<script src="<?=base_url()?>assets/backend/bootstrap/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/backend/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/backend/bootstrap/js/bootstrap-tree.js"></script>
    <script src="<?=base_url()?>assets/backend/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=base_url()?>assets/backend/bootstrap/js/jasny-bootstrap.js"></script>
    <script src="<?=base_url()?>assets/backend/ckeditor/js/ckeditor.js"></script>
    <script src="<?=base_url()?>assets/backend/ckeditor/js/config.js"></script>
    <script src="<?=base_url()?>assets/backend/ckeditor/js/styles.js"></script>
    <script src="<?=base_url()?>assets/backend/ckfinder/ckfinder.js"></script>
    <script src="<?=base_url()?>assets/backend/ckfinder/config.js"></script>
    
    <script>
	function logout()
	{
		window.location='<?=base_url()?>admin/logout';
	}
	function dashboard()
	{
		window.location='<?=base_url()?>admin/cms';
	}
	</script>
</head>
<body>
<div id="main-header" class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner" style="background: #ffffff; border: none; box-shadow: none">
		<div style="height: 105px; background: #000;">
			<div class="container">
				<div style="margin-left: 19px; float: left; margin-top: 35px;">
					<img src="<?=base_url()?>assets/backend/img/new_admin/logo-dashboard.png" alt="company-logo"/>
				</div>

				<div style="margin-right: 19px; float: right; margin-top: 14px;">
					<div>
						<div style="float: right;"><button class="btn " type="button" onclick="javascript:logout();">Logout</button></div>
						<div style="float: right; margin-right: 9px;"><button  class="btn " type="button" onclick="javascript:dashboard();">Dashboard</button></div>
						<div style="clear: both"></div>
					</div>
					<div style="clear: both; height: 13px"></div>
					<form method="post" action="<?=base_url()?>admin/cms/search_all_admin">
					    <div class="input-append">
						    <input placeholder="product or customer name" class="span2" id="appendedInputButton" type="text" name="keyword">
						    <button class="btn" type="submit">Search <i class="icon-search"></i></button>
					    </div>
					</form>					
				</div>

				<div style="clear: both"></div>

			</div>

		</div>
		<div style="height: 17px; background: url('<?=base_url()?>assets/backend/img/new_admin/header-shadow.png'); background-position:center">
				&nbsp;
		</div>

		<div class="container" style="margin-top: -10px; margin-bottom: 10px">
			<div style="margin-right: 19px; float: right; font-size: 14px;">
				Logged in as: <span style="font-weight: 600">Onlinemerchandis</span>
			</div>
			<div style="clear: both"></div>
		</div>

	</div>
</div>
	
	
<div class="container">
		<div class="row">
        	<?=$menu;?>
			<?=$content;?>
		</div>
</div>

<div style="clear: both; height: 20px"></div>

<div id="main-header" class="footer navbar-fixed-bottom" style="z-index: 0">
    <div style="height: 268px; background: url('<?=base_url()?>assets/backend/img/new_admin/footer-bg.png'); background-position:center">
        
    </div>
</div>

</body>
</html>