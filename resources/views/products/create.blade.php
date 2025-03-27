@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Product</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <input type="text" name="category_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="brand_id">Brand</label>
                <input type="text" name="brand_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
