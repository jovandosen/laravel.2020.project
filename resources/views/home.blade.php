@extends('layouts.app')

@section('title', '| Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if (session('status'))
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        You are logged in!
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-10 move-search-box">
            <form method="GET" action="{{ route('home') }}" class="form-inline">
                <input type="text" name="search" id="search-movies" class="form-control mr-sm-1" placeholder="Search for movies..." autocomplete="off">
                <button type="submit" class="btn btn-outline-primary">{{ __('Search') }}</button>
            </form>
            <hr>
        </div>

        @if( ! $movies->isEmpty() )

            @foreach( $movies as $movie )
                <div class="col-md-10 move-box">
                    <div class="row">
                        <div class="col-4">
                            <img src='{{ asset("/images/movies/$movie->image") }}' class="img-fluid">
                        </div>
                        <div class="col-8">
                            <h4>{{ $movie->title }}</h4>
                            <hr>
                            <p>{{ $movie->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-10">
                <div class="row justify-content-center">
                    {{ $movies->withQueryString()->links() }}
                </div>
            </div>

        @else
            <div class="col-md-10 move-box">
                <h4>No results.</h4>
            </div>    

        @endif

    </div>
</div>
@endsection
