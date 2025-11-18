<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/test/{id}', [TestController::class, 'index'])->name('posts.list');
//Route chi tiết bài viết
Route::get('/detail/{id}', [TestController::class, 'show'])->name('posts.detail');

//Nhóm những route admin lại
Route::prefix('admin')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('admin.posts.index');
    //Hiển thị form thêm
    Route::get('/posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    //Lưu dữ liệu khi thêm mới vào CSDL
    Route::post('/posts/create', [PostController::class, 'store'])->name('admin.posts.store');
    //Hiển thị form edit (cập nhật
    Route::get('/posts/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');
    //Lưu dữ liệu khi cập nhật vào CSDL
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    //Xóa dữ liệu
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    //Hiển thị chi tiết
    Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('admin.posts.show');
});
