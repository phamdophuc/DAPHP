@extends('layouts.app')

<style>
    /* Basic Container Styles */
    .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 32px;
        color: #6b46c1;
        font-weight: bold;
    }

    /* Card Style */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #6b46c1;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }

    .card-body {
        padding: 30px;
        background-color: #f9f9f9;
    }

    .row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    /* Product Image Style */
    .product-img {
        width: 100%;
        max-width: 200px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .col-md-6 {
        flex: 1;
    }

    /* Product Info */
    .product-info p {
        font-size: 16px;
        margin-bottom: 12px;
        color: #555;
    }

    .product-info strong {
        color: #6b46c1;
    }

    /* Button Style */
    .btn {
        background-color: #6b46c1;
        color: #fff;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #5733a8;
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>{{ $product->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{ Str::startsWith($product->image_url, ['http://', 'https://']) ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="Ảnh sản phẩm" class="product-img">
                    </div>
                    <div class="col-md-6 product-info">
                        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
                        <p><strong>Thương hiệu:</strong> {{ $product->brand->name }}</p>
                        <p><strong>Giá:</strong> {{ number_format($product->price, 0, ',', '.') }} VND</p>
                        <p><strong>Giá khuyến mãi:</strong> 
                            @if($product->promotion_price)
                                {{ number_format($product->promotion_price, 0, ',', '.') }} VND
                            @else
                                0 VND
                            @endif
                        </p>
                        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                        <a href="{{ route('products.index') }}" class="btn">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
