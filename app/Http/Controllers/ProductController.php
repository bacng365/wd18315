<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
