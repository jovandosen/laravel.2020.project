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

			</form>
		</div>
	</div>
</div>
@endsection