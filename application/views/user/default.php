<!DOCTYPE html>
<html>
  <head>
    <title><?=$title;?></title>
    <meta name="keywords" content="<?=$keywords;?>" />
	<meta name="description" content="<?=$description;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap3/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/fontawesome4/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-select.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/date-picker/css/datepicker.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/css/frontend.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/jQuery/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>assets/frontend-assets/css/ie.css" rel="stylesheet" media="screen">
    
    
	<script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-1.9.1.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/bootstrap.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap3/js/respond.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-select.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/bootstrap/js/bootstrap-fileupload.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/date-picker/js/bootstrap-datepicker.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/jQuery/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="<?=base_url()?>assets/frontend-assets/scripts/helper.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700,400italic,500italic,700italic|Roboto:400,400italic,500italic,700italic,700,500,900,900italic' rel='stylesheet' type='text/css'>
    <script> var $j = jQuery.noConflict(); </script>
  </head>
  <body> 
  	<div>
     <?=$header;?>
     <?=$content;?>
     <?=$footer;?>
     </div>
  </body>
</html>
