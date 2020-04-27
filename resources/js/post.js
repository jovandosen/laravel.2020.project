$(document).ready(function(){
	checkFlashMessage();
});

function checkFlashMessage()
{
	var text = $("#flash-message-content").text();

	if( text != '' ){
		setInterval(function(){
			// remove flash message box from DOM
			$("#flash-message-box").fadeOut(3000);
		}, 5000);
	}
}

window.confirmAction = function (that){
	var buttonElement = that;
	var buttonElementID = buttonElement.id;
	var postForm = $("#" + buttonElementID).parent();
	var postFormID = postForm[0].id;
	$("#confirm-yes").attr("data-send", postFormID);
}

window.confirmActionYes = function(that){
	var el = that;
	var formID = el.dataset.send;
	$("#postModal").modal('toggle');
	$("#" + formID).submit();
}

window.confirmPostUpdate = function(){
	$("#postModal").modal('toggle');
    $("#update-post-form").submit();
}