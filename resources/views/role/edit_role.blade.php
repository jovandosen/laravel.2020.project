@extends('layouts.app')

@section('title', '| Edit Role')

@section('content')
<div class="container">
	@if( session()->has('roleUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('roleUpdated') }}
                    </div>
              </div>      
        </div>      
  	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('role.update', ['id' => $role->id]) }}" id="update-role-form">
				
				<div class="form-group">
					<label for="roleName">Role Name</label>
					<input type="text" name="roleName" id="roleName" placeholder="Role Name..." autocomplete="off" class="form-control @if($errors->has('roleName')) field-error @endif" aria-describedby="roleNameHelp" maxlength="255" value="{{ $role->roleName }}">
					<small id="roleNameHelp" class="form-text text-muted">
						@if( $errors->has('roleName') )
							<font color="red">{{ $errors->first('roleName') }}</font>
						@else
							Please enter role name.	
						@endif
					</small>
				</div>

				<div class="form-group">
					<label for="roleDescription">Role Description</label>
					<textarea name="roleDescription" id="roleDescription" class="form-control @if($errors->has('roleDescription')) field-error @endif" autocomplete="off" aria-describedby="roleDescriptionHelp" placeholder="Role Description...">{{ $role->roleDescription }}</textarea>
					<small id="roleDescriptionHelp" class="form-text text-muted">
						@if( $errors->has('roleDescription') )
							<font color="red">{{ $errors->first('roleDescription') }}</font>
						@else
							Please enter role description.	
						@endif
					</small>
				</div>

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleModal">{{ __('UPDATE ROLE') }}</button>
				@csrf
				@method('PATCH')

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
      	<div class="modal-content">
          	<div class="modal-header">
	          	<h5 class="modal-title" id="exampleModalCenterTitle">Update Role</h5>
	          	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	          	</button>
          	</div>
          	<div class="modal-body">
          		{{ __('Are You sure You want to update this Role ?') }}
          	</div>
          	<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          		<button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmRoleUpdate()">Yes</button>
          	</div>
      	</div>
  	</div>
</div>

@endsection