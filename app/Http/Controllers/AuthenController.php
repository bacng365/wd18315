<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Session;

class AuthenController extends Controller
{
    public function register() {
        return view('register');
    }

    public function postRegister(Request $request) {
        $check = User::where('email', $request->email)->exists();
        if ($check) {
            return back()->with([
                'message' => 'Email đã tồn tại'
            ]);
        } else {
            if ($request->password == $request->confirm_password) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                // Auth::login(['email' => $request->email,'password' => $request->password]);
                // return redirect()->route('dashboard')

                return redirect()->route('login')->with(['message' => 'Đăng ký thành công']);
            }
            return back()->with([
                'message' => 'Mật khẩu không khớp'
            ]);
        }
    }

    public function login() {
        return view('login');
    }

    public function postLogin(Request $request) {
        $remember = $request->has('remember');
        if (Auth::attempt(['email' => $request->email,'password' => $request->password], $remember)) {
            // Logout hết các tài khoản khác
            Session::where('user_id', Auth::id())->delete();
            // Tạo phiên đăng nhập mới
            session()->put('user_id', Auth::id());

            // Đăng nhập thành công
            if (Auth::user()->role == '1') {
                return redirect()->route('admin.products.listProduct')->with([
                    'message' => 'Đăng nhập thành công'
                ]);
            } else {
                // Đăng nhập vào user
                echo "Đăng nhập vào user";
            }
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->with([
                'message' => 'Email hoặc mật khẩu không đúng'
            ]);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with([
            'message' => 'Đăng xuất thành công'
        ]);
    }
}
