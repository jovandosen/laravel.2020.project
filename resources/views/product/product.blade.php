@extends('layouts.app')

@section('title', '| Add Product')

@section('content')
<div class="container">
	@if( session()->has('productCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('productCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			<form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Product Name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" maxlength="255" aria-describedby="nameHelp" value="{{ old('name') }}">
					<small id="nameHelp" class="form-text text-muted">
						@if( $errors->has('name') )
							<font color="red">{{ $errors->first('name') }}</font>
						@else
							Please enter product name.
						@endif
					</small>
				</div>

				<div class="form-group">
					<label for="manufacturer">Manufacturer</label>
					<input type="text" name="manufacturer" id="manufacturer" placeholder="Product Manufacturer..." autocomplete="off" class="form-control @if( $errors->has('manufacturer') ) field-error @endif" aria-describedby="manufacturerHelp" maxlength="255" value="{{ old('manufacturer') }}">
					<small id="manufacturerHelp" class="form-text text-muted">
						@if( $errors->has('manufacturer') )
							<font color="red">{{ $errors->first('manufacturer') }}</font>
						@else
							Please enter product manufacturer.
						@endif
					</small>
				</div>

				<div class="row">
					<div class="col">
						
						<div class="form-group">
							<label for="price">Price</label>
							<input type="number" name="price" id="price" placeholder="Product Price..." autocomplete="off" class="form-control @if( $errors->has('price') ) field-error @endif" aria-describedby="priceHelp" value="{{ old('price') }}" min="1">
							<small id="priceHelp" class="form-text text-muted">
								@if( $errors->has('price') )
									<font color="red">{{ $errors->first('price') }}</font>
								@else
									Please enter product price.
								@endif
							</small>
						</div>

					</div>
					<div class="col">
						
						<div class="form-group">
							<label for="quantity">Quantity</label>
							<input type="number" name="quantity" id="quantity" placeholder="Product Quantity..." autocomplete="off" class="form-control @if( $errors->has('quantity') ) field-error @endif" aria-describedby="quantityHelp" value="{{ old('quantity') }}" min="0">
							<small id="quantityHelp" class="form-text text-muted">
								@if( $errors->has('quantity') )
									<font color="red">{{ $errors->first('quantity') }}</font>
								@else
									Please enter product quantity.
								@endif
							</small>
						</div>

					</div>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" placeholder="Product Description..." autocomplete="off" class="form-control" aria-describedby="descriptionHelp">{{ old('description') }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">Please enter product description.</small>
				</div>

				<div class="form-group">
					<label for="images">Images</label>
					<input type="file" name="images[]" id="images" aria-describedby="imagesHelp" class="form-control-file" multiple>
					<small id="imagesHelp" class="form-text text-muted">Please upload product image or images.</small>
				</div>

				<input type="hidden" name="userID" id="userID" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary">{{ __('ADD PRODUCT') }}</button>
				@csrf

			</form>

		</div>
	</div>
</div>
@endsection