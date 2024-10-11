<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //danh sách
    public function index()
    {
        $posts = Post::query()->latest('id')->paginate(10);
        return response()->json([
            'success' => true,
            'message' => 'Danh sách bài Post',
            'data' => $posts,
        ]);
    }

    //Chi tiết
    public function show($id)
    {
        try {
            $post = Post::query()->findOrFail($id);
            return response()->json([
                'success' => true,
                'messsage' => 'Chi tiết bài Post',
                'data' => $post
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bài post phù hợp'
            ], 404);
        }
    }

    //xóa
    public function destroy($id)
    {
        try {
            $post = Post::query()->findOrFail($id);
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa bài viết thành công',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Không xóa được dữ liệu',
            ]);
        }
    }

    //Thêm dữ liệu
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['required'],
            'content' => ['required'],
            'category_id' => ['required']
        ]);

        //lỗi dữ liệu
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập dữ liệu',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            //thêm ảnh
            $data['image'] = $this->uploadFile($request, 'image');
            $post = Post::query()->create($data);
            return response()->json([
                'success' => true,
                'message' => 'Thêm dữ liệu thành công',
                'data' => $post,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    //Update
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['required'],
            'content' => ['required'],
            'category_id' => ['required']
        ]);

        //lỗi dữ liệu
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi nhập dữ liệu',
                'errors' => $validator->errors(),
            ]);
        }

        try {
            //lấy dữ liệu
            $post = Post::query()->findOrFail($id);
            //Kiểm tra xem có cập nhật ảnh ko?
            if ($request->hasFile('image')) {
                $data['image'] = $this->uploadFile($request, 'image');
                //xóa ảnh cũ
                if ($post->image) {
                    Storage::delete($post->image);
                }
            } else {
                $data['image'] = $post->image; //giữ lại ảnh cũ
            }
            $post->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật dữ liệu thành công',
                'data' => $post,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật dữ liệu thất bại',
            ]);
        }
    }

    //upload file
    public function uploadFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('images');
        }
        return '';
    }
}
