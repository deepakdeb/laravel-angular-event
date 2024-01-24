<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <div class="content-wrapper">
        @yield('content')
    </div>
</body>

</html>