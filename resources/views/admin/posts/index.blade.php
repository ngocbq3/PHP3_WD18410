@extends('admin.layout')

@section('title', 'Danh sách bài viết')

@section('content')
    @if (session('message'))
        <div class="alert bg-primary text-white">
            {{ session('message') }}
        </div>
    @endif
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
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create</a>
                        <a href="{{ route('admin.post.trashed') }}" class="btn btn-primary">Trashed</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ asset('storage') . '/' . $post->image }}" width="60" alt="">
                        </td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <div class="d-flex gap-1">

                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary mx-1">
                                    Edit
                                </a>

                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc xóa không?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $posts->links() }}
    </div>

@endsection
