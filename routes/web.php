<?php

// use App\Http\Controllers\Lab2\ProductController as Lab2ProductController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\SinhVienController;
// use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthenController;

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

// Route: http://127.0.0.1:8000
// Route::get('/', function() {
//     echo "Trang chu";
// });

// Route::get('list-products', [ProductController::class, 'showProduct']);

// Truyền dữ liệu từ Route => Controller
// Truyền Slug
// Route: http://127.0.0.1:8000/get-product/3
// Route::get('get-product/{id}/{name?}', [ProductController::class, 'getProduct']);

// Truyền Params
// Route: http://127.0.0.1:8000/get-product?id=3&name=iphone
// Route::get('update-product', [ProductController::class, 'updateProduct']);
// Route::get('thongtinsv', [SinhVienController::class, 'index']);
// Route::get('query-builder', [ProductController::class, 'queryBuilder']);


// CRUD bảng users
// BASE_URL
// Route: http://127.0.0.1:8000/users/list-users
// Route: http://127.0.0.1:8000/users/add-users
// Route: http://127.0.0.1:8000/users/update-users
// Route: http://127.0.0.1:8000/users/delete-users

// Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
//     Route::get('list-user', [UserController::class, 'listUsers'])->name('listUsers');
//     Route::get('add-user', [UserController::class, 'addUsers'])->name('addUsers');
//     Route::post('add-user', [UserController::class, 'addPostUsers'])->name('addPostUsers');
//     Route::get('delete-user/{idUser}', [UserController::class, 'deleteUsers'])->name('deleteUsers');
//     Route::get('eidt-user/{idUser}', [UserController::class, 'editUsers'])->name('editUsers');
//     Route::put('eidt-user/{idUser}', [UserController::class, 'editPutUsers'])->name('editPutUsers');
// });


// Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
//     Route::get('list-product', [Lab2ProductController::class, 'listProducts'])->name('listProducts');
//     Route::get('add-product', [Lab2ProductController::class, 'addProducts'])->name('addProducts');
//     Route::post('add-product', [Lab2ProductController::class, 'addPostProducts'])->name('addPostProducts');
//     Route::get('edit-product/{idProduct}', [Lab2ProductController::class, 'editProducts'])->name('editProducts');
//     Route::put('eidt-product/{idProduct}', [Lab2ProductController::class, 'editPutProducts'])->name('editPutProducts');
//     // Route::get('delete-product/{idProduct}', [Lab2ProductController::class, 'deleteProducts'])->name('deleteProducts');
//     Route::delete('delete-product', [Lab2ProductController::class, 'deleteProducts'])->name('deleteProducts');
//     Route::get('search-product', [Lab2ProductController::class, 'searchProduct'])->name('searchProduct');
// });



// Route::get('test', function() {
//     return view('admin.products.list-product');
// });

Route::get('register', [AuthenController::class, 'register'])->name('register');
Route::post('register', [AuthenController::class, 'postRegister'])->name('postRegister');

Route::get('login', [AuthenController::class, 'login'])->name('login');
Route::post('login', [AuthenController::class, 'postLogin'])->name('postLogin');
Route::get('logout', [AuthenController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'checkAdmin'], function() {
// Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::group(['prefix' => 'products', 'as' => 'products.'], function() {
        // CRUD products => Resful API
        Route::get('/', [ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('add-product', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::put('add-product', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
        Route::delete('delete-product', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('detail-product/{idProduct}', [ProductController::class, 'detailProduct'])->name('detailProduct');
        Route::get('update-product/{idProduct}', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::patch('update-product/{idProduct}', [ProductController::class, 'updatePatchProduct'])->name('updatePatchProduct');
    });
});