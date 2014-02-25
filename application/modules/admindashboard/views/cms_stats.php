		<?php if($this->dashboard_model->check_dash_module_visibility_status('total_products')): ?>
    	<div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Products</span>
                <span class="action"><a href="<?=base_url();?>admin/product"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle purple-bg"><i class="fa fa-tags"></i></div>
                <div class="stats-box">
                	<span class="head" id="total-products">
                    	0 
						<span class="item-counter">(<span class="active-count">0</span> - <span class="inactive-count">0</span>)</span>
                    </span>
                    <span class="sub-head">Total Products</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('total_pages')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Pages</span>
                <span class="action"><a href="<?=base_url();?>admin/page"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle purple-bg"><i class="fa fa-file-text-o"></i></div>
                <div class="stats-box">
                	<span class="head" id="total-pages">0</span>
                    <span class="sub-head">Total Pages</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('total_articles')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Articles</span>
                <span class="action"><a href="<?=base_url();?>admin/case_studies"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle purple-bg"><i class="fa fa-file-text-o"></i></div>
                <div class="stats-box">
                	<span class="head" id="total-articles">
                    	0 
						<span class="item-counter">(<span class="active-count">0</span> - <span class="inactive-count">0</span>)</span>
                    </span>
                    <span class="sub-head">Total Articles</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('total_galleries')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Galleries</span>
                <span class="action"><a href="<?=base_url();?>admin/gallery"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle purple-bg"><i class="fa fa-picture-o"></i></div>
                <div class="stats-box">
                	<span class="head" id="total-galleries">
                    	0 
						<span class="item-counter">(<span class="active-count">0</span> - <span class="inactive-count">0</span>)</span>
                    </span>
                    <span class="sub-head">Total Galleries</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>

