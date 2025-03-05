<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name', 'Blog Management System') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7fafc;
            color: #333;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20240102/pngtree-vibrant-gradient-texture-for-a-captivating-birthday-youtube-thumbnail-image_13905332.png');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .content {
            padding: 40px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .title {
            font-size: 3rem;
            font-weight: 600;
        }

        .sub-title {
            font-size: 1.25rem;
            margin-top: 10px;
        }

        .nav-links {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-links a {
            background-color: #202fff;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .nav-links a:hover {
            background-color: #1733e6;
        }

        footer {
            margin-top: 30px;
            color: #f7fafc;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h1 class="title">Welcome to Blog Management System</h1>
            <p class="sub-title">Enjoy Today & Update Knowledge</p>

            <div class="nav-links">
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
