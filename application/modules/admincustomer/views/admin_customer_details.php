<script>

function approved() {

	if (confirm('You want to approve this user as trading account?')) {

		var notify = $('#notify:checked').val();

		var send = 0;

		if (notify) { send = 1; }

		$.ajax({ 

			url: '<?=base_url()?>admin/customer/approvetrader',

			type: 'POST',

			data: ({id:'<?=$user['id']?>',send:send}),

			dataType: "html",

			success: function(html) {

				window.location = '<?=base_url()?>admin/customer/list_all';

			}

		})	

	}

}

function pending() {

	if (confirm('You want to put this user to be pending?')) {

		$.ajax({ 

			url: '<?=base_url()?>admin/customer/pendingtrader',

			type: 'POST',

			data: ({id:'<?=$user['id']?>'}),

			dataType: "html",

			success: function(html) {

				window.location = '<?=base_url()?>admin/customer/list_all';

			}

		})	

	}

}

function deleteuser() {

	$('#deleteModal').modal('show');
	
	if (confirm('This action will delete this customers account, including all past orders related to this customer. Please note this action cannot be undone. If you don\'t wish to delete all past orders relating to this customer yet still want to deactivate the account click the pending button instead.')) {

		window.location = '<?=base_url()?>admin/customer/deletecustomer/<?=$user['id']?>';

	}

}

function delete_comment(id)
{
	if (confirm('Are you sure you want to delete this comment?')) {

		$.ajax({ 

			url: '<?=base_url()?>admin/customer/ajax/deletecomment',

			type: 'POST',

			data: ({id:id}),

			dataType: "html",

			success: function(html) {

				jQuery("#comment_"+id).remove();

			}

		})	


	}
}

function check_billing()
{
	/*
	if(jQuery("#same_billing").is(":checked"))
	{
		jQuery('#shipping_firstname').val(jQuery('#firstname').val());
		jQuery('#shipping_lastname').val(jQuery('#lastname').val());
		jQuery('#shipping_address').val(jQuery('#address').val());
		jQuery('#shipping_address2').val(jQuery('#address2').val());
		jQuery('#shipping_suburb').val(jQuery('#suburb').val());
		jQuery('#shipping_state').val(jQuery('#state').val());
		jQuery('#shipping_country').val(jQuery('#country').val());
		jQuery('#shipping_postcode').val(jQuery('#postcode').val());
		jQuery('#shipping_same').val(1);
		
	}
	else
	{
		jQuery('#shipping_firstname').val('');
		jQuery('#shipping_lastname').val('');
		jQuery('#shipping_address').val('');
		jQuery('#shipping_address2').val('');
		jQuery('#shipping_suburb').val('');
		jQuery('#shipping_state').val('');
		jQuery('#shipping_country').val('');
		jQuery('#shipping_postcode').val('');
		jQuery('#shipping_same').val(0);
	}*/
}

</script>

