@extends('layouts.app')

@section('title', '| User Roles')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			
			<form method="POST" action="#">

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

						<div class="custom-control custom-checkbox">
        					<input type="checkbox" class="custom-control-input" id="{{ $role->roleName }}" value="{{ $role->id }}" name="userRoles[]">
        					<label class="custom-control-label" for="{{ $role->roleName }}">{{ $role->roleName }}</label>
      					</div>

					@endforeach

				</div>

				<button class="btn btn-primary" type="submit">{{ __('ASSIGN ROLES') }}</button>
				@csrf

			</form>

		</div>
	</div>
</div>
@endsection