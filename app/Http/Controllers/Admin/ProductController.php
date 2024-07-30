<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function listProduct() {
        $listProduct = Product::paginate(7);
        return view('admin.products.list-product')->with([
            'listProduct' => $listProduct
        ]);
    }

    public function addProduct() {
        return view('admin.products.add-product');
    }

    public function addPostProduct(Request $req) {
        // $product = new Product();
        // $product->name = $req->nameSP;
        // $product->price = $req->priceSP;
        // $product->save();
        $linkImage = '';
        if ($req->hasFile('imageSP')) {
            $image = $req->file('imageSP');
            $newName = time() . '.' . $image->getClientOriginalExtension();
            $linkStorage = 'imageProducts/';
            $image->move(public_path($linkStorage), $newName);

            $linkImage = $linkStorage.$newName;
        }
        $data = [
            'name' => $req->nameSP,
            'price' => $req->priceSP,
            'image' => $linkImage
        ];

        Product::create($data);

        return redirect()->route('admin.products.listProduct')->with([
            'message' => 'Thêm mới dữ liệu thành công'
        ]);
    }

    public function deleteProduct(Request $req) {
        $product = Product::where('id', $req->idProduct)->first();
        if ($product->image != null && $product->image != '') {
            File::delete(public_path($product->image));
        }

        Product::where('id', $req->idProduct)->delete();
        return redirect()->route('admin.products.listProduct')->with([
            'message' => 'Xóa thành công'
        ]); 
    }

    public function detailProduct($idProduct) {
        $product = Product::where('id', $idProduct)->first();
        return view('admin.products.detail-product')->with([
            'product' => $product
        ]);
    }

    public function updateProduct($idProduct) {
        $product = Product::where('id', $idProduct)->first();
        return view('admin.products.update-product')->with([
            'product' => $product
        ]);
    }

    public function updatePatchProduct($idProduct, Request $request) {
        $product = Product::where('id', $idProduct)->first();
        $linkImage = $product->image;
        if ($request->hasFile('imageSP')) {
            File::delete(public_path($product->image));
            $image = $request->file('imageSP');
            $newName = time() . "." . $image->getClientOriginalExtension();
            $linkStorage = 'imageProduct/';
            $image->move(public_path($linkStorage), $newName);
            $linkImage = $linkStorage . $newName;
        }
        
        $data = [
            'name' => $request->nameSP,
            'price' => $request->priceSP,
            'image' => $linkImage
        ];

        Product::where('id', $idProduct)->update($data);
        
        return redirect()->route('admin.products.listProduct')->with([
            'message' => 'Sửa thành công'
        ]); 
    }
}
