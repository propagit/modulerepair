<style>
#profile-image-header-box
{
	
    height:30px;
    margin: 0;
    padding: 0;
}

#profile-image-header-box-text
{
	line-height: 30px;
    margin: 0px !important;
    text-align: center;
    letter-spacing: 2px;
}
#profile-image-img-wrapper
{
	margin-top:10px;
	margin-bottom:10px;
}
#profile-image-img-wrapper img
{
	width: 100%;
}
#profile-image-upload-wrapper
{
	margin-bottom:10px;
}
.lookup-list ul
{
	background: #fff;
	border:1px solid #ccc;
	border-top:none;
	padding-left:15px;
	padding-top:10px;
	padding-bottom:10px;
}

.lookup-list ul li
{
	list-style: none;
	line-height:22px;
	cursor: pointer;
}
</style>
<script>
function email_copy()
{
	var email = $('#email').val();
	$('#email-copy').html(email);
}

var lookup = {
    //load suburbs
    load_suburbs:function(){
        var entered_keyword = jQuery('#search_suburb').val();
        var state = jQuery('#state').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/suburbs_search',
                    data:{keyword:entered_keyword,state:state},
                    success:function(html){
                                    jQuery('#ajax_lookup_suburb_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_suburb:function(postcode_id,postcode,suburb_details){
		if(postcode_id){
            jQuery('#search_suburb').val(suburb_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#suburb').val(postcode_id);
            jQuery('#ajax_lookup_suburb_list').hide();
            jQuery('#postcode').val(postcode);
	    }
    },
    
    load_state:function(){
        var entered_keyword = jQuery('#search_state').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/state_search',
                    data:{keyword:entered_keyword},
                    success:function(html){
                                    jQuery('#ajax_lookup_state_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_state:function(state_id,state_details){
		if(state_id){
            jQuery('#search_state').val(state_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#state').val(state_id);
            jQuery('#ajax_lookup_state_list').hide();
	    }
    },
    
    load_country:function(){
        var entered_keyword = jQuery('#search_country').val();
        if(entered_keyword){
            if(entered_keyword.length >= 3){
                jQuery.ajax({
                    type:'post',
                    url:'<?=base_url();?>admin/customer/ajax/country_search',
                    data:{keyword:entered_keyword},
                    success:function(html){
                                    jQuery('#ajax_lookup_country_list').html(html).show();
                    },error:function(){
                                    //error message
                    }
                });          
            }
        }
    },

    //Select Suburb
    select_country:function(country_id,country_details){
		if(country_id){
            jQuery('#search_country').val(country_details);
            //jQuery('#postcode_id').val(postcode_id);     
            //hide ajax_pc_sub_list box
            jQuery('#country').val(country_id);
            jQuery('#ajax_lookup_country_list').hide();
	    }
    }
};

function copy_email_to_username()
{
	var email = $('#email').val();
	$('#email-copy').html(email);
}

</script>

<div class="row row-bottom-margin">
	<div class="col-md-12">
		<div class="title-page">EDIT CUSTOMER</div>
        <div class="sub-title">Upload new customer or edit and manage existing customers.</div>
		<div class="grey-box">
        	<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/customer';"><i class="fa fa-hand-o-left"></i> To Customer List</button>
        </div>
        
		
		<form enctype="multipart/form-data" method="post" action="<?=base_url()?>admin/customer/update" autocomplete="off" id="customer-admin-add">
		<div class="row">
			<div class="col-md-10">
				
					<input type="hidden" name="id" value="<?=$user['id']?>"/>
					<div>
						<div class="form-common-label">First Name <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input type="text" class="form-control input-text" id="firstname" name="firstname" data="required"  value="<?=$customer['firstname']?>"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Last Name <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input type="text" class="form-control input-text" id="lastname" name="lastname" data="required" value="<?=$customer['lastname']?>"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					
					<div>
						<div class="form-common-label">Email Address <span style="color:#F00">*</span></div>
						<div class="form-common-input">
							<input readonly="readonly" value="<?=$customer['email']?>" onkeyup="copy_email_to_username();" onclick="copy_email_to_username();" onblur="copy_email_to_username();" type="text" class="form-control input-text" id="email" name="email" data="email"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Phone Number</div>
						<div class="form-common-input">
							<input value="<?=$customer['phone']?>" type="text" class="form-control input-text" id="phone" name="phone"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Mobile Number</div>
						<div class="form-common-input">
							<input value="<?=$customer['mobile']?>" type="text" class="form-control input-text" id="mobile" name="mobile"/>
						</div>
					</div>
		            <div class="form-common-gap">&nbsp;</div>
					
					<div>
						<div class="form-common-label">Address 1</div>
						<div class="form-common-input">
							<input value="<?=$customer['address']?>" type="text" class="form-control input-text" id="address" name="address"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Address 2</div>
						<div class="form-common-input">
							<input value="<?=$customer['address2']?>" type="text" class="form-control input-text" id="address2" name="address2"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">State</div>
						<div class="form-common-input">
							<input name="state" id="state" type="hidden" value="<?=$customer['state']?>">
							<?
							$state = $this->lookup_model->get_state($customer['state']);
							?>
							<input value="<?=$state?>" class="pc_txt form-control input-text" type="text" id="search_state" name="search_state" onblur="if(this.value==''){this.value='enter state';}" onfocus="if (this.value=='enter state'){this.value='';} lookup.load_state();" onclick="if (this.value=='enter state'){this.value='';}" value="enter state" onkeyup="lookup.load_state();" />
			
			                <div class="lookup-list" id="ajax_lookup_state_list"></div>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Suburb</div>
						<div class="form-common-input">
							<!-- <input type="text" class="form-control input-text" id="suburb" name="suburb"/> -->
							<?
							if($customer['suburb'] != 0)
							{
							?>
								<input name="suburb" id="suburb" type="hidden" value="<?=$customer['suburb']?>">
								<?
								$suburb = $this->lookup_model->get_suburb($customer['suburb']);
								?>
								<input value="<?=$suburb?>" class="pc_txt form-control input-text" type="text" id="search_suburb" name="search_suburb" onblur="if(this.value==''){this.value='enter postcode or suburb';}" onfocus="if (this.value=='enter postcode or suburb'){this.value='';} lookup.load_suburbs();" onclick="if (this.value=='enter postcode or suburb'){this.value='';}" value="enter postcode or suburb" onkeyup="lookup.load_suburbs();" />
				
				                <div class="lookup-list" id="ajax_lookup_suburb_list"></div>
							<?
							}
							else
							{
							?>
								<input name="suburb" id="suburb" type="hidden" >
								
								<input  class="pc_txt form-control input-text" type="text" id="search_suburb" name="search_suburb" onblur="if(this.value==''){this.value='enter postcode or suburb';}" onfocus="if (this.value=='enter postcode or suburb'){this.value='';} lookup.load_suburbs();" onclick="if (this.value=='enter postcode or suburb'){this.value='';}" value="enter postcode or suburb" onkeyup="lookup.load_suburbs();" />
				
				                <div class="lookup-list" id="ajax_lookup_suburb_list"></div>
							<?
							}
							?>
							
						</div>
					</div>
					
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Country</div>
						<div class="form-common-input">
							<input name="country" id="country" type="hidden" value="<?=$customer['country']?>">
							<?
							$country = $this->lookup_model->get_country($customer['country']);
							?>
							<input value="<?=$country?>" class="pc_txt form-control input-text" type="text" id="search_country" name="search_country" onblur="if(this.value==''){this.value='Australia';}" onfocus="if (this.value=='Australia'){this.value='';} lookup.load_country();" onclick="if (this.value=='Australia'){this.value='';}" value="Australia" onkeyup="lookup.load_country();" />
			
			                <div class="lookup-list" id="ajax_lookup_country_list"></div>
		                	
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Postcode</div>
						<div class="form-common-input">
							<input value="<?=$customer['postcode']?>" readonly="readonly" type="text" class="form-control input-text" id="postcode" name="postcode"/>
						</div>
					</div>
		            <div class="form-common-gap">&nbsp;</div>
					
					<div>
						<div class="form-common-label">Username</div>
						<div class="form-common-input" style="line-height: 30px;">
							<span id="email-copy"><?=$customer['email']?></span>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">Password</div>
						<div class="form-common-input">
							<input type="password" class="form-control input-text" id="password" name="password"/>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					<div>
						<div class="form-common-label">&nbsp;</div>
						<div class="form-common-input">
							<button class="btn btn-info" type="button" onclick="help.validate_form('customer-admin-add');"><i class="fa fa-save"></i> Edit</button>
						</div>
					</div>
					<div class="form-common-gap">&nbsp;</div>
					
				
			</div>
			<div class="col-md-2">
				<div class="grey-box" id="profile-image-header-box">
					<div class="subtitle-page" id="profile-image-header-box-text">Profile Image</div>
				</div>
				<div id="profile-image-img-wrapper">
					<?
					if($customer['image'])
					{
					?>
					<img alt="" src="<?=base_url()?>uploads/customers/<?=md5('cus'.$customer['id'])?>/<?=$customer['image']?>"/>
					<?
					}
					else
					{
					?>
					<img alt="" src="http://placehold.it/770x601"/>
					<?
					}
					?>
				</div>
				<div id="profile-image-upload-wrapper">
					<!-- <div class="fileupload fileupload-new" data-provides="fileupload">
				    <div class="input-append">
				    <div class="uneditable-input span3"><i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
				    <span class="btn btn-file"><span class="fileupload-new"><i class="fa fa-cloud-upload"></i> Select file</span><span class="fileupload-exists">Change</span>
				    <input type="file" name="userfile" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
				    </div>
				    </div> -->
				    
				    <div class="fileupload fileupload-new article-upload-field" data-provides="fileupload" style="width: 100%; float: left;">
                    <span class="btn btn-file">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="fileupload-new">Select file</span>
                        <span class="fileupload-exists">Change</span>         
                        <input type="file" name="userfile"/>
                    </span>
                    <span class="fileupload-preview" style="height: 30px; line-height: 20px; margin : 0px; padding: 5px; text-align: center; width: 100%;"></span>
                    <a href="#" class="fileupload-exists" data-dismiss="fileupload" style="float: none"><i class="fa fa-trash-o"></i></a>
               	    </div>
				</div>
				<div>
					<div style="float: left"><?=$customer['image']?></div>
					<div style="float: right"><i class="fa fa-search"></i> &nbsp;&nbsp; <i class="fa fa-trash-o"></i></div>
					<div style="clear: both"></div>
				</div>
			</div>
			</form>
		</div>
		
		<!-- <div class="grey-box">
        	<button class="btn btn-info" onclick="window.location = '<?=base_url()?>admin/customer';"><i class="fa fa-plus"></i> Add new field</button>
        </div> -->
		
	</div>
</div>


