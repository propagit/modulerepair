<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page"> Google Web Stats (Anaylitics)</div>
        <div class="sub-title">Enter your Google Anaylitics account information to sync with your FlareRetail account</div>
		<!--
        <div class="grey-box">
        	<div class="title-page">YOUR GOOGLE STAT</div>
        </div>		
        -->
		<div style="clear: both;height:20px;"></div>
        <form name="googlestats" id="googlestats" action="<?=base_url()?>admin/googlestats/update" method="POST">
        	<div style="width: 20%; float: left; font-weight: 700; height: 30px; line-height: 30px">
				Email
			</div>
			<div style="width: 80%; float: left;">				
                <div class="article-input" style="float:left;">
                    <input id="web_email" name="web_email" class="article-txt-box " type="text" value="<?=$webstat['web_email']?>" >
                </div>
			</div>

			<div style="clear: both; height: 15px"></div>

			<div style="width: 20%; float: left; font-weight: 700; height: 30px; line-height: 30px">
				Password
			</div>

			<div style="width: 80%; float: left;">
				                <div class="article-input" style="float:left;">
                    <input id="web_password" name="web_password" class="article-txt-box " type="text" value="<?=$webstat['web_password']?>" >
                </div>
			</div>

			<div style="clear: both; height: 15px"></div>
			<div style="width: 20%; float: left; font-weight: 700; height: 30px; line-height: 30px">
				Profile ID
			</div>

			<div style="width: 80%; float: left;">
				<div class="article-input" style="float:left;">
                    <input id="profile_id" name="profile_id" class="article-txt-box " type="text" value="<?=$webstat['profile_id']?>" >
                </div>
			</div>
			<div style="clear: both; height: 15px"></div>
			<button class="btn btn-info" type="submit" >Update</button>
            <a target="_blank" href="https://accounts.google.com/ServiceLogin?service=analytics&passive=true&nui=1&hl=en&continue=https%3A%2F%2Fwww.google.com%2Fanalytics%2Fweb%2F%3Fhl%3Den&followup=https%3A%2F%2Fwww.google.com%2Fanalytics%2Fweb%2F%3Fhl%3Den"><button class="btn btn-info" type="button" >Log In to Google Analytics</button></a>
		</form>
			<div style="clear: both; height:30px;"></div>


	</div>
    
                

    <div class="col-md-3 dash-box">
        <div class="head-row">
            <span class="title">Webstats</span>
            <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
        </div>
        <div class="body-row">
            <div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
            <div class="stats-box">
                <span class="head" id="webstats-today"><?=number_format($webstat['today_unique']);?></span>
                <span class="sub-head">Site Visits <span class="item-counter">(Today)</span></span>
            </div>
        </div>
    </div><!--end web-stats-->

    <div class="col-md-3 dash-box">
        <div class="head-row">
            <span class="title">Webstats</span>
            <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
        </div>
        <div class="body-row">
            <div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
            <div class="stats-box">
                <span class="head" id="webstats-yesterday"><?=number_format($webstat['yesterday_unique']);?></span>
                <span class="sub-head">Site Visits <span class="item-counter">(Yesterday)</span></span>
            </div>
        </div>
    </div><!--end web-stats-->

    <div class="col-md-3 dash-box">
        <div class="head-row">
            <span class="title">Webstats</span>
            <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
        </div>
        <div class="body-row">
            <div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
            <div class="stats-box">
                <span class="head" id="webstats-current-month"><?=number_format($webstat['thismonth_unique']);?></span>
                <span class="sub-head">Site Visits <span class="item-counter">(Month)</span></span>
            </div>
        </div>
    </div><!--end web-stats-->

    <div class="col-md-3 dash-box">
        <div class="head-row">
            <span class="title">Webstats</span>
            <span class="action"><i class="fa fa-info-circle"></i> More Info</span>
        </div>
        <div class="body-row">
            <div class="icon-circle orange-bg"><i class="fa fa-hand-o-up"></i></div>
            <div class="stats-box">
                <span class="head" id="webstats-last-month"><?=number_format($webstat['lastmonth_unique']);?></span>
                <span class="sub-head">Site Visits <span class="item-counter">(Last Month)</span></span>
            </div>
        </div>
    </div><!--end web-stats-->
</div>