<div class="row">
	<div class="col-md-12">
		<div class="title-page">EDIT CUSTOMER</div>
		<button class="btn btn-info" type="button" onclick="window.location = '<?=base_url()?>admin/order/order_customer/<?=$customer['id']?>';">View Order</button>
        <!--<button class="btn btn-info" type="button" onclick="window.location='http://propatest.com/fruitopia/store/admin_login/<?=$customer['id']?>';">Login as Customer</button>-->
		<div class="subtitle-page">Personal Detail</div>
		<form method="post" action="<?=base_url()?>admin/customer/update" autocomplete="off">
			<input type="hidden" name="id" value="<?=$user['id']?>" />
            <!--<input type="hidden" name="shipping_same" id="shipping_same" value="<?=$customer['shipping_same']?>" />-->
            <div>
				<div class="form-common-label">First Name <span style="color:#F00">*</span></div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="firstname" name="firstname" value="<?=$customer['firstname']?>" required="required"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Last Name <span style="color:#F00">*</span></div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="lastname" name="lastname" value="<?=$customer['lastname']?>" required="required"/>
				</div>
			</div>
			<!--
            <div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Date of Birth</div>
				<div class="form-common-input">
					<input class="form-control input-text" type="text" id="dob" name="dob" readonly style="cursor: pointer; background: #fff"></input>
					<script type="text/javascript">
					  $(function() {
					    $('#dob').datepicker({
					    	 format: "dd-mm-yyyy",
							 todayBtn: "linked"
					    });
					  });
					  $('#dob').val('<?=date('d-m-Y',strtotime($customer['birthday']))?>');
					</script>
				</div>
			</div>
            -->
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Email Address <span style="color:#F00">*</span></div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="email" name="email" value="<?=$customer['email']?>" required="required"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Phone Number</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="phone" name="phone" value="<?=$customer['phone']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Mobile Number</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="mobile" name="mobile" value="<?=$customer['mobile']?>"/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <!--
			<div>
				<div class="form-common-label">Fax Number</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="fax" name="fax" value="<?=$customer['fax']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            -->
			<div class="subtitle-page">Account Details</div>
			<div>
				<div class="form-common-label">Address 1</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="address" name="address" value="<?=$customer['address']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Address 2</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="address2" name="address2" value="<?=$customer['address2']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Suburb</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="suburb" name="suburb" value="<?=$customer['suburb']?>"/>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">State</div>
				<div class="form-common-input">
					<select class="selectpicker" name="state" id="state" >
                        <?php foreach($states as $st) { ?>
                        	<option value="<?=$st['id']?>"  <?php if($st['id'] == $customer['state'])  print ' selected="selected"'; ?>><?=$st['name']?></option>
                        <?php } ?>
                	</select>
                	<script>jQuery(".selectpicker").selectpicker();</script>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Country</div>
				<div class="form-common-input">
					<select class="selectpicker" name="country" id="country" >

                        <option value="" selected="selected">Select Country</option> 

						<option value="United States">United States</option> 

						<option value="United Kingdom">United Kingdom</option> 

						<option value="Afghanistan">Afghanistan</option> 

						<option value="Albania">Albania</option> 

						<option value="Algeria">Algeria</option> 

						<option value="American Samoa">American Samoa</option> 

						<option value="Andorra">Andorra</option> 

						<option value="Angola">Angola</option> 

						<option value="Anguilla">Anguilla</option> 

						<option value="Antarctica">Antarctica</option> 

						<option value="Antigua and Barbuda">Antigua and Barbuda</option> 

						<option value="Argentina">Argentina</option> 

						<option value="Armenia">Armenia</option> 

						<option value="Aruba">Aruba</option> 

						<option value="Australia">Australia</option> 

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

						<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 

						<option value="Botswana">Botswana</option> 

						<option value="Bouvet Island">Bouvet Island</option> 

						<option value="Brazil">Brazil</option> 

						<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 

						<option value="Brunei Darussalam">Brunei Darussalam</option> 

						<option value="Bulgaria">Bulgaria</option> 

						<option value="Burkina Faso">Burkina Faso</option> 

						<option value="Burundi">Burundi</option> 

						<option value="Cambodia">Cambodia</option> 

						<option value="Cameroon">Cameroon</option> 

						<option value="Canada">Canada</option> 

						<option value="Cape Verde">Cape Verde</option> 

						<option value="Cayman Islands">Cayman Islands</option> 

						<option value="Central African Republic">Central African Republic</option> 

						<option value="Chad">Chad</option> 

						<option value="Chile">Chile</option> 

						<option value="China">China</option> 

						<option value="Christmas Island">Christmas Island</option> 

						<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 

						<option value="Colombia">Colombia</option> 

						<option value="Comoros">Comoros</option> 

						<option value="Congo">Congo</option> 

						<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 

						<option value="Cook Islands">Cook Islands</option> 

						<option value="Costa Rica">Costa Rica</option> 

						<option value="Cote D'ivoire">Cote D'ivoire</option> 

						<option value="Croatia">Croatia</option> 

						<option value="Cuba">Cuba</option> 

						<option value="Cyprus">Cyprus</option> 

						<option value="Czech Republic">Czech Republic</option> 

						<option value="Denmark">Denmark</option> 

						<option value="Djibouti">Djibouti</option> 

						<option value="Dominica">Dominica</option> 

						<option value="Dominican Republic">Dominican Republic</option> 

						<option value="Ecuador">Ecuador</option> 

						<option value="Egypt">Egypt</option> 

						<option value="El Salvador">El Salvador</option> 

						<option value="Equatorial Guinea">Equatorial Guinea</option> 

						<option value="Eritrea">Eritrea</option> 

						<option value="Estonia">Estonia</option> 

						<option value="Ethiopia">Ethiopia</option> 

						<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 

						<option value="Faroe Islands">Faroe Islands</option> 

						<option value="Fiji">Fiji</option> 

						<option value="Finland">Finland</option> 

						<option value="France">France</option> 

						<option value="French Guiana">French Guiana</option> 

						<option value="French Polynesia">French Polynesia</option> 

						<option value="French Southern Territories">French Southern Territories</option> 

						<option value="Gabon">Gabon</option> 

						<option value="Gambia">Gambia</option> 

						<option value="Georgia">Georgia</option> 

						<option value="Germany">Germany</option> 

						<option value="Ghana">Ghana</option> 

						<option value="Gibraltar">Gibraltar</option> 

						<option value="Greece">Greece</option> 

						<option value="Greenland">Greenland</option> 

						<option value="Grenada">Grenada</option> 

						<option value="Guadeloupe">Guadeloupe</option> 

						<option value="Guam">Guam</option> 

						<option value="Guatemala">Guatemala</option> 

						<option value="Guinea">Guinea</option> 

						<option value="Guinea-bissau">Guinea-bissau</option> 

						<option value="Guyana">Guyana</option> 

						<option value="Haiti">Haiti</option> 

						<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 

						<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 

						<option value="Honduras">Honduras</option> 

						<option value="Hong Kong">Hong Kong</option> 

						<option value="Hungary">Hungary</option> 

						<option value="Iceland">Iceland</option> 

						<option value="India">India</option> 

						<option value="Indonesia">Indonesia</option> 

						<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 

						<option value="Iraq">Iraq</option> 

						<option value="Ireland">Ireland</option> 

						<option value="Israel">Israel</option> 

						<option value="Italy">Italy</option> 

						<option value="Jamaica">Jamaica</option> 

						<option value="Japan">Japan</option> 

						<option value="Jordan">Jordan</option> 

						<option value="Kazakhstan">Kazakhstan</option> 

						<option value="Kenya">Kenya</option> 

						<option value="Kiribati">Kiribati</option> 

						<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 

						<option value="Korea, Republic of">Korea, Republic of</option> 

						<option value="Kuwait">Kuwait</option> 

						<option value="Kyrgyzstan">Kyrgyzstan</option> 

						<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 

						<option value="Latvia">Latvia</option> 

						<option value="Lebanon">Lebanon</option> 

						<option value="Lesotho">Lesotho</option> 

						<option value="Liberia">Liberia</option> 

						<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 

						<option value="Liechtenstein">Liechtenstein</option> 

						<option value="Lithuania">Lithuania</option> 

						<option value="Luxembourg">Luxembourg</option> 

						<option value="Macao">Macao</option> 

						<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 

						<option value="Madagascar">Madagascar</option> 

						<option value="Malawi">Malawi</option> 

						<option value="Malaysia">Malaysia</option> 

						<option value="Maldives">Maldives</option> 

						<option value="Mali">Mali</option> 

						<option value="Malta">Malta</option> 

						<option value="Marshall Islands">Marshall Islands</option> 

						<option value="Martinique">Martinique</option> 

						<option value="Mauritania">Mauritania</option> 

						<option value="Mauritius">Mauritius</option> 

						<option value="Mayotte">Mayotte</option> 

						<option value="Mexico">Mexico</option> 

						<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 

						<option value="Moldova, Republic of">Moldova, Republic of</option> 

						<option value="Monaco">Monaco</option> 

						<option value="Mongolia">Mongolia</option> 

						<option value="Montserrat">Montserrat</option> 

						<option value="Morocco">Morocco</option> 

						<option value="Mozambique">Mozambique</option> 

						<option value="Myanmar">Myanmar</option> 

						<option value="Namibia">Namibia</option> 

						<option value="Nauru">Nauru</option> 

						<option value="Nepal">Nepal</option> 

						<option value="Netherlands">Netherlands</option> 

						<option value="Netherlands Antilles">Netherlands Antilles</option> 

						<option value="New Caledonia">New Caledonia</option> 

						<option value="New Zealand">New Zealand</option> 

						<option value="Nicaragua">Nicaragua</option> 

						<option value="Niger">Niger</option> 

						<option value="Nigeria">Nigeria</option> 

						<option value="Niue">Niue</option> 

						<option value="Norfolk Island">Norfolk Island</option> 

						<option value="Northern Mariana Islands">Northern Mariana Islands</option> 

						<option value="Norway">Norway</option> 

						<option value="Oman">Oman</option> 

						<option value="Pakistan">Pakistan</option> 

						<option value="Palau">Palau</option> 

						<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 

						<option value="Panama">Panama</option> 

						<option value="Papua New Guinea">Papua New Guinea</option> 

						<option value="Paraguay">Paraguay</option> 

						<option value="Peru">Peru</option> 

						<option value="Philippines">Philippines</option> 

						<option value="Pitcairn">Pitcairn</option> 

						<option value="Poland">Poland</option> 

						<option value="Portugal">Portugal</option> 

						<option value="Puerto Rico">Puerto Rico</option> 

						<option value="Qatar">Qatar</option> 

						<option value="Reunion">Reunion</option> 

						<option value="Romania">Romania</option> 

						<option value="Russian Federation">Russian Federation</option> 

						<option value="Rwanda">Rwanda</option> 

						<option value="Saint Helena">Saint Helena</option> 

						<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 

						<option value="Saint Lucia">Saint Lucia</option> 

						<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 

						<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 

						<option value="Samoa">Samoa</option> 

						<option value="San Marino">San Marino</option> 

						<option value="Sao Tome and Principe">Sao Tome and Principe</option> 

						<option value="Saudi Arabia">Saudi Arabia</option> 

						<option value="Senegal">Senegal</option> 

						<option value="Serbia and Montenegro">Serbia and Montenegro</option> 

						<option value="Seychelles">Seychelles</option> 

						<option value="Sierra Leone">Sierra Leone</option> 

						<option value="Singapore">Singapore</option> 

						<option value="Slovakia">Slovakia</option> 

						<option value="Slovenia">Slovenia</option> 

						<option value="Solomon Islands">Solomon Islands</option> 

						<option value="Somalia">Somalia</option> 

						<option value="South Africa">South Africa</option> 

						<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 

						<option value="Spain">Spain</option> 

						<option value="Sri Lanka">Sri Lanka</option> 

						<option value="Sudan">Sudan</option> 

						<option value="Suriname">Suriname</option> 

						<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 

						<option value="Swaziland">Swaziland</option> 

						<option value="Sweden">Sweden</option> 

						<option value="Switzerland">Switzerland</option> 

						<option value="Syrian Arab Republic">Syrian Arab Republic</option> 

						<option value="Taiwan, Province of China">Taiwan, Province of China</option> 

						<option value="Tajikistan">Tajikistan</option> 

						<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 

						<option value="Thailand">Thailand</option> 

						<option value="Timor-leste">Timor-leste</option> 

						<option value="Togo">Togo</option> 

						<option value="Tokelau">Tokelau</option> 

						<option value="Tonga">Tonga</option> 

						<option value="Trinidad and Tobago">Trinidad and Tobago</option> 

						<option value="Tunisia">Tunisia</option> 

						<option value="Turkey">Turkey</option> 

						<option value="Turkmenistan">Turkmenistan</option> 

						<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 

						<option value="Tuvalu">Tuvalu</option> 

						<option value="Uganda">Uganda</option> 

						<option value="Ukraine">Ukraine</option> 

						<option value="United Arab Emirates">United Arab Emirates</option> 

						<option value="United Kingdom">United Kingdom</option> 

						<option value="United States">United States</option> 

						<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 

						<option value="Uruguay">Uruguay</option> 

						<option value="Uzbekistan">Uzbekistan</option> 

						<option value="Vanuatu">Vanuatu</option> 

						<option value="Venezuela">Venezuela</option> 

						<option value="Viet Nam">Viet Nam</option> 

						<option value="Virgin Islands, British">Virgin Islands, British</option> 

						<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 

						<option value="Wallis and Futuna">Wallis and Futuna</option> 

						<option value="Western Sahara">Western Sahara</option> 

						<option value="Yemen">Yemen</option> 

						<option value="Zambia">Zambia</option> 

						<option value="Zimbabwe">Zimbabwe</option>	

                	</select>

                	<script>

                		jQuery("#country").val('<?=$customer['country']?>');

                		jQuery(".selectpicker").selectpicker();

                	</script>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Postcode</div>
				<div class="form-common-input">
					<input type="text" class="form-control input-text" id="postcode" name="postcode" value="<?=$customer['postcode']?>"/>
				</div>
			</div>
            <div class="form-common-gap">&nbsp;</div>
            <!--			            
			<div class="subtitle-page">Account Login</div>
			<div>
				<div class="form-common-label">Username</div>
				<div class="form-common-input">
					<strong><?=$user['username']?></strong>
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
				<div class="form-common-label">Date Registered</div>
				<div class="form-common-input">
					<?=date('d M Y',strtotime($customer['joined']))?>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
            -->
            <div class="form-common-gap">&nbsp;</div>
            <div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">&nbsp;</div>
				<div class="form-common-input">
					<button class="btn btn-info" type="submit">Update</button>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<!--
            <div class="subtitle-page">Admin Comment</div>
			<div>
				<div class="form-common-label">Total Spend</div>
				<div class="form-common-input">
					$ <?=number_format($total,2,'.',',')?>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">Comment</div>
				<div class="form-common-input">
					<textarea type="text" class="form-control input-text" id="admin_comment" rows="3"></textarea>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<div>
				<div class="form-common-label">&nbsp;</div>
				<div class="form-common-input">
					<button class="btn btn-info" type="button" onclick="addcomment();">Add Comment</button>
				</div>
			</div>
			<div class="form-common-gap">&nbsp;</div>
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width: 10%">DATE</th>
						<th style="width: 70%">COMMENT</th>
						<th style="width: 15%">ADMIN</th>
                        <th style="width: 5%">DELETE</th>
					</tr>
				</thead>
				<tbody id="all_comment">
					<?php
					foreach($comments as $cm)
					{
						$user = $this->user_model->id($cm['admin_id']);
					?>
					<tr id="comment_<?=$cm['id']?>">
						<td><?=date('d-m-Y',strtotime($cm['created']))?></td>
						<td><?=$cm['comment']?></td>
						<td><?=$user['username']?></td>
                        <td align="center"><div class="all_tt center_icon " data-toggle="tooltip" title="Delete Product" onclick="delete_comment(<?=$cm['id']?>);">
	    					<i class="fa fa-trash-o blue-icon" style="cursor:pointer;"></i>
	    					</div>
                        </td>
					</tr>
					<?
					}
					?>
				</tbody>
			</table>
            -->
		</form>
	</div>
</div>



<script>

function addcomment()

{

	var comment = $('#admin_comment').val().replace("<br />", "\N");

	var cust_id = <?=$customer['id']?>;

	

	$.ajax({ 

			url: '<?=base_url()?>admin/customer/ajax/add_comment',

			type: 'POST',

			data: ({comment:comment,cust_id:cust_id}),

			dataType: "html",

			success: function(html) {

				$('#all_comment').html(html);

			}

		})	

	

	//alert(comment);

}

</script>