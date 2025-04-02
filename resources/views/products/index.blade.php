@extends('layouts.app')

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

        <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>{{ number_format($product->price) }} VNĐ</td>
                        <td>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
