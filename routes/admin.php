<?php

use Illuminate\Support\Facades\Route;

//Nhóm đường dẫn có tiền tố giống nhau
Route::prefix('admin')->group(function () {
    Route::get('product', function () {
        return "Product Page";
    });

    Route::get('category', function () {
        return "Category Page";
    });

    Route::get('users', function () {
        return "User Page";
    });
});
