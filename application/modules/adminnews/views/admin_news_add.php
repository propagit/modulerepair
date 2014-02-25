<script>
	$(function(){
		$j('.custom-select').selectpicker();
		
	    $j('#date').datepicker({
			format: "dd-mm-yyyy",
			todayBtn: "linked",
			autoclose: true	  
	    });
	  
	  help.custom_checkbox('.checker');
	  
	  help.make_permalink('#title','#id_title'); 
	  
	  $('#title').keyup(function(){
		    var permalink = $('#id_title').val();
		 	help.permalink_exists('<?=base_url();?>admin/news/ajax/permalink_exists',permalink,'#id_title'); 
	  });
	  
	  $('#id_title').keyup(function(){
		    var permalink = $('#id_title').val();
		 	help.permalink_exists('<?=base_url();?>admin/news/ajax/permalink_exists',permalink,'#id_title'); 
	  });
	  
	  $('#add_category').click(function(){
		  $j('#new_category_model').modal('show'); 
	  });
	  
	  $('#add-meta-data').click(function(){
		 $('#meta-data-box').toggle(); 
	  });
	});//ready

var wave1_news = {
	//add category
	add_new_category:function(){
		var name = $('#news_category_name').val();
		var news_id = $('#news_id').val();
		if(title != ''){
			$.ajax({
				url: '<?=base_url();?>admin/news/ajax/add_new_category',
				type: 'POST',
				data: {name:name,news_id:news_id},
				success: function(html) {
					if(html != 'failed'){
						$('#news_tbody').html(html);	
						$('#news_category_name').val('');
						$j('#new_category_model').modal('hide');
						help.custom_checkbox('.checker');
					}else{
						alert('Failed to add new category! Please try again!!!');
						$j('#new_category_model').modal('hide');	
					}
				},
				error:function(){
					alert('Something went wrong! Please try again!!!');
					$j('#new_category_model').modal('hide');
				}
			});	
		}
	},
	
	confirm_delete_category:function(category_id,category_name){
		if(category_id && category_name){
			$('#delete_category_name').html(category_name);
			$('#delete_category_id').val(category_id);	
			$j('#delete_category_model').modal('show'); 
		}
		
	},
	
	//delete category
	delete_news_category:function(){
		var category_id = $('#delete_category_id').val();
		var news_id = $('#news_id').val();
		if(category_id){
			$.ajax({
				url: '<?=base_url();?>admin/news/ajax/delete_category',
				type: 'POST',
				data: {category_id:category_id,news_id:news_id},
				success: function(html) {
					if(html != 'failed'){
						$('#news_tbody').html(html);
						$j('#delete_category_model').modal('hide');
						help.custom_checkbox('.checker');
					}else{
						alert('Failed to add new category! Please try again!!!');
						$j('#delete_category_model').modal('hide');	
					}
				},
				error:function(){
					alert('Something went wrong! Please try again!!!');
					$j('#delete_category_model').modal('hide');
				}
			});		
		}
	},
	
	confirm_delete_image:function(image_name){
		if(image_name){
			$('#delete_image_name_span').html(image_name);
			$j('#delete_news_image_model').modal('show'); 
		}
		
	},
	
	delete_news_image:function(){
		var news_id = $('#news_id').val();
		if(news_id){
			$.ajax({
				url: '<?=base_url();?>admin/news/ajax/delete_news_image',
				type: 'POST',
				data: {news_id:news_id},
				success: function(html) {
					if(html != 'failed'){
						$('#image-preview').remove();
						$j('#delete_news_image_model').modal('hide');
					}else{
						alert('Failed to add new category! Please try again!!!');
						$j('#delete_news_image_model').modal('hide');	
					}
				},
				error:function(){
					alert('Something went wrong! Please try again!!!');
					$j('#delete_news_image_model').modal('hide');
				}
			});		
		}
	},
	
	confirm_delete_doc:function(doc_name){
		if(doc_name){
			$('#delete_doc_name_span').html(doc_name);
			$j('#delete_news_doc_model').modal('show'); 
		}
		
	},
	
	delete_news_doc:function(){
		var news_id = $('#news_id').val();
		if(news_id){
			$.ajax({
				url: '<?=base_url();?>admin/news/ajax/delete_news_doc',
				type: 'POST',
				data: {news_id:news_id},
				success: function(html) {
					if(html != 'failed'){
						$('#doc-preview').remove();
						$j('#delete_news_doc_model').modal('hide');
					}else{
						alert('Failed to add new category! Please try again!!!');
						$j('#delete_news_doc_model').modal('hide');	
					}
				},
				error:function(){
					alert('Something went wrong! Please try again!!!');
					$j('#delete_news_doc_model').modal('hide');
				}
			});		
		}
	},
	
	toggle_gallery_tooltip:function(gallery_tooltip_id,toggle_type){
		if(toggle_type == 'show'){
			$('#'+gallery_tooltip_id).show();
		}else{
			$('#'+gallery_tooltip_id).hide();
		}
	}
};
</script>
<?php
	//if mode is edit
	$title = '';
	$id_title = '';
	$date = '';
	$news_id = '';
	$gallery = '';
	$preview = '';
	$content = '';
	$image = '';
	$doc = '';
	$folder = '';
	$meta_title = '';
	$meta_desc = '';
	$meta_keywords = '';
	$process_link = 'add_new_news';
	if(isset($news)){
		$title = $news->title;
		$id_title = $news->id_title;
		$date = date('d-m-Y',strtotime($news->news_date));
		$news_id = $news->id;
		$gallery = $news->gallery;
		$preview = $news->preview;
		$content = $news->content;
		$image = $news->image;
		$doc = $news->doc;
		$folder = md5('wave1_news'.$news_id);
		$meta_title = $news->meta_title;
		$meta_desc = $news->meta_description;
		$meta_keywords = $news->meta_keywords;
		$process_link = 'update_news';	
	}


