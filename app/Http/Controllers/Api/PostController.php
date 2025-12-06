<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    //lấy danh sách bài viết
    public function index()
    {
        $posts = Post::query()->orderBy('id', 'desc')->paginate(10);
        return response()->json([
            'message'   => 'Danh sách bài viết',
            'data'      => $posts
        ], 200);
    }

    //Lấy 1 bài viết
    public function show($id)
    {
        $post = Post::query()->find($id);
        if ($post) {
            return response()->json([
                'message'       => "Bài viết có id: " . $post->id,
                'data'          => $post
            ], 200);
        } else {
            return response()->json([
                'message'   => 'Bài viết không tồn tại'
            ], 404);
        }
    }

    //Thêm
    public function store(Request $request)
    {
        //Validate dữ liệu
        $validator = Validator::make(
            $request->all(),
            [
                'title'       => ['required', 'string', 'unique:posts,title', 'max:255'],
                'description' => ['nullable', 'string', 'max:255'],
                'content'     => ['nullable', 'string'],
                'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp',  'max:2048'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
            ],
            [
                // Custom message cho từng rule
                'title.required'       => 'Bạn phải nhập tiêu đề bài viết',
                'title.unique'          => 'Tiêu đề bài viết đã tồn tại',
                'title.max'            => 'Tiêu đề không được vượt quá 255 ký tự',
                'description.max'      => 'Mô tả không được vượt quá 255 ký tự',
                'category_id.required' => 'Vui lòng chọn danh mục',
                'category_id.exists'   => 'Danh mục bạn chọn không tồn tại',

                'image.image'    => 'File tải lên phải là một hình ảnh',
                'image.mimes'    => 'Ảnh phải có định dạng: jpg, jpeg, png hoặc webp',
                'image.max'      => 'Dung lượng ảnh không được vượt quá 2MB',
            ]
        );

        //Nếu có lỗi input
        if ($validator->fails()) {
            return response()->json([
                'errors'   => $validator->errors()
            ]);
        }

        $data = $request->except('image');
        //Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');
            $data['image'] = $image;
        }
        //Lưu vào database
        Post::query()->create($data);
        return response()->json([
            'message'      => "Thêm dữ liệu thành công",
            'data'         => $data
        ], 201);
    }

    //Xóa
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        if (!$post) {
            return response()->json([
                'message'   => "bài viết không tồn tại"
            ], 404);
        }
        $post->delete();
        Storage::delete($post->image);

        return response()->json([
            'message'   => 'Xóa dữ liệu thành công',
            'data'      => $post
        ], 200);
    }

    //Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'       => ['required', 'string', 'max:255', Rule::unique('posts', 'title')->ignore($id)],
                'description' => ['nullable', 'string', 'max:255'],
                'content'     => ['nullable', 'string'],
                'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp',  'max:2048'],
                'category_id' => ['required', 'integer', 'exists:categories,id'],
            ],
            [
                // Custom message cho từng rule
                'title.required'       => 'Bạn phải nhập tiêu đề bài viết',
                'title.unique'          => 'Tiêu đề bài viết đã tồn tại',
                'title.max'            => 'Tiêu đề không được vượt quá 255 ký tự',
                'description.max'      => 'Mô tả không được vượt quá 255 ký tự',
                'category_id.required' => 'Vui lòng chọn danh mục',
                'category_id.exists'   => 'Danh mục bạn chọn không tồn tại',

                'image.image'    => 'File tải lên phải là một hình ảnh',
                'image.mimes'    => 'Ảnh phải có định dạng: jpg, jpeg, png hoặc webp',
                'image.max'      => 'Dung lượng ảnh không được vượt quá 2MB',
            ]
        );
        //Nếu có lỗi input
        if ($validator->fails()) {
            return response()->json([
                'errors'   => $validator->errors()
            ]);
        }

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

        return response()->json([
            'message'   => 'Cập nhật dữ liệu thành công',
            'data'      => $post
        ], 200);
    }
    
}
