
 <style>
#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; cursor: pointer}

</style>
 <script>
$(function() {
	 $( "#sortable" ).sortable({
		 activate:function(event,ui){
			$('#update-hint').show();	 
		 }	 
	 });
});

function create_product_nav(my_select,button_link,button_name)
{
	var url = 'http://';
	if(my_select){
		 url = '<?=base_url();?>products/'+my_select.value;
		 $('#'+button_link).val(url);	
		 $('#'+button_name).val(my_select.options[my_select.selectedIndex].text);
	}
}

function update_order()
{
	$('#order_nav_pos').submit();	
}
</script>
<div class="row row-bottom-margin">

	<div class="col-md-12">
		
        <div class="title-page">EDIT NAVIGATION</div>
        <div class="sub-title">Create buttons and links on your website navigation menu system.<br />Change the name of the button and the link that the button will go to when clicked</div>
        <div class="subtitle-page title-page">ADD A NEW BUTTON TO THE [<?=$menu_info->name;?>] MENU</div>
        
        <form name="customerform" method="post" action="<?=base_url()?>admin/navigation/addsub">

			<input type="hidden" class="form-control input-text" id="menu_id" name="menu_id" value="<?=$menu_id?>"/>

            <div class="form-search-label">Button Name</div>

			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="name" name="name" value=""/>
			</div>
           
			<div class="form-search-gap"></div>            		  		

            <div class="form-search-label">Button Link (Internal)</div>
			<?php if($product_categories){ ?>
			<div class="form-search-input">
				<select class="selectpicker" id="page" name="page" onchange="create_product_nav(this,'url','name');">
                   <option value="-">Please Select a Product Category</option> 
                    <? foreach($product_categories as $cat){ ?>						
                   <option value="<?=$cat['id_title']?>"><?=$cat['name']?></option>                       
                    <? }?>
				</select>
			</div>
            <?php }else{ ?>
            <div class="form-search-input">
				
				<select class="selectpicker" id="page" name="page">
                   <option value="-">Please Select a page</option> 
                    <? foreach($pages as $pg){ ?>						
                   <option value="<?=$pg['id']?>"><?=$pg['title']?></option>                        
                    <? }?>
				</select>
			</div>
            <?php } ?>
            <div class="form-search-gap"></div>  
            <div class="form-search-label">Button Link (External)</div>
            <div class="form-search-input">	
                <input type="text" class="form-control input-text" id="url" name="url" value="http://"/>
	            <script>jQuery(".selectpicker").selectpicker();</script>
			</div>
	        <div class="form-search-gap"></div>		
			<div class="form-search-label"></div>
			<div class="form-search-input">
            	<button class="btn btn-info" onclick=""><i class="fa fa-plus"></i> Add Button</button>
            </div>
            <div class="form-search-gap"></div>		
		</form>

		<div style="clear: both"></div>
        
        
		<div style="clear: both"></div>
		
        <div id="top-table">
			<div style="float: left">
				<div id="top-table-title"><?=$menu_info->name;?> MENU SYSTEM <span>(Drag & Drop to change the order of the menu)</span> <span id="update-hint" class="update-hint">(Hit Update to save your changes)</span></div>
			</div> 
            <div id="top-table-button-group">
          	  <button class="btn btn-info pull-right" type="button" onclick="update_order();">Update</button>  
            </div>      
			<div style="clear: both">

			</div>

		</div>
        
        <div class="simulate-tr">
            	<div class="tr-title">
                	Button Name
                </div>
                <div class="tr-action-edit">View - Edit</div>
                <div class="tr-action-delete">Delete</div>
        </div>
		<form action="<?=base_url();?>admin/navigation/order_nav_links_position" method="post" id="order_nav_pos">
        <input type="hidden" name="menu_id" value="<?=$menu_id;?>" />
		<ol class="nested_with_switch vertical" id="sortable">
        	<? foreach($alllinks as $lnk){?>
			<li id="link<?=$lnk['id']?>">
            <input type="hidden" name="nav_pos_ids[]" value="<?=$lnk['id'];?>"  />
            <div class="tr-title">
                <a href="javascript:edit_link(<?=$lnk['id']?>,'<?=$lnk['name']?>')"><?=$lnk['name']?></a>
            </div>
            <div class="tr-action-edit"><a href="javascript:edit_link(<?=$lnk['id']?>,'<?=$lnk['name']?>')"><i class="fa fa-search"></i></a></div>
            <div class="tr-action-delete"><a href="javascript:confirm_delete(<?=$lnk['id']?>,'<?=$lnk['name']?>')"><i class="fa fa-trash-o"></i></a></div>		
            </li>			
            <? }?>
            
        </ol>
		</form>

	</div>

