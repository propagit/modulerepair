<script>
$(function(){
	<?=$this->dashboard_model->get_query_function_for_active_dash_modules();?>
			
	$j('#config-dash-btn').click(function(){
		help.get_dash_components('<?=base_url();?>admin/dashboard/ajax/get_dash_modules','#ajax-dash-modules','.checker');
	});
});//ready

var dash = {
	get_stat:function(action_url, callback){
		$.ajax({
			url: action_url,
			type: 'POST',
			dataType: "json",
			success: function(data) {
				callback(data);
			},
			error:function(){
				alert('Something went wrong! Please try again!!!');
			}
		});		
	},
	
	web_stats:function(){
		$('#webstats-today').addClass('loading').html('');
		$('#webstats-yesterday').addClass('loading').html('');
		$('#webstats-current-month').addClass('loading').html('');
		$('#webstats-last-month').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_web_stats';
		dash.get_stat(action_url,function (webstats) { 
        	$('#webstats-today').removeClass('loading').html(webstats['today']);
			$('#webstats-yesterday').removeClass('loading').html(webstats['yesterday']);
			$('#webstats-current-month').removeClass('loading').html(webstats['this_month']);
			$('#webstats-last-month').removeClass('loading').html(webstats['last_month']);
   		});
	},
	
	cust_stats:function(){
		$('#member-account').addClass('loading').html('');
		$('#australian-members').addClass('loading').html('');
		$('#international-members').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_customer_stats';
		dash.get_stat(action_url,function (cust_stats) { 
			$('#member-account').removeClass('loading').html(cust_stats['total_customers']);
			$('#australian-members').removeClass('loading').html(cust_stats['aussi_customers']);
			$('#international-members').removeClass('loading').html(cust_stats['international_customers']);
   		});
	},
	
	product_stats:function(){
		$('#total-products').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_products_stats';
		dash.get_stat(action_url,function (products_stats) { 
            $('#total-products').removeClass('loading').html(products_stats['products']);
   		});
	},
	
	pages_stats:function(){
		$('#total-pages').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_pages_stats';
		dash.get_stat(action_url,function (pages_stats) { 
            $('#total-pages').removeClass('loading').html(pages_stats['total_pages']);
   		});
	},
	
	article_stats:function(){
		$('#total-articles').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_articles_stats';
		dash.get_stat(action_url,function (article_stats) { 
            $('#total-articles').removeClass('loading').html(article_stats['articles']);
   		});
	},
	
	galleries_stats:function(){
		$('#total-galleries').addClass('loading').html('');
		var action_url = '<?=base_url();?>admin/dashboard/ajax/get_galleries_stats';
		dash.get_stat(action_url,function (galleries_stats) { 
            $('#total-galleries').removeClass('loading').html(galleries_stats['galleries']);
   		});
	}
};


</script>
<div class="row">
	<div class="col-md-12">
		<div class="title-page">DASHBOARD</div> 
	</div>
    <?php $this->load->view('web_stats');?>
    <?php $this->load->view('customer_stats');?>
    <?php $this->load->view('sales_stats');?>
    <?php $this->load->view('cms_stats');?>
</div>
<div id="config-dash-btn" class="config-btn"><i class="fa fa-cogs"></i></div>
    
    
<!--begin dash components-->
<div id="dash-components" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="<?=base_url();?>admin/dashboard/update_dash_modules_status">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h3 id="myModalLabel">Configure Dashboard</h3>
            </div>
            <div class="modal-body">
            <p>Tick the modules you would like to display on your dashboard.</p>
            <div id="ajax-dash-modules"></div>
            </div>
            <div class="modal-footer">
            <button class="btn btn-info"><i class="fa fa-plus"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--begin dash components-->