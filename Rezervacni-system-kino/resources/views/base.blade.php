<!DOCTYPE html>
<html lang="cs-CZ">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('description')" />
    <title>@yield('title', env('APP_NAME'))</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{ env('APP_NAME') }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ url('') }}">Hlavní stránka</a>
        <a class="p-2 text-dark" href="{{ route('performance.index') }}">Správa představení</a>
        <a class="p-2 text-dark" href="{{ route('reservation.index') }}">Správa rezervací</a>
        <a class="p-2 text-dark" href="{{ route('user.index') }}">Správa uživatelů</a>
        <a class="p-2 text-dark" href="{{ route('hall.index') }}">Správa sálů</a>
    </nav>
</div>

<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>

@stack('scripts')
</body>
</html>