?>
<div class="row row-bottom-margin">
	<div class="col-md-12">
        <div class="title-page">News</div>
        <div class="sub-title">Add new News here</div>
		<div style="clear: both"></div>
		
        <div class="grey-box">
		<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/news';"><i class="fa fa-hand-o-left"></i> Back To Case Studies</button>
        </div>
		<div class="subtitle-page">Basic Detail</div>
    </div> 
    <form id="add_news" method="post" action="<?=base_url();?>admin/news/<?=$process_link;?>" enctype="multipart/form-data">
    <input type="hidden" name="update_id" value="<?=$news_id;?>" id="news_id" />
    <div class="col-md-12">
        <div class="col-md-6 remove-gutter">
        	<div class="article-form-row">
				<div class="article-label">Article Title</div>
				<div class="article-input">
					<input class="article-txt-box" type="text" id="title" name="title" value="<?=$title;?>" data="required"/>
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">Link Title (No space,'/','&') </div>
				<div class="article-input">
					<input class="article-txt-box" type="text" id="id_title" name="id_title" value="<?=$id_title;?>" data="required"/>
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">Article Date</div>
				<div class="article-input">
					<input id="date" name="date" class="article-txt-box cursor" type="text" value="<?=$date;?>" readonly="readonly">
					<span class="add-on grey-bg"><i class="fa fa-calendar"></i></span>
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">Article Thumbnail</div>
				<div class="article-input">
                    <div class="fileupload fileupload-new article-upload-field" data-provides="fileupload">
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile_thumb"/>
                    </span>
                    <span class="fileupload-preview"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
               	    </div>
                    <?php if($image) { ?>
                         <div class="file-preview" id="image-preview">
                                <span><?=$image;?></span> <i class="fa fa-search cursor" onmouseover="wave1_news.toggle_gallery_tooltip('tool_img_<?=$news_id;?>','show');" onmouseout="wave1_news.toggle_gallery_tooltip('tool_img_<?=$news_id;?>','hide');"></i> 
                                <i onclick="wave1_news.confirm_delete_image('<?=$image;?>');" class="fa fa-trash-o cursor"></i>
                                <img id="tool_img_<?=$news_id;?>" class="img-tooltip" src="<?=base_url();?>uploads/news/<?=$folder;?>/thumb/<?=$image;?>"/>
                         </div>   
                    <?php } ?>
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">Article Download</div>
                
				<div class="article-input">
                	<div class="fileupload fileupload-new article-upload-field" data-provides="fileupload">
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile_download"/>
                    </span>
                    <span class="fileupload-preview"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
               	    </div>
					<?php if($doc) { ?>
                         <div class="file-preview" id="doc-preview">
                                <span><?=$doc;?></span> <a target="_blank" href="<?=base_url();?>uploads/news/<?=$folder;?>/doc/<?=$doc;?>"><i class="fa fa-search cursor"></i></a>
                                <i onclick="wave1_news.confirm_delete_doc('<?=$doc;?>');" class="fa fa-trash-o cursor"></i>
                         </div>   
                    <?php } ?>
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">Article Gallery</div>
				<div class="article-input">
					<select class="custom-select" id="gallery_id" name="gallery_id">
	                   <?=$this->news_model->load_gallery_options($gallery);?>
					</select>  
				</div>
			</div>
            
            <div class="article-form-row">
				<div class="article-label">&nbsp;</div>
				<div class="article-input">
					<button type="button" class="btn btn-info" onclick="help.validate_form('add_news');"><i class="fa fa-plus"></i> Save</button> 
				</div>
			</div>
        </div>
        
        <div class="col-md-6 remove-gutter">
            <div class="grey-box article-cat-grey-box remove-margin-top">
                <div class="title-page">Article Categories <span>(Check the categories this post should appear in)</span></div>
            </div>
            <table class="article-cat-table">
            	<thead>
                	<tr class="list-tr">
                    	<th class="th-title">Category</th>
                        <th class="th-status">Active</th>
                        <th class="th-delete">Delete</th>
                    </tr>
                </thead>
                
                <tbody id="news_tbody">
                	<?=$this->news_model->create_category_list($news_id);?>
                </tbody>
            </table>
            <div class="grey-box add-new-cat-grey-box">
                <div class="title-page cursor" id="add_category"><i class="fa fa-plus"></i> Add Categories</div>
            </div>
        </div>
        

	</div>
    <div style="clear: both"></div>
    <div class="col-md-12">
    	<div class="grey-box">
        	<div class="title-page">News Content</div>
        </div>
        
        <div class="title-page">News Preview Text</div>
        <div class="sub-title">The prview text is used to show a small amount of the full new so the viewer can decide if they would like to read more</div>
		<div class="article-fullwidth-row">
    		<textarea id="preview_article" class="article-preview-txt-area" name="preview_article"><?=$preview;?></textarea>
        </div>
        
        <div class="title-page">Complete News</div>
        <div class="sub-title">Write your complete news here</div>
		<div class="article-fullwidth-row">
    		<textarea id="complete_article" class="article-preview-txt-area" name="complete_article"><?=$content;?></textarea>
        </div>

    </div>
    
    <div style="clear: both"></div>
    <div class="col-md-12">
    	<div class="grey-box">
        	<button class="btn btn-info"  type="button" id="add-meta-data"><i class="fa fa-plus"></i> Meta Data</button>
        </div>
        
        <div id="meta-data-box">
            <div class="title-page">Meta Title</div>
            <div class="sub-title">This will appear as the title for the web browser</div>
            <div class="article-fullwidth-row">
                <input class="article-txt-box full-width" type="text" name="meta_title" value="<?=$meta_title;?>" maxlength="255" />
            </div>
            
             <div class="title-page">Meta Description</div>
            <div class="sub-title">This will be used to describe the page content in brief for SEO bots</div>
            <div class="article-fullwidth-row">
                <input class="article-txt-box full-width" type="text" name="meta_desc" value="<?=$meta_desc;?>" maxlength="255" />
            </div>
            
             <div class="title-page">Meta Keywords</div>
            <div class="sub-title">This will serve as keywords page</div>
            <div class="article-fullwidth-row">
                <input class="article-txt-box full-width" type="text" name="meta_keywords" value="<?=$meta_keywords;?>" maxlength="255" />
            </div>
        </div>
		<div class="article-fullwidth-row">
    		<button type="button" class="btn btn-info" onclick="help.validate_form('add_news');"><i class="fa fa-plus"></i> Save</button> 
        </div>

    </div>
    </form>
