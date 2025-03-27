@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="promotion_price">Promotion Price</label>
                <input type="number" step="0.01" name="promotion_price" class="form-control" value="{{ $product->promotion_price }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" name="image_url" class="form-control" value="{{ $product->image_url }}">
            </div>
            <div class="form-group">
                <label for="category_id">Category ID</label>
                <input type="number" name="category_id" class="form-control" value="{{ $product->category_id }}" required>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand ID</label>
                <input type="number" name="brand_id" class="form-control" value="{{ $product->brand_id }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
