<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP3 - @yield('title')</title>
</head>

<body>
    <nav>
        <a href="/">Trang chủ</a> |
        <a href="/user/123">User</a> |
        <a href="">Trang admin</a> |

        <!--Danh sách category-->
        @foreach ($categories as $cate)
            <a href="{{ route('page.list', $cate->id) }}">{{ $cate->name }}</a> |
        @endforeach
    </nav>

    @yield('content')

    <footer>
        FOOTER
    </footer>
</body>

</html>
