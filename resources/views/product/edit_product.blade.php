@extends('layouts.app')

@section('title', '| Edit Product')

@section('content')
<div class="container">
	@if( session()->has('productUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('productUpdated') }}
                    </div>
              </div>      
        </div>      
  	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">
			 
			<form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}" id="update-product-form" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Product Name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" maxlength="255" aria-describedby="nameHelp" value="{{ $product->name }}">
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
					<input type="text" name="manufacturer" id="manufacturer" placeholder="Product Manufacturer..." autocomplete="off" class="form-control @if( $errors->has('manufacturer') ) field-error @endif" aria-describedby="manufacturerHelp" maxlength="255" value="{{ $product->manufacturer }}">
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
							<input type="number" name="price" id="price" placeholder="Product Price..." autocomplete="off" class="form-control @if( $errors->has('price') ) field-error @endif" aria-describedby="priceHelp" value="{{ $product->price }}" min="1">
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
							<input type="number" name="quantity" id="quantity" placeholder="Product Quantity..." autocomplete="off" class="form-control @if( $errors->has('quantity') ) field-error @endif" aria-describedby="quantityHelp" value="{{ $product->quantity }}" min="0">
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
					<textarea name="description" id="description" placeholder="Product Description..." autocomplete="off" class="form-control" aria-describedby="descriptionHelp">{{ $product->description }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">Please enter product description.</small>
				</div>

				<div class="row">
					<div class="col-6">
						
						<div class="form-group">
							<label for="images">Images</label>
							<input type="file" name="images[]" id="images" aria-describedby="imagesHelp" class="form-control-file" multiple>
							<small id="imagesHelp" class="form-text text-muted">Please upload product image or images.</small>
						</div>

					</div>
					<div class="col-6">
						<div class="row">
							@foreach( $productImages as $key => $productImg )
								
								<div class="col-6 add-space">
									<img src='{{ asset("/images/products/$product->name/$productImg") }}' class="img-fluid" id="{{ $productImg }}">
									<a href="javascript:void(0)" onclick="removeProductImage(this)" class="product-img-link">{{ __('remove') }}</a>
								</div>
								
							@endforeach
						</div>
					</div>
				</div>

				<input type="hidden" name="userID" id="userID" value="{{ Auth::user()->id }}">
				<input type="hidden" name="productImageList" id="productImageList" value="{{ $product->images }}">
				<input type="hidden" name="removedProductImages" id="removedProductImages" value="">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productModal">{{ __('UPDATE PRODUCT') }}</button>
				@csrf
				@method('PATCH')

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
      	<div class="modal-content">
          	<div class="modal-header">
	          	<h5 class="modal-title" id="exampleModalCenterTitle">Update Product</h5>
	          	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	          	</button>
          	</div>
          	<div class="modal-body">
          		{{ __('Are You sure You want to update this Product ?') }}
          	</div>
          	<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          		<button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmProductUpdate()">Yes</button>
          	</div>
      	</div>
  	</div>
</div>

@endsection