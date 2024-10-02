@extends('admin.layout')
@section('title', 'Thêm bài viết')

@section('content')
    @if (session('message'))
        <div class="alert bg-primary text-white">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="">Title</label>
            <input type="text" name="title" id="" value="{{ $post->title }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label> <br>
            <img src="{{ Storage::url($post->image) }}" width="100" alt="">
            <input type="file" name="image" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control" rows="3">{{ $post->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="">Content</label>
            <textarea name="content" id="" class="form-control" rows="6">{{ $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="">Category Name</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}" @if ($cate->id == $post->category_id) selected @endif>
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
