@extends('layouts.app')

@section('title', '| Genre List')

@section('content')
<div class="container">
	@if( session()->has('genreDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('genreDeleted') }}
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
				      	<th scope="col">Description</th>
				      	<th scope="col">Author</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $genres as $genre )
  						@php
  							$genreAuthor = DB::table('users')->where('id', $genre->user_id)->first();
  							$genreAuthorName = $genreAuthor->name;
  						@endphp
  						<tr>
  							<td>{{ $genre->name }}</td>
  							<td>{{ $genre->description }}</td>
  							<td>{{ $genreAuthorName }}</td>
  							<td>{{ $genre->created_at->diffForHumans() }}</td>
  							<td><a href="{{ route('genre.edit', ['id' => $genre->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a></td>
  							<td>
  								<form method="POST" action="{{ route('genre.delete', ['id' => $genre->id]) }}" id="delete-genre-form-{{ $genre->id }}">
  									<button type="button" class="btn btn-sm btn-danger" id="delete-genre-{{ $genre->id }}" data-toggle="modal" data-target="#genreModal" onclick="confirmAction(this)">{{ __('Delete') }}</button>
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
<div class="modal fade" id="genreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Genre</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Genre ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="confirmGenreActionYes(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection