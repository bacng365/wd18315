@extends('admin.layouts.default')

@section('title')
    @parent
    Chỉnh sửa sản phẩm 
@show

@push('styles')
    <style>
        .img-product {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="p-4" style="min-height: 800px;">
        <h4 class="text-primary mb-4">Chỉnh sửa sản phẩm</h4>
        <form action="{{ route('admin.products.updatePatchProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="nameSP">Tên sản phẩm</label>
                <input type="text" id="nameSP" name="nameSP" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label for="nameSP">Giá sản phẩm</label>
                <input type="text" id="priceSP" name="priceSP" class="form-control" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label for="imageSP">Ảnh sản phẩm</label><br>
                <img src="{{ asset($product->image) }}" alt="" class="img-product">
                <input type="file" id="imageSP" name="imageSP" class="form-control">
            </div>
            <button class="btn btn-success">Sửa sản phẩm</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
