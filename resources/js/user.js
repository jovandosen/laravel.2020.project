$(document).ready(function(){
	//
});

window.getUserDataAndRedirect = function(that){
	var el = that;
	var id = $(el).attr("id");
	window.location.href = "http://laravel.2020.project/assign/roles/"+id;
}