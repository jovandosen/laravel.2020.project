@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">

            	<div class="form-group">
            		<label for="title">Title</label>
            		<input type="text" name="title" class="form-control @if( $errors->has('title') ) field-error @endif" placeholder="Post Title..." aria-describedby="titleHelp" autocomplete="off" id="title" value="{{ old('title') }}" maxlength="255">
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
            		<input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}" placeholder="Post Excerpt..." autocomplete="off" aria-describedby="excerptHelp" class="form-control @if( $errors->has('excerpt') ) field-error @endif">
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
            		<textarea class="form-control @if( $errors->has('content') ) field-error @endif" name="content" id="content" placeholder="Post Content..." aria-describedby="contentHelp" minlength="3">{{ old('content') }}</textarea>
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

            	<div class="form-group">
            		<label for="image">Image</label>
            		<input type="file" name="image" id="image" class="form-control-file" aria-describedby="imageHelp">
            		<small class="form-text text-muted" id="imageHelp">Upload post image.</small>
            	</div>

            	<input type="hidden" name="userID" value="{{ Auth::user()->id }}">

            	<button type="submit" class="btn btn-primary">ADD POST</button>
            	@csrf
            </form>
        </div>
    </div>
</div>
@endsection