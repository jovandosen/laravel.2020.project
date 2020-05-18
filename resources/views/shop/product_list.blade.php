@extends('layouts.app')

@section('title', '| Shop')

@section('content')
<div class="container">

	<div class="row justify-content-center">
		
		<div class="col-12">
            <form method="GET" action="{{ route('shop') }}" class="form-inline" id="product-search-form">
                <input type="text" name="search" id="search-products" class="form-control mr-sm-1" placeholder="Search shop..." autocomplete="off">
                <button type="submit" class="btn btn-outline-primary">{{ __('Search') }}</button>
            </form>
        </div>

        <div class="col-12">
        	<a href="{{ route('shop') }}">{{ __('back to shop') }}</a> |
            <a href="{{ route('clear.cart') }}">{{ __('clear cart') }}</a> |
            <a href="javascript:void(0)" id="product-form-filters">{{ __('add filters') }}</a>
            <hr>
        </div>

        <div class="col-12" id="price-range-box" style="display: none;">
        	<label>Price range:</label>
        	<div class="row">
        		<div class="col-6">
        			<input type="number" name="priceFrom" id="priceFrom" placeholder="From..." class="form-control" min="0" form="product-search-form">
        		</div>
        		<div class="col-6">
        			<input type="number" name="priceTo" id="priceTo" placeholder="To..." class="form-control" min="0" form="product-search-form">
        		</div>
        	</div>
        	<hr>
        </div>

	</div>

	<div class="row justify-content-center">

		@if( ! $products->isEmpty() )
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

			<div class="col-md-10">
	            <div class="row justify-content-center products-pagination-box">
	                {{ $products->withQueryString()->links() }}
	            </div>
	        </div>
	    @else
	    	<div class="col-12">
	    		<h4>No Products found.</h4>
	    	</div>    
        @endif

	</div>
</div>
<input type="hidden" name="productList" id="product-list" value="list">
@endsection