@extends('layouts.app')

@section('title', '| All Users')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<table class="table table-bordered table-hover">
				<thead>
				    <tr>
				      	<th scope="col">Name</th>
				      	<th scope="col">Email</th>
				      	<th scope="col">Created</th>
				    </tr>
  				</thead>
  				<tbody>
  					@foreach( $users as $user )
  						<tr title="Click on row to assign Roles to User" onclick="getUserDataAndRedirect(this)" id="{{ $user->id }}">
  							<td>
  								@if( $user->name )
  									{{ $user->name }}
  								@else
  									<i>{{ __('No Name') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $user->email )
  									{{ $user->email }}
  								@else
  									<i>{{ __('No Email') }}</i>	
  								@endif
  							</td>
  							<td>
  								@if( $user->created_at )
  									{{ $user->created_at->diffForHumans() }}
  								@else
  									<i>{{ __('No Created At Data') }}</i>	
  								@endif
  							</td>
  						</tr>
  					@endforeach
  				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection