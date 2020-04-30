@extends('layouts.app')

@section('title', '| Edit Genre')

@section('content')
<div class="container">
	@if( session()->has('genreUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('genreUpdated') }}
                    </div>
              </div>      
        </div>      
   	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('genre.update', ['id' => $genre->id]) }}" id="update-genre-form">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Genre name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" aria-describedby="nameHelp" maxlength="255" minlength="3" value="{{ $genre->name }}">
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
					<textarea name="description" id="description" class="form-control @if( $errors->has('description') ) field-error @endif" aria-describedby="descriptionHelp" placeholder="Genre description..." minlength="3">{{ $genre->description }}</textarea>
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

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genreModal">EDIT GENRE</button>
				@method('PATCH')
				@csrf

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="genreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Update Genre</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{ __('Are You sure You want to update this Genre ?') }}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmGenreUpdate()">Yes</button>
              </div>
          </div>
      </div>
</div>

@endsection