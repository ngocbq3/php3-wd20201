<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login Api sử dụng sanctum
    public function login(Request $request)
    {
        //Lấy ra user theo $email
        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'   => "Email hoặc mật khẩu không chính xác"
            ]);
        }
        //Tạo token lưu trữ cho việc đăng nhập thành công
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'   => 'Đăng nhập thành công',
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ]);
    }

    //Đăng xuất
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'   => 'Đăng xuất thành công'
        ]);
    }

    //Đăng ký
    public function register(Request $request)
    {
        $data = $request->all();

        $user = User::query()->create($data);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'   => 'Đăng ký thành công',
            'access_token'  => $token,
            'data'  => $user
        ], 201);
    }
}
