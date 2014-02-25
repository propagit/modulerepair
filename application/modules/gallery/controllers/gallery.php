<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MX_Controller {
	function __construct() {
		parent::__construct();
		
		
        $this->load->model('gallery_model');      
		
	}
	
	/**
	*	@desc This is the index function
	*
	*   @name index
	*	@access public
	*	@param [string]method, [string] param
	*	@return to link to the correct function
	*/
	
	public function index($method='',$param='')
	{
		switch($method)
		{
			
			case 'preview':
					$this->preview();
				break;	
			
			case 'regenerate_thumbnail':
				$this->regenerate_thumbnail();
			break;

			default:
					$this->preview();
				break;
		}
	}
	
	function preview($cat='all',$id=0,$slide=-1)
	{
		
		$data['index']=1;
		$data['slide']=-1;
		$data['pages_story']=1;
		$data['id_active']=$id;
		//$data['stories'] = $this->gallery_model->get_galleries_activepreview();
		$galleries = $this->gallery_model->get_galleries_activepreview();
		$data['galleries'] = $galleries;
		
		$data['id'] = $id;
		$data['cat'] = $cat;
		$data['story_single'] = $this->gallery_model->get_galleries_activepreview();
		$data['story_parent'] = $this->gallery_model->get_galleries_activepreview();
		$setting=$this->gallery_model->get_gallery_setting(1);
		$data['setting'] =$setting;
		
		$data['index']=ceil(count($data['galleries'])/6);
		$this->load->view('gallery_preview', isset($data) ? $data : NULL);	
	}
	function regenerate_thumbnail()
	{
		//move_uploaded_file($_FILES[$str]['tmp_name'], $target);
		//$gid=33;
		
		/*
		$setting=$this->gallery_model->get_gallery_setting(1);
		
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
		$gals=$this->gallery_model->get_galleries();
		foreach($gals as $gd){
			$gid=$gd['id'];
			$photos = $this->gallery_model->get_photos($gid);
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
		}*/
		$data = array('description'=>'test cron');
		$this->gallery_model->update_gallery_setting($data);
	}
	function scale_image($image,$target,$width,$height)
	{
	  if(!empty($image)) //the image to be uploaded is a JPG I already checked this
	  {
		 $source_image = imagecreatefromjpeg($image);
		 $source_imagex = imagesx($source_image);
		 $source_imagey = imagesy($source_image);
	
		 $dest_imagex = $width;
		 $dest_imagey = $height;
	
		 $image2 = imagecreatetruecolor($dest_imagex, $dest_imagey);
		 imagecopyresampled($image2, $source_image, 0, 0, 0, 0,
		 $dest_imagex, $dest_imagey, $source_imagex, $source_imagey);
	
		 imagejpeg($image2, $target, 100);
	
	  }
	}
}