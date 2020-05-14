@extends('layouts.app')

@section('title', '| User Roles')

@section('content')
<div class="container">
	@if( session()->has('rolesAssigned') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('rolesAssigned') }}
				</div>
			</div>	
		</div>	
	@endif
	@if( session()->has('rolesUpdated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('rolesUpdated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			<form method="POST" action="{{ route('user.roles') }}">

				<div class="form-group">
					<label for="userName">User Name</label>
					<input type="text" name="userName" id="userName" class="form-control" value="{{ $user->name }}" readonly>
				</div>

				<div class="form-group">
					<label for="userEmail">User Email Address</label>
					<input type="text" name="userEmail" id="userEmail" class="form-control" value="{{ $user->email }}" readonly>
				</div>

				<div class="form-group">

					<label>Roles</label>

					@foreach( $roles as $role )

						@php
							if( in_array($role->id, $userRoles) ){
								$checked = "checked";
							} else {
								$checked = "";
							}
						@endphp

						<div class="custom-control custom-checkbox">
        					<input type="checkbox" class="custom-control-input" id="{{ $role->roleName }}" value="{{ $role->id }}" name="userRoles[]" @php echo $checked; @endphp>
        					<label class="custom-control-label" for="{{ $role->roleName }}">{{ $role->roleName }}</label>
      					</div>

					@endforeach

				</div>

				<input type="hidden" name="userID" value="{{ $user->id }}">

				<button class="btn btn-primary" type="submit">{{ __('ASSIGN ROLES') }}</button>
				@csrf

			</form>

		</div>
	</div>
</div>
@endsection