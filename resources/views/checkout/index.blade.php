@extends('layouts.app')
<style>
    /* Basic Container Styling */
.container {
    max-width: 1200px;
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

/* Table Styling */
.table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
}

.table th, .table td {
    text-align: center;
    padding: 15px;
    border: 1px solid #ddd;
}

.table th {
    background-color: #f8f9fa;
    font-size: 18px;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Form and Input Styling */
.form-group label {
    font-weight: bold;
    margin-bottom: 10px;
}

.form-group input, .form-group textarea, .form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
}

.form-group textarea {
    height: 120px;
}

textarea, input[type="date"], select {
    margin-bottom: 20px;
}

/* Button Styling */
.btn-success, .btn-danger {
    font-size: 16px;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-success {
    background-color: #28a745;
    color: white;
    width: 100%;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
    width: 100%;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Summary Box Styling */
.list-group-item {
    font-size: 18px;
    padding: 15px;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    border-radius: 6px;
}

.list-group-item strong {
    font-weight: bold;
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

    .form-group input, .form-group select, .form-group textarea {
        font-size: 14px;
        padding: 8px;
    }

    .btn-success, .btn-danger {
        font-size: 14px;
        padding: 10px;
    }

    .col-md-8, .col-md-4 {
        width: 100%;
        padding: 10px;
    }
}
</style>
@section('content')
<div class="container">
    <h1>Thanh Toán</h1>
    
    @if($cartItems->count() > 0)
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <h3>Giỏ Hàng Của Bạn</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng Cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td>{{ $cartItem->product->name }}</td>
                                    <td>{{ number_format($cartItem->product->price, 0, ',', '.') }} VND</td>
                                    <td>{{ $cartItem->quantity }}</td>
                                    <td>{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }} VND</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label for="order_date">Ngày Đặt Hàng</label>
                        <input type="date" name="order_date" id="order_date" class="form-control" value="{{ old('order_date', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ Giao Hàng</label>
                        <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="notes">Ghi Chú</label>
                        <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Phương Thức Thanh Toán</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="cash_on_delivery">Thanh Toán Khi Nhận Hàng</option>
                            <option value="credit_card">Thẻ Tín Dụng</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-4">
                    <h3>Tóm Tắt Đơn Hàng</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Tổng Số Mặt Hàng:</strong> {{ $cartItems->count() }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tổng Giá:</strong> 
                            {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }} VND
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-success btn-lg btn-block" onclick="return confirmOrder()">Đặt Hàng</button>

                    <a href="{{ route('cart.index') }}" class="btn btn-danger btn-lg btn-block mt-2">Quay lại giỏ hàng</a>
                </div>
            </div>
        </form>
    @else
        <p>Giỏ hàng của bạn hiện đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi tiếp tục thanh toán.</p>
    @endif
</div>
@endsection
@section('scripts')
<script>
    function confirmOrder() {
        return confirm("Bạn có chắc chắn muốn đặt hàng không?");
    }
</script>
@endsection

