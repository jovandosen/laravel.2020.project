@extends('layouts.app')

@section('title', '| All Products')

@section('content')
<div class="container">
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
  							<td>{{ $product->description }}</td>
  							<td>{{ $product->created_at->diffForHumans() }}</td>
  							<td><a href="#">edit</a></td>
  							<td><a href="#">delete</a></td>
  						</tr>
  					@endforeach
  				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection