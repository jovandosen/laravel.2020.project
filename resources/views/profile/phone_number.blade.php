@extends('layouts.app')

@section('title', '| Add Phone Number')

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
	<div class="row justify-content-center">
		<div class="col-md-8">		
			<form method="POST" action="{{ route('store.phone.number') }}">
				<div class="form-group">
					<label for="phone">Phone Number</label>
					<input type="text" name="phone" id="phone" autocomplete="off" class="form-control @if( $errors->has('phone') ) field-error @endif" placeholder="Phone Number..." aria-describedby="phoneHelp" maxlength="255" minlength="6" value="{{ old('phone') }}">
					<small class="form-text text-muted" id="phoneHelp">
						@if( $errors->has('phone') )
							<font color="red">{{ $errors->first('phone') }}</font>
						@else
							Please enter your phone number.
						@endif
					</small>
				</div>
				<button type="submit" class="btn btn-primary">{{ __('ADD PHONE NUMBER') }}</button>
				@csrf
			</form>
		</div>
	</div>
</div>
@endsection