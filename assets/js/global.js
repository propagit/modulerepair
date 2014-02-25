function select_category(reference_id)
{
	$.ajax({
		type: "POST",
		url: base_url + 'product/ajax/select_category',
		data: {reference_id: reference_id},
		dataType: "html",
		success: function(html)
		{
			$('#selected_category_label').html(html);
			load_brands();
		}
	})
}
function load_brands()
{
	$.ajax({
		type: "POST",
		url: base_url + 'product/ajax/load_brands',
		dataType: "html",
		success: function(html)
		{
			$('#wrapper_brands').html(html);
			$('#selected_brand_label').html('Any brand');
		}
	})
}
function select_brand(reference_id)
{
	$.ajax({
		type: "POST",
		url: base_url + 'product/ajax/select_brand',
		data: {reference_id: reference_id},
		dataType: "html",
		success: function(html)
		{
			$('#selected_brand_label').html(html);
		}
	})
}
messageType = {
    Success : 'alert alert-success fade in',
    Warning : 'alert alert-warning fade in',
    Error   : 'alert alert-danger fade in',
    Info    : 'alert alert-info fade in'
}
alert_message = function() {}
errorState = function(){}
alert_message.Show = function ($tagSelector, message, messageType, autoClose){
    $tagSelector.html('<div class="'+messageType+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+message+'</div>');
    if(autoClose){
        setTimeout(function() {
            $tagSelector.empty();
        }, 5000);
    }
}
alert_message.Popup = function(message, messageType){
    //clear other message popup
    $('div[id^=smPopup_]').remove();

    var autoId = 'smPopup_'+ new Date().getMilliseconds();
    var alertPopupHtml  = '<div id="'+autoId+'" class="smPopup '+messageType+'">';
    alertPopupHtml      += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
    alertPopupHtml      += message+'</div>';
    $('body').prepend(alertPopupHtml);

    setTimeout(function() {
        $('#'+autoId).remove();
    }, 5000);

}

errorState.Add = function ($childSelector){
    $childSelector.parent().addClass('has-error');
}

errorState.ResetAll = function(){
    $('.form-group').removeClass('has-error')
}