</div>

<script>
function confirm_delete(id,link_name)
{
	$('#delete_id').val(id);
	$('#delete_nav_link_span').html(link_name);
	$j('#delete_link').modal('show');
	 
}

function deletelink()
{
	var id = $('#delete_id').val();
	$('#update-hint').hide();
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/deletelinks/',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			jQuery('#link'+id).remove();
			$j('#delete_link').modal('hide');
			set_footer();
		}
	});
}

function edit_link(id,name)
{
	$j('#updatelinkModal').modal('show');
	jQuery('#linkname').val(name);
	jQuery('#linkid').val(id);
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/get_url/',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			//location.reload();
			jQuery('#editurl').val(html);
		}
	});
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/get_page/',
		type: 'POST',
		data: ({id:id}),
		dataType: "html",
		success: function(html) {
			//location.reload();
			jQuery('#editpage').val(html);
			//jQuery("#editpage option:selected").val(html);
		}
	});
}
function edit_navigation()
{
	var id = jQuery('#linkid').val();
	var name = jQuery('#linkname').val();
	var url = jQuery('#editurl').val();
	var page = jQuery('#editpage').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/edit_link/',
		type: 'POST',
		data: ({id:id,name:name,url:url,page:page}),
		dataType: "html",
		success: function(html) {
			location.reload();
		}
	});
}

</script>


<div id="updatelinkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel" class="title-page">Edit Link</h3>
            </div>
            <div class="modal-body">
                <div class="left-side modal-label">            
                    Name       
                </div>          
                <div class="left-side" style="width:70%">           
                    <input class="form-control input-text" type="text" id="linkname"/>
                    <input type="hidden" id="linkid">          
                </div>
                <div class="cleardiv" style="height:10px"></div>
                
                <div class="left-side modal-label">            
                    Link to
                </div>  
                <?php if($product_categories){ ?>
                <div class="left-side" style="width:70%">           
                    <select class="selectpicker" id="editpage" name="editpage" onchange="create_product_nav(this,'editurl','linkname');">
	                   <option value="-">Please Select Product Category</option> 
	                    <? foreach($product_categories as $cat){ ?>						
	                   <option value="<?=$cat['id_title']?>"><?=$cat['name']?></option>                        
	                    <? }?>
					</select> 
                </div>
                <?php }else { ?>       
                <div class="left-side" style="width:70%">           
                    <select class="selectpicker" id="editpage" name="editpage">
	                   <option value="-">Please Select a page</option> 
	                    <? foreach($pages as $pg){ ?>						
	                   <option value="<?=$pg['id']?>"><?=$pg['title']?></option>                        
	                    <? }?>
					</select> 
                </div>
                <?php } ?>
  
                
                <div class="left-side modal-label">            
                    &nbsp;
                </div>          
                <div class="left-side" style="width:70%">           
					<input type="text" class="form-control input-text" id="editurl" name="editurl" value="http://" style="margin-top:10px;"/>
                </div>
                
                <div class="cleardiv" style="height:10px"></div>
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-info" onclick="edit_navigation()">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>jQuery(".selectpicker").selectpicker();</script>

<div id="addNavigationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel" class="title-page">Add Navigation</h3>
            </div>
            <div class="modal-body">
                <div class="left-side modal-label">            
                    Title       
                </div>          
                <div class="left-side">           
                    <input class="form-control input-text" type="text" id="title"/>          
                </div>
                <div class="cleardiv" ></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-info" onclick="add_navigation()">Add</button>
            </div>
        </div>
    </div>
</div>

<!--begin delete-->
<div id="delete_link" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Nav Link</h3>
            </div>
            <div class="modal-body">
                
                <p>
                    You are about to delete <strong><span id="delete_nav_link_span"></span></strong>. Confirm delete?
                </p>
                
               
            </div>
            <div class="modal-footer">
            <input type="hidden" id="delete_id" />
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="deletelink();"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete -->

<style>
#delete_nav_link_span{ text-transform:uppercase;}
body.dragging, body.dragging * {
  cursor: move !important;
}
.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.vertical {
   /*  margin: 0 0 9px; */
    margin:-1px 0 0 0;
	float:left;
	padding-left:0;
	width:100%;
}
ol.vertical li {
    /* background: none repeat scroll 0 0 #EEEEEE;
    border: 1px solid #CCCCCC; */
    color: #0088CC;
    display: block;
    /* margin: 5px; */
    /* padding-left: 15px; */
	font-size: 12px;
	font-weight: 700;
	text-transform: uppercase;
	border: 1px solid #d9d9d9;
	width: 100%;
	line-height: 56px;
	height: 58px;
}
ol.vertical li.placeholder {
    border: medium none;
    margin: 0;
    padding: 0;
    position: relative;
}
ol.vertical li.placeholder:before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: rgba(0, 0, 0, 0) -moz-use-text-color rgba(0, 0, 0, 0) #FF0000;
    border-image: none;
    border-style: solid none solid solid;
    border-width: 5px medium 5px 5px;
    content: "";
    height: 0;
    left: -5px;
    margin-top: -5px;
    position: absolute;
    top: -4px;
    width: 0;
}
ol {
    list-style-type: none;
}
ol i.icon-move {
    cursor: pointer;
}
ol li.highlight {
    background: none repeat scroll 0 0 #333333;
    color: #999999;
}
ol li.highlight i.icon-move {
    background-image: url("../img/glyphicons-halflings-white.png");
}
ol.nested_with_switch, ol.nested_with_switch ol {
    /* border: 1px solid #EEEEEE; */
}
ol.nested_with_switch.active, ol.nested_with_switch ol.active {
   /*  border: 1px solid #333333; */
}
ol.nested_with_switch li, ol.simple_with_animation li, ol.default li {
    cursor: pointer;
}
.switch-container {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 80px;
}
.navbar-sort-container {
    height: 200px;
}
ol.nav li, ol.nav li a {
    cursor: pointer;
}
ol.nav .divider-vertical {
    cursor: default;
}
ol.nav li.dragged {
    background-color: #2C2C2C;
}
ol.nav li.placeholder {
    position: relative;
}
ol.nav li.placeholder:before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: #FF0000 rgba(0, 0, 0, 0) -moz-use-text-color;
    border-image: none;
    border-left: 5px solid rgba(0, 0, 0, 0);
    border-right: 5px solid rgba(0, 0, 0, 0);
    border-style: solid solid none;
    border-width: 5px 5px medium;
    content: "";
    height: 0;
    margin-left: -5px;
    position: absolute;
    top: -6px;
    width: 0;
}
ol.nav ol.dropdown-menu li.placeholder:before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: rgba(0, 0, 0, 0) -moz-use-text-color rgba(0, 0, 0, 0) #FF0000;
    border-image: none;
    border-style: solid none solid solid;
    border-width: 5px medium 5px 5px;
    left: 10px;
    margin-top: -5px;
    top: 0;
}
</style>