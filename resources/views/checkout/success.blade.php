@extends('layouts.app')

<style>
.container {
    max-width: 800px;
    margin: 100px auto;
    padding: 50px;
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(107, 70, 193, 0.1);
    text-align: center;
}

/* Success line (icon + heading) */
.success-message {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 24px;
    color: #6b46c1;
    font-weight: 600;
    margin-bottom: 16px;
}

.success-message i {
    font-size: 28px;
    color: #38a169;
}

/* Text below */
p {
    font-size: 16px;
    color: #4a5568;
    margin-bottom: 30px;
}

/* Button */
.btn-primary {
    background: linear-gradient(135deg, #6b46c1, #9f7aea);
    color: white;
    font-size: 16px;
    padding: 12px 26px;
    border-radius: 999px;
    text-decoration: none;
    transition: 0.3s ease;
    box-shadow: 0 4px 14px rgba(107, 70, 193, 0.3);
    display: inline-block;
    margin-top: 10px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #553c9a, #805ad5);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(107, 70, 193, 0.4);
}

@media (max-width: 768px) {
    .container {
        padding: 30px;
        margin: 40px 20px;
    }

    .success-message {
        font-size: 20px;
        flex-direction: row;
        justify-content: center;
        gap: 6px;
    }

    .btn-primary {
        font-size: 14px;
        padding: 10px 20px;
    }
}
</style>

@section('content')
<div class="container">
    <div class="success-message">
        <i class="fas fa-check-circle"></i>
        <span>Đặt hàng thành công!</span>
    </div>
    <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
</div>
@endsection
