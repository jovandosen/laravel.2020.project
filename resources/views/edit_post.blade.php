@extends('layouts.app')

@section('title', '| Edit Post')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="#" enctype="multipart/form-data">

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

            		<div class="col-md-6">
            			<p>test</p>
            		</div>	

            	</div>	

            	

            	<input type="hidden" name="userID" value="{{ Auth::user()->id }}">
            	<input type="hidden" name="postImage" value="{{ $post->image }}">

            	<button type="submit" class="btn btn-primary">EDIT POST</button>
            	@csrf
            	@method('PATCH')

			</form>
		</div>	
	</div>
</div>
@endsection