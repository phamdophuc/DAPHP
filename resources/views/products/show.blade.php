@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>{{ $product->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-fluid rounded shadow">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p class="mb-3"><strong>Danh mục:</strong> {{ isset($product->category) ? $product->category->name : 'Chưa phân loại' }}</p>
                        <p class="mb-3"><strong>Thương hiệu:</strong> {{ isset($product->brand) ? $product->brand->name : 'Không có' }}</p>
                        <p class="mb-3"><strong>Giá:</strong> 
                            {{ $product->price !== null ? number_format($product->price, 0, ',', '.') . ' VND' : 'Liên hệ' }}
                        </p>
                        <p class="mb-3"><strong>Mô tả:</strong> {{ $product->description ?: 'Chưa có mô tả' }}</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
