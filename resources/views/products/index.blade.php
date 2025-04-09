@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    /* Định dạng chung */
    body {
        font-family: 'Helvetica Neue', sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        color: #2d3748;
    }

    .container {
        width: 95%;
        max-width: 1200px;
        margin: 40px auto;
        padding: 25px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }


    h1 {
        text-align: center;
        color: #333;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b46c1;
    }

    /* Form Lọc Sản Phẩm */
    .filter-form {
        display: flex;
        gap: 12px;
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .filter-form input,
    .filter-form select,
    .filter-form button {
        padding: 12px 18px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .filter-form input:focus,
    .filter-form select:focus {
        border-color: #6b46c1;
        box-shadow: 0 0 8px rgba(107, 70, 193, 0.5);
    }

    .filter-form button {
        background-color: #6b46c1;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .filter-form button:hover {
        background-color: #4c2889;
        transform: scale(1.05);
    }

    /* Bảng danh sách sản phẩm */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    .table th, .table td {
        border: 1px solid #f1f1f1;
        padding: 18px;
        text-align: center;
    }

    .table th {
        background-color: #6b46c1;
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Bỏ hiệu ứng hover */
    .table tr:hover {
        background-color: inherit; /* Không thay đổi màu nền khi hover */
        transform: none; /* Không có hiệu ứng nổi khi hover */
    }

    /* Ảnh sản phẩm */
    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }


    .product-image:hover {
        transform: scale(1.1);
    }

    /* Nút hành động */
    .action-buttons a,
    .action-buttons button {
        display: inline-block;
        padding: 10px 15px;
        margin: 6px;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .action-buttons .btn-info {
        background-color: #3498db;
    }

    .action-buttons .btn-info:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }

    .action-buttons .btn-warning {
        background-color: #f39c12;
    }

    .action-buttons .btn-warning:hover {
        background-color: #e67e22;
        transform: scale(1.05);
    }

    .action-buttons .btn-danger {
        background-color: #e74c3c;
    }

    .action-buttons .btn-danger:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }

    .action-buttons .btn-success {
        background-color: #2ecc71;
    }

    .action-buttons .btn-success:hover {
        background-color: #27ae60;
        transform: scale(1.05);
    }

    /* Cột hành động */
    .action-buttons form {
        display: inline;
    }

    /* Responsive */
    @media screen and (max-width: 768px) {
        .filter-form {
            flex-direction: column;
        }

        .filter-form input,
        .filter-form select,
        .filter-form button {
            width: 100%;
            margin-bottom: 12px;
        }
    }

    /* Hiệu ứng fade-in */
    .fade-in {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

</style>

@section('content')
    <div class="container py-4 fade-in">
        <h1 class="mb-4 text-center text-primary">Danh Sách Sản Phẩm</h1>
        <form action="{{ route('products.index') }}" method="GET" class="filter-form mb-4 bg-light p-3 rounded shadow-sm">
            <div class="col-md-3">
                <input type="text" name="query" class="form-control" placeholder="🔍 Tìm sản phẩm..." value="{{ request('query') }}">
            </div>
            <div class="col-md-2">
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="brand_id" class="form-select">
                    <option value="">-- Chọn thương hiệu --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
        </form>

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
                                @if(Str::startsWith($product->image_url, ['http://', 'https://']))
                                    <img src="{{ $product->image_url }}" alt="Ảnh sản phẩm" class="product-image">
                                @else
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Ảnh sản phẩm" class="product-image">
                                @endif
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
                            <td class="text-center action-buttons">
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
