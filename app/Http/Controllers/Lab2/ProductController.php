<?php

namespace App\Http\Controllers\Lab2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ProductController extends Controller
{
    public function listProducts() {
        $products = DB::table('product')
        ->join('category', 'category.id', '=', 'product.category_id')
        ->select('product.id', 'product.name', 'product.price', 'product.view' , 'category.name as categoryName')
        ->orderBy('view', 'desc')
        ->get();
        return view('lab2.index', compact('products'));
    }

    public function addProducts() {
        $categories = DB::table('category')->get();
        return view('lab2.add', compact('categories'));
    }

    public function addPostProducts(Request $request) {
        DB::table('product')->insert(
            [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'view' => 1,
                'create_at' => Carbon::now(),
                'update_at' => Carbon::now(),
            ]
        );

        return redirect()->route('products.listProducts');
    }

    public function editProducts($idProduct) {
        $product = DB::table('product')->find($idProduct);
        $categories = DB::table('category')->get();
        return view('lab2.edit', compact('product', 'categories'));
    }

    public function editPutProducts(Request $request) {
        DB::table('product')->update(
            [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'view' => 1,
                'create_at' => Carbon::now(),
                'update_at' => Carbon::now(),
            ]
        );

        return redirect()->route('products.listProducts');
    }



    // public function deleteProducts($idProduct) {
    //     DB::table('product')->delete($idProduct);
    //     return redirect()->route('products.listProducts');
    // }

    public function deleteProducts(Request $request) {
        DB::table('product')->delete($request->productId);
        return redirect()->route('products.listProducts');
    }

    public function searchProduct(Request $request) {
        $result = DB::table('product')->where('name', 'like', "%$request->searchName%")->select('name')->get();
        // return response()->json($result);
        return $result;
    }
}
