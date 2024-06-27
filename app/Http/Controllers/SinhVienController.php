<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinhVienController extends Controller
{
    public function index() {
        $info = [
            "Tên" => "Nguyễn Hùng Bắc",
            "Mã sinh viên" => "PH31350",
            "Tuổi" => "18",
            "Chuyên ngành" => "Lập trình web - Backend"
        ];

        return view('sinh-vien', compact('info'));
    }
}
