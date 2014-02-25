$(function() {
	
	//===== Select2 dropdowns =====//

	$j(".select").select2();
	
	//===== Sortable columns =====//
	
	$j("table").tablesorter();
	
	
	//===== Resizable columns =====//
	
	$j("#resize, #resize2").colResizable({
		liveDrag:true,
		draggingClass:"dragging" 
	});
	
	
	//===== Dynamic data table =====//
	
	oTable = $j('.dTable').dataTable({
		"bJQueryUI": false,
		"bAutoWidth": false,
		"sPaginationType": "full_numbers",
		"sDom": '<"tablePars"fl>t<"tableFooter"ip>',
		"oLanguage": {
			"sLengthMenu": "<span class='showentries'>Show Results:</span> _MENU_"
		}
	});
	

	//===== Dynamic table toolbars =====//		
	
	$j('#dyn .tOptions').click(function () {
		$j('#dyn .tablePars').slideToggle(200);
	});	
	
	$j('#dyn2 .tOptions').click(function () {
		$j('#dyn2 .tablePars').slideToggle(200);
	});	
	
	
	$j('.tOptions').click(function () {
		$j(this).toggleClass("act");
	});
	

	//== Adding class to :last-child elements ==//
		
	$j(".subNav li:last-child a, .formRow:last-child, .userList li:last-child, table tbody tr:last-child td, .breadLinks ul li ul li:last-child, .fulldd li ul li:last-child, .niceList li:last-child").addClass("noBorderB")

	
	//===== Add classes for sub sidebar detection =====//
	
	if ($j('div').hasClass('secNav')) {
		$j('#sidebar').addClass('with');
		//$j('#content').addClass('withSide');
	}
	else {
		$j('#sidebar').addClass('without');
		$j('#content').css('margin-left','0px');//.addClass('withoutSide');
		$j('#footer > .wrapper').addClass('fullOne');
		};
	
	//===== Form elements styling =====//
	
	$j(".styled, input:radio, input:checkbox, .dataTables_length select").uniform();
	
	//===== File uploader =====//
	
	$j("#uploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : '../php/upload.php',
		max_file_size : '100kb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		]
	});
})