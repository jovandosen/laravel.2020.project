@extends('layouts.app')

@section('title', '| All Movies')

@section('content')
<div class="container">
	@if( session()->has('movieDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('movieDeleted') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-10">
			<table class="table table-bordered table-hover">
				<thead>
				    <tr>
				      	<th scope="col">Title</th>
				      	<th scope="col">Description</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $movies as $movie )
  						<tr>
  							<td>
  								@if( $movie->title )
  									{{ $movie->title }}
  								@else
  									<i>{{ __('No Title') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $movie->description )
  									{{ $movie->description }}
  								@else
  									<i>{{ __('No Description') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $movie->created_at )
  									{{ $movie->created_at->diffForHumans() }}
  								@else
  									<i>{{ __('No Created At Detail') }}</i>	
  								@endif
  							</td>
  							<td><a class="btn btn-sm btn-primary" href="{{ route('movie.edit', ['id' => $movie->id]) }}">{{ __('EDIT') }}</a></td>
  							<td>
  								<form method="POST" action="{{ route('movie.delete', ['id' => $movie->id]) }}" id="delete-movie-form-{{ $movie->id }}">
  									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#movieModal" id="delete-movie-{{ $movie->id }}" onclick="confirmAction(this)">{{ __('DELETE') }}</button>
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
<div class="modal fade" id="movieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Movie</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Movie ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="deleteMovie(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection