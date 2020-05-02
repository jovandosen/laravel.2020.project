@extends('layouts.app')

@section('title', '| All Products')

@section('content')
<div class="container">
	@if( session()->has('productDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('productDeleted') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-10">
			<table class="table table-bordered table-hover">
				<thead>
				    <tr>
				      	<th scope="col">Name</th>
				      	<th scope="col">Manufacturer</th>
				      	<th scope="col">Price</th>
				      	<th scope="col">Quantity</th>
				      	<th scope="col">Description</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $products as $product )
  						<tr>
  							<td>{{ $product->name }}</td>
  							<td>{{ $product->manufacturer }}</td>
  							<td>{{ $product->price }}</td>
  							<td>{{ $product->quantity }}</td>
  							<td>
  								@if( !empty($product->description) )
  									{{ $product->description }}
  								@else
  									<i>{{ __('No Description') }}</i>
  								@endif
  							</td>
  							<td>{{ $product->created_at->diffForHumans() }}</td>
  							<td><a href="#">edit</a></td>
  							<td>
  								<form method="POST" action="{{ route('product.delete', ['id' => $product->id]) }}" id="delete-product-form-{{ $product->id }}">
  									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#productModal" id="delete-product-{{ $product->id }}" onclick="confirmAction(this)">{{ __('DELETE') }}</button>
  									@method('DELETE')
									@csrf
  								</form>
  							</td>
  						</tr>
  					@endforeach
  				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Product</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Product ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="deleteProduct(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection