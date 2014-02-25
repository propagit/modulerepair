<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller: Product
 * @author: rseptiane@gmail.com
 */

class Ajax extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('gallery_model');
	}
	
	
	
	function delete_gallery() 
	{
		$id = $_POST['id'];
		
		//$this->check_authentication();
		$photos = $this->gallery_model->get_photos($id);
		foreach($photos as $photo) {
			if ($this->gallery_model->delete_photo($photo['id'])) {
				unlink("./uploads/galleries/".md5("cdkgallery".$id)."/".$photo['name']);
				unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumbnails/".$photo['name']);	
				unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumb1/".$photo['name']);				
			}
		}
		//print_r('test');
		unlink("./uploads/galleries/".md5("cdkgallery".$id)."/index.html");
		unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumbnails/index.html");
		unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumb1/index.html");
		unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumbnails2/index.html");
		unlink("./uploads/galleries/".md5("cdkgallery".$id)."/thumb_gal/index.html");
		
		if ($this->gallery_model->delete_gallery($id)) {
			rmdir("./uploads/galleries/".md5("cdkgallery".$id)."/thumb1");
			rmdir("./uploads/galleries/".md5("cdkgallery".$id)."/thumbnails");
			rmdir("./uploads/galleries/".md5("cdkgallery".$id)."/thumb_gal");
			rmdir("./uploads/galleries/".md5("cdkgallery".$id)."/thumbnails2");
			rmdir("./uploads/galleries/".md5("cdkgallery".$id));
			//$this->Page_model->reset_gallery($id);
			print "Ok";
		} 
		
		else {
			print "Error";
		}
				
		
	}
	
	function update_gallery_order()
	{
		$image_order = $this->input->post('img_order',true);
		$arr = explode(",",$image_order);
		$new_order = 1;
		foreach($arr as $a){
			$this->gallery_model->update_photo($a,array('order' => $new_order));	
			$new_order++;
		}
		echo 'success';
	}
	function update_gallery_detail()
	{
		$id = $_POST['pk'];
		$data = array(			
			'title' => $_POST['value'],			
			'modified' => date('Y-m-d H:i:s')
		);
		//print_r($data);
		$this->gallery_model->update_gallery($id,$data);
	}
	
	function switchstatuspreview()
	{
		$id=$this->input->post('gallery_id');
		$gallery = $this->gallery_model->get_gallery($id);
		$out = '';
		if ($gallery['active_preview'] == 0) {
			$this->gallery_model->update_gallery($id,array('active_preview' => 1));		
			echo 1;	
		} else if($gallery['active_preview'] == 1) {
			$this->gallery_model->update_gallery($id,array('active_preview' => 0));			
			echo 0;
		}
	}
	
	function setthumbnail()
	{
		$id=$this->input->post('gallery_id');
		$name = $this->input->post('name');
		$data_thumbnail_gallery['thumbnail']=1;
		$data_thumbnail_gallery['thumb_img']=$name;
		$data_thumbnail_gallery['modified']= date('Y-m-d H:i:s');
		$this->gallery_model->update_gallery($id,$data_thumbnail_gallery);
	}
}
