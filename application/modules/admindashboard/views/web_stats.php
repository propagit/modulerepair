        <?php if($this->dashboard_model->check_dash_module_visibility_status('webstats_today')): ?>
    	<div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Webstats</span>
                <span class="action"><a href="<?=base_url();?>admin/googlestats"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
                <div class="stats-box">
                	<span class="head" id="webstats-today">0</span>
                    <span class="sub-head">Site Visits <span class="item-counter">(Today)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('webstats_yesterday')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Webstats</span>
                <span class="action"><a href="<?=base_url();?>admin/googlestats"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
                <div class="stats-box">
                	<span class="head" id="webstats-yesterday">0</span>
                    <span class="sub-head">Site Visits <span class="item-counter">(Yesterday)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('webstats_month')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Webstats</span>
                <span class="action"><a href="<?=base_url();?>admin/googlestats"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
                <div class="stats-box">
                	<span class="head" id="webstats-current-month">0</span>
                    <span class="sub-head">Site Visits <span class="item-counter">(Month)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('webstats_lastmonth')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Webstats</span>
                <span class="action"><a href="<?=base_url();?>admin/googlestats"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
                <div class="stats-box">
                	<span class="head" id="webstats-last-month">0</span>
                    <span class="sub-head">Site Visits <span class="item-counter">(Last Month)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
