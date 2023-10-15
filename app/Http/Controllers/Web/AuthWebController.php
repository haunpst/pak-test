<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthWebController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($validate)) {
                return redirect()->route('product.list');
            } else {
                return redirect()->back()
                    ->withErrors(['error' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
            }
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required|min:6|confirmed',
            ];

            $messages = [
                'name.required' => 'Tên người dùng là bắt buộc.',
                'username.required' => 'Tên đăng nhập là bắt buộc.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.min' => 'Mật khẩu phải từ 6 kí tự.',
                'password.confirmed' => 'Mật khẩu xác thực không chính xác.',
            ];

            Validator::make($request->all(), $rules, $messages)->validate();

            if (User::isUsernameTaken($request->username))
                return redirect()->back()->withErrors(['error' => 'Tên người dùng đã tồn tại']);

            try {
                $user = new User();
                $user->name = $request->name;
                $user->username = $request->username;
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công!');
            } catch (\Throwable $e) {
                return redirect()->back()->withErrors(['error' => 'Xảy ra lỗi, vui lòng thử lại!']);
            }
        }
        return view('auth.register');
    }
}
