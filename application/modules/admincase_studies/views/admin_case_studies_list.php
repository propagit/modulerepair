<script>
$(function(){
	$j('.custom-select').selectpicker();
	
	cs_search.start_search();
	
	$j('#config-records-per-page').click(function(){
		$j('#record-per-page').modal('show'); 
	});	
	case_std_list.my_tooltip();
});//ready
	
var case_std_list = {

	confirm_delete_case_study:function(case_study_name,case_study_id){
		if(case_study_name && case_study_id){
			$('#delete_case_study_name_span').html(case_study_name);
			$('#case_study_id').val(case_study_id);
			$j('#delete_case_study_model').modal('show'); 
		}
		
	},
	
	delete_case_study:function(){
		var case_study_id = $('#case_study_id').val();
		if(case_study_id){
			window.location='<?=base_url();?>admin/case_studies/delete_case_study/'+case_study_id;
		}
	},
	
	my_tooltip:function(){
		 $j('.my-tooltip').tooltip({
			 showURL: false
		 });
	}

};

//cs = case study
var cs_search = {
	
	//default sort parameters
	title_sort:'az',
	date_sort:'za',
	status_sort:'az',
	active_sort:'date',
	
	//get all parameters for search
	get_all_filters:function(){
		var params = {};
		params['category_id'] = $('#category').val();
		params['keywords'] = $('#keyword').val();
		params['sort_params'] = cs_search.get_sort_params();
		return params	
	},
	
	start_search:function(){
		var current_filters = cs_search.get_all_filters();	
		$.ajax({
		  type:'post',
		  url:'<?=base_url();?>admin/case_studies/ajax/search_case_studies',
		  data:{params:current_filters},
		  dataType: "json",
		  success:function(data){
			   $('#total-count').html(data[0]);
			   $('#case-study-list-tbody').html(data[1]);
			   case_std_list.my_tooltip();
		  },error:function(){
			  //error
		  }
	  });
	},
	
	sort_search:function(sort_by){
		cs_search.set_sort_param(sort_by);
		cs_search.start_search();
	},
	
	get_sort_params:function(){
		var sort_params = {};
		sort_params['active_sort'] = cs_search.active_sort;
		sort_params['sort_type'] = cs_search.title_sort;
		switch(cs_search.active_sort){
			case 'title':
				sort_params['sort_type'] = cs_search.title_sort;
			break;
			
			case 'date':
				sort_params['sort_type'] = cs_search.date_sort;
			break;
			
			case 'status':
				sort_params['sort_type'] = cs_search.status_sort;
			break;	
		}
		return sort_params;
	},
	
	set_sort_param:function(sort_by){
		switch(sort_by){
			case 'title':
			  if(cs_search.title_sort == 'az'){
				 cs_search.title_sort = 'za';
				
			  }else{
				  cs_search.title_sort = 'az';
			  }
			  cs_search.active_sort = 'title';
			break;
			
			case 'date':
				if(cs_search.date_sort == 'az'){
				   cs_search.date_sort = 'za'; 
			    }else{
				   cs_search.date_sort = 'az';
			    }
				cs_search.active_sort = 'date';
			break;
			
			case 'status':
				if(cs_search.status_sort == 'az'){
				   cs_search.status_sort = 'za'; 
			    }else{
				    cs_search.status_sort = 'az';
			    }
				cs_search.active_sort = 'status';
			break;
			
			default:
				cs_search.active_sort = 'date';
			break;	
		}
		cs_search.change_icons(sort_by);
	},
	
	change_icons:function(sort_by){
		$('.sort-icons').removeClass('status-active');
		switch(sort_by){
			case 'title':
			  if(cs_search.title_sort == 'az'){
				 	$('.list-title-sort').removeClass('fa-sort-alpha-desc').addClass('fa-sort-alpha-asc status-active');
			  }else{
					$('.list-title-sort').removeClass('fa-sort-alpha-asc').addClass('fa-sort-alpha-desc status-active');
			  }
			break;
			
			case 'date':
			  if(cs_search.date_sort == 'az'){
					$('.list-date-sort').removeClass('fa-sort-alpha-desc').addClass('fa-sort-alpha-asc status-active');
			  }else{
					$('.list-date-sort').removeClass('fa-sort-alpha-asc').addClass('fa-sort-alpha-desc status-active');
			  }
			break;
			
			case 'status':
			  if(cs_search.status_sort == 'az'){
					$('.list-status-sort').removeClass('fa-sort-amount-desc').addClass('fa-sort-amount-asc status-active');
			  }else{
					$('.list-status-sort').removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc status-active');
			  }
			break;
		}
		
	}
	
	
};
</script>
<div class="row row-bottom-margin">
	<div class="col-md-12">
		
        <div class="title-page">Manage Case Studies</div>
        <div class="sub-title">Search case studies here. You can sort the search results based on title, date and status.</div>
		<div style="clear: both"></div>


		<div class="grey-box">
        	<button class="btn btn-info" onclick="window.location='<?=base_url();?>admin/case_studies/add'"><i class="fa fa-plus"></i> Add New Case Study</button>
        </div>
		<div style="clear: both"></div>
        
		<div class="subtitle-page">Search Case Studies</div>

        	<div class="form-search-label">Category</div>
			<div class="form-search-input">
				<select class="custom-select" name="category" id="category" onchange="cs_search.start_search();">
                	<option value="0">Select Category</option>
                	<?php
					if($categories){
						foreach($categories as $cat){
					?>
                    	<option value="<?=$cat->id;?>"><?=$cat->name;?></option>
                    <?php		
						}
					}
	            	?>	
	            </select>
			</div>
            <div class="form-search-gap"></div>
			<div class="form-search-label">Keyword</div>
			<div class="form-search-input">
				<input type="text" class="form-control input-text" id="keyword" name="keyword" value="" onkeyup="cs_search.start_search();"/>
			</div>
			<div class="form-search-gap"></div>
			
			<div class="form-search-label">&nbsp;</div>
			<div class="form-search-input">
				<button class="btn btn-info" onclick="cs_search.start_search();"><i class="fa fa-search"></i> Search</button>
			</div>

			<div class="form-search-gap"></div>

            
         
        <div id="top-table">
			<div style="float: left">
				<div id="top-table-title">Case Studies List <span id="total-count"></span></div>
			</div>         
			<div style="clear: both"></div>
		</div>
		<table class="case-study-list-table">
	    	<thead>
	    		<tr class="list-tr">
	    			<th class="list-case-title">Case Study Title <i data-toggle="tooltip" title="Sort by title" class="fa fa-sort-alpha-asc cursor list-title-sort sort-icons my-tooltip" onclick="cs_search.sort_search('title');"></i></th>
	    			<th class="list-case-cat">Category</th>
	    			<th class="list-case-date">Date <i data-toggle="tooltip" title="Sort by date" class="fa fa-sort-alpha-desc cursor list-date-sort sort-icons status-active my-tooltip" onclick="cs_search.sort_search('date');"></i></th>
	    			<th class="list-case-status">Status <i data-toggle="tooltip" title="Sort by status" class="fa fa-sort-amount-asc cursor list-status-sort sort-icons my-tooltip" onclick="cs_search.sort_search('status');"></i></th>
	    			<th class="list-case-view">View | Edit</th>
	    			<th class="list-case-del">Delete</th>
	    		</tr>
	    	</thead>
	    	<tbody id="case-study-list-tbody">
            
            	
            </tbody>
       </table>

	</div>
