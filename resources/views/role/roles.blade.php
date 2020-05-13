@extends('layouts.app')

@section('title', '| All Roles')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<table class="table table-bordered table-hover">
				<thead>
				    <tr>
				      	<th scope="col">Name</th>
				      	<th scope="col">Description</th>
				      	<th scope="col">Created</th>
				      	<th scope="col">Edit</th>
				      	<th scope="col">Delete</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $roles as $role )
  						<tr>
  							<td>
  								@if( $role->roleName )
  									{{ $role->roleName }}
  								@else
  									<i>{{ __('No Name') }}	</i>
  								@endif
  							</td>
  							<td>
  								@if( $role->roleDescription )
  									{{ $role->roleDescription }}
  								@else
  									<i>{{ __('No Description') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $role->created_at )
  									{{ $role->created_at->diffForHumans() }}
  								@else
  									<i>{{ __('No Created At Detail') }}</i>	
  								@endif
  							</td>
  							<td>
  								<a href="#">{{ __('Edit') }}</a>
  							</td>
  							<td>
  								<a href="#">{{ __('Delete') }}</a>
  							</td>
  						</tr>
  					@endforeach
  				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection