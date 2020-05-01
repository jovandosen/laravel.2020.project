@extends('layouts.app')

@section('title', '| Category List')

@section('content')
<div class="container">
	@if( session()->has('categoryDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('categoryDeleted') }}
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
  					@foreach( $categories as $category )
  						@php
  							$categoryAuthor = DB::table('users')->where('id', $category->user_id)->first();
  							$categoryAuthorName = $categoryAuthor->name;
  						@endphp
  						<tr>
  							<td>{{ $category->name }}</td>
  							<td>{{ $category->description }}</td>
  							<td>{{ $categoryAuthorName }}</td>
  							<td>{{ $category->created_at->diffForHumans() }}</td>
  							<td><a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a></td>
  							<td>
  								<form method="POST" action="{{ route('category.delete', ['id' => $category->id]) }}" id="delete-category-form-{{ $category->id }}">
  									<button type="button" class="btn btn-sm btn-danger" id="delete-category-{{ $category->id }}" data-toggle="modal" data-target="#categoryModal" onclick="confirmAction(this)">
  										{{ __('Delete') }}
  									</button>
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
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Category</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Category ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="confirmCategoryActionYes(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection