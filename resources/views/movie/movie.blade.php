@extends('layouts.app')

@section('title', '| Add Movie')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="POST" action="{{ route('movie.store') }}" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" placeholder="Movie title..." autocomplete="off" class="form-control" aria-describedby="titleHelp" maxlength="255">
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
					<textarea class="form-control" name="description" id="description" placeholder="Movie description..." minlength="3" aria-describedby="descriptionHelp"></textarea>
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

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

            	<button type="submit" class="btn btn-primary">ADD MOVIE</button>
            	@csrf

			</form>
		</div>
	</div>
</div>
@endsection