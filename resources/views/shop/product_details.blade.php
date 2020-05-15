@extends('layouts.app')

@section('title', '| Product Details')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form>
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" readonly>
				</div>

				<div class="form-group">
					<label for="manufacturer">Manufacturer</label>
					<input type="text" name="manufacturer" id="manufacturer" class="form-control" value="{{ $product->manufacturer }}" readonly>
				</div>

				<div class="row">
					<div class="col">
						
						<div class="form-group">
							<label for="price">Price</label>
							<input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" readonly>
						</div>

					</div>
					<div class="col">
						
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input type="number" name="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" readonly>
						</div>

					</div>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control" readonly>{{ $product->description }}</textarea>
				</div>

				<div class="form-group">
					
					@if( !empty($productImages) )
					<div id="productCarousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@foreach( $productImages as $key => $value )
								<li data-target="#productCarousel" data-slide-to="{{ $key }}" class="@if($loop->first) active @endif"></li>
							@endforeach
						</ol>
						<div class="carousel-inner">
							@foreach( $productImages as $k => $v )
							<div class="carousel-item @if($loop->first) active @endif">
								<img src='{{ asset("/images/products/$product->name/$v") }}' class="d-block w-100" alt="{{ $v }}" width="100%" height="300px">
							</div>
							@endforeach
						</div>
						<a href="#productCarousel" class="carousel-control-prev" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a href="#productCarousel" class="carousel-control-next" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					@else
						<h5>This product has no images.</h5>
					@endif

				</div>

				<a class="btn btn-outline-primary" href="#">{{ __('ADD TO CART') }}</a>
				<a class="btn btn-outline-primary" href="{{ route('shop') }}">{{ __('BACK TO SHOP') }}</a>

			</form>
		</div>
	</div>
</div>
@endsection