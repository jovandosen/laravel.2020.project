$(document).ready(function(){
	//
});

var totalItems = 0;
var productIds = [];

window.addProductToCart = function(id, element){

	totalItems++;
	$("#items").empty().text(totalItems);

	productIds.push( parseInt(id) );

	var linkId = $(element).attr("id");

	$(element).text("remove from cart");
	$(element).attr("onclick", 'removeProductFromCart('+id+', '+linkId+')');

	$("#cart-items").val(productIds);

}

window.removeProductFromCart = function(id, linkId){
	
	totalItems--;
	$("#items").empty().text(totalItems);

	productIds = productIds.filter(function(item){
		return item != linkId;
	});

	$("#"+linkId).text("add to cart");
	$("#"+linkId).attr("onclick", 'addProductToCart('+id+', this)');

	$("#cart-items").val(productIds);

}

window.userCheckout = function(){
	var data = $("#cart-items").val();
	window.location.href = "http://laravel.2020.project/process/order/"+data;
}