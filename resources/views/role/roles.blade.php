@extends('layouts.app')

@section('title', '| All Roles')

@section('content')
<div class="container">
	@if( session()->has('roleDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-10">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('roleDeleted') }}
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
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $roles as $role )
  						<tr>
  							<td>
  								@if( $role->roleName )
  									{{ $role->roleName }}
  								@else
  									<i>{{ __('No Name') }}	</i>
  								@endif
  							</td>
  							<td>
  								@if( $role->roleDescription )
  									{{ $role->roleDescription }}
  								@else
  									<i>{{ __('No Description') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $role->created_at )
  									{{ $role->created_at->diffForHumans() }}
  								@else
  									<i>{{ __('No Created At Detail') }}</i>	
  								@endif
  							</td>
  							<td>
  								<a href="#">{{ __('Edit') }}</a>
  							</td>
  							<td>
  								<form method="POST" action="{{ route('role.delete', ['id' => $role->id]) }}" id="delete-role-form-{{ $role->id }}">
  									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#roleModal" id="delete-role-{{ $role->id }}" onclick="confirmAction(this)">{{ __('DELETE') }}</button>
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
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Role</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Role ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="deleteRole(this)">Yes</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection