<script>
$j(function(){
	 $j('.custom-select').selectpicker();
	
	
	 cs_search.start_search();
});//ready


//cs = case study
var cs_search = {
	
	
	//get all parameters for search
	get_all_filters:function(){
		var params = {};
		params['category_id'] = $j('#category').val();
		params['keywords'] = $j('#keyword').val();
		return params	
	},
	
	start_search:function(){
		var current_filters = cs_search.get_all_filters();
		$j('#ajax-news').html('');
		$j('#ajax-news').addClass('loading');
		$j.ajax({
		  type:'post',
		  url:'<?=base_url();?>news/ajax/search_news',
		  data:{params:current_filters},
		  success:function(html){
			  $j('#ajax-news').removeClass('loading');
			  $j('#ajax-news').html(html);
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
  
               <div class="col-md-12">
               <span class="page-title">RECENT NEWS</span>
               <p class="head-p">
              Keep up to date by checking what is 
going on within Wave1 and the rest of 
the industry.  
               </p>
               </div>
               <!--
               <div class="col-md-5 search-box">
                  <span class="search-box-head">FIND NEWS</span>
                  <span class="">Enter news title or bring up news based on category</span>
                  <div class="search-row search-first-row">
                      <span>Keyword</span>
                      <input type="text" placeholder="Enter Keyword" name="keyword" id="keyword" class="gen-txt-box" onkeyup="cs_search.start_search();" />
                  </div>
                  <div class="search-row">
                      <span>Category</span>
                      <select id="category" class="custom-select case-study-select" onchange="cs_search.start_search();">
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
                    <button type="button" class="button search-btn" onclick="cs_search.start_search();" ><i class="fa fa-search"></i> SEARCH</button>
                  </div>
               </div>--><!--end search-box-->

            </div>
        </div><!--row-->	
        
        <div class="row">
            <div class="col-lg-12"> 
            	<div class="col-md-12">            
					<h1 class="normal-h1 case-studies-h1">RECENT NEWS</h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">   
            	<div class="col-md-12">
  					<div id="ajax-news">
                    
                    </div>
                </div>
            </div>
        </div>


        
        
	</div><!--page-wrap-->
</div><!--container-->
