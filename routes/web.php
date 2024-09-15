<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('greeting', function () {
    return "Hello Laravel";
});
Route::get('test', [TestController::class, 'index']);

Route::view('home', 'home');

//Thêm tham số vào URI
Route::get('user/{id}', function ($id) {
    return "USER ID: $id";
});
Route::get('user/{id}/comment/{comment_id}', function ($id, $comment_id) {
    return "User ID: $id có Comment: $comment_id";
});

//Chỉ định cho tham số loại dữ liệu mong muốn (sử dụng regular expression)
Route::get('product/{id}', function ($id) {
    return "PRODUCT ID: $id";
})->where('id', '[0-9]+');

Route::get('product/{id}/user/{name}', function ($id, $name) {
    return "Product id: $id được tạo bởi $name";
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

//Đặt tên cho đường dẫn
Route::get('admin12312', function () {
    return "Đây là trang dashboard";
})->name('dashboard');

//Query builder
Route::get('posts', function () {
    //Lấy tất cả dữ liệu của bảng posts
    // $posts = DB::table('posts')->get();

    //Lấy dữ liệu của các cột được chỉ định
    $posts = DB::table('posts')
        ->select('title', 'description')
        ->get();

    //Lấy dữ liệu theo điều kiện = 
    $posts = DB::table('posts')
        ->where('title', 'A distinctio quibusdam eos.')
        ->get();
    //Lấy dữ liệu theo điều kiện LIKE
    $posts = DB::table('posts')
        ->where('title', 'LIKE', '%rem%')
        ->get();

    //Nối nhiều bảng
    $posts = DB::table('posts')
        ->join('categories', 'categories.id', 'posts.category_id')
        ->get();

    return $posts;
});

Route::get('post/{id}', function ($id) {
    //Lấy 1 bản ghi theo id
    $post = DB::table('posts')
        ->where('id', $id)
        ->first();

    if ($post)
        return $post;
    return "Không có dữ liệu bài viết có ID=$id";
});
