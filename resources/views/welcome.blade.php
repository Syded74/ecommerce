<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .welcome-title {
            font-size: 3rem;
            color: #333;
        }
        .welcome-subtitle {
            font-size: 1.5rem;
            color: #666;
        }
        .nav-links {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .nav-links a {
            margin-left: 10px;
            font-weight: 600;
            color: #555;
            text-decoration: none;
        }
        .nav-links a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="nav-links">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>

    <div class="container">
        <h1 class="welcome-title">Welcome to Laravel E-Commerce</h1>
        <p class="welcome-subtitle">Your gateway to a great shopping experience</p>
    </div>
</body>
</html>