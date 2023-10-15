<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Tên đăng nhập hoặc mật khẩu không đúng!'], 422);
            }
            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Có lỗi trong quá trình đăng nhập, vui lòng thử lại!'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth('api')->logout();
            return response()->json(['message' => 'Đăng xuất thành công!']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Đăng xuất không thành công!'], 500);
        }
    }
}
