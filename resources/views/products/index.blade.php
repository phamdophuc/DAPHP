@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container">
        <h1>Product List</h1>
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="query" class="form-control" placeholder="Tìm sản phẩm..."
                        value="{{ request('query') }}">
                </div>

                <div class="col-md-2">
                    <select name="category_id" class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="brand_id" class="form-control">
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" 
                                {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Giá từ"
                            value="{{ request('min_price') }}" min="0">
                </div>

                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Giá đến"
                            value="{{ request('max_price') }}" min="0">
                </div>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </div>
        </form>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Thể loại</th>
                    <th>Thương hiệu</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>
                        @if ($product->promotion_price && $product->promotion_price < $product->price)
                            {{ number_format($product->promotion_price) }} VNĐ
                            <del>{{ number_format($product->price) }} VNĐ</del>
                        @else
                            {{ number_format($product->price) }} VNĐ
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Chi tiết</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
