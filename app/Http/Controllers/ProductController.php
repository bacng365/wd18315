<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showProduct() {
        // return 'Chi tiết san pham';
        $data = [
            [
                'id' => '1',
                'name' => 'iphone14',
            ],
            [
                'id' => '2',
                'name' => 'iphone15',
            ],
        ];
        return view('list-product')->with([
            'listProduct' => $data
        ]);
        // return view('list-product', compact($data));
    }

    public function getProduct($id, $name='') {
        return $id.$name;
    }

    public function updateProduct(Request $request) {
        echo $request->id;
        echo $request->name;
    }

    public function queryBuilder() {
        $idBanGiamHieu = DB::table('phongban')->where('ten_donvi', 'like', 'Ban giám hiệu')->value('id');
        $idPhongDaoTao = DB::table('phongban')->where('ten_donvi', 'like', 'Ban đào tạo')->value('id');
        // dd($idPhongDaoTao);

        // 1. Lấy danh sách toàn bộ user
        $question1 = DB::table('users')->get();
        
        // 2. Lấy thông tin user có id = 4 
        $question2 = DB::table('users')->where('id', 4)->first();
        // $question3 = DB::table('users')->where('id', '=', 16)->value('name');

        // 3. Lấy thuộc tính 'name' của user có id = 16
        $question3 = DB::table('users')->where('id', 16)->value('name');
        
        // 4. Lấy danh sách idUser của phòng ban 'Ban giám hiệu'
        $question4 = DB::table('users')->where('phongban_id', $idBanGiamHieu)->pluck('id');
        
        // 5. Tìm user có độ tuổi lớn nhất trong công ty 
        // $question5 = DB::table('users')->max('tuoi');
        $question5 = DB::table('users')->where('tuoi', DB::table('users')->max('tuoi'))->get();

        // 6. Tìm user có độ tuổi nhỏ nhất trong công ty
        // $question6 = DB::table('users')->min('tuoi');
        $question5 = DB::table('users')->where('tuoi', DB::table('users')->min('tuoi'))->get();

        // 7. Đếm xem phòng ban 'Ban giám hiệu' có bao nhiêu user
        $question7 = DB::table('users')->select('id')->where('phongban_id', $idBanGiamHieu)->count();

        // 8. Lấy danh sách tuổi các user 
        $question8 = DB::table('users')->distinct()->pluck('tuoi');

        // 9. Tìm danh sách user có tên 'Khải' hoặc có tên 'Thanh'
        $question9 = DB::table('users')->where('name', 'like', '%Khải')->orWhere('name', 'like', '%Thanh')->get();

        // 10. Lấy danh sách user ở phòng ban 'Ban đào tạo'
        // $question10 = DB::table('users')->where('phongban_id', $idPhongDaoTao)->get();
        $question10 = DB::table('users')->where('phongban_id', $idPhongDaoTao)->select('id', 'name', 'email')->get();
        
        // 11. Lấy danh sách user có tuổi lớn hơn hoặc bằng 30, danh sách sắp xếp tăng dần
        $question11 = DB::table('users')->where('tuoi', '>=', 30)->orderBy('tuoi')->get();
        
        // 12. Lấy danh sách 10 user sắp xếp giảm dần độ tuổi, bỏ qua 5 user đầu tiên
        $question12 = DB::table('users')->orderBy('tuoi', 'desc')->offset(5)->limit(10)->get();

        // 13. Thêm một user mới vào công ty
        // $question13 = DB::table('users')->insert([
        //     'name' => 'huy2',
        //     'email' => 'huyng12@gmail.com',
        //     'phongban_id' => 1,
        //     'songaynghi' => 10,
        //     'tuoi' => 20,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);
        $newIdUser = DB::table('users')->insertGetId([
            'name' => 'huy3',
            'email' => 'huyng13@gmail.com',
            'phongban_id' => 1,
            'songaynghi' => 12,
            'tuoi' => 20,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $newUserInfo = DB::table('users')->find($newIdUser);

        // 14. Thêm chữ 'PĐT' sau tên tất cả user ở phòng ban 'Ban đào tạo'
        $userNames = DB::table('users')->where('phongban_id', $idPhongDaoTao)->get();
        foreach ($userNames as $userName) {
            DB::table('users')->where('id', $userName->id)->update([
                'name' => $userName->name . ' PĐT', 
            ]);
        }

        // 15. Xóa user nghỉ quá 15 ngày
        // $question15 = DB::table('users')->where('songaynghi', '>', 15)->delete();

        // dd($question15);
        // Buoi sau: join, truy van long, rawQuery
    }
}
