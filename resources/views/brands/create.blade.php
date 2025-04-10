@extends('layouts.app')
<style>
    /* Basic Container Styling */
.container {
    max-width: 600px;
    margin: 50px auto;
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
</style>
@section('content')
    <div class="container">
        <h1>Create Brand</h1>
        <form action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
