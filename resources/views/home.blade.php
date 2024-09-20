@extends('layout')

@section('title', 'Trang chủ')

@section('content')

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

@endsection
