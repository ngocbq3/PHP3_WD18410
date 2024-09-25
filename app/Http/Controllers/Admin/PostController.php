<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function test()
    {
        //Lấy toàn bộ dữ liệu
        $posts = Post::all();
        //Lấy dữ liệu theo số lượng
        $posts = Post::query()
            ->latest('id')
            ->limit(10)
            ->get();
        //Điều kiện
        $posts = Post::query()
            ->where('category_id', 1)
            ->get();

        return $posts;
    }

    public function index()
    {
        //Phân trang
        $posts = Post::query()->paginate(8);

        return view('admin.posts.index', compact('posts'));
    }
}
