<script type="text/javascript" src="<?=base_url()?>assets/backend/js/sortable/jquery-jsortable.js"></script>
<script>
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
	jQuery('#notes').html("<span style='color:#F00;'>Changes haven't save yet</span>");	
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
		url: '<?=base_url()?>admin/position/update_order/',
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
	var category=jQuery('#pos_cat').val();
	//alert(category);
	jQuery.ajax({
		url: '<?=base_url()?>admin/position/update_order/',
		type: 'POST',
		data: ({indx:indx,category:category}),
		dataType: "html",
		success: function(html) {
			searchproduct();
		}
	})
	jQuery('#notes').html("<span style='color:#3F0;'>Changes saved</span>");
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
<div class="span9">
	<div style="min-height: 365px; border: 1px solid #d6d6d6; border-radius: 5px; margin-right: 19px;">
		<div style="padding: 20px">
			<!-- start here -->
			<h1 style="padding-left: 7px">Manage Products Position123</h1>
                           
                
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
			<!-- end here -->
		</div>
	</div>
</div>


<div id="changePosition" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Change Position</h3>
</div>
<div class="modal-body" >
    <input type="hidden" name="idprod" id="idprod"  />
    <div style="height: 5px; clear: both">&nbsp;</div>
    <div>
        <div style="width: 20%; float: left">                    
            To Position No:
        </div>
        <div style="width: 80%; float: left">                    
            <input class="textfield rounded" type="text" name="position_new" id="position_new"/>
        </div>
    </div>
</div>
<div class="modal-footer">
<button class="btn btn-primary" type="button" onclick="detect_position()" >Save</button>
<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>