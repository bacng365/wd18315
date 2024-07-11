<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function listUsers() {
        $data = DB::table('users')
        ->join('phongban', 'users.phongban_id', '=', 'phongban.id')
        ->select('users.name', 'users.email', 'phongban.ten_donvi', 'users.id', 'phongban.id as idPhongBan')
        // ->latest()
        ->get();
        return view('users.list-user')->with([
            'listUsers' => $data
        ]);

        
    }

    public function addUsers() {
        $phongBans = DB::table('phongban')->select('id', 'ten_donvi')->get();
        return view('users/add-user')->with([
            'phongBans' => $phongBans
        ]);
    }

    public function addPostUsers(Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phongban_id' => $request->phongban_id,
            'tuoi' => $request->age,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        
        $request->validate(
            [
                'name' => 'required',
                // 'email' => "required|email|unique:users,email,$user->id",
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'age' => 'required|integer',
                'phongban_id' => ['required', Rule::in(DB::table('phongban')->pluck('id'))]
            ],
            [
                'name.required' => 'Không được để trống tên',
                'email.required' => 'Không được để trống email',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'age.required' => 'Không được để trống tuổi',
                'age.integer' => 'Tuổi phải là số',
                'phongban_id.required' => 'Phải lựa chọn phòng ban',
                'phongban_id.in' => 'Phòng ban không hợp lệ',
            ]
        );
        
        DB::table('users')->insert($data);


        // return redirect('users/list-user');
        return redirect()->route('users.listUsers')->with('msg', 'Thêm user thành công');
    }

    public function editUsers($idUser) {
        $user = DB::table('users')->where('id', $idUser)->first();
        $phongBans = DB::table('phongban')->select('id', 'ten_donvi')->get();
        return view('users/edit-user')->with([
            'user' => $user,
            'phongBans' => $phongBans
        ]);
    }

    public function editPutUsers(Request $request, $idUser) {
        $user = DB::table('users')->find($idUser);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tuoi' => $request->age,
            'phongban_id' => $request->phongban_id,
            'updated_at' => Carbon::now(),
        ];
        $request->validate(
            [
                'name' => 'required',
                // 'email' => "required|email|unique:users,email,$user->id",
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'age' => 'required|integer',
                'phongban_id' => ['required', Rule::in(DB::table('phongban')->pluck('id'))]
            ],
            [
                'name.required' => 'Không được để trống tên',
                'email.required' => 'Không được để trống email',
                'email.email' => 'Email không hợp lệ',
                'email.unique' => 'Email đã tồn tại',
                'age.required' => 'Không được để trống tuổi',
                'age.integer' => 'Tuổi phải là số',
                'phongban_id.required' => 'Phải lựa chọn phòng ban',
                'phongban_id.in' => 'Phòng ban không hợp lệ',
            ]
        );

        DB::table('users')->where('id', $idUser)->update($data);
        return back()->with('msg', 'Cập nhật thành công');
    }

    public function deleteUsers($idUser) {
        
        DB::table('users')->delete($idUser);
        return redirect()->route('users.listUsers');
    }
}
