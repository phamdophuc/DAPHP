@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Product List</h1>
        {{-- Chỉ admin mới thấy nút thêm sản phẩm --}}
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        @endif

        {{-- Hiển thị danh sách sản phẩm cho tất cả user --}}
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            {{-- Ai cũng có thể xem sản phẩm --}}
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>

                            {{-- Chỉ admin mới có thể chỉnh sửa & xóa --}}
                            @if (Auth::check() && Auth::user()->role === 'admin')
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
