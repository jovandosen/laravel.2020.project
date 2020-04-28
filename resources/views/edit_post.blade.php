@extends('layouts.app')

@section('title', '| Edit Post')

@section('content')
<div class="container">
      @if( session()->has('postUpdated') )
            <div class="row justify-content-center" id="flash-message-box">
                  <div class="col-md-8">
                        <div class="alert alert-success" role="alert" id="flash-message-content">
                              {{ session()->get('postUpdated') }}
                        </div>
                  </div>      
            </div>      
      @endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('post.update', ['id' => $post->id]) }}" enctype="multipart/form-data" id="update-post-form">

				<div class="form-group">
            		<label for="title">Title</label>
            		<input type="text" name="title" class="form-control @if( $errors->has('title') ) field-error @endif" placeholder="Post Title..." aria-describedby="titleHelp" autocomplete="off" id="title" value="{{ $post->title }}" maxlength="255">
            		<small class="form-text text-muted" id="titleHelp">
            			@if( $errors->has('title') )
            				<font color="red">
            					{{ $errors->first('title') }}
            				</font>
            			@else
            				Enter post title.
            			@endif
            		</small>
            	</div>

            	<div class="form-group">
            		<label for="excerpt">Excerpt</label>
            		<input type="text" name="excerpt" id="excerpt" value="{{ $post->excerpt }}" placeholder="Post Excerpt..." autocomplete="off" aria-describedby="excerptHelp" class="form-control @if( $errors->has('excerpt') ) field-error @endif">
            		<small>
            			@if( $errors->has('excerpt') )
            				<font color="red">
            					{{ $errors->first('excerpt') }}
            				</font>
            			@else
            				Enter post excerpt.
            			@endif
            		</small>
            	</div>

            	<div class="form-group">
            		<label for="content">Content</label>
            		<textarea class="form-control @if( $errors->has('content') ) field-error @endif" name="content" id="content" placeholder="Post Content..." aria-describedby="contentHelp" minlength="3">{{ $post->content }}</textarea>
            		<small class="form-text text-muted" id="contentHelp">
            			@if( $errors->has('content') )
            				<font color="red">
            					{{ $errors->first('content') }}
            				</font>
            			@else
            				Enter post content.
            			@endif
            		</small>
            	</div>

            	<div class="row justify-content-center">

            		<div class="col-md-6">

            			<div class="form-group">
		            		<label for="image">Image</label>
		            		<input type="file" name="image" id="image" class="form-control-file" aria-describedby="imageHelp">
		            		<small class="form-text text-muted" id="imageHelp">Upload post image.</small>
            			</div>

            		</div>	

            		<div class="col-md-6 text-right">
            			@if( $post->image )
                                    <img src='{{ asset("images/posts/$post->image") }}' class="img-fluid">
                              @else
                                    <h5>No Image.</h5>      
                              @endif
            		</div>	

            	</div>	

            	

            	<input type="hidden" name="userID" value="{{ Auth::user()->id }}">
            	<input type="hidden" name="postImage" value="@if( $post->image ) {{ $post->image }} @endif">

            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#postModal">EDIT POST</button>
            	@csrf
            	@method('PATCH')

			</form>
		</div>	
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Update Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                  {{ __('Are You sure You want to update this Post ?') }}
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmPostUpdate()">Yes</button>
                  </div>
          </div>
      </div>
</div>

@endsection