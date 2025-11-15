<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/test/{id}', [TestController::class, 'index'])->name('posts.list');
//Route chi tiết bài viết
Route::get('/detail/{id}', [TestController::class, 'show'])->name('posts.detail');

Route::get('/admin/posts', [PostController::class, 'index']);
