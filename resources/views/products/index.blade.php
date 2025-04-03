@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp
<style>
    /* Định dạng chung */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
}

/* Form Lọc Sản Phẩm */
.filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 15px;
    background: #f1f1f1;
    border-radius: 5px;
    margin-bottom: 20px;
}

.filter-form input,
.filter-form select,
.filter-form button {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.filter-form button {
    background: #007bff;
    color: white;
    cursor: pointer;
    border: none;
}

.filter-form button:hover {
    background: #0056b3;
}

/* Bảng danh sách sản phẩm */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

.table th {
    background: #007bff;
    color: white;
}

.table tr:nth-child(even) {
    background: #f9f9f9;
}

/* Ảnh sản phẩm */
.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

/* Nút hành động */
.action-buttons a,
.action-buttons button {
    display: inline-block;
    padding: 5px 10px;
    margin: 2px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    color: white;
}

.action-buttons .btn-info {
    background: #17a2b8;
}

.action-buttons .btn-warning {
    background: #ffc107;
}

.action-buttons .btn-danger {
    background: #dc3545;
}

.action-buttons .btn-success {
    background: #28a745;
}

.action-buttons button:hover {
    opacity: 0.8;
}

        
</style>
@section('content')
    <div class="container py-4">
        <h1 class="mb-4 text-center text-primary">Danh Sách Sản Phẩm</h1>

        <!-- Form Lọc Sản Phẩm -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4 bg-light p-3 rounded shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-md-3">
                    <input type="text" name="query" class="form-control" placeholder="🔍 Tìm sản phẩm..." value="{{ request('query') }}">
                </div>
                <div class="col-md-2">
                    <select name="category_id" class="form-select">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="brand_id" class="form-select">
                        <option value="">-- Chọn thương hiệu --</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Giá từ" value="{{ request('min_price') }}" min="0">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Giá đến" value="{{ request('max_price') }}" min="0">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        @if (Gate::allows('admin'))
            <div class="mb-3 text-end">
                <a href="{{ route('products.create') }}" class="btn btn-success">+ Thêm Sản Phẩm</a>
            </div>
        @endif

        <!-- Bảng Danh Sách Sản Phẩm -->
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        @if (Gate::allows('admin'))
                            <th>ID</th>
                        @endif

                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Thể loại</th>
                        <th>Thương hiệu</th>
                        <th>Giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="align-middle">
                        @if (Gate::allows('admin'))
                            <td class="text-center">{{ $product->id }}</td>
                        @endif
                            <td class="text-center">
                                <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" 
                                    alt="{{ $product->name }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td class="text-center">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $product->brand->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                @if ($product->promotion_price && $product->promotion_price < $product->price)
                                    <strong class="text-danger">{{ number_format($product->promotion_price) }} VNĐ</strong>
                                    <del class="text-muted">{{ number_format($product->price) }} VNĐ</del>
                                @else
                                    {{ number_format($product->price) }} VNĐ
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">🔍</a>
                                @if (Gate::allows('admin'))
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">✏️</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?');">🗑️</button>
                                        </form>
                                @endif
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">🛒</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
