        <?php if($this->dashboard_model->check_dash_module_visibility_status('news_subscribers')): ?>
    	<div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Customers</span>
                <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
            </div>
            <div class="body-row">
            	<div class="icon-circle green-bg"><i class="fa fa-users"></i></div>
                <div class="stats-box">
                	<span class="head" id="newsletter-subscribers">0</span>
                    <span class="sub-head">News Subscribers</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('total_customers')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Customers</span>
                <span class="action"><a href="<?=base_url();?>admin/customer"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle green-bg"><i class="fa fa-users"></i></div>
                <div class="stats-box">
                	<span class="head" id="member-account">0</span>
                    <span class="sub-head">Member Accounts</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('australian_customers')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Customers</span>
                <span class="action"><a href="<?=base_url();?>admin/customer"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle green-bg"><i class="fa fa-users"></i></div>
                <div class="stats-box">
                	<span class="head" id="australian-members">0</span>
                    <span class="sub-head">Customers <span class="item-counter">(Aus)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('international_customers')): ?> 
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Customers</span>
                <span class="action"><a href="<?=base_url();?>admin/customer"><i class="fa fa-info-circle"></i> More Info</a></span>
            </div>
            <div class="body-row">
            	<div class="icon-circle green-bg"><i class="fa fa-users"></i></div>
                <div class="stats-box">
                	<span class="head" id="international-members">0</span>
                    <span class="sub-head">Customers <span class="item-counter">(Intl)</span></span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>

