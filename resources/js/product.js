$(document).ready(function(){
	//
});

window.deleteProduct = function(that){
	var el = that;
	var formID = el.dataset.send;
	$("#productModal").modal('toggle');
	$("#" + formID).submit();
}

window.confirmProductUpdate = function(){
	$("#productModal").modal('toggle');
	$("#update-product-form").submit();
}

var imgList = [];

window.removeProductImage = function(that){

	var el = that;

	var productImageParent = $(el).parent();
	var productImage = $(el).prev();

	var productImageID = productImage[0].id;

	imgList.push(productImageID);

	var images = JSON.stringify(imgList);

	$("#removedProductImages").val( images );

	$(productImageParent).remove();
}