<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        //Lấy dữ liệu của bảng posts
        $posts = DB::table('posts')->get();

        return view('test', compact('posts'));
    }
}
