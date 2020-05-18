$(document).ready(function(){

	checkCart();

	$("#product-form-filters").on("click", function(){
		$("#price-range-box").toggle("slow");
	});

});

window.addProductToCart = function(id, element){

	var cartTotal = parseInt( $("#items").text() );

	cartTotal++;

	$("#items").empty().text(cartTotal);

	$(element).text("remove from cart");

	$(element).attr("onclick", 'removeProductFromCart('+id+', this)');

	$.ajax({
		type: 'GET',
		url: '/cart/add',
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
    	data: {
    		productID: id
    	},
    	success: function(response){
    		// console.log('ADD');
    		// console.log(response);
    	}, 
    	error: function(response){
    		console.log('Error while processing order.');
    	}
	});

	if( $("#process-order").val() != '' ){

		var total = $("#cart-total").text();

		var productPrice = element.dataset.price;

		total = parseInt(total);

		productPrice = parseInt(productPrice);

		var newTotal = total + productPrice;

		$("#cart-total").text(newTotal+"$");
	}

}

window.removeProductFromCart = function(id, element){
	
	var cartTotal = parseInt( $("#items").text() );

	cartTotal--;

	$("#items").empty().text(cartTotal);

	$(element).text("add to cart");

	$(element).attr("onclick", 'addProductToCart('+id+', this)');

	$.ajax({
		type: 'GET',
		url: '/cart/remove',
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
    	data: {
    		productID: id
    	},
    	success: function(response){
    		// console.log('REMOVE');
    		// console.log(response);
    	}, 
    	error: function(response){
    		console.log('Error while processing order.');
    	}
	});

	if( $("#process-order").val() != '' ){

		var total = $("#cart-total").text();

		var productPrice = element.dataset.price;

		total = parseInt(total);

		productPrice = parseInt(productPrice);

		var newTotal = total - productPrice;

		$("#cart-total").text(newTotal+"$");
	}

}

window.userCheckout = function(){
	window.location.href = "http://laravel.2020.project/process/order";
}

function checkCart()
{
	var checkList = $("#product-list").val();

	if( checkList != '' ){

		var cartData = $("#ordered-items").val();
	
		if( cartData ){

			cartData = JSON.parse(cartData);

			var cartDataLength = cartData.length;

			if( cartDataLength > 0 ){
				for( var i = 0; i < cartDataLength; i++ ){

					$("#"+cartData[i]).text("remove from cart");

					$("#"+cartData[i]).attr("onclick", 'removeProductFromCart('+cartData[i]+', this)');

				}
			}

		}
	}
}

window.processUserOrder = function(){
	$("#orderModal").modal('toggle');
	window.location.href = "http://laravel.2020.project/process/user/order";
}