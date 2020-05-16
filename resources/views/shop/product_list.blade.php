@extends('layouts.app')

@section('title', '| Shop')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		@foreach( $products as $product )
			<div class="col-lg-3 col-md-4 col-sm-6 product-box">
				<div class="card">
					<div class="card-header">
						@if( $product->name )
							{{ $product->name }}
						@else
							<i>{{ __('No Name') }}	</i>
						@endif
					</div>
					<div class="card-body">
						<h6 class="card-title">Description</h6>
						<hr>
						@if( $product->description )
							<p class="card-text">{{ \Illuminate\Support\Str::limit( $product->description, 50, $end='...' ) }}</p>
						@else
							<i>{{ __('No Description') }}</i>
						@endif
					</div>
					<div class="card-footer">
						<a href="{{ route('product.details', ['id' => $product->id]) }}">details</a> |
						<a href="javascript:void(0)" id="{{ $product->id }}" onclick='addProductToCart("{{ $product->id }}", this)'>add to cart</a> |
						<span>
							@if( $product->price )
								<strong>{{ $product->price }}$</strong>
							@else
								<i>{{ __('free') }}</i>	
							@endif
						</span>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
<input type="hidden" name="cartItems" id="cart-items" value="">
@php
	if( !empty( session('productItems') ) ){
		$orderedItems = session('productItems');
		$orderedItems = json_encode($orderedItems);
	} else {
		$orderedItems = [];
		$orderedItems = json_encode($orderedItems);
	}
@endphp
<input type="hidden" name="orderedItems" id="ordered-items" value="{{ $orderedItems }}">
@endsection