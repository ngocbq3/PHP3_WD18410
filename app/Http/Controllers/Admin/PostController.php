<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $posts = Post::query()->latest('id')->paginate(8);

        return view('admin.posts.index', compact('posts'));
    }

    //Hiển thị form create
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    //Tạo mới dữ liệu
    public function store(Request $request)
    {
        $data = $request->except('image');

        //Khi chưa có hình ảnh
        $path = "";
        //Khi có hình
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
        }
        //Đưa đường dẫn hình vào data
        $data['image'] = $path;

        //Insert data
        Post::query()->create($data);

        return redirect()->route('admin.posts.index')->with('message', 'Thêm dữ liệu thành công');
    }
}
