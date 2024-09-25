@extends('admin.layout')

@section('title', 'Danh sách bài viết')

@section('content')

    <div class="m-5 w-80">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">
                        <a href="#" class="btn btn-primary">Create</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ $post->image }}" width="60" alt="">
                        </td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category_id }}</td>
                        <td>
                            Edit/Delete
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $posts->links() }}
    </div>

@endsection
