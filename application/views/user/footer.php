<script>
function validate()
{
	var username = jQuery('#username').val();
	var password = jQuery('#password').val();
	
	jQuery.ajax({
		url: '<?=base_url()?>client/ajax/validate/',
		type: 'POST',
		data: ({username:username,password:password}),
		dataType: "html",
		success: function(html) {
	
			if(html=='ok')
			{
				window.location='<?=base_url()?>client';
			}else
			{
				jQuery('#any_message').html("Sorry, your username and password are not correct");
		jQuery('#anyModal').modal('show');
			}
		}
	});
}
</script>
<!-- begin footer-->
<div class="container">
	<div class="wrap" id="footer-wrap">
    	<div class="row">
            <div class="col-md-12 footer-links-row">
                <div class="col-md-4 footer-box">
                  <h3>CONTACT US</h3>
                   	18 Elliot Place <br />
                    Ringwood, VIC 3134<br />
                    Australia<br /><br />
                    
                    P: 03 9879 3400<br />
                    F: 03 9879 3422<br />
                    E: repairs@modulerepair.com.au<br />
                </div>
                <div class="visible-sm footer-clear-add-height"></div>
                <div class="col-md-4 footer-box hidden-xs">                  
                  <span>Check your website stats and manage your email</span>
                  <form name="footer_login" id="footer_login" action="<?=base_url()?>client/validate" method="post">
                  <input type="text" class="login-txt-box" id="username" name="username" data="required" err-msg="User Name is mandatory" placeholder="User Name"/> 
                  <input type="password" class="login-txt-box" id="password" name="password" data="required" err-msg="Password is mandatory" placeholder="Password"/> 
                  <button type="button" class="button login-btn" onclick="validate();"><i class="fa fa-angle-double-right"></i> LOGIN</button>
                  </form>
                </div>
                <div class="col-md-4 footer-box">
                  <h3>AUTHORISED DEALERS</h3>                                   
	                Coburg Save on Spares<br />
                    10 Nicholson Street Coburg, VIC 3058<br />
                    P: 03 9384 6888<br />
                    <br />
                    Footscray Save on Spares<br />
                    176B Somerville Road Footscray, VIC 3012<br />
                    P: 03 9315 1285<br />
                    <br />
                    Gippsland Save on Spares<br />
                    Unit 7/1 Alexanders Road Morwell, VIC 3840<br />
                    P: 03 5135 3530<br />
                    <br />
                    South Australia Save on Spares<br />
                    1070 South Road Edwardstown, SA 5039<br />
                    P: 08 8277 5666<br />
                </div>
            </div>                        
        </div>
    </div>
</div>
<!-- end footer-->

<div id="anyModal" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
      <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
<h3 id="myModalLabel" class="title-page">Message</h3>
</div>
<div class="modal-body">
    <p id="any_message"></p>
</div>
<div class="modal-footer">
<button class="button login-btn" data-dismiss="modal" aria-hidden="true">Close</button>
</div>
</div>
</div>
</div>