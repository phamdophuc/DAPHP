@extends('layouts.app')
<style>
    /* Basic Container Styling */
.container {
    max-width: 800px;
    margin: 100px auto;
    padding: 50px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    font-size: 36px;
    color: #28a745;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    color: #555;
    margin-bottom: 30px;
}

/* Button Styling */
.btn-primary {
    background-color: #007bff;
    color: white;
    font-size: 16px;
    padding: 12px 25px;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-primary:active {
    background-color: #003366;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        padding: 30px;
        margin: 20px;
    }

    h2 {
        font-size: 28px;
    }

    p {
        font-size: 16px;
    }

    .btn-primary {
        font-size: 14px;
        padding: 10px 20px;
    }
}
</style>
@section('content')
<div class="container text-center">
    <h2>Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">OK</a>
</div>
@endsection
