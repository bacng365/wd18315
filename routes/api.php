<?php

use App\Http\Controllers\Api\AuthenController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('products', [ProductController::class, 'getListProduct']);


Route::post('login', [AuthenController::class, 'postLogin']);
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('list-product', [ProductController::class, 'getListProducts']);
    Route::get('product/{idProduct}', [ProductController::class, 'getProduct']);
    Route::post('product', [ProductController::class, 'addProduct']);
    Route::patch('product', [ProductController::class, 'updateProduct']);
    Route::delete('product', [ProductController::class, 'deleteProduct']);
});