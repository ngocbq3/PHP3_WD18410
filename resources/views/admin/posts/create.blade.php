@extends('admin.layout')
@section('title', 'Thêm bài viết')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="">Title</label>
            <input type="text" name="title" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Image</label>
            <input type="text" name="image" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="">Content</label>
            <textarea name="content" id="" class="form-control" rows="6"></textarea>
        </div>
        <div class="mb-3">
            <label for="">Category Name</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}">
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create new</button>
        </div>
    </form>
@endsection
