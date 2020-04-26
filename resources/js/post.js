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