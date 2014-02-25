<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admingallery extends MX_Controller {
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
			
			case 'testexec':
				$this->execs();
				
			break;
			
			case 'regenerate_thumbnail':
				$this->regenerate_thumbnail();
			break;
			
			case 'preview':
					$this->preview();
				break;	
			
			case 'add':
					$this->add($param);
				break;		
			case 'switchstatuspreview':
					$this->switchstatuspreview($param);
				break;	
				
			case 'add_photo' :
					$this->add_photo();
				break;
			
			case 'add_photo_ratio' :
					$this->add_photo_ratio();
				break;
				
			case 'add_video' :
					$this->add_video();
				break;
			
			case 'detail':
					$this->detail($param);
				break;	
				
			case 'delete_photo':
					$this->delete_photo($param);
				break;	

			case 'update':
					$this->update($param);
				break;	

			case 'update_gallery':
					$this->update_gallery();
				break;		
			
			case 'update_gallery_thumb':
					$this->update_gallery_thumb($param);
			break;
			
			case 'create_gallery':
					$this->create_gallery();
				break;				
			
			case 'update_setting_gallery':
					$this->update_setting_gallery();
				break;
			
			default:
					$this->galleries($param);
				break;
		}
	}
	function execs()
	{
		/*if(exec('echo EXEC') == 'EXEC'){
		    echo 'exec works';
		}
		else{
			echo 'no';
		}*/
		$disabled = explode(',', ini_get('disable_functions'));
		return !in_array('exec', $disabled);
	}
	function preview($cat='all',$id=0,$slide=-1)
	{
		
		$data['index']=1;
		$data['slide']=-1;
		$data['pages_story']=1;
		$data['id_active']=$id;
		//$data['stories'] = $this->gallery_model->get_galleries_activepreview();
		$galleries = $this->gallery_model->get_galleries();
		$data['galleries'] = $galleries;
		
		$data['id'] = $id;
		$data['cat'] = $cat;
		$data['story_single'] = $this->gallery_model->get_galleries();
		$data['story_parent'] = $this->gallery_model->get_galleries();
		
		
		$data['index']=ceil(count($data['galleries'])/6);
		$this->load->view('admin_gallery_preview', isset($data) ? $data : NULL);	
	}
	
	function update_setting_gallery()
	{
		$setting=$this->gallery_model->get_gallery_setting(1);
		if($setting['cron']==0)
		{
			$size= $this->input->post('size');
			$height= $this->input->post('height');
			$set_height = $height;
			$description = '';
			if($size==1){$description = 'SQUARE RATIO 1x1';}
			if($size==2){$description = 'PORTRAIT RATIO 2x3';}
			if($size==3){$description = 'LANDSCAPE RATIO 4x3';}
			if($size==4){$description = 'PANORAMIC RATIO 5x3';}
			if($size==5){$description = 'WIDE ANGLE RATIO 16x9';}
			if($size==1){
				$new_width=$set_height;
				$new_height=$set_height;
			}else
			#ratio portrait 2x3
			if($size==2){
				$new_width=2*round(($set_height/3));
				$new_height=$set_height;
			}else
			#ratio landscape 4x3
			if($size==3){
				$new_width=4*round(($set_height/3));
				$new_height=$set_height;
			}else
			#ratio Panoramic 5x3
			if($size==4){
				$new_width=5*round(($set_height/3));
				$new_height=$set_height;
			}else
			#ratio wideangle 16x9
			if($size==5){
				$new_width=16*round(($set_height/9));
				$new_height=$set_height;
			}
			$data = array('size' => $size, 'height' =>$height, 'regenerate' =>0,'description'=>$description, 'cron'=>2, 'width' =>$new_width);
			$this->gallery_model->update_gallery_setting($data);
			exec("wget -b ". "http://propatest.com/wave1/cron/check_cron");
			/*$ch = curl_init();	
			// set url
			curl_setopt($ch, CURLOPT_URL, "http://propatest.com/wave1/cron/check_cron");
	
			//return the transfer as a string
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
			// $output contains the output string
			$output = curl_exec($ch);
	
			// close curl resource to free up system resources
			curl_close($ch);      */
		}
		else
		{
			$this->session->set_flashdata('cron_job','Sorry, The system is running regenerating thumbnail at the moment. Please wait a moment.<br><br>');
		}
		//$this->regenerate_thumbnail();
		//exec("wget -b ". "http://propatest.com/wave1/cron/regenerate_thumbnail");
		//$url='http://propatest.com/wave1/cron/regenerate_thumbnail';
		//shell_exec("wget -O /dev/null http://propatest.com/wave1/cron/regenerate_thumbnail");
		redirect('admin/gallery');
	}
	
	function galleries($id=null,$pid=null) 
	{
		# Check authentication and load models
		//$this->check_authentication();
		
		# load normal header view
		//$this->load->view('admin/common/header');
		//$this->load->view('admin/common/leftbar');
		
		# if not a particular gallery
		if ($id == null) {
			# Get all galleries
			$galleries = $this->gallery_model->get_galleries();
//			print_r($galleries);
			# Determine the thumbnail
			$thumbnails = array();
			
			
			# Pass data to the view
			$data['galleries'] = $galleries;
			$data['thumbnails'] = $thumbnails;			
			$setting=$this->gallery_model->get_gallery_setting(1);
			$data['setting'] =$setting;
			//$this->load->view('admin/gallery/admin_gallery_list',$data);
			$this->load->view('admin_gallery_list', isset($data) ? $data : NULL);	
		} 
		
		# Viewing a particular gallery
		else {
			# Get the gallery
			$data['gallery'] = $this->gallery_model->get_gallery($id);
			if(!$data['gallery'])
			{
				redirect('admin/gallery/galleries/');
			}
			$setting=$this->gallery_model->get_gallery_setting(1);
			$data['setting'] =$setting;
			# Get all photos in the gallery
			$data['photos'] = $this->gallery_model->get_photos($id);
			# If no photo yet
			if ($pid == null) {
				//$this->load->view('admin/gallery/admin_gallery_detail',$data);
				$this->load->view('admin_gallery_detail', isset($data) ? $data : NULL);	
			} else {
				$data['photo'] = $this->gallery_model->get_photo($pid);
				if($data['photo'])
				{
				$this->load->view('admin/gallery/photo',$data);
				}
				else
				{
					redirect('admin/gallery/galleries/'.$id);
				}
			}		
		}
		
		//$this->load->view('admin/common/rightbar');
		//$this->load->view('admin/common/footer');		
	}

	function create_gallery() 
	{
		
		if (trim($_POST['title']) == "") {
			$this->session->set_flashdata('error_cg',true);
			redirect('admin/gallery/galleries');
		}
		$data = array(
			'title' => $_POST['title'],
			'created' => date('Y-m-d H:i:s'),
			'modified' => date('Y-m-d H:i:s')
		);
		$gid = $this->gallery_model->create_gallery($data);
		
		$path = "./uploads/galleries";
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
		
		$dir .= "/thumbnails";
		if(!is_dir($dir))
		{
		  mkdir($dir);
		  chmod($dir,0777);
		  $fp = fopen($dir.'/index.html', 'w');
		  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
		  fclose($fp);
		}

		
		
		$dir = $path."/".$newfolder;
		$dir .= "/thumb1";
		if(!is_dir($dir))
		{
		  mkdir($dir);
		  chmod($dir,0777);
		  $fp = fopen($dir.'/index.html', 'w');
		  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
		  fclose($fp);
		}		
		
		$dir = $path."/".$newfolder;
		$dir .= "/thumbnails2";
		if(!is_dir($dir))
		{
		  mkdir($dir);
		  chmod($dir,0777);
		  $fp = fopen($dir.'/index.html', 'w');
		  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
		  fclose($fp);
		}	
		
		$dir = $path."/".$newfolder;
		$dir .= "/thumb_gal";
		if(!is_dir($dir))
		{
		  mkdir($dir);
		  chmod($dir,0777);
		  $fp = fopen($dir.'/index.html', 'w');
		  fwrite($fp, '<html><head>Permission Denied</head><body><h3>Permission denied</h3></body></html>');
		  fclose($fp);
		}	
		redirect('admin/gallery/galleries/'.$gid);
	}
	
	function update_gallery() 
	{
		$id= $this->input->post('update_id');
		if (trim($_POST['title']) == "") {
			$this->session->set_flashdata('error_cg',true);
			redirect('admin/gallery/galleries');
		}
		$data = array(
			'title' => $_POST['title'],			
			'modified' => date('Y-m-d H:i:s')
		);
		
		$this->gallery_model->update_gallery($id,$data);						
		redirect('admin/gallery/galleries/'.$id);
	}
	
	function update_gallery_thumb($param) 
	{
		$id= $param;
		
		$data = array(
			'thumbnail' => 0,			
			'thumb_img' => '',			
			'modified' => date('Y-m-d H:i:s')
		);
		
		$this->gallery_model->update_gallery($id,$data);						
		redirect('admin/gallery/galleries/'.$id);
	}
	
	
	function add_photo()
	{
		
		
		$gid = $_POST['gallery_id'];		
		$type= $_POST['type'];
		$config['upload_path'] = "./uploads/galleries/".md5('cdkgallery'.$gid);
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());			
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];
			$width = $data['upload_data']['image_width'];
			$height = $data['upload_data']['image_height'];
			$photo = array(
				'name' => $file_name,
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s'),
				'gallery_id' => $gid,
				'order' => 0,
				'thumbnail' =>$type
			);
			$pid = $this->gallery_model->add_photo($photo);
			$this->gallery_model->update_photo($pid,array('order'=>$pid));
			#thumbnail
			if($type==1)
			{
				$data_thumbnail_gallery['thumbnail']=1;
				$data_thumbnail_gallery['thumb_img']=$file_name;
				$data_thumbnail_gallery['modified']= date('Y-m-d H:i:s');
				$this->gallery_model->update_gallery($gid,$data_thumbnail_gallery);
				
			}
			$gallery_data = $this->gallery_model->get_gallery($gid);
			if($gallery_data['thumbnail']==0)
			{
				$data_thumbnail_gallery['thumbnail']=1;
				$data_thumbnail_gallery['thumb_img']=$file_name;
				$data_thumbnail_gallery['modified']= date('Y-m-d H:i:s');
				$this->gallery_model->update_gallery($gid,$data_thumbnail_gallery);
			}
			/*if($gid != 4)
			{
				//420
				if ($height != 625)
				{
				$config = array();
				// Resize image
				$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = 100;
				$config['width'] = (625 * $width) / $height;
				$config['height'] = 625;
				$config['master_dim'] = 'height';
				$this->load->library('image_lib');
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name);
				rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name);
				$this->image_lib->clear();
			    }	
			}*/
			
			
			
			// Thumbnail creation
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			
			//$width_thumb = 262;
			//$height_thumb = 132;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (132/262))
				{
					$config['height'] = 262;
					$config['width'] = intval(262 * ($height/$width));
					$config['master_dim'] = 'height';
				}
				else
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($height/$width));
					$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (262/132))
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(262 * ($width/$height));
					
				$config['height'] = 132;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 262;
				$config['height'] = intval(262 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name;
			
			$config['width'] = 262;
			$config['height'] = 132;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			
			
			
			// Thumbnail frontend creation
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (145/225))
				{
					$config['height'] = 225;
				$config['width'] = intval(225 * ($height/$width));
				$config['master_dim'] = 'height';
				}
				else
				{
				$config['width'] = 225;
				$config['height'] = intval(145 * ($height/$width));
				$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (225/145))
				{
					$config['width'] = 225;
					$config['height'] = intval(145 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(225 * ($width/$height));
					
				$config['height'] = 145;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 225;
				$config['height'] = intval(225 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name;
			
			$config['width'] = 225;
			$config['height'] = 145;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);
			
			
			// Thumbnail2 for bootstrap
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (150/170))
				{
					$config['height'] = 170;
				$config['width'] = intval(170 * ($height/$width));
				$config['master_dim'] = 'height';
				}
				else
				{
				$config['width'] = 170;
				$config['height'] = intval(150 * ($height/$width));
				$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (170/150))
				{
					$config['width'] = 170;
					$config['height'] = intval(150 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(170 * ($width/$height));
					
				$config['height'] = 150;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 170;
				$config['height'] = intval(170 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name;
			
			$config['width'] = 170;
			$config['height'] = 150;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
					  
			$this->session->set_flashdata('addphoto_id',$pid);
			$this->session->set_flashdata('addphoto_src',$file_name);
		}
		redirect('admin/gallery/galleries/'.$gid);
	}

	function delete_photo($id) 
	{
		
		$photo = $this->gallery_model->get_photo($id);
		
			if ($this->gallery_model->delete_photo($id)) 
			{
				$this->gallery_model->reset_thumbnail($id);
				unlink("./uploads/galleries/".md5("cdkgallery".$photo['gallery_id'])."/".$photo['name']);
				unlink("./uploads/galleries/".md5("cdkgallery".$photo['gallery_id'])."/thumbnails/".$photo['name']);
				unlink("./uploads/galleries/".md5("cdkgallery".$photo['gallery_id'])."/thumbnails2/".$photo['name']);
				unlink("./uploads/galleries/".md5("cdkgallery".$photo['gallery_id'])."/thumb1/".$photo['name']);
				
			} else {
				
			}
		
		
		
		redirect('admin/gallery/galleries/'.$photo['gallery_id']);
	}
	
	function listorder()
    {
       
        $orders=$this->input->post('textorder');
        $id=$this->input->post('idgallery');
        if($orders<>'')
        {
            
            $order = explode(",", $orders);
            $image=array();                      
            for($i=0;$i<count($order);$i++)
            {                             
                $data=array(
                    'gallery_id' => $id,
                    'order'=> $i
                );
                $this->gallery_model->update_photo($order[$i],$data);
                
            }   
            $this->session->set_flashdata('update',true);     
        }
        else
        {
            $this->session->set_flashdata('warning',true);
        }
        redirect('admin/gallery/galleries/'.$id);       
    }
    
    function add_photo_title()
	{				
		$id = $_POST['photo_id'];
		$data = array(
			'title' => $_POST['title'],			
			'modified' => date('Y-m-d H:i:s')
			);
		$this->gallery_model->update_photo($id,$data);
		redirect('admin/gallery/galleries/'.$_POST['gallery_id']);
	}
	
	function add_video()
	{				
		$gid = $_POST['gallery_id'];
		//$radio = $_POST['radio'];
		$link = $_POST['link'];
		$pos = strpos($link,'src="');
		$back = substr($link,$pos+5,strlen($link) - $pos);
		$pos = strpos($back,'"');
		$middle = substr($back,0,$pos);
		//echo $middle;
		
		$photo = array(
				'name' => $middle,
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s'),
				'gallery_id' => $gid,
				'order' => 0,
				'video' => 1
			);
			
		$pid = $this->gallery_model->add_photo($photo);
		$this->gallery_model->update_photo($pid,array('order'=>$pid));
		
		redirect('admin/gallery/galleries/'.$gid);
		
	}
	function switchstatuspreview($id)
	{
		$gallery = $this->gallery_model->get_gallery($id);
		$out = '';
		if ($gallery['active_preview'] == 0) {
			$this->gallery_model->update_gallery($id,array('active_preview' => 1));			
		} else if($gallery['active_preview'] == 1) {
			$this->gallery_model->update_gallery($id,array('active_preview' => 0));			
		}
		redirect('admin/gallery/galleries');
	}
	function switchstatuspage($id)
	{
		$gallery = $this->gallery_model->get_gallery($id);
		$out = '';
		if ($gallery['active_page'] == 0) {
			$this->gallery_model->update_gallery($id,array('active_page' => 1));			
		} else if($gallery['active_page'] == 1) {
			$this->gallery_model->update_gallery($id,array('active_page' => 0));			
		}
		redirect('admin/gallery/galleries');
	}
	
	function add_thumbnail()
	{		
		/*$id=$this->input->post('id_gallery_thumb');
		$path = "./uploads/galleries/".md5("cdkgallery".$id);
		$newfolder = 'thumb_gal';
		$dir = $path."/".$newfolder;
		if(!is_dir($dir))
		{
			mkdir($dir,0777);
			chmod($dir,0777);
		}
		
		$config['upload_path'] = $dir;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '8192'; //  MB
		$config['max_width']  = '4000';
		$config['max_height']  = '4000';
		$config['width'] = 4000;
		$config['height'] = 4000;
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload()) {
			$this->session->set_flashdata('error_upload',$this->upload->display_errors());
			redirect('admin/gallery/galleries/'.$id);	
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$name = $data['upload_data']['file_name'];	
			$thumb_name = 'thumb_'.$name;		
			# Add details to database			
			$data = array(
				'thumb_img' => $name,
				'thumbnail' => 1				
			);
			$this->gallery_model->update_gallery($id,$data);	
			
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/".$name;
			$config['create_thumb'] = TRUE;
			//$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb_".$name;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$name;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = 100;
			
			//$width_thumb = 262;
			//$height_thumb = 132;
			 if ($width < $height) 
			  {		
			    if(($height/$width) < (132/262))
				{
					$config['height'] = 262;
					$config['width'] = intval(262 * ($height/$width));
					$config['master_dim'] = 'height';
				}
				else
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($height/$width));
					$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (262/132))
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(262 * ($width/$height));
					
				$config['height'] = 132;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 262;
				$config['height'] = intval(262 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$data['upload_data']['raw_name'].$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb_".$name;
			
			$config['width'] = 262;
			$config['height'] = 132;
		    // really important shoud be crop from top 0 left 0
			$config['x_axis'] = 0;
			$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$name);
			rename("./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$data['upload_data']['raw_name'].$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$id)."/thumb_gal/thumb/thumb_".$name);
			
			$new = "_thumb";
			$length = strlen($name);
			$pos = substr($name,$length-4,$length);
			$string = str_replace($pos, $new.$pos ,$name);
			$data_thumb = array(
				'thumb_img' => 'thumb_'.$string,
				'thumbnail' => 1				
			);
			$this->gallery_model->update_gallery($id,$data_thumb);	
			
			*/
			
			$gid=$this->input->post('id_gallery_thumb');
			
		$config['upload_path'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal";
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());			
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];
			$width = $data['upload_data']['image_width'];
			$height = $data['upload_data']['image_height'];
			/*$photo = array(
				'name' => $file_name,
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s'),
				'gallery_id' => $gid,
				'order' => 0
			);
			$pid = $this->gallery_model->add_photo($photo);
			$this->gallery_model->update_photo($pid,array('order'=>$pid));*/
			$photo = array(
				'thumb_img' => $name,
				'thumbnail' => 1				
			);
			$this->gallery_model->update_gallery($gid,$photo);
			
			
			
			// Thumbnail creation
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			
			//$width_thumb = 262;
			//$height_thumb = 132;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (132/262))
				{
					$config['height'] = 262;
					$config['width'] = intval(262 * ($height/$width));
					$config['master_dim'] = 'height';
				}
				else
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($height/$width));
					$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (262/132))
				{
					$config['width'] = 262;
					$config['height'] = intval(132 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(262 * ($width/$height));
					
				$config['height'] = 132;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 262;
				$config['height'] = intval(262 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$file_name;
			
			$config['width'] = 262;
			$config['height'] = 132;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb_gal/thumb/".$file_name);
			
			
			
			// Thumbnail frontend creation
			
			
			// Thumbnail2 for bootstrap
			
		
			
			
			
			
		
			/*
			$filename = "./uploads/galleries/".md5("cdkgallery".$id)."/thumb_gal/".$name;
			
			// Set a maximum height and width
			$width = 262;
			$height = 132;
			
			// Content type
			header('Content-Type: image/jpeg');
			
			// Get new dimensions
			list($width_orig, $height_orig) = getimagesize($filename);
			
			$ratio_orig = $width_orig/$height_orig;
			
			
			if ($width/$height > $ratio_orig) {
			   $width = $height*$ratio_orig;
			} else {
			   $height = $width/$ratio_orig;
			}
			
			// Resample
			$image_p = imagecreatetruecolor($width, $height);
			$image = imagecreatefromjpeg($filename);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
			
			// Output
			imagejpeg($image_p, "./uploads/galleries/".md5("cdkgallery".$id)."/thumb_gal/thumb".$name, 100);*/
/*			$updir = "./uploads/galleries/".md5("cdkgallery".$id)."/thumb_gal/";
			
			$thumbnail_width = 262;
			$thumbnail_height = 132;
			$thumb_beforeword = "thumb";
			$arr_image_details = getimagesize("$filename"); // pass id to thumb name
			$original_width = $arr_image_details[0];
			$original_height = $arr_image_details[1];
			if ($original_width > $original_height) {
				$new_width = $thumbnail_width;
				$new_height = intval($original_height * $new_width / $original_width);
			} else {
				$new_height = $thumbnail_height;
				$new_width = intval($original_width * $new_height / $original_height);
			}
			$dest_x = intval(($thumbnail_width - $new_width) / 2);
			$dest_y = intval(($thumbnail_height - $new_height) / 2);
			
			$old_image = imagecreatefromjpeg("$filename");
			$new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
			imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
			imagejpeg($new_image, "$updir" . "$thumb_beforeword" . "$name");*/
		}
		redirect('admin/gallery/galleries/'.$gid);
	}
	function previews($cat='all',$id=0,$slide=-1)
	{
		$this->load->model('System_model');             
		$this->load->model('Category_model');
		$this->load->model('Product_model');
		$this->load->model('Menu_model');               
		
		if( ! $this->session->userdata('cur_sign'))
		{
			$data['sign'] = '<span style="font-size:12px">AU</span> $';
			$data['cur_val'] = 1;
		}
		else 
		{
			//echo $this->session->userdata('cur_val');
			$data['sign'] = $this->session->userdata('cur_sign');
			$data['cur_val'] = $this->session->userdata('cur_val');
		}
		
		$cur = $this->System_model->get_currency();
		
		$data['usa'] = $cur['usa'];
		$data['eur'] = $cur['eur'];
		$data['gbp'] = $cur['gbp'];
		$data['jpy'] = $cur['jpy'];
		
		$data['index']=1;
		$data['slide']=-1;
		$data['pages_story']=1;
		$data['id_active']=$id;
		$data['stories'] = $this->gallery_model->get_galleries_activepreview();
		
		//$data['pages_story'] = $this->System_model->get_storypage($id);
		//if($id=='Lookbook'){$cat='latest season'; $id='';}
		
		$data['id'] = $id;
		$data['cat'] = $cat;
		$data['story_single'] = $this->gallery_model->get_galleries();
		$data['story_parent'] = $this->gallery_model->get_galleries();
		
						
		$data['index']=ceil(count($data['stories'])/6);
		$this->load->view('common/header',$data);
		$this->load->view('admin/gallery/admin_gallery_preview',$data);
		$this->load->view('common/footer');
	}
	function view_gallery($cat='all',$id=0,$slide=-1)
	{
		$this->load->model('System_model');             
		$this->load->model('Category_model');
		$this->load->model('Product_model');
		$this->load->model('Menu_model');               
		
		if( ! $this->session->userdata('cur_sign'))
		{
			$data['sign'] = '<span style="font-size:12px">AU</span> $';
			$data['cur_val'] = 1;
		}
		else 
		{
			//echo $this->session->userdata('cur_val');
			$data['sign'] = $this->session->userdata('cur_sign');
			$data['cur_val'] = $this->session->userdata('cur_val');
		}
		
		$cur = $this->System_model->get_currency();
		
		$data['usa'] = $cur['usa'];
		$data['eur'] = $cur['eur'];
		$data['gbp'] = $cur['gbp'];
		$data['jpy'] = $cur['jpy'];
		
		$data['index']=1;
		$data['slide']=-1;
		$data['pages_story']=1;
		$data['id_active']=$id;
		$data['stories'] = $this->gallery_model->get_galleries_activepage();
		
		//$data['pages_story'] = $this->System_model->get_storypage($id);
		//if($id=='Lookbook'){$cat='latest season'; $id='';}
		
		$data['id'] = $id;
		$data['cat'] = $cat;
		$data['story_single'] = $this->gallery_model->get_galleries();
		$data['story_parent'] = $this->gallery_model->get_galleries();
		
						
		$data['index']=ceil(count($data['stories'])/6);
		$this->load->view('common/header',$data);
		$this->load->view('admin/gallery/admin_gallery_preview',$data);
		$this->load->view('common/footer');
	}
	
	function regenerate_thumbnail()
	{
		//move_uploaded_file($_FILES[$str]['tmp_name'], $target);
		//$gid=33;
		//error_reporting(E_ALL);
		
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
		}
	}
	function scale_image($image,$target,$thumbnail_width,$thumbnail_height)
	{
	  if(!empty($image)) //the image to be uploaded is a JPG I already checked this
	  {
		// error_reporting(E_ALL);
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
	function add_photo_ratio()
	{
		
		
		$gid = $_POST['gallery_id'];		
		$type= $_POST['type'];
		
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
		
		if($setting['regenerate']==0){$folder_init='galleries'; $folder_pic = 'thumbnails';}else{$folder_init='regenerate'; $folder_pic = $setting['size'];}
		
		
		$config['upload_path'] = "./uploads/galleries/".md5('cdkgallery'.$gid);
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4096'; // 4 MB
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
		
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());			
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$file_name = $data['upload_data']['file_name'];
			$width = $data['upload_data']['image_width'];
			$height = $data['upload_data']['image_height'];
			$photo = array(
				'name' => $file_name,
				'created' => date('Y-m-d H:i:s'),
				'modified' => date('Y-m-d H:i:s'),
				'gallery_id' => $gid,
				'order' => 0,
				'thumbnail' =>$type
			);
			$pid = $this->gallery_model->add_photo($photo);
			$this->gallery_model->update_photo($pid,array('order'=>$pid));
			#thumbnail
			if($type==1)
			{
				$data_thumbnail_gallery['thumbnail']=1;
				$data_thumbnail_gallery['thumb_img']=$file_name;
				$data_thumbnail_gallery['modified']= date('Y-m-d H:i:s');
				$this->gallery_model->update_gallery($gid,$data_thumbnail_gallery);
				
			}
			$gallery_data = $this->gallery_model->get_gallery($gid);
			if($gallery_data['thumbnail']==0)
			{
				$data_thumbnail_gallery['thumbnail']=1;
				$data_thumbnail_gallery['thumb_img']=$file_name;
				$data_thumbnail_gallery['modified']= date('Y-m-d H:i:s');
				$this->gallery_model->update_gallery($gid,$data_thumbnail_gallery);
			}
									
			// Thumbnail creation
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			
			//$width_thumb = 262;
			//$height_thumb = 132;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < ($new_height/$new_width))
				{
					$config['height'] = $new_width;
					$config['width'] = intval($new_width * ($height/$width));
					$config['master_dim'] = 'height';
				}
				else
				{
					$config['width'] = $new_width;
					$config['height'] = intval($new_height * ($height/$width));
					$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < ($new_width/$new_height))
				{
					$config['width'] = $new_width;
					$config['height'] = intval($new_height * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval($new_width * ($width/$height));
					
				$config['height'] = $new_height;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = $new_width;
				$config['height'] = intval($new_width * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name;
			
			$config['width'] = $new_width;
			$config['height'] = $new_height;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name);
			
			copy("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails/".$file_name, "./uploads/regenerate/".md5('cdkgallery'.$gid)."/".$ratio_option."/".$file_name);
			
			
			
			
			
			// Thumbnail frontend creation
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (145/225))
				{
					$config['height'] = 225;
				$config['width'] = intval(225 * ($height/$width));
				$config['master_dim'] = 'height';
				}
				else
				{
				$config['width'] = 225;
				$config['height'] = intval(145 * ($height/$width));
				$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (225/145))
				{
					$config['width'] = 225;
					$config['height'] = intval(145 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(225 * ($width/$height));
					
				$config['height'] = 145;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 225;
				$config['height'] = intval(225 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name;
			
			$config['width'] = 225;
			$config['height'] = 145;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);

			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumb1/".$file_name);
			
			
			// Thumbnail2 for bootstrap
			$config = array();
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/".$file_name;
			$config['create_thumb'] = TRUE;
			$config['new_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name;
			$config['maintain_ratio'] = TRUE;
			$config['quality'] = 100;
			  if ($width < $height) 
			  {		
			    if(($height/$width) < (150/170))
				{
					$config['height'] = 170;
				$config['width'] = intval(170 * ($height/$width));
				$config['master_dim'] = 'height';
				}
				else
				{
				$config['width'] = 170;
				$config['height'] = intval(150 * ($height/$width));
				$config['master_dim'] = 'width';
				}
				
			  } 
			  else if($width > $height)
			  {		
			   
					
				if(($width/$height) < (170/150))
				{
					$config['width'] = 170;
					$config['height'] = intval(150 * ($width/$height));
					$config['master_dim'] = 'width';
				}
				else
				{
					$config['width'] = intval(170 * ($width/$height));
					
				$config['height'] = 150;
				$config['master_dim'] = 'height';
				}
				
				
			  }
			  else  // for square image
			  {		
			  
				$config['width'] = 170;
				$config['height'] = intval(170 * ($height/$width));
				// if the thumbnail width is longer set to width otherwise set to height
				$config['master_dim'] = 'width';
				
			  }
			
			$this->load->library('image_lib');
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			if(!$this->image_lib->resize())
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());	
			}
			
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
			$this->image_lib->clear();
			
			// Crop thumbnail			
			$config['image_library'] = 'GD2';
			$config['source_image'] = "./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name;
			
			$config['width'] = 170;
			$config['height'] = 150;
		    // really important shoud be crop from top 0 left 0
				$config['x_axis'] = 0;
				$config['y_axis'] = 0;
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$crop_thumbnail = $this->image_lib->crop();
			if ( ! $crop_thumbnail)
			{
				$this->session->set_flashdata('error_addphoto',$this->upload->display_errors());
			}
			unlink("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
			rename("./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'],"./uploads/galleries/".md5('cdkgallery'.$gid)."/thumbnails2/".$file_name);
					  
			$this->session->set_flashdata('addphoto_id',$pid);
			$this->session->set_flashdata('addphoto_src',$file_name);
		}
		redirect('admin/gallery/galleries/'.$gid);
	}
}
