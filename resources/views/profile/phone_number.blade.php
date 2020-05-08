@extends('layouts.app')

@section('title', $data['title'])

@section('content')
<div class="container">
	@if( session()->has('phoneNumberCreated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('phoneNumberCreated') }}
				</div>
			</div>	
		</div>	
	@endif
	@if( session()->has('phoneNumberUpdated') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-success" role="alert" id="flash-message-content">
					{{ session()->get('phoneNumberUpdated') }}
				</div>
			</div>	
		</div>	
	@endif
	@if( session()->has('phoneNumberDeleted') )
		<div class="row justify-content-center" id="flash-message-box">
			<div class="col-md-8">
				<div class="alert alert-danger" role="alert" id="flash-message-content">
					{{ session()->get('phoneNumberDeleted') }}
				</div>
			</div>	
		</div>	
	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">		
			<form method="POST" action="{{ $data['action'] }}">
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="text" name="phone" id="phone" autocomplete="off" class="form-control @if( $errors->has('phone') ) field-error @endif" placeholder="Phone Number..." aria-describedby="phoneHelp" maxlength="255" minlength="6" value="@if(!empty($data['userPhoneNumber'])){{ $data['userPhoneNumber'] }} @else{{ old('phone') }}@endif">
					<small class="form-text text-muted" id="phoneHelp">
						@if( $errors->has('phone') )
							<font color="red">{{ $errors->first('phone') }}</font>
						@else
							Please enter your phone number.
						@endif
					</small>
				</div>
				<button type="submit" class="btn btn-primary">{{ $data['button'] }}</button>
				@csrf
				@if( !empty($data['userPhoneNumber']) )
					@method('PATCH')
				@endif
			</form>
			@if( !empty($data['id']) )
				<form method="POST" action="{{ route('delete.phone.number', ['id' => $data['id']]) }}" id="delete-phone-number">
					<button id="delete-phone-number-btn" class="btn btn-danger" type="button" data-toggle="modal" data-target="#phoneNumberModal">{{ __('DELETE PHONE NUMBER') }}</button>
					@csrf
					@method('DELETE')
				</form>	
			@endif
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="phoneNumberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalCenterTitle">Delete Phone Number</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
	        	{{ __('Are You sure You want to delete this Phone Number ?') }}
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	        	<button type="button" class="btn btn-danger" data-send="" id="confirm-yes" onclick="confirmPhoneNumberDelete()">Delete</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection