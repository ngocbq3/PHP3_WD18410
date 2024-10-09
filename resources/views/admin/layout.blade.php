<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin -- @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav>Menu

            @if (Auth::check())
                <div>
                    <b>{{ Auth::user()->email }}</b>
                    <a href="{{ route('logout') }}" class=>Logout</a>
                </div>
            @endif
        </nav>

        @yield('content')

        <footer>
            Footer
        </footer>
    </div>
</body>

</html>
