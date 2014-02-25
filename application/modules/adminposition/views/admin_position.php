<script type="text/javascript" src="<?=base_url()?>assets/backend/js/sortable/jquery-jsortable.js"></script>
<script>
jQuery(document).ready(function(){
	<? if($first==true){
		?> searchproduct();<?
	}?>
});
function searchproduct() {	
	var category = jQuery('#category').val();
	jQuery.ajax({
		url: '<?=base_url()?>admin/position/ajax/searchproductposition',
		type: 'POST',
		data: ({category:category}),
		dataType: "html",
		success: function(html) {
			jQuery('#addfeature').html(html);
			$('.sorted_table').sortable({
			  containerSelector: 'tbody',			 
			  itemSelector: 'tr',
			  placeholder: '<tr class="placeholder"/>',
			  onDrop:	function(item, event, _super) {
  					update_order();
					_super(item)		
				}		 
			})
		}
	})
}
function update_order(){
	jQuery('#notes-position').html("<span style='color:#F00;'>Hit the update product button to save changes</span>");	
}
function change_position(id)
{
	jQuery('#idprod').val(id);
	$('#changePosition').modal('show');	
}
function detect_position()
{
	jQuery('#changePosition').modal('hide');	
	var indx=[];
	var i=1;
	jQuery('.tr_cat').each(function () {
		var id = $(this).attr("id");
		dtrp=id.replace('cat-','');
		indx[i]=dtrp;
		i=i+1;		
	});
	indx = $.grep(indx,function(n){ return(n) });
	var new_idx=[];
	var id_from=jQuery('#idprod').val();
	var id_pos=jQuery('#position_new').val();
	
	for(j=1; j<id_pos; j++)
	{
		new_idx[j]=indx[j];		
	}
	new_idx[j]=id_from;	
	j++;
	for(k=id_pos; k<i; k++)
	{
		
		if(indx[k]!=id_from){
			new_idx[j]=indx[k];
			j++;
		}
	}
	var category=jQuery('#pos_cat').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>admin/position/ajax/update_order/',
		type: 'POST',
		data: ({indx:new_idx,category:category}),
		dataType: "html",
		success: function(html) {
			
			searchproduct();
		}
	})
}

function update_product()
{
	var indx=[];
	var i=1;
	jQuery('.tr_cat').each(function () {
		var id = $(this).attr("id");
		dtrp=id.replace('cat-','');
		indx[i]=dtrp;
		i=i+1;
		
	});
	indx = $.grep(indx,function(n){ return(n) });
	var category=jQuery('#pos_cat').val();
	//alert(category);
	jQuery.ajax({
		url: '<?=base_url()?>admin/position/ajax/update_order/',
		type: 'POST',
		data: ({indx:indx,category:category}),
		dataType: "html",
		success: function(html) {
			searchproduct();
		}
	})
	jQuery('#notes-position').html("<span style='color:#128a0c;'>Changes saved</span>");
}
</script>
<style>
body.dragging, body.dragging * {
  cursor: move !important;

}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}
.sorted_table tr {
    cursor: pointer;
}
.sorted_table tr.placeholder {
    background: none repeat scroll 0 0 red;
    border: medium none;
    display: block;
    margin: 0;
    padding: 0;
    position: relative;
}
.sorted_table tr.placeholder:before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: transparent -moz-use-text-color transparent red;
    border-image: none;
    border-style: solid none solid solid;
    border-width: 5px medium 5px 5px;
    content: "";
    height: 0;
    left: -5px;
    margin-top: -5px;
    position: absolute;
    width: 0;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="title-page">Manage Product Position</div>
        <p>
        In the manage product position section you can manage what positions your products are displayed. Drag and drop the product name to change the order or hit the position button and type the position the product should appear in. Select the product category to display the product positions within that category.
        </p>
		<div class="subtitle-page">Search Products</div>
		<!-- <div class="error"><?=$this->session->flashdata('error_input')?></div>  -->
		<div class="form-search-label">Category</div>
		<div class="form-search-input">
			<select class="selectpicker" id="category" name="category">            		
            	<?php foreach($main as $maincat) { ?>
            		<option value="<?=$maincat['id']?>"><?=$maincat['name']?></option>        
            	<?php }?>
            					
            </select>
            <script>jQuery(".selectpicker").selectpicker();</script>
		</div>
		<div class="form-search-gap"></div>
		<div class="form-search-label">&nbsp;</div>
		<div class="form-search-input">
			<button class="btn btn-info" onclick="searchproduct()">Search</button>
		</div>
		<div class="form-search-gap"></div>
		<div id="addfeature">
    
        </div>
	</div>
</div>


<!-- <div class="span9">
	<div style="min-height: 365px; border: 1px solid #d6d6d6; border-radius: 5px; margin-right: 19px;">
		<div style="padding: 20px">
			
			<h1 style="padding-left: 7px">123</h1>
                           
                
                <div style="height: 5px; clear: both">&nbsp;</div>
                <div style="height: 0px; clear: both; border-top:1px solid #ccc">&nbsp;</div>
                <div class="box bgw">
            		<h2 style="padding-left:7px;">Search Product</h3>
                
                    
                    <div class="error"><?=$this->session->flashdata('error_input')?></div> 
                    <div style="height: 5px; clear: both">&nbsp;</div>
                    <div style="padding-left: 7px;">
                        <div style="width: 20%; float: left; height: 30px; line-height: 30px;">Category</div>
                        <div style="width: 80%; float: right">                                        
                            <select id="category">
                            <option value="0">All categories</option>
                            <?php foreach($main as $maincat) { ?>
                            <option value="<?=$maincat['id']?>"><?=$maincat['name']?></option>                            
                            <? }?>
                            </select>
                        </div>
                    </div>
                    <div style="height: 5px; clear: both">&nbsp;</div>
                    <div style="padding-left: 7px;">
                    <div style="width: 20%; float: left; height: 30px; line-height: 30px;">&nbsp;</div>
                    <div style="width: 80%; float: right">						
                        <button class="btn btn-primary" type="button" onclick="searchproduct()">Search</button>
                    </div>
            	</div>
                    
                
            </div>
            <div style="height: 25px; clear: both">&nbsp;</div>
            <div style="height: 0px; clear: both; border-top:1px solid #ccc">&nbsp;</div>  
            <div id="addfeature">
    
            </div>
			
		</div>
	</div>
</div> -->


<div id="changePosition" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Change Position</h3>
</div>
<div class="modal-body" >
	<input type="hidden" name="idprod" id="idprod"  />
	<div class="left-side modal-label">
    	 Change product position No#
    </div>
    <div class="left-side">
    	<input class="form-control input-text" type="text" id="position_new"/>
    </div>
    <div class="cleardiv"></div>
    
    <!-- <div style="height: 5px; clear: both">&nbsp;</div>
    <div>
        <div style="width: 20%; float: left">                    
            
        </div>
        <div style="width: 80%; float: left">                    
            <input class="textfield rounded" type="text" name="position_new" id="position_new"/>
        </div>
    </div> -->
</div>
<div class="modal-footer">
<button class="btn btn-info" type="button" onclick="detect_position()" >Save</button>
<button class="btn btn-info" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>