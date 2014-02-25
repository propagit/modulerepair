// JavaScript Document
/* * 
	Helper Script 
	v 1.0

*/

var help = {
	
	validate_email:function(emailAddress){
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	
		return pattern.test(emailAddress);
	},
	
	check_numeric:function(field, event,type){
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		//numeric with dot 0-9,.
		if(type=="nd"){
			if((keyCode >=48 && keyCode<=57)||keyCode==46||keyCode==8||keyCode==9){return true;} 
			else{return false;}
		}
		//numeric without dot		
		if(type=="n"){
			if((keyCode >=48 && keyCode<=57) || keyCode==8 || keyCode==9){return true;} 
			else{return false;}
		}
	},
	
	validate_form:function(form_id){
		var valid = true;
		var validation_rule = '';
		$j('#'+form_id+' input,#'+form_id+' textarea,#'+form_id+' select').each(function(){
			validation_rule = $j(this).attr('data');
			switch(validation_rule){
				case 'required':
					if(!$j(this).val()){
						valid = false;
						$j(this).addClass('error');	
					}else{
						$j(this).removeClass('error');
					}
				break;
				
				case 'email':
					if(!$j(this).val()){
						valid = false;	
						$j(this).addClass('error');
					}else{
						if(!help.validate_email($j(this).val())){
							valid = false;
							$j(this).addClass('error');	
						}else{
							$j(this).removeClass('error');
						}
					}
				break;
				
				case 'checked':
					if(!$j(this).is(':checked')){
						valid = false;	
						$j(this).addClass('error');
					}else{
						$j(this).removeClass('error');
					}
				break;	
			}
		});
		
		if(valid){
			$j('#'+form_id).submit();	
		}
		
	},
	
	
	//set height of an element to the max height
	//eg find elements with same class name and set height to the max height
	unify_height:function(selector){
		$j(selector).css({'min-height':0});
		var maxHeight = 0;
		$j(selector)
		  .each(function() { maxHeight = Math.max(maxHeight, $j(this).height()); })
		  .css({'min-height':maxHeight});	
	},
	
	//a simple accordion
	my_accordion:function(selector){
		$j(selector+' h3').click(function() {
			//set all elements as inactive
			$j(selector+' h3').removeClass('active');
			$j(selector+' h3').find('i').replaceWith('<i class="fa fa-angle-double-up pull-right"></i>');
			
			//evaluate and toggle accordingly
			if($j(this).next('div').is(':visible')){
				$j(this).next('div').slideUp();   
			}else{
				$j(selector+' h3').next('div').slideUp();
				$j(this).next('div').slideToggle();
				$j(this).addClass('active');
				$j(this).find('i').replaceWith('<i class="fa fa-angle-double-down pull-right"></i>');
			}
		});
	}
	


	

};
