@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Your Profile name..." value="{{ Auth::user()->name }}" class="form-control" autocomplete="off" aria-describedby="nameHelp" maxlength="255">
					<small class="form-text text-muted" id="nameHelp">Please enter your profile name.</small>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" placeholder="Your Email address..." autocomplete="off" class="form-control" aria-describedby="emailHelp" maxlength="255" value="{{ Auth::user()->email }}">
					<small class="form-text text-muted" id="emailHelp">Please enter your email address.</small>
				</div>

				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" name="image" id="image" class="form-control-file" aria-describedby="imageHelp">
							<small class="form-text text-muted" id="imageHelp">Please upload your profile image.</small>
						</div>
					</div>
					<div class="col-md-6 text-right">
						Profile image
					</div>
				</div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

				<button type="submit" class="btn btn-primary">UPDATE PROFILE</button>
				@csrf
				@method('PATCH')

			</form>

		</div>
	</div>
</div>
@endsection