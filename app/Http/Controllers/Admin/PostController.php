<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    //Hiển thị dữ liệu đã xóa
    public function listPostTrash()
    {
        $posts = Post::onlyTrashed()->paginate(8);
        return view('admin.posts.trash', compact('posts'));
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

    //Xóa dữ liệu
    public function destroy(Post $post)
    {
        //Xóa ảnh
        Storage::delete($post->image);
        //Xóa dữ liệu
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Xóa dữ liệu thành công');
    }

    //Hiển thị form cập nhật
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    //Cập nhật dữ liệu
    public function update(Request $request, Post $post)
    {
        $data = $request->except('image');

        //Nếu cập nhật ảnh
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $data['image'] = $path;
            //Xóa ảnh cũ
            Storage::delete($post->image);
        }

        //Cập nhật dữ liệu
        $post->update($data);

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }

    //Khôi phục dữ liệu đã xóa
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.post.trashed')->with('message', 'Khôi phục dữ liệu thành công');
    }
}
