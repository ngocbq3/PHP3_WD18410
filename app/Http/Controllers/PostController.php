<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    public function home()
    {
        //Hiển thị 8 bài viết mới nhất
        $posts = DB::table('posts')
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        return view('home', compact('posts'));
    }

    //Hiển thị danh sách bài viết theo danh mục
    public function list($id)
    {
        $posts = DB::table('posts')
            ->where('category_id', $id)
            ->get();

        return view('list-post', compact('posts'));
    }

    //Hiển thị chi tiết bài viết
    public function detail($id)
    {
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();

        return view('detail', compact('post'));
    }
}
