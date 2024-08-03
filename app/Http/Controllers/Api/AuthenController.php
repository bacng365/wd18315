<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthenController extends Controller
{
    public function postLogin(Request $req) {
        if (Auth::attempt(['email' => $req->email,'password' => $req->password])) {
            if (Auth::user()->role == '1') {
                DB::table('personal_access_tokens')->where('tokenable_id', Auth::id())->delete();
                $token = User::find(Auth::id())->createToken('AuthToken')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'message' => 'Đăng nhập thành công',
                    'status_code' => '200'
                ], 200);
            }
        }

        return response()->json([
            'message' => 'Đăng nhập thất bại',
            'status_code' => '200'
        ], 200);

        // ->header('Access-Control-Allow-Origin', 'http://127.0.0.1:5000')
    }
}
