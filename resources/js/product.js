$(document).ready(function(){
	//
});

window.deleteProduct = function(that){
	var el = that;
	var formID = el.dataset.send;
	$("#productModal").modal('toggle');
	$("#" + formID).submit();
}