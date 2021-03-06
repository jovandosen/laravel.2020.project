@extends('layouts.app')

@section('title', '| Profile')

@section('content')
<div class="container">
	@if( session()->has('userProfileUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('userProfileUpdated') }}
                    </div>
              </div>      
        </div>      
  	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('profile.update', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data" id="update-profile-form">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Your Profile name..." value="{{ Auth::user()->name }}" class="form-control" autocomplete="off" aria-describedby="nameHelp" maxlength="255">
					<small class="form-text text-muted" id="nameHelp">
						@if( $errors->has('name') )
            				<font color="red">
            					{{ $errors->first('name') }}
            				</font>
            			@else
            				Please enter your profile name.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" placeholder="Your Email address..." autocomplete="off" class="form-control" aria-describedby="emailHelp" maxlength="255" value="{{ Auth::user()->email }}">
					<small class="form-text text-muted" id="emailHelp">
						@if( $errors->has('email') )
            				<font color="red">
            					{{ $errors->first('email') }}
            				</font>
            			@else
            				Please enter your email address.
            			@endif
					</small>
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
						@if( Auth::user()->image )
							<div id="image-box">
								@php $imgPath = Auth::user()->image; @endphp
								<img src='{{ asset("/images/profile/$imgPath") }}' class="img-fluid" id="user-image">
								<p id="remove-user-image"><a href="javascript:void(0)" onclick="removeUserImage()" class="btn btn-sm btn-danger">remove image</a></p>
							</div>	
						@else
							<div id="no-image-box">
								<h5>No Profile image.</h5>	
							</div>
						@endif
					</div>
				</div>

				<input type="hidden" name="userID" value="{{ Auth::user()->id }}">
				<input type="hidden" name="userImage" value="@if( Auth::user()->image ) {{ Auth::user()->image }} @endif" id="userImage">
				<input type="hidden" name="removedImage" value="" id="removedImage">
				<input type="hidden" name="removedImgSrc" value="" id="removed-img-src">
				<input type="hidden" name="userOldImage" value="{{ Auth::user()->image }}">

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userProfileModal">UPDATE PROFILE</button>
				@csrf
				@method('PATCH')

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="userProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Update Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                  {{ __('Are You sure You want to update Profile details ?') }}
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmUserProfileUpdate()">Update</button>
                  </div>
          </div>
      </div>
</div>

@endsection