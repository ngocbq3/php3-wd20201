<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //Danh sách bài viết theo danh muc: $id là id danh mục
    public function index($id)
    {
        //Lấy dữ liệu của bảng posts
        // $posts = DB::table('posts')->get();
        //Lấy dữ liệu có phân trang theo danh mục
        $posts = DB::table('posts')
            ->where('category_id', $id)
            ->paginate(10);

        return view('test', compact('posts'));
    }
    //Hiển thị chi tiết bài viết
    public function show($id)
    {
        //lấy ra 1 bài viết
        $post = DB::table('posts')
            ->where('id', $id)
            ->first();

        //gọi view
        return view('detail', compact('post'));
    }
}
