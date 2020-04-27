@extends('layouts.app')

@section('title', '| All Posts')

@section('content')
<div class="container">
	@if( session()->has('postDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('postDeleted') }}
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
				      	<th scope="col">Excerpt</th>
				      	<th scope="col">Content</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
					@foreach( $posts as $post )
						<tr>
							<td>{{ $post->title }}</td>
							<td>{{ $post->excerpt }}</td>
							<td>{{ $post->content }}</td>
							<td>{{ $post->created_at->diffForHumans() }}</td>
							<td>
								<a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-sm btn-primary">{{ __('EDIT') }}</a>
							</td>
							<td>
								<form method="POST" action="{{ route('post.delete', ['id' => $post->id]) }}" id="delete-post-form-{{ $post->id }}">
									<button type="button" class="btn btn-sm btn-danger" id="delete-post-{{ $post->id }}" onclick="confirmAction(this)" data-toggle="modal" data-target="#postModal">{{ __('DELETE') }}</button>
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
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Post</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Post ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="confirmActionYes(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection