@extends('layouts.app')

@section('title', '| Edit Category')

@section('content')
<div class="container">
	@if( session()->has('categoryUpdated') )
        <div class="row justify-content-center" id="flash-message-box">
              <div class="col-md-8">
                    <div class="alert alert-success" role="alert" id="flash-message-content">
                          {{ session()->get('categoryUpdated') }}
                    </div>
              </div>      
        </div>      
   	@endif
	<div class="row justify-content-center">
		<div class="col-md-8">

			<form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}" id="update-category-form">
				
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Category name..." autocomplete="off" class="form-control @if( $errors->has('name') ) field-error @endif" aria-describedby="nameHelp" maxlength="255" minlength="3" value="{{ $category->name }}">
					<small id="nameHelp" class="form-text text-muted">
						@if( $errors->has('name') )
            				<font color="red">
            					{{ $errors->first('name') }}
            				</font>
            			@else
            				Please enter category name.
            			@endif
					</small>
				</div>

				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control @if( $errors->has('description') ) field-error @endif" aria-describedby="descriptionHelp" placeholder="Category description..." minlength="3">{{ $category->description }}</textarea>
					<small id="descriptionHelp" class="form-text text-muted">
						@if( $errors->has('description') )
            				<font color="red">
            					{{ $errors->first('description') }}
            				</font>
            			@else
            				Please enter category description.
            			@endif
					</small>
				</div>

				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal">EDIT CATEGORY</button>
				@method('PATCH')
				@csrf

			</form>

		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Update Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{ __('Are You sure You want to update this Category ?') }}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-send="" id="confirm-yes" onclick="confirmCategoryUpdate()">Yes</button>
              </div>
          </div>
      </div>
</div>

@endsection