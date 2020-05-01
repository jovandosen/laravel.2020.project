@extends('layouts.app')

@section('title', '| Add Category')

@section('content')
<div class="container">
	@if( session()->has('categoryCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('categoryCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('category.store') }}">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Category name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" aria-describedby="nameHelp" maxlength="255" minlength="3" value="{{ old('name') }}">
					<small id="nameHelp" class="form-text text-muted">
						@if( $errors->has('name') )
            				<font color="red">
            					{{ $errors->first('name') }}
            				</font>
            			@else
            				Please enter category name.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control @if( $errors->has('description') ) field-error @endif" aria-describedby="descriptionHelp" placeholder="Category description..." minlength="3">{{ old('description') }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">
						@if( $errors->has('description') )
            				<font color="red">
            					{{ $errors->first('description') }}
            				</font>
            			@else
            				Please enter category description.
            			@endif
					</small>
				</div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary">ADD CATEGORY</button>
				@csrf

			</form>

		</div>
	</div>
</div>
@endsection