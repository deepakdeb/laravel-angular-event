<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Event Management</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script type="text/javascript" src="{{ asset('assets/js/lib/jquery-3.1.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dist/jquery.validate.min.js') }}"></script>


    <link href="{{ asset('assets/css/awesome-notifications/style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('assets/js/awesome-notifications/index.var.js') }}"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Auth::user())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('events.index')}}">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registrations.index')}}">Registration</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="content-wrapper">
        @yield('content')
    </div>
</body>

</html>