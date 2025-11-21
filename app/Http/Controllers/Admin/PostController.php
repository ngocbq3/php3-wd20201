<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Lấy toàn bộ dự liệu bảng posts
        // $posts = Post::all();
        //Phân trang
        // $posts = Post::query()->paginate(10);

        $posts = Post::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }
        //Lưu vào database
        Post::query()->create($data);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        //lấy bài viết
        $post = Post::query()->find($id);
        //gọi view
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::query()->find($id);
        //Lấy dữ liệu cập nhật
        $data = $request->except('image');
        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }

        //Cập nhật vào CSDL
        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Cập nhật dữ liệu thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::query()->find($id);
        $post->delete();
        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Xóa dữ liệu thành công');
    }
}
