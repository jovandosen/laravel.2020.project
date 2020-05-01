@extends('layouts.app')

@section('title', '| Category List')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">

			<table class="table table-bordered table-hover">
				<thead>
				    <tr>
				      	<th scope="col">Name</th>
				      	<th scope="col">Description</th>
				      	<th scope="col">Author</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $categories as $category )
  						@php
  							$categoryAuthor = DB::table('users')->where('id', $category->user_id)->first();
  							$categoryAuthorName = $categoryAuthor->name;
  						@endphp
  						<tr>
  							<td>{{ $category->name }}</td>
  							<td>{{ $category->description }}</td>
  							<td>{{ $categoryAuthorName }}</td>
  							<td>{{ $category->created_at->diffForHumans() }}</td>
  							<td><a href="#">edit</a></td>
  							<td><a href="#">delete</a></td>
  						</tr>
  					@endforeach
  				</tbody>
			</table>

		</div>
	</div>
</div>
@endsection