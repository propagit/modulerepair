<script>
$j(function(){
	 $j('.custom-select').selectpicker();
	 cs_search.start_search(false);
});//ready

//functions to call while scrolling
$j(window).scroll(function() {
   
   //when end of page reaches
   var buffer = 200;
   if(($j(window).scrollTop() + buffer) > ($j(window).height()/2)) {
	   //bottom reached load more data
	   if($j('#limit').val() != 'no-more-data'){
		   if($j('#data-loading').val() == 'no'){
			   $j('#data-loading').val('yes');
			   cs_search.start_search(true);
		   }
	   }else{
			$j('#no-data').show();   
	   }
   }

});//$j(window).scroll 

function filterbycategory(category_id)
{

	$j('#category').val(category_id);
	cs_search.start_search();
	
}

//cs = case study
var cs_search = {
	
	
	//get all parameters for search
	get_all_filters:function(){
		var params = {};
		params['category_id'] = $j('#category').val();
		params['keywords'] = $j('#keyword').val();
		params['limit'] = $j('#limit').val();
		return params	
	},
	
	start_search:function(show_more){
		if(!show_more){
			$j('#limit').val('0');  
			$j('#no-data').hide(); 	
		}
		var current_filters = cs_search.get_all_filters();
		$j('#loading-wheel').addClass('loading');
		$j.ajax({
		  type:'post',
		  url:'<?=base_url();?>case_studies/ajax/search_case_studies',
		  dataType: "json",
		  data:{params:current_filters},
		  success:function(data){
			  $j('#loading-wheel').removeClass('loading');
			  $j('#data-loading').val('no');
			  if(show_more){
				$j('#ajax-case-studies').append(data['case_studies']);
				$j('#new-limit').html(data['new_limit']);  
			  }else{
				//treat as new search 
			  	$j('#ajax-case-studies').html(data['case_studies']);
				$j('#new-limit').html(data['new_limit']);  
			  }
		  },error:function(){
			  //error
		  }
	  });
	}
	
	
	
	
};
</script>
<div class="container margin-top-10">
	<div class="wrap page-wrap">
        <div class="row">
            <div class="col-lg-12">
  
               <div class="col-md-6">
               <span class="page-title">CASE STUDIES</span>
               <p class="head-p">
              Wave1 has been operating for more than 30 years and in that time we 
have provided network services for virtually all industries including 
Government, Health, Education and Corporate clients.<br /><br />

Please browse or search our case study database to find out more 
about the solutions Wave1 has provided and the feedback we 
continually get back from our clients.  
               </p>
               </div>
               <div class="col-md-5 search-box">
                  <span class="search-box-head">FIND A CASE STUDY</span>
                  <span class="">Enter a case study name or bring up case studies based on industry</span>
                  <div class="search-row search-first-row">
                      <span>Keyword</span>
                      <input type="text" placeholder="Enter Keyword" name="keyword" id="keyword" class="gen-txt-box" onkeyup="cs_search.start_search(false);" />
                  </div>
                  <div class="search-row">
                      <span>Industry</span>
                      <select id="category" class="custom-select case-study-select" onchange="cs_search.start_search(false);">
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
                  <div class="search-row">
                  	<span>&nbsp;</span>
                    <button type="button" class="button search-btn" onclick="cs_search.start_search();"><i class="fa fa-search"></i> SEARCH</button>
                  </div>
               </div><!--end search-box-->

            </div>
        </div><!--row-->	
        
        <div class="row">
            <div class="col-lg-12"> 
            	<div class="col-md-12">            
					<h1 class="normal-h1 case-studies-h1">RECENT CASE STUDIES</h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">   
            	<div class="col-md-12">
  					<div id="ajax-case-studies">

                    </div>
                    <div id="new-limit"><input id="limit" type="hidden" value="<?=$records_per_page;?>"></div>
                </div>
                <div class="col-md-12 float-left">
                	<div id="loading-wheel"></div>
                    <div id="no-data">No More Records To Display</div>
                    <input type="hidden" id="data-loading" value="no" />
                </div>
            </div>
        </div>


        
        
	</div><!--page-wrap-->
</div><!--container-->
