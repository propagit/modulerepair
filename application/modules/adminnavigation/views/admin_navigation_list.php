<script>
jQuery(function() {
	jQuery('.edit-cust').tooltip({
		showURL: false
	});
});
function addNavigationModal()
{
	$j('#addNavigationModal').modal('show');
}
function add_navigation()
{
	var title = jQuery('#title').val();
	if(title!='')
	{
		$j('#addNavigationModal').modal('hide');
		jQuery.ajax({
			url: '<?=base_url()?>admin/navigation/add/',
			type: 'POST',	
			data: ({title:title}),
			dataType: "html",
			success: function(html) {	
				location.reload(); 	
			}
		})
	}
	else
	{
		alert('Please fill in the title of your navigation');
	}
}
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		
        <div class="title-page">Manage Navigation</div>
        <div class="sub-title">You can control the menu on your website via this page. Your primary menu items are displayed below. Edit the primary menu name and link by clicking the name. To control the secondary menu categories click the view edit link.</div>
		<div style="clear: both"></div>
		
        <div id="top-table">
			<div style="float: left">
				<div id="top-table-title">Primary Navigation</div>
			</div>
			
            <div id="top-table-button-group" style="margin-right:25px;">
				<!-- <button class="btn btn-info" onclick="addNavigationModal()">Add Navigation</button> -->
			</div>
			<div style="clear: both">
			</div>
		</div>
		
		
		<table class="table table-hover table-height">
			<thead>
				<tr class="list-tr">
					<th>BUTTON NAME</th>
					<th>VIEW - EDIT</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($main as $mn) 
					{
					?>
					<tr  class="list-tr" id="navigation<?=$mn['id']?>">
						<td><a href="javascript:edit_nav(<?=$mn['id']?>)"><?=$mn['name']?></a></td>
						<td style="text-align: center;">
                            <span class="edit-cust" data-toggle="tooltip" title="Edit this menu category" style="cursor: pointer" onclick="window.location = '<?=base_url()?>admin/navigation/detail/<?=$mn['id']?>'">
                                <i class="fa fa-search blue-icon"></i>

                            </span>
						</td>
					</tr>
					<?php
					} 
				?>
			</tbody>
		</table>
		
	</div>
</div>
<script>
var choosen = 0;
function edit_nav(id)
{
	choosen = id;
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/get_nav_title',
		type: 'POST',	
		data: ({id:id}),
		dataType: "html",
		success: function(html) {	
			//location.reload();
			jQuery('#edittitle').val(html);	
		}
	});
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/get_nav_url',
		type: 'POST',	
		data: ({id:id}),
		dataType: "html",
		success: function(html) {	
			//location.reload();
			jQuery('#editurl').val(html);	
		}
	});
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/get_nav_page',
		type: 'POST',	
		data: ({id:id}),
		dataType: "html",
		success: function(html) {	
			//location.reload();
			jQuery('#editpage').val(html);	
		}
	});
	
	$j('#editNavigationModal').modal('show');
}
function edit_navigation(id)
{
	var title = jQuery('#edittitle').val();
	var url = jQuery('#editurl').val();
	var page = jQuery('#editpage').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/navigation/ajax/edit_nav',
		type: 'POST',	
		data: ({id:id,title:title,url:url,page:page}),
		dataType: "html",
		success: function(html) {	
			//location.reload();
			//jQuery('#editurl').val(html);	
			$j('#editNavigationModal').modal('hide');
		}
	});
}
</script>
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
<div id="editNavigationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 id="myModalLabel" class="title-page">Edit Navigation</h3>
            </div>
            <div class="modal-body">
                <div class="left-side modal-label">            
                    Title       
                </div>          
                <div class="left-side">           
                    <input class="form-control input-text" type="text" id="edittitle"/>          
                </div>
                <div class="cleardiv" style="height:5px;"></div>
                <div class="left-side modal-label">            
                    Page     
                </div>          
                <div class="left-side">           
                    <select class="selectpicker" id="editpage" name="editpage">
	                   <option value="-">Please Select a page</option> 
	                    <? foreach($pages as $pg){ ?>						
	                   <option value="<?=$pg['id']?>"><?=$pg['title']?></option>                        
	                    <? }?>
					</select>  
					<script>jQuery(".selectpicker").selectpicker();</script>
                </div>
                <div class="cleardiv" style="height:5px;"></div>
                <div class="left-side modal-label">            
                    Url       
                </div>          
                <div class="left-side">           
                    <input class="form-control input-text" type="text" id="editurl" value="http://"/>          
                </div>
                <div class="cleardiv" style="height:5px;"></div>
                <div class="left-side modal-label">            
                    &nbsp;
                </div>          
                <div class="left-side">           
                            
                </div>
                <div class="cleardiv" ></div>
            </div>
            <div class="modal-footer">
            	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-info" onclick="edit_navigation(choosen)">Save</button>  
            </div>
        </div>
    </div>
</div>