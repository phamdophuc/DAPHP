@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="container">
        <h1>Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
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
                        <td>
                        @if ($product->promotion_price)
                            <span class="text-danger">{{ number_format($product->promotion_price, 0, ',', '.') }} đ</span>
                            <del class="text-muted">{{ number_format($product->price, 0, ',', '.') }} đ</del>
                        @else
                            {{ number_format($product->price, 0, ',', '.') }} đ
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
