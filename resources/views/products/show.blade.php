@extends('layouts.app')

<style>
    /* Basic Container Styles */
    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        color: #333;
    }

    /* Error Message Styling */
    .alert {
        margin-top: 20px;
        font-size: 16px;
        padding: 15px;
        background-color: #f8d7da;
        border-radius: 5px;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert ul {
        padding-left: 20px;
        list-style-type: none;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 6px;
        color: #444;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        background-color: #fdfdfd;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 4px rgba(40, 167, 69, 0.5);
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
                    <div class="col-md-6">
                        <td class="text-center">
                            @if(Str::startsWith($product->image_url, ['http://', 'https://']))
                                <img src="{{ $product->image_url }}" alt="Ảnh sản phẩm" width="120">
                            @else
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="Ảnh sản phẩm" width="120">
                            @endif
                        </td>
                    </div>
                    <div class="col-md-6">
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
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
