@extends('layouts.app')

@section('title', '| Add Movie')

@section('content')
<div class="container">
	@if( session()->has('movieCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('movieCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" placeholder="Movie title..." autocomplete="off" class="form-control @if( $errors->has('title') ) field-error @endif" aria-describedby="titleHelp" maxlength="255" value="{{ old('title') }}">
					<small id="titleHelp" class="form-text text-muted">
						@if( $errors->has('title') )
            				<font color="red">
            					{{ $errors->first('title') }}
            				</font>
            			@else
            				Please enter movie title.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control @if( $errors->has('description') ) field-error @endif" name="description" id="description" placeholder="Movie description..." minlength="3" aria-describedby="descriptionHelp">{{ old('description') }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">
						@if( $errors->has('description') )
            				<font color="red">
            					{{ $errors->first('description') }}
            				</font>
            			@else
            				Please enter movie description.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" name="image" id="image" class="form-control-file" aria-describedby="imageHelp">
					<small id="imageHelp" class="form-text text-muted">
						@if( $errors->has('image') )
            				<font color="red">
            					{{ $errors->first('image') }}
            				</font>
            			@else
            				Please upload movie image.
            			@endif
					</small>
				</div>

				<div class="form-group">

					<label>Genres</label>

					@foreach( $genres as $genre )

						<div class="custom-control custom-checkbox">
        					<input type="checkbox" class="custom-control-input" id="{{ $genre->name }}" value="{{ $genre->id }}" name="movieGenres[]">
        					<label class="custom-control-label" for="{{ $genre->name }}">{{ $genre->name }}</label>
      					</div>

					@endforeach

				</div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

            	<button type="submit" class="btn btn-primary">ADD MOVIE</button>
            	@csrf

			</form>
		</div>
	</div>
</div>
@endsection