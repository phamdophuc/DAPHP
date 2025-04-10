@extends('layouts.app')
<style>
    /* CSS cho trang Access Denied */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    padding-top: 80px;
}

.alert {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}

p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.1rem;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
    text-decoration: none;
}

/* Đảm bảo trang hiển thị đẹp trên các thiết bị di động */
@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    h1 {
        font-size: 2rem;
    }

    p {
        font-size: 1rem;
    }

    .btn {
        width: 100%;
    }
}
</style>
@section('content')
<div class="container text-center mt-5">
    <div class="alert alert-danger" role="alert">
        <h1>Access Denied</h1>
        <p>Bạn không có quyền truy cập vào trang này.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Về trang chủ</a>
    </div>
</div>
@endsection