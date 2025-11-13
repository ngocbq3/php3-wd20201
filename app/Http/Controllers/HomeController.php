<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //Lấy danh mục
        $categories = DB::table('categories')->get();
        //lấy ra số lượng bài viết
        $posts = DB::table('posts')
            ->limit(8)
            ->orderBy('id', 'desc')
            ->get();
        return view('index', compact('posts', 'categories'));
    }
}
