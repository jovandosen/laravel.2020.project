@extends('layouts.app')

@section('title', '| Genre List')

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
  					@foreach( $genres as $genre )
  						@php
  							$genreAuthor = DB::table('users')->where('id', $genre->user_id)->first();
  							$genreAuthorName = $genreAuthor->name;
  						@endphp
  						<tr>
  							<td>{{ $genre->name }}</td>
  							<td>{{ $genre->description }}</td>
  							<td>{{ $genreAuthorName }}</td>
  							<td>{{ $genre->created_at->diffForHumans() }}</td>
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