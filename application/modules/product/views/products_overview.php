<link href="<?=base_url()?>assets/lightbox/magnific-popup.css" rel="stylesheet" media="screen">
<script src="<?=base_url()?>assets/lightbox/jquery.magnific-popup.js"></script>
<script>
$j(function(){
	help.my_accordion('.my-accordion');			
});//ready

$j(document).ready(function() {
	$j('.popup-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
}); 



</script>

<div class="container margin-top-10">
	<div class="wrap page-wrap">
        <div class="row">
            <div class="col-lg-12">
            	<div class="col-md-12">
                     <span class="page-title">OUR PRODUCTS</span>
                     <ul class="page-inner-menu">
                        <?=$category_crumb;?>
                     </ul>
                 </div>
            </div>
        </div><!--row-->	
        
        <div class="row">
            <div class="col-lg-12">              
               <div class="col-md-6">
                  <h1><?=$product->title;?></h1>
                  <h2><?=$category->name;?></h2>
                  <p>
                  <?=$product->long_desc;?>
                  </p>
                    
                    <!--begin accordion -->
                    <div class="my-accordion hidden-xs hidden-sm">
                        <h3 class="active">Product Features <i class="fa fa-angle-double-down pull-right"></i></h3>   
                        <?php if($product->features){?>
                        <div class="accordion-item active-item">
                        	<?=$this->product_model->format_product_features($product->features,false);?>
                        </div>
                    	<?php }?>
                        <?php if($product->technical_information){?>
                        <h3>Technical Information <i class="fa fa-angle-double-up pull-right"></i></h3>
                        <div class="accordion-item">
                        	<?=$this->product_model->format_product_features($product->technical_information,false);?>
                        </div>
                        <?php }?>
                    </div>
                  <!-- end accordion -->
               </div>
               
               <div class="col-md-6 product-image">
               <?php
			   		$dir = md5('mbb'.$product->id);
			   		$hero = $this->product_model->get_product_hero_image($product->id);
			   		$img_src_full = '';
					if(!$hero){
						$img_src = base_url().'assets/frontend-assets/img/core/no-image-thumb.jpg';	
						$img_src_full = base_url().'assets/frontend-assets/img/core/no-image-thumb.jpg';
					}else{
						$img_src = base_url().'uploads/products/'.$dir.'/thumb1/'.$hero;
						$img_src_full = base_url().'uploads/products/'.$dir.'/'.$hero;
					}
			   ?>
               		
               		<div class="popup-gallery">
               			<a title="<?=$hero?>" href="<?=$img_src_full?>"><img class="product-hero-img" src="<?=$img_src;?>" /></a>
               			<?php
               			if($photos)
						{
							
							foreach($photos as $photo)
							{
								$photo_src_full = base_url().'uploads/products/'.$dir.'/'.$photo['name'];
							?>
								<a title="<?=$photo['name']?>" style="display: none" href="<?=$photo_src_full?>"><?=$photo_src_full?></a>
							<?
							}
						}
               			?>
               		</div>
                    <span class="gallery-open">Click Image For larger View & Additional Images</span>
                    <!-- <div id="demoLightbox" class="lightbox fade" tabindex="-1" role="dialog" aria-hidden="true">
					    <div class='lightbox-content'>
						    <img src="<?=$img_src?>">
						    <div class="lightbox-caption"><p>Your caption here</p></div>
					    </div>
				    </div> -->
                    
                    <div class="my-accordion visible-xs visible-sm">
                        <h3 class="active">Product Features <i class="fa fa-angle-double-down pull-right"></i></h3>   
                        <?php if($product->features){?>
                        <div class="accordion-item active-item">
                        	<?=$this->product_model->format_product_features($product->features,false);?>
                        </div>
                    	<?php }?>
                        <?php if($product->technical_information){?>
                        <h3>Technical Information <i class="fa fa-angle-double-up pull-right"></i></h3>
                        <div class="accordion-item">
                        	<?=$this->product_model->format_product_features($product->technical_information,false);?>
                        </div>
                        <?php }?>
                    </div>
               </div> 

            </div>
        </div><!--row-->
        
        <div class="row margin-top-60">
			<div class="col-lg-12">
               <div class="col-md-6">
               	   <?php
				   		$status = 'hidden';
						$href = '';	
				   		if(trim($product->pdf_url) != ''){
							$status = '';
							$href = 'href="'.base_url().'uploads/products/'.$dir.'/doc/'.$product->pdf_url.'"';	
						}
				   ?>
                   <a class="no-text-decoration <?=$status;?>" <?=$href;?> target="_blank">
                   <div class="shadow-box">
                        <div class="shadow-box-inner">
                        	<span class="head">DOWNLOAD</span>
                            <p>The product brochure for more information</p>
                            <i class="fa fa-download"></i>
                        </div>	
                   </div>
                   </a>
               </div>
               <div class="col-md-6">

                   <a href="#quoteForm" role="button" data-toggle="modal" class="no-text-decoration">
                   <div class="shadow-box">
                        <div class="shadow-box-inner">
                        	<span class="head">REQUEST A QUOTE</span>
                            <p>Need a quote, contact our sales team</p>
                            <i class="fa fa-envelope"></i>
                        </div>	
                   </div>
                   </a>
               </div>
            </div>
        </div>	

        
        
	</div><!--product-wrap-->
</div>
<script>
<?php 
if($this->session->flashdata('quote_success'))
{?>
	//$j('#any_message').html("<?=$this->session->flashdata('quote_success')?>");
	//$j('#anyModal').modal('show');
	alert('<?=$this->session->flashdata('quote_success')?>');
<? } ?>
</script>


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



<style>
.modal {left:-280px!important;}
#quoteForm .left-side {float: left;}
#quoteForm .right-side {float: right;}
#quoteForm .cleardiv{clear:both;}
#quoteForm .form-gap {height: 5px;}
#quoteForm .form-label {color: #2d2d2d;	font-size: 14px;	font-weight: 400;	height: 30px;	line-height: 30px;	width: 35%;}
#quoteForm .form-input-wrapper {width: 77%;}
#quoteForm .form-input { border: 1px solid #EDEDED !important;  border-radius: 5px !important;   margin: 0 !important;  width: 65%; height:30px;    line-height: 30px; padding: 4px 6px;}
#quoteForm .modal-header { border-bottom: none; }
#quoteForm .header_model {margin-left:20px;margin-top:20px;}
#quoteForm .modal-body {background: none repeat scroll 0 0 #EFEFEF;    border: 1px solid rgba(239, 239, 239, 0.3);    border-radius: 6px;    margin-left: 30px;    margin-right: 30px;    max-height: 900px !important;}
#quoteForm .modal-content {width:825px;}
#quoteForm .modal-footer { border-top: none; padding: 0px;}
#quoteForm span.head { color: #EF1816;  display: block;  font-size: 24px;   font-weight: 900; }
#quoteForm p { color: #2D2D2D;    font-size: 14px;    font-weight: 800;    width: 80%;}
#quoteForm .select_model {width:214px;}
#quoteForm a{ color: #535353;}
@media (max-width: 767px)
{
	.modal {left:0px!important;}
	#quoteForm .modal-header { padding:10px; }
	#quoteForm p {font-size:11px;}
	#quoteForm .text-model {font-size:12px;}
	#quoteForm .modal-content {width:auto!important;}
	#quoteForm .modal-body{ padding: 10px; margin-left: 15px;    margin-right: 15px; }
	#quoteForm .form-label {font-size: 12px;}
	#quoteForm .header_model {margin-left:10px;margin-top:10px;}
	#quoteForm .select_model {width: 65%;}
	
	.product-hero-img{width:100%!important;}
	.popup-gallery{height:auto!important; line-height:0px!important;}
	.shadow-box .shadow-box-inner span.head {font-size:20px;}
	.shadow-box .shadow-box-inner p {font-size:11px;}
}
@media (min-width: 768px) and (max-width: 991px)
{
	.modal {left:0px!important;}
	#quoteForm .modal-content {width:auto!important;}
	#quoteForm .select_model {width: 65%;}
}
</style>

<div id="quoteForm" class="modal  fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <div class="header_model">
                <span class="head">REQUEST A QUOTE</span>
                <p>Need a quote, contact our sales team</p>
                <span class="text-model">
                Ready to purchase? We're happy to provide you with a quote for as many devices as you might need. Simply fill out the form below and submit it to us, and we'll provide you a quote shortly after receiving. 
                You also could email us through the form below.
                </span>
                </div>
          </div>  		   
  		  <div class="modal-body">
          	<div class="row">
				<div class="col-lg-12">
                	<div class="col-md-6">
                    	<span style="color: red">**</span><i>Denotes required fields </i>
                        <div class="cleardiv form-gap"></div>
            
                            <form method="post" action="<?=base_url()?>product/get_quotes">
            				<input type="hidden" name="product_id" id="product_id" value="<?=$product->id?>"/>	
                            <input type="hidden" name="product_link" id="product_link" value="<?=$product->id_title?>"/>	
                            <input type="hidden" name="category_link" id="category_link" value="<?=$category->id_title?>"/>	
                            
                            <div class="form-label left-side">Company<span style="color: red">**</span></div>	
            
                            <input class="form-input left-side" name="companyname" type="text" required/>
            
                            <div class="cleardiv form-gap"></div>
            
                            <div class="form-label left-side">Salutation</div>	
            
                            <select class="form-input left-side" name="salutation">
            
                                <option value="">Please Select</option>
            
                                <option value="Mr.">Mr.</option>
            
                                <option value="Ms.">Ms.</option>
            
                                <option value="Mrs.">Mrs.</option>
            
                                <option value="Dr.">Dr.</option>
            
                                <option value="Prof.">Prof.</option>
            
                            </select>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">First Name<span style="color: red">**</span></div>	
            
                            <input class="form-input left-side" name="firstname" type="text" required/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Last Name<span style="color: red">**</span></div>	
            
                            <input class="form-input left-side" name="lastname" type="text" required/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Title / Position</div>	
            
                            <input class="form-input left-side" name="position" type="text"/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Email<span style="color: red">**</span></div>	
            
                            <input class="form-input left-side"name="email" type="email" required/>
            
                            <div class="cleardiv form-gap"></div>
            
                            <div class="form-label left-side">Street Address</div>	
            
                            <input class="form-input left-side" name="address" type="text" />
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">City</div>	
            
                            <input class="form-input left-side" name="city" type="text" />
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">State / Country</div>	
            
                            <input class="form-input left-side" name="state" type="text" />
            
                            <div class="cleardiv form-gap"></div>	
            
                            <div class="form-label left-side">Postcode</div>	
            
                            <input class="form-input left-side" name="zip" type="text" />
            
                            <div class="cleardiv form-gap"></div>	
                    </div>
                    
                    <div class="col-md-6">
                    		<div class="cleardiv form-gap hidden-xs hidden-sm"></div>
                            <div class="cleardiv form-gap hidden-xs hidden-sm"></div>
                            <div class="cleardiv form-gap hidden-xs hidden-sm"></div>
                            <div class="cleardiv form-gap hidden-xs hidden-sm"></div>
                            
                            <div class="form-label left-side">Country</div>	
            
                            <!-- <input  type="text"/> -->
            
                            <select class="form-input left-side select_model" name="country" >
            
                                <option value="Afganistan">Afghanistan</option>
            
                                <option value="Albania">Albania</option>
            
                                <option value="Algeria">Algeria</option>
            
                                <option value="American Samoa">American Samoa</option>
            
                                <option value="Andorra">Andorra</option>
            
                                <option value="Angola">Angola</option>
            
                                <option value="Anguilla">Anguilla</option>
            
                                <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
            
                                <option value="Argentina">Argentina</option>
            
                                <option value="Armenia">Armenia</option>
            
                                <option value="Aruba">Aruba</option>
            
                                <option value="Australia" selected="selected" >Australia</option>
            
                                <option value="Austria">Austria</option>
            
                                <option value="Azerbaijan">Azerbaijan</option>
            
                                <option value="Bahamas">Bahamas</option>
            
                                <option value="Bahrain">Bahrain</option>
            
                                <option value="Bangladesh">Bangladesh</option>
            
                                <option value="Barbados">Barbados</option>
            
                                <option value="Belarus">Belarus</option>
            
                                <option value="Belgium">Belgium</option>
            
                                <option value="Belize">Belize</option>
            
                                <option value="Benin">Benin</option>
            
                                <option value="Bermuda">Bermuda</option>
            
                                <option value="Bhutan">Bhutan</option>
            
                                <option value="Bolivia">Bolivia</option>
            
                                <option value="Bonaire">Bonaire</option>
            
                                <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
            
                                <option value="Botswana">Botswana</option>
            
                                <option value="Brazil">Brazil</option>
            
                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
            
                                <option value="Brunei">Brunei</option>
            
                                <option value="Bulgaria">Bulgaria</option>
            
                                <option value="Burkina Faso">Burkina Faso</option>
            
                                <option value="Burundi">Burundi</option>
            
                                <option value="Cambodia">Cambodia</option>
            
                                <option value="Cameroon">Cameroon</option>
            
                                <option value="Canada">Canada</option>
            
                                <option value="Canary Islands">Canary Islands</option>
            
                                <option value="Cape Verde">Cape Verde</option>
            
                                <option value="Cayman Islands">Cayman Islands</option>
            
                                <option value="Central African Republic">Central African Republic</option>
            
                                <option value="Chad">Chad</option>
            
                                <option value="Channel Islands">Channel Islands</option>
            
                                <option value="Chile">Chile</option>
            
                                <option value="China">China</option>
            
                                <option value="Christmas Island">Christmas Island</option>
            
                                <option value="Cocos Island">Cocos Island</option>
            
                                <option value="Colombia">Colombia</option>
            
                                <option value="Comoros">Comoros</option>
            
                                <option value="Congo">Congo</option>
            
                                <option value="Cook Islands">Cook Islands</option>
            
                                <option value="Costa Rica">Costa Rica</option>
            
                                <option value="Cote DIvoire">Cote D'Ivoire</option>
            
                                <option value="Croatia">Croatia</option>
            
                                <option value="Cuba">Cuba</option>
            
                                <option value="Curaco">Curacao</option>
            
                                <option value="Cyprus">Cyprus</option>
            
                                <option value="Czech Republic">Czech Republic</option>
            
                                <option value="Denmark">Denmark</option>
            
                                <option value="Djibouti">Djibouti</option>
            
                                <option value="Dominica">Dominica</option>
            
                                <option value="Dominican Republic">Dominican Republic</option>
            
                                <option value="East Timor">East Timor</option>
            
                                <option value="Ecuador">Ecuador</option>
            
                                <option value="Egypt">Egypt</option>
            
                                <option value="El Salvador">El Salvador</option>
            
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
            
                                <option value="Eritrea">Eritrea</option>
            
                                <option value="Estonia">Estonia</option>
            
                                <option value="Ethiopia">Ethiopia</option>
            
                                <option value="Falkland Islands">Falkland Islands</option>
            
                                <option value="Faroe Islands">Faroe Islands</option>
            
                                <option value="Fiji">Fiji</option>
            
                                <option value="Finland">Finland</option>
            
                                <option value="France">France</option>
            
                                <option value="French Guiana">French Guiana</option>
            
                                <option value="French Polynesia">French Polynesia</option>
            
                                <option value="French Southern Ter">French Southern Ter</option>
            
                                <option value="Gabon">Gabon</option>
            
                                <option value="Gambia">Gambia</option>
            
                                <option value="Georgia">Georgia</option>
            
                                <option value="Germany">Germany</option>
            
                                <option value="Ghana">Ghana</option>
            
                                <option value="Gibraltar">Gibraltar</option>
            
                                <option value="Great Britain">Great Britain</option>
            
                                <option value="Greece">Greece</option>
            
                                <option value="Greenland">Greenland</option>
            
                                <option value="Grenada">Grenada</option>
            
                                <option value="Guadeloupe">Guadeloupe</option>
            
                                <option value="Guam">Guam</option>
            
                                <option value="Guatemala">Guatemala</option>
            
                                <option value="Guinea">Guinea</option>
            
                                <option value="Guyana">Guyana</option>
            
                                <option value="Haiti">Haiti</option>
            
                                <option value="Hawaii">Hawaii</option>
            
                                <option value="Honduras">Honduras</option>
            
                                <option value="Hong Kong">Hong Kong</option>
            
                                <option value="Hungary">Hungary</option>
            
                                <option value="Iceland">Iceland</option>
            
                                <option value="India">India</option>
            
                                <option value="Indonesia">Indonesia</option>
            
                                <option value="Iran">Iran</option>
            
                                <option value="Iraq">Iraq</option>
            
                                <option value="Ireland">Ireland</option>
            
                                <option value="Isle of Man">Isle of Man</option>
            
                                <option value="Israel">Israel</option>
            
                                <option value="Italy">Italy</option>
            
                                <option value="Jamaica">Jamaica</option>
            
                                <option value="Japan">Japan</option>
            
                                <option value="Jordan">Jordan</option>
            
                                <option value="Kazakhstan">Kazakhstan</option>
            
                                <option value="Kenya">Kenya</option>
            
                                <option value="Kiribati">Kiribati</option>
            
                                <option value="Korea North">Korea North</option>
            
                                <option value="Korea Sout">Korea South</option>
            
                                <option value="Kuwait">Kuwait</option>
            
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
            
                                <option value="Laos">Laos</option>
            
                                <option value="Latvia">Latvia</option>
            
                                <option value="Lebanon">Lebanon</option>
            
                                <option value="Lesotho">Lesotho</option>
            
                                <option value="Liberia">Liberia</option>
            
                                <option value="Libya">Libya</option>
            
                                <option value="Liechtenstein">Liechtenstein</option>
            
                                <option value="Lithuania">Lithuania</option>
            
                                <option value="Luxembourg">Luxembourg</option>
            
                                <option value="Macau">Macau</option>
            
                                <option value="Macedonia">Macedonia</option>
            
                                <option value="Madagascar">Madagascar</option>
            
                                <option value="Malaysia">Malaysia</option>
            
                                <option value="Malawi">Malawi</option>
            
                                <option value="Maldives">Maldives</option>
            
                                <option value="Mali">Mali</option>
            
                                <option value="Malta">Malta</option>
            
                                <option value="Marshall Islands">Marshall Islands</option>
            
                                <option value="Martinique">Martinique</option>
            
                                <option value="Mauritania">Mauritania</option>
            
                                <option value="Mauritius">Mauritius</option>
            
                                <option value="Mayotte">Mayotte</option>
            
                                <option value="Mexico">Mexico</option>
            
                                <option value="Midway Islands">Midway Islands</option>
            
                                <option value="Moldova">Moldova</option>
            
                                <option value="Monaco">Monaco</option>
            
                                <option value="Mongolia">Mongolia</option>
            
                                <option value="Montserrat">Montserrat</option>
            
                                <option value="Morocco">Morocco</option>
            
                                <option value="Mozambique">Mozambique</option>
            
                                <option value="Myanmar">Myanmar</option>
            
                                <option value="Nambia">Nambia</option>
            
            
                                <option value="Nauru">Nauru</option>
            
                                <option value="Nepal">Nepal</option>
            
                                <option value="Netherland Antilles">Netherland Antilles</option>
            
                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
            
                                <option value="Nevis">Nevis</option>
            
                                <option value="New Caledonia">New Caledonia</option>
            
                                <option value="New Zealand">New Zealand</option>
            
                                <option value="Nicaragua">Nicaragua</option>
            
                                <option value="Niger">Niger</option>
            
                                <option value="Nigeria">Nigeria</option>
            
                                <option value="Niue">Niue</option>
            
                                <option value="Norfolk Island">Norfolk Island</option>
            
                                <option value="Norway">Norway</option>
            
                                <option value="Oman">Oman</option>
            
                                <option value="Pakistan">Pakistan</option>
            
                                <option value="Palau Island">Palau Island</option>
            
                                <option value="Palestine">Palestine</option>
            
                                <option value="Panama">Panama</option>
            
                                <option value="Papua New Guinea">Papua New Guinea</option>
            
                                <option value="Paraguay">Paraguay</option>
            
                                <option value="Peru">Peru</option>
            
                                <option value="Phillipines">Philippines</option>
            
                                <option value="Pitcairn Island">Pitcairn Island</option>
            
                                <option value="Poland">Poland</option>
            
                                <option value="Portugal">Portugal</option>
            
                                <option value="Puerto Rico">Puerto Rico</option>
            
                                <option value="Qatar">Qatar</option>
            
                                <option value="Republic of Montenegro">Republic of Montenegro</option>
            
                                <option value="Republic of Serbia">Republic of Serbia</option>
            
                                <option value="Reunion">Reunion</option>
            
                                <option value="Romania">Romania</option>
            
                                <option value="Russia">Russia</option>
            
                                <option value="Rwanda">Rwanda</option>
            
                                <option value="St Barthelemy">St Barthelemy</option>
            
                                <option value="St Eustatius">St Eustatius</option>
            
                                <option value="St Helena">St Helena</option>
            
                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
            
                                <option value="St Lucia">St Lucia</option>
            
                                <option value="St Maarten">St Maarten</option>
            
                                <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
            
                                <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
            
                                <option value="Saipan">Saipan</option>
            
                                <option value="Samoa">Samoa</option>
            
                                <option value="Samoa American">Samoa American</option>
            
                                <option value="San Marino">San Marino</option>
            
                                <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
            
                                <option value="Saudi Arabia">Saudi Arabia</option>
            
                                <option value="Senegal">Senegal</option>
            
                                <option value="Serbia">Serbia</option>
            
                                <option value="Seychelles">Seychelles</option>
            
                                <option value="Sierra Leone">Sierra Leone</option>
            
                                <option value="Singapore">Singapore</option>
            
                                <option value="Slovakia">Slovakia</option>
            
                                <option value="Slovenia">Slovenia</option>
            
                                <option value="Solomon Islands">Solomon Islands</option>
            
                                <option value="Somalia">Somalia</option>
            
                                <option value="South Africa">South Africa</option>
            
                                <option value="Spain">Spain</option>
            
                                <option value="Sri Lanka">Sri Lanka</option>
            
                                <option value="Sudan">Sudan</option>
            
                                <option value="Suriname">Suriname</option>
            
                                <option value="Swaziland">Swaziland</option>
            
                                <option value="Sweden">Sweden</option>
            
                                <option value="Switzerland">Switzerland</option>
            
                                <option value="Syria">Syria</option>
            
                                <option value="Tahiti">Tahiti</option>
            
                                <option value="Taiwan">Taiwan</option>
            
                                <option value="Tajikistan">Tajikistan</option>
            
                                <option value="Tanzania">Tanzania</option>
            
                                <option value="Thailand">Thailand</option>
            
                                <option value="Togo">Togo</option>
            
                                <option value="Tokelau">Tokelau</option>
            
                                <option value="Tonga">Tonga</option>
            
                                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
            
                                <option value="Tunisia">Tunisia</option>
            
                                <option value="Turkey">Turkey</option>
            
                                <option value="Turkmenistan">Turkmenistan</option>
            
                                <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
            
                                <option value="Tuvalu">Tuvalu</option>
            
                                <option value="Uganda">Uganda</option>
            
                                <option value="Ukraine">Ukraine</option>
            
                                <option value="United Arab Erimates">United Arab Emirates</option>
            
                                <option value="United Kingdom">United Kingdom</option>
            
                                <option value="United States of America" >United States of America</option>
            
                                <option value="Uraguay">Uruguay</option>
            
                                <option value="Uzbekistan">Uzbekistan</option>
            
                                <option value="Vanuatu">Vanuatu</option>
            
                                <option value="Vatican City State">Vatican City State</option>
            
                                <option value="Venezuela">Venezuela</option>
            
                                <option value="Vietnam">Vietnam</option>
            
                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
            
                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
            
                                <option value="Wake Island">Wake Island</option>
            
                                <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
            
                                <option value="Yemen">Yemen</option>
            
                                <option value="Zaire">Zaire</option>
            
                                <option value="Zambia">Zambia</option>
            
                                <option value="Zimbabwe">Zimbabwe</option>
            
                            </select>
            
                            <div class="cleardiv form-gap"></div>			
            
                            <div class="form-label left-side">Office Phone</div>	
            
                            <input class="form-input left-side" name="phone" type="tel"/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Mobile Phone</div>	
            
                            <input class="form-input left-side" name="mobile" type="tel"/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Department</div>	
            
                            <input class="form-input left-side" name="department" type="text"/>
                            <input name="product" type="hidden" value="<?=$product->title?>"/>
            
                            <div class="cleardiv form-gap"></div>		
            
                            <div class="form-label left-side">Message<span style="color: red">**</span></div>	
            
                            <!-- <input class="form-input left-side" type="text"/> -->
            
                            <textarea required name="message" rows="5" style="height:50px!important;" class="form-input left-side"></textarea>
            
                            <div class="cleardiv form-gap"></div>	
            
                            <div class="cleardiv form-gap"></div>
            
                            <button id="contact-send-btn" class="button login-btn form-button right-side">SEND <i class="icon icon-envelope-alt"></i></button>						
            
                            <div class="cleardiv"></div>
            
                            </form>	
                    </div>
                </div>
          	</div>
          </div>
          
          <div class="modal-footer">
            	<!--<button class="button login-btn" data-dismiss="modal" aria-hidden="true">Close</button>-->
                <br /><br />
          </div>
          
      </div>
  </div>  
</div>