</div>

<div id="config-records-per-page" class="config-btn"><i class="fa fa-cogs"></i></div>

<!--begin delete-->
<div id="delete_case_study_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Delete Case Study</h3>
            </div>
            <div class="modal-body">
                
                <p>
                    You are about to delete <strong><span id="delete_case_study_name_span"></span></strong>. Confirm delete?
                </p>
                
               
            </div>
            <div class="modal-footer">
            <input type="hidden" id="case_study_id" />
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-info" onclick="case_std_list.delete_case_study();"><i class="fa fa-trash-o"></i> Delete</button>
            </div>
        </div>
    </div>
</div>
<!--end delete -->

<!--begin record per page config-->
<div id="record-per-page" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="<?=base_url();?>admin/case_studies/update_records_per_page">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Configure Records Per Page</h3>
            </div>
            <div class="modal-body">
             	<div class="left-side modal-label">
                    Backend
                </div>
                <div class="left-side">
                    <input class="form-control input-text" type="text" name="records_per_page_backend" value="<?=$records_per_page->backend;?>"/>
                </div>
                <div class="cleardiv"><br /></div>
                <div class="left-side modal-label">
                    Frontend
                </div>
                <div class="left-side">
                    <input class="form-control input-text" type="text" name="records_per_page_frontend" value="<?=$records_per_page->frontend;?>"/>
                </div>
                <input type="hidden" name="records_per_page_id" value="<?=$records_per_page->id;?>" />
                <div class="cleardiv"></div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-info"><i class="fa fa-plus"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--end record per page config-->