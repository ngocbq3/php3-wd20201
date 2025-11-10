<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return "<h1>Trang giới thiệu</h1>";
});
//Định nghĩa tham số
Route::get('/users/{id}', function ($id) {
    return "User có id: $id";
});
Route::get('/users/{id}/{comment_id}', function ($id, $comment_id) {
    return "User id: $id có bình luận $comment_id";
})->name('users.comment');
//Điều kiện cho tham số
Route::get('/posts/{id}', function ($id) {
    return "POST ID: $id";
})->where('id', "[0-9]+");

//Nhóm đường dẫn
Route::prefix('admin')->group(function () {
    Route::get('/products', function () {
        return "Trang quản trị sản phẩm";
    })->name('admin.products');
    Route::get('/posts', function () {
        return "Trang quản trị bài viết";
    })->name('admin.posts');
});

Route::get('/test', [TestController::class, 'index']);
