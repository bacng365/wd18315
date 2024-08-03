<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function getListProducts() {
        $product = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.id', 'products.name', 'products.price', 'products.description', 'categories.name as category_name')
        ->get();
        
        return response()->json([
            'data' => $product,
            'message' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function getProduct($idProduct) {
        $product = Product::join('categories', 'categories.id', '=', 'products.category_id')
        ->select('products.id', 'products.name', 'products.price', 'products.description', 'categories.name as category_name')
        ->find($idProduct);
        
        return response()->json([
            'data' => $product,
            'message' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function addProduct(Request $req) {
        $data = json_decode($req->getContent());
        $data = [
            'name' => $req->name,
            'price' => $req->price,
            'description' => $req->description,
            'category_id' => $req->category_id
        ];

        $newProduct = Product::create($data);
        return response()->json([
            'data' => $newProduct,
            'message' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function updateProduct(Request $req) {
        $data = [
            'name' => $req->name,
            'price' => $req->price,
            'description' => $req->description,
            'category_id' => $req->category_id
        ];

        $product = Product::find($req->idProduct);
        $product->update($data);
        return response()->json([
            'data' => $product,
            'message' => 'success',
            'status_code' => '200'
        ], 200);
    }

    public function deleteProduct(Request $req) {
        Product::find($req->idProduct)->delete();
        return response()->json([
            'message' => 'success',
            'status_code' => '200'
        ], 200);
    }
}
