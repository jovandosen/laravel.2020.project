@extends('layouts.app')

@section('title', '| Edit Movie')

@section('content')
<div class="container">
	@if( session()->has('movieUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('movieUpdated') }}
                    </div>
              </div>      
        </div>      
  	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('movie.update', ['id' => $movie->id]) }}" enctype="multipart/form-data" id="update-movie-form">
				
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" placeholder="Movie title..." autocomplete="off" class="form-control @if( $errors->has('title') ) field-error @endif" aria-describedby="titleHelp" maxlength="255" value="{{ $movie->title }}">
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
					<textarea class="form-control @if( $errors->has('description') ) field-error @endif" name="description" id="description" placeholder="Movie description..." minlength="3" aria-describedby="descriptionHelp">{{ $movie->description }}</textarea>
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

				<div class="row justify-content-center">

					<div class="col-md-6">

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

					</div>

					<div class="col-md-6 text-right">

						@if( $movie->image )
							<div id="image-box">
                                  <img src='{{ asset("images/movies/$movie->image") }}' class="img-fluid" id="movie-img">
                                  <p id="remove-post-image"><a href="javascript:void(0)" onclick="removeMovieImage()" class="btn btn-sm btn-danger">remove image</a></p>
                            </div>
                        @else
                        	<div id="no-image-box">
                                  <h5>No Image.</h5>    
                            </div>     
						@endif

					</div>

				</div>

        <div class="form-group">

            <label>Genres</label>

                @foreach( $allGenres as $singleGenre )

                    @php 
                        if( in_array($singleGenre->id, $genres) ){
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                    @endphp

                    <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="{{ $singleGenre->name }}" value="{{ $singleGenre->id }}" name="movieGenres[]" @php echo $checked; @endphp>
                          <label class="custom-control-label" for="{{ $singleGenre->name }}">{{ $singleGenre->name }}</label>
                    </div>

                @endforeach

        </div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">
            	<input type="hidden" name="movieImage" value="@if( $movie->image ) {{ $movie->image }} @endif" id="movieImage">
                <input type="hidden" name="removedImage" value="" id="removedImage">
                <input type="hidden" name="removedImgSrc" value="" id="removed-img-src">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#movieModal">EDIT MOVIE</button>
            	@csrf
            	@method('PATCH')

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Update Movie</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                  {{ __('Are You sure You want to update this Movie ?') }}
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmMovieUpdate()">Yes</button>
                  </div>
          </div>
      </div>
</div>

@endsection