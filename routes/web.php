<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SinhVienController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//GET, POST, PUT, PATCH, DELETE(method)
// Base url: http://127.0.0.1:8000

// Route: http://127.0.0.1:8000/test
// Route được viết theo chuẩn sale(Ngăn cách các từ bằng "-", không dấu, viết thường)
// VD: http://127.0.0.1:8000/san-pham
Route::get('test', function() {
    echo "123";
});

// Route: http://127.0.0.1:8000
Route::get('/', function() {
    echo "Trang chu";
});

Route::get('list-products', [ProductController::class, 'showProduct']);

// Truyền dữ liệu từ Route => Controller
// Truyền Slug
// Route: http://127.0.0.1:8000/get-product/3
Route::get('get-product/{id}/{name?}', [ProductController::class, 'getProduct']);

// Truyền Params
// Route: http://127.0.0.1:8000/get-product?id=3&name=iphone
Route::get('update-product', [ProductController::class, 'updateProduct']);
Route::get('thongtinsv', [SinhVienController::class, 'index']);