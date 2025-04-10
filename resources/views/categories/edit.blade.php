@extends('layouts.app')
<style>
.container {
    max-width: 900px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    font-size: 32px;
    color: #333;
    margin-bottom: 30px;
}

/* Form Styling */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-size: 16px;
    color: #495057;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 6px;
    border: 1px solid #ddd;
    box-sizing: border-box;
}

.form-group input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button Styling */
.btn-success, .btn-secondary {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Success Message Styling */
.alert-success {
    padding: 15px;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        padding: 20px;
        margin: 20px;
    }

    h1 {
        font-size: 28px;
    }

    .form-group input {
        font-size: 14px;
    }

    .btn-success, .btn-secondary {
        width: 100%;
        font-size: 14px;
    }
}
</style>
@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
