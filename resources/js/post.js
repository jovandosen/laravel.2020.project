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

window.removePostImage = function(){
	$("#removedImage").val( $("#postImage").val() );
	$("#postImage").val('');
	$("#removed-img-src").val( $("#post-img").attr("src") );
	$("#image-box").empty();
	$("#image-box").append("<a href='javascript:void(0)' id='restore-image-data' class='btn btn-sm btn-primary' onclick='restoreImageData()'>restore image</a>");
}

window.restoreImageData = function(){
	$("#postImage").val( $("#removedImage").val() );
	$("#removedImage").val('');
	var restoredImgSrc = $("#removed-img-src").val();
	$("#image-box").empty();
	$("#image-box").append("<img src='"+restoredImgSrc+"' class='img-fluid' id='post-img'>");
	$("#image-box").append("<p id='remove-post-image'><a href='javascript:void(0)' class='btn btn-sm btn-danger' onclick='removePostImage()'>remove image</a></p>");
}

window.deleteMovie = function(that){
	var el = that;
	var formID = el.dataset.send;
	$("#movieModal").modal('toggle');
	$("#" + formID).submit();
}

window.removeMovieImage = function(){
	$("#removedImage").val( $("#movieImage").val() );
	$("#movieImage").val('');
	$("#removed-img-src").val( $("#movie-img").attr("src") );
	$("#image-box").empty();
	$("#image-box").append("<a href='javascript:void(0)' id='restore-image-data' class='btn btn-sm btn-primary' onclick='restoreMovieImageData()'>restore image</a>");
}

window.restoreMovieImageData = function(){
	$("#movieImage").val( $("#removedImage").val() );
	$("#removedImage").val('');
	var restoredImgSrc = $("#removed-img-src").val();
	$("#image-box").empty();
	$("#image-box").append("<img src='"+restoredImgSrc+"' class='img-fluid' id='movie-img'>");
	$("#image-box").append("<p id='remove-post-image'><a href='javascript:void(0)' class='btn btn-sm btn-danger' onclick='removeMovieImage()'>remove image</a></p>");
}

window.confirmMovieUpdate = function(){
	$("#movieModal").modal('toggle');
	$("#update-movie-form").submit();
}