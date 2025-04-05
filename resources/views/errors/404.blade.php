@extends('layouts.app')

@section('title', 'Không tìm thấy trang')

<style>
    /* Đặt nền cho toàn bộ trang */
.error-container {
    height: 100vh;
    background: linear-gradient(to right, #f8b400, #f2a200); /* Màu sắc gradient */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #fff;
    font-family: 'Arial', sans-serif;
}

/* Khung chứa thông báo lỗi */
.error-box {
    background-color: #333;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    width: 100%;
}

/* Tiêu đề lỗi */
.error-title {
    font-size: 80px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #f8b400;
}

/* Thông báo lỗi */
.error-message {
    font-size: 20px;
    margin-bottom: 30px;
    color: #fff;
}

/* Nút quay về trang chủ */
.back-home-btn {
    display: inline-block;
    background-color: #f8b400;
    color: #333;
    padding: 12px 30px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.back-home-btn:hover {
    background-color: #f2a200;
    transform: scale(1.05);
}

</style>

@section('content')
    <div class="error-container">
        <div class="error-box">
            <h1 class="error-title">404</h1>
            <p class="error-message">Không tìm thấy trang mà bạn đang tìm.</p>
            <a href="{{ url('/') }}" class="back-home-btn">Quay về trang chủ</a>
        </div>
    </div>
@endsection

