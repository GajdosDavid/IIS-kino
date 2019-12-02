<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', env('APP_NAME'))</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Kinema City
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Přihlášení') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrace') }}</a>
                                </li>
                            @endif
                        @else
                            <a class="p-2 text-dark" href="{{ route('reservation.myReservations') }}">Moje rezervace</a>
                            @if (Auth::user()->role == 3)
                                <a class="p-2 text-dark" href="{{ route('user.index') }}">Správa uživatelů</a>
                            @endif
                            @if (Auth::user()->role == 3 || Auth::user()->role == 2 )
                                <a class="p-2 text-dark" href="{{ route('performance.index') }}">Správa událostí</a>
                                <a class="p-2 text-dark" href="{{ route('piece.index') }}">Správa kulturních děl</a>
                                <a class="p-2 text-dark" href="{{ route('hall.index') }}">Správa sálů</a>
                            @endif
                            @if (Auth::user()->role == 3 || Auth::user()->role == 1 )
                                <a class="p-2 text-dark" href="{{ route('reservation.index') }}">Správa rezervací</a>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name.' '.Auth::user()->surname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.edit', Auth::user() )}}">
                                        {{ __('Upravit profil') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('change.password', Auth::user() )}}">
                                        {{ __('Změnit heslo') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odhlásit se') }}
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
        <div  class="info-container">
            @if ($errors->any())
                <ul >
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            @yield('content')
        </div>
        @yield('footer')
        @stack('scripts')
    </div>
</body>
</html>
