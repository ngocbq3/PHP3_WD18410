<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HOME</title>
</head>

<body>
    <h1>Trang HOME</h1>
    <nav>
        <a href="/">Trang chủ</a> |
        <a href="/user/123">User</a> |
        <a href="">Trang admin</a> |

        <!--Danh sách category-->
        @foreach ($categories as $cate)
            <a href="#">{{ $cate->name }}</a> |
        @endforeach
    </nav>

    <!--Hiển thị dữ liệu-->
    @foreach ($posts as $post)
        <div>
            <a href="#">
                <h3>{{ $post->title }}</h3>
            </a>
            <p>{{ $post->description }}</p>
            <hr>
        </div>
    @endforeach
</body>

</html>
