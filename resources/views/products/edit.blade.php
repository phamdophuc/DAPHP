@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp
<style>
    /* Basic Container Styling */
.container {
    max-width: 900px;
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

/* Form Group Styling */
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

/* File Input Styling */
.form-control[type="file"] {
    padding: 8px;
    font-size: 14px;
}

.img-thumbnail {
    margin-top: 10px;
    width: 80px;
    height: 80px;
    object-fit: cover;
}

/* Row Layout for Two Inputs */
.row {
    display: flex;
    gap: 20px;
}

.col-md-6 {
    flex: 1;
}

/* Button Styling */
.btn-success, .btn-secondary {
    width: 100%;
    padding: 12px;
    font-size: 18px;
    background-color: #28a745;
    border: none;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 20px;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-secondary {
    background-color: #6c757d;
    margin-top: 10px;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Textarea and Input Field Styling */
textarea.form-control {
    min-height: 120px;
}

select.form-control, input.form-control {
    margin-bottom: 10px;
}

/* Add some space between the form elements */
.form-group:last-child {
    margin-bottom: 0;
}
</style>
@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" 
                               value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="promotion_price">Promotion Price</label>
                        <input type="number" step="0.01" name="promotion_price" class="form-control" 
                               value="{{ old('promotion_price', $product->promotion_price) }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Product Image</label>
                <input type="file" name="image_url" class="form-control">
                @if ($product->image_url)
                    <img src="{{ Str::startsWith($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 80px; height: 80px;">
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_hot">Is Hot?</label>
                <select name="is_hot" class="form-control">
                    <option value="1" {{ $product->is_hot ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$product->is_hot ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hot_start_date">Hot Start Date</label>
                        <input type="datetime-local" name="hot_start_date" class="form-control"
                               value="{{ old('hot_start_date', $product->hot_start_date ? date('Y-m-d\TH:i', strtotime($product->hot_start_date)) : '') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="hot_end_date">Hot End Date</label>
                        <input type="datetime-local" name="hot_end_date" class="form-control"
                               value="{{ old('hot_end_date', $product->hot_end_date ? date('Y-m-d\TH:i', strtotime($product->hot_end_date)) : '') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
