        <?php if($this->dashboard_model->check_dash_module_visibility_status('sales_today')): ?>
    	<div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Sales</span>
                <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
            </div>
            <div class="body-row">
            	<div class="icon-circle blue-bg"><i class="fa fa-stack-overflow"></i></div>
                <span class="alert-circle red-bg">0</span>
                <div class="stats-box">
                	<span class="head" id="sales-today">0</span>
                    <span class="sub-head">Sales Today</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('sales_week')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Sales</span>
                <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
            </div>
            <div class="body-row">
            	<div class="icon-circle blue-bg"><i class="fa fa-stack-overflow"></i></div>
                <span class="alert-circle red-bg">0</span>
                <div class="stats-box">
                	<span class="head" id="sales-week">0</span>
                    <span class="sub-head">Sales Week</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('sales_month')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Sales</span>
                <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
            </div>
            <div class="body-row">
            	<div class="icon-circle blue-bg"><i class="fa fa-stack-overflow"></i></div>
                <div class="stats-box">
                	<span class="head" id="sales-month">0</span>
                    <span class="sub-head">Sales Month</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>
        <?php if($this->dashboard_model->check_dash_module_visibility_status('sales_year')): ?>
        <div class="col-md-3 dash-box">
        	<div class="head-row">
            	<span class="title">Sales</span>
                <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
            </div>
            <div class="body-row">
            	<div class="icon-circle blue-bg"><i class="fa fa-stack-overflow"></i></div>
                <div class="stats-box">
                	<span class="head" id="sales-year">0</span>
                    <span class="sub-head">Sales Year</span>
                </div>
            </div>
        </div><!--end web-stats-->
        <?php endif;?>

