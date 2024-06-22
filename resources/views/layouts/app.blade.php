<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GynoCare</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .body{
            min-height: 100vh;
            height: 100%;
            background-image: url({{asset('images/background.jpeg')}});
            background-repeat: repeat-y;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    @include('navbar.navbar')
    <div id="app" class = "body">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
