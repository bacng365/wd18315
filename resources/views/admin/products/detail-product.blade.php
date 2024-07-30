@extends('admin.layouts.default')

@section('title')
    @parent
    Chi tiết sản phẩm
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
        <p>Tên sản phẩm: <span class="fw-bold">{{ $product->name }}</span></p>
        <p>Giá: <span class="fw-bold">{{ $product->price }}</span></p>
        <p>Hình ảnh: 
            <img src="{{ asset($product->image) }}" class="img-product" alt="">
        </p>
        <a href="{{ route('admin.products.listProduct') }}" class="btn btn-info mt-3">Quay lại</a>
    </div>

@endsection

@push('scripts')
    <script>

    </script>
@endpush
