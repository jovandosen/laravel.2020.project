$(document).ready(function(){
	checkCart();

	$("#product-form-filters").on("click", function(){
		$("#price-range-box").toggle("slow");
	});

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

function checkCart()
{
	var cartData = $("#ordered-items").val();
	
	if( cartData ){

		cartData = JSON.parse(cartData);

		var cartDataLength = cartData.length;

		if( cartDataLength > 0 ){
			for( var i = 0; i < cartDataLength; i++ ){
				$("#"+cartData[i]).trigger("click");
			}
		}

	}
}

window.removeProduct = function(that){

	$(that).text('add to cart');

	var cartDetails = $("#cart-items").val();

	var productCount = parseInt( $("#items").text() );

	productCount--;

	$("#items").empty().text(productCount);

	var productIdToRemove = $(that).attr("id");

	var recordIds = cartDetails.split(",");

	recordIds = recordIds.filter(function(item){
		return item != productIdToRemove;
	});

	$("#cart-items").val( recordIds.join() );

	$(that).attr("onclick", 'addProduct(this)');

	var total = $("#cash").val();
	
	total = parseInt(total) - parseInt(that.dataset.price);

	$("#cash").val(total);

	$("#cart-total").empty().text(total+"$");
}

window.addProduct = function(that){

	$(that).text('remove from cart');

	var productCount = parseInt( $("#items").text() );

	productCount++;

	$("#items").empty().text(productCount);

	var productIdToAdd = $(that).attr("id");

	var cartDetails = $("#cart-items").val();

	var recordIds = cartDetails.split(",");

	recordIds.unshift(productIdToAdd);

	$("#cart-items").val( recordIds.join() );

	$(that).attr("onclick", 'removeProduct(this)');

	var total = $("#cash").val();
	
	total = parseInt(total) + parseInt(that.dataset.price);

	$("#cash").val(total);

	$("#cart-total").empty().text(total+"$");
}

window.addToCart = function(that){

	var productId = $(that).attr("id");

	var cartDetails = $("#cart-items").val();

	var recordIds = cartDetails.split(",");

	recordIds.unshift(productId);

	$(that).text('REMOVE FROM CART');

	$(that).attr("onclick", 'removeFromCart(this)');

	var productCount = parseInt( $("#items").text() );

	productCount++;

	$("#items").empty().text(productCount);

	$("#cart-items").val( recordIds.join() );
}

window.removeFromCart = function(that){

	var productId = $(that).attr("id");

	var cartDetails = $("#cart-items").val();

	var recordIds = cartDetails.split(",");

	recordIds = recordIds.filter(function(item){
		return item != productId;
	});

	$(that).text('ADD TO CART');

	$(that).attr("onclick", 'addToCart(this)');

	var productCount = parseInt( $("#items").text() );

	productCount--;

	$("#items").empty().text(productCount);

	$("#cart-items").val( recordIds.join() );
}