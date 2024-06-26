<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gynocare</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        html {
            height: 100%;
            width: 100%;
        }

        body{
            height: 100%;
            width: 100%;
        }

        .page-container {
            display: flex;
        }

        .page-container .image {
            flex: 0 0 70%;
            height: 100vh;
            background-image: url({{asset('images/auth-background.jpeg')}});
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .page-container .login {
            width: 30%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <div class="image">
            
        </div>

        <div class="login">
            @yield('content')
        </div>
    </div>
</body>
</html>
