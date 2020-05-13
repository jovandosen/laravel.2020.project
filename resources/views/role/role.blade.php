@extends('layouts.app')

@section('title', '| Add Role')

@section('content')
<div class="container">
	@if( session()->has('roleCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('roleCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('role.store') }}">
				
				<div class="form-group">
					<label for="roleName">Role Name</label>
					<input type="text" name="roleName" id="roleName" placeholder="Role Name..." autocomplete="off" class="form-control @if($errors->has('roleName')) field-error @endif" aria-describedby="roleNameHelp" maxlength="255" value="{{ old('roleName') }}">
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
					<textarea name="roleDescription" id="roleDescription" class="form-control @if($errors->has('roleDescription')) field-error @endif" autocomplete="off" aria-describedby="roleDescriptionHelp" placeholder="Role Description...">{{ old('roleDescription') }}</textarea>
					<small id="roleDescriptionHelp" class="form-text text-muted">
						@if( $errors->has('roleDescription') )
							<font color="red">{{ $errors->first('roleDescription') }}</font>
						@else
							Please enter role description.	
						@endif
					</small>
				</div>

				<input type="hidden" name="userID" id="userID" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary">{{ __('ADD ROLE') }}</button>
				@csrf

			</form>

		</div>
	</div>
</div>
@endsection