@extends('layouts.app')

@section('title', '| Add Genre')

@section('content')
<div class="container">
	@if( session()->has('genreCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('genreCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="POST" action="{{ route('genre.store') }}">

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Genre name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" aria-describedby="nameHelp" maxlength="255" minlength="3" value="{{ old('name') }}">
					<small id="nameHelp" class="form-text text-muted">
						@if( $errors->has('name') )
            				<font color="red">
            					{{ $errors->first('name') }}
            				</font>
            			@else
            				Please enter genre name.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control @if( $errors->has('description') ) field-error @endif" aria-describedby="descriptionHelp" placeholder="Genre description..." minlength="3">{{ old('description') }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">
						@if( $errors->has('description') )
            				<font color="red">
            					{{ $errors->first('description') }}
            				</font>
            			@else
            				Please enter genre description.
            			@endif
					</small>
				</div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary">ADD GENRE</button>
				@csrf

			</form>
		</div>
	</div>
</div>
@endsection