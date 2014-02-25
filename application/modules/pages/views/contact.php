<script>
$j(function(){
	 $j('.custom-select').selectpicker();
	 
	 $j('#submit-form').click(function(){
		help.validate_form('contact-form');	
	});
	
	
	<?php if($this->session->flashdata('sent') || $this->session->flashdata('error')) { ?>
  	$j('#contact-message').modal();
    <?php } ?>
});//ready

</script>
<div class="container margin-top-10">
	<div class="wrap page-wrap">
        <div class="row">
            <div class="col-lg-12">
            	<div class="col-md-12">
                     <span class="page-title">Contact Us</span>
                 </div>
            </div>
        </div><!--row-->	
        
        
		<div class="row margin-top-30">
            <div class="col-lg-12">
            	<div class="col-md-8 secondary-pages contact-page">
                     <h1>WAVE1 HAS OFFICES IN MELBOURNE, SYDNEY & BRISBANE</h1>
                  	 <h2>AND TECHINICAL SUPPORT TEAMS IN ALL MAJOR CITIES. WAVE1 IS ALWAYS AVAILABLE TO YOU.</h2>
					 <div class="clearboth"></div>	
                      <ul class="contact-offices-ul">
                        <li>Victoria</li>
                        <li>19 Laser Drive</li>
                        <li>Rowville VIC 3178</li>
                        <li></li>
                        <li>Tel: +61 (03) 9212 7200</li>
                        <li>Fax: +61 (03) 9212 7222</li>
                        </ul>
                      <ul class="contact-offices-ul">
                        <li>New South Wales</li>
						<li>Unit 5, 13-15 Wollongong Road</li>
                        <li>Arncliffe NSW 2205</li>
                        <li></li>
                        <li>Tel: +61 (02) 9556 1500</li>
                        <li>Fax: +61 (02) 9556 2600</li>
                      </ul>
                      <ul class="contact-offices-ul">
                        <li>Queensland</li>
						<li>Unit 13, 547 Kessels Road</li>
                        <li>MacGregor QLD 4109</li>
                        <li></li>
                        <li>Tel: +61 (07) 3343 0555</li>
                        <li>Fax: +61 (07) 3343 0500</li>
                      </ul>
                      
                      
                      <h2>SUPPORT OR SALES REQUEST</h2>
                      
                      <div class="form-wrap">
                      	  <p>Enter the form below to contact us by email.</p>
                          <form  method="post" id="contact-form" action="<?=base_url();?>send-contact-msg">
                          <div class="form-row">
                              <span>Your Name</span>
                              <input type="text" name="name" data="required" class="gen-txt-box grey-txt" />
                          </div>
                          <div class="form-row">
                              <span>Your Company</span>
                              <input type="text" name="company" data="required" class="gen-txt-box grey-txt" />
                          </div>
                          <div class="form-row">
                              <span>Your Email</span>
                              <input type="text" name="email" data="email" class="gen-txt-box grey-txt" />
                          </div>
                          <div class="form-row">
                              <span>Your Phone</span>
                              <input type="text" name="phone" class="gen-txt-box grey-txt" />
                          </div>
                          <div class="form-row">
                              <span>Department</span>
                              <select class="custom-select case-study-select" name="department">
                                  <option value="tech-support">Technical Support</option>
                              	  <option value="sales">Sales</option>
                          	  </select>
                          </div>
                          <div class="form-row">
                              <span>Your Message</span>
                              <textarea name="message" class="gen-textarea grey-txt" data="required"></textarea>
                          </div>
                          <div class="form-row">
                          <button id="submit-form" type="button" class="button pull-right" ><i class="fa fa-envelope"></i> EMAIL US</button>
                          </div>
                          <input type="hidden" name="spambot" />
                          </form>
                      </div>
                </div>
                
                <?=$this->load->view('maps');?>
            </div>
        </div><!--row-->	
        
        
	</div><!--product-wrap-->
</div>

<!--begin message -->
<div id="contact-message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
               <?php if($this->session->flashdata('sent')) { ?>
                    <div class="row msg success">
                        Your message has been sent successfully.<br />One of our staff will contact you shortly to address your question..
                    </div>
                <?php } elseif($this->session->flashdata('error')) { ?>
                    <div class="row msg err-msg">
                        Uh oh! You must have left the mandatory fields empty. <br />Please fill in all the form fields and try again.
                    </div>
                <?php } ?>
               
            </div>
            <div class="modal-footer">
            <button class="button" data-dismiss="modal" aria-hidden="true">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--end message -->
