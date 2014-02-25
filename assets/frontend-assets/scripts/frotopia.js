// JavaScript Document
/* * 
	Frotopia 
	v 1.0

*/

var fruit = {
	
	//set height of an element to the max height
	//eg find elements with same class name and set height to the max height
	set_element_max_height:function(container_identifier){
		$j(container_identifier).css({'min-height':0});
		var maxHeight = 0;
		$j(container_identifier)
		  .each(function() { maxHeight = Math.max(maxHeight, $j(this).height()); })
		  .css({'min-height':maxHeight});	
	}

	

};