</div>
<script>
	
var preview_article = CKEDITOR.replace('preview_article',{
  height:100
});
var complete_article = CKEDITOR.replace('complete_article',{
  height:300
});

CKEDITOR.config.toolbar = [
   ['Source'],['Styles'], ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],['Link', 'Unlink','Anchor'],['Image'],['list', 'indent', 'blocks', 'align', 'bidi' ],[ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'],['Paste', 'PasteText', 'PasteFromWord']
] ;
CKFinder.setupCKEditor( preview_article, '<?=base_url()?>assets/ckfinder/' );
CKFinder.setupCKEditor( complete_article, '<?=base_url()?>assets/ckfinder/' );
CKFinder.setupCKEditor( testimonial, '<?=base_url()?>assets/ckfinder/' );
</script>



<!--begin add categories-->
<div id="new_category_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Add New Category</h3>
            </div>
            <div class="modal-body">
                
                <div class="left-side modal-label">
                    Category Name
                </div>
                <div class="left-side">
                    <input class="form-control input-text" type="text" id="news_category_name" value=""/>
                </div>
                <div class="cleardiv"></div>
               
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-info" onclick="wave1_news.add_new_category();"><i class="fa fa-plus"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<!--end add categories-->

<!--begin delete categories-->
<div id="delete_category_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Category</h3>
            </div>
            <div class="modal-body">
                
                <p>
                    You are about to delete <span class="title-page" id="delete_category_name"></span> category. Confirm delete?
                    <input type="hidden" id="delete_category_id" />
                </p>
                <div class="cleardiv"></div>
               
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="wave1_news.delete_news_category();"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete categories-->

<!--begin delete image-->
<div id="delete_news_image_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Image</h3>
            </div>
            <div class="modal-body">
                
                <p>
                    You are about to delete <strong><span id="delete_image_name_span"></span></strong>. Confirm delete?
                </p>
                <div class="cleardiv"></div>
               
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="wave1_news.delete_news_image();"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete image-->

<!--begin delete image-->
<div id="delete_news_doc_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Document</h3>
            </div>
            <div class="modal-body">
                
                <p>
                    You are about to delete <strong><span id="delete_doc_name_span"></span></strong>. Confirm delete?
                </p>
                <div class="cleardiv"></div>
               
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="wave1_news.delete_news_doc();"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete image-->

