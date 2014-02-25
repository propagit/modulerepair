<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MX_Controller {
	function __construct() {
		parent::__construct();
		
		
        $this->load->model('Cron_model');      
		
	}
	
	/**
	*	@desc This is the index function
	*
	*   @name index
	*	@access public
	*	@param [string]method, [string] param
	*	@return to link to the correct function
	*/
	function check_cron()
	{
		$setting=$this->Cron_model->get_gallery_setting(1);
		if($setting['cron']==2)
		{
			$this->regenerate_thumbnail();
		}
	}
	function test()
	{
		$data = array('test'=>100);
		$this->Cron_model->update_gallery_setting($data);
	}
	function test_exec()
	{
		exec("wget -b ". "http://propatest.com/wave1/cron/test");
		/* // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://propatest.com/wave1/cron/test");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);      */
	}
	function regenerate_thumbnail()
	{
		//move_uploaded_file($_FILES[$str]['tmp_name'], $target);
		//$gid=33;
		
		$data = array('regenerate'=>0,'cron'=>3);
		$this->Cron_model->update_gallery_setting($data);
		
		$setting=$this->Cron_model->get_gallery_setting(1);
		
		$set_height = $setting['height'];
		$ratio_option = $setting['size'];
		
		#ratio square
		if($ratio_option==1){
			$new_width=$set_height;
			$new_height=$set_height;
		}else
		#ratio portrait 2x3
		if($ratio_option==2){
			$new_width=2*round(($set_height/3));
			$new_height=$set_height;
		}else
		#ratio landscape 4x3
		if($ratio_option==3){
			$new_width=4*round(($set_height/3));
			$new_height=$set_height;
		}else
		#ratio Panoramic 5x3
		if($ratio_option==4){
		$new_width=5*round(($set_height/3));
		$new_height=$set_height;
		}else
		#ratio wideangle 16x9
		if($ratio_option==5){
			$new_width=16*round(($set_height/9));
			$new_height=$set_height;
		}
		$gals=$this->Cron_model->get_galleries();
		foreach($gals as $gd){
			$gid=$gd['id'];
			$photos = $this->Cron_model->get_photos($gid);
			foreach($photos as $ph){
				
				$path = "./uploads/regenerate";
				$newfolder = md5('cdkgallery'.$gid);
				$dir = $path."/".$newfolder;
				if(!is_dir($dir))
				{
				  mkdir($dir);
				  chmod($dir,0777);
				  $fp = fopen($dir.'/index.html', 'w');
				  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
				  fclose($fp);
				}
				$dirs=$dir.'/'.$ratio_option;
				if(!is_dir($dirs))
				{
				  mkdir($dirs);
				  chmod($dirs,0777);
				  $fp = fopen($dirs.'/index.html', 'w');
				  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
				  fclose($fp);
				}
				copy("./uploads/galleries/".md5('cdkgallery'.$gid)."/".$ph['name'], "./uploads/regenerate/".md5('cdkgallery'.$gid)."/".$ratio_option."/".$ph['name']);
				$target = "./uploads/regenerate/".md5('cdkgallery'.$gid)."/".$ratio_option."/".$ph['name'];
				//echo $target.'<br>';
				$this->scale_image($target,$target,$new_width,$new_height);	
				//echo "<img src='".base_url()."uploads/regenerate/".md5("cdkgallery".$gid)."/".$ratio_option."/".$ph['name']."'>"."<br>";
			}
		}
		//echo 'test';
		$data = array('regenerate'=>1,'cron'=>0);
		$this->Cron_model->update_gallery_setting($data);
	}
	function scale_image($image,$target,$thumbnail_width,$thumbnail_height)
	{
	  if(!empty($image)) //the image to be uploaded is a JPG I already checked this
	  {
		 /*$source_image = imagecreatefromjpeg($image);
		 $source_imagex = imagesx($source_image);
		 $source_imagey = imagesy($source_image);
	
		 $dest_imagex = $width;
		 $dest_imagey = $height;
	
		 $image2 = imagecreatetruecolor($dest_imagex, $dest_imagey);
		 imagecopyresampled($image2, $source_image, 0, 0, 0, 0,
		 $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
	
		 imagejpeg($image2, $target, 100);*/
		 list($width_orig, $height_orig) = getimagesize($image);   
		$myImage = imagecreatefromjpeg($image);
		$ratio_orig = $width_orig/$height_orig;
		echo $ratio_orig;
		if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
		   $new_height = $thumbnail_width/$ratio_orig;
		   $new_width = $thumbnail_width;
		} else {
		   $new_width = $thumbnail_height*$ratio_orig;
		   $new_height = $thumbnail_height;
		}
		
		$x_mid = $new_width/2;  //horizontal middle
		$y_mid = $new_height/2; //vertical middle
		
		$process = imagecreatetruecolor(round($new_width), round($new_height)); 
		
		imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
		$thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height); 
		imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);
		
		imagedestroy($process);
		imagedestroy($myImage);
		imagejpeg($thumb,$target, 100);
	
	  }
	}
}