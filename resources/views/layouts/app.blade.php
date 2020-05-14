<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Laravel 2020') }} @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicon ico -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.jpg') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    @php $message = 'test'; $type = 'success'; @endphp
    <x-package-alert type="error" :message="$message" :type="$type"/>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- 
                            <li class="nav-item">
                                <a href="{{ route('foo') }}" class="nav-link">{{ __('Foo') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('bar') }}" class="nav-link">{{ __('Bar') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('baz') }}" class="nav-link">{{ __('Baz') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('test') }}" class="nav-link">{{ __('Test') }}</a>
                            </li> 
                            -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                    <a class="dropdown-item" href="{{ route('home') }}">{{ __('Home') }}</a>
                                    <a class="dropdown-item" href="{{ route('phone.number') }}">{{ __('Phone Number') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('role.show') }}">{{ __('Add Role') }}</a>
                                    <a class="dropdown-item" href="{{ route('role.list') }}">{{ __('Role List') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('users.list') }}">{{ __('User List') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('post.show') }}">{{ __('Add Post') }}</a>
                                    <a class="dropdown-item" href="{{ route('post.list') }}">{{ __('Post List') }}</a>
                                    <a class="dropdown-item" href="{{ route('category.show') }}">{{ __('Add Category') }}</a>
                                    <a class="dropdown-item" href="{{ route('category.list') }}">{{ __('Category List') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('movie.show') }}">{{ __('Add Movie') }}</a>
                                    <a class="dropdown-item" href="{{ route('movie.list') }}">{{ __('Movie List') }}</a>
                                    <a class="dropdown-item" href="{{ route('genre.show') }}">{{ __('Add Genre') }}</a>
                                    <a class="dropdown-item" href="{{ route('genre.list') }}">{{ __('Genre List') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('product.show') }}">{{ __('Add Product') }}</a>
                                    <a class="dropdown-item" href="{{ route('product.list') }}">{{ __('Product List') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('password.request') }}">{{ __('Reset Password') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
