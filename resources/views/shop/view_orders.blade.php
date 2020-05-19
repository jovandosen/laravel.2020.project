@extends('layouts.app')

@section('title', '| User Orders')

@section('content')
<div class="container">

	@if( count( $allOrders ) > 0 )

		@foreach( $allOrders as $key => $orders )

			<h4 class="order-title">Order details:</h4>
			<hr>

			@php $total = 0; @endphp

			@for( $i = 0; $i < count( $orders ); $i++ )

				@php
					$product = $orders[$i];
					$total = $total + $product->price;
				@endphp

				<div class="row justify-content-center">
					<div class="col-md-3">
						<strong>Product Name:</strong><p>{{ $product->name }}</p>
					</div>
					<div class="col-md-3">
						<strong>Product Manufacturer:</strong><p>{{ $product->manufacturer }}</p>
					</div>
					<div class="col-md-3">
						<strong>Product Price:</strong><p>{{ $product->price }}</p>
					</div>
					<div class="col-md-3">
						<strong>Product Description:</strong><p>{{ \Illuminate\Support\Str::limit( $product->description, 30, $end='...' ) }}</p>
					</div>
				</div>

			@endfor

			<hr>
			<div class="row justify-content-center">
				<div class="col-12">
					<strong>Total:</strong><p>{{ $total }}$</p>
				</div>
			</div>
			<hr class="order-break">

		@endforeach

	@else
		<div class="row justify-content-center">
			<div class="col-12">
				<h4>No Orders found.</h4>
			</div>
		</div>	
	@endif

</div>
@endsection