@extends('layouts.app')

<style>
/* Container */
.container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 30px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Tiêu đề */
h1, h3 {
    text-align: center;
    color: #4a4a4a;
    font-weight: 700;
}

/* Table */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table th, .table td {
    text-align: center;
    padding: 15px;
    border-bottom: 1px solid #eee;
}

.table th {
    background-color: #f9f9f9;
    color: #6b46c1;
    font-size: 18px;
    text-transform: uppercase;
}

/* Hover Row */
.table tbody tr:hover {
    background-color: #faf5ff;
}

/* Form */
.form-group label {
    font-weight: 600;
    color: #333;
}

.form-group input, .form-group textarea, .form-group select {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
    transition: 0.3s;
}

.form-group input:focus, .form-group textarea:focus, .form-group select:focus {
    border-color: #6b46c1;
    outline: none;
}

/* Nút bấm */
.btn-success, .btn-danger {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 16px;
    padding: 14px;
    border-radius: 12px;
    transition: 0.3s ease;
    border: none;
    width: 100%;
}

.btn-success {
    background-color: #6b46c1;
    color: white;
}

.btn-success:hover {
    background-color: #5531a7;
}

.btn-danger {
    background-color: #e53e3e;
    color: white;
}

.btn-danger:hover {
    background-color: #c53030;
}

/* Tổng kết */
.list-group-item {
    font-size: 17px;
    border: 1px solid #e2e8f0;
    margin-bottom: 10px;
    border-radius: 10px;
    padding: 12px 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .col-md-8, .col-md-4 {
        width: 100%;
        padding: 0;
    }

    .btn-success, .btn-danger {
        font-size: 15px;
        padding: 12px;
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
                                    <td>
                                        @if($cartItem->product->promotion_price)
                                            <span style="color: red; text-decoration: line-through;">
                                                {{ number_format($cartItem->product->price, 0, ',', '.') }} VND
                                            </span><br>
                                            <span>
                                                {{ number_format($cartItem->product->promotion_price, 0, ',', '.') }} VND
                                            </span>
                                        @else
                                            {{ number_format($cartItem->product->price, 0, ',', '.') }} VND
                                        @endif
                                    </td>
                                    <td>{{ $cartItem->quantity }}</td>
                                    <td>
                                        @if($cartItem->product->promotion_price)
                                            <span style="color: red; text-decoration: line-through;">
                                                {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }} VND
                                            </span><br>
                                            <span>
                                                {{ number_format($cartItem->product->promotion_price * $cartItem->quantity, 0, ',', '.') }} VND
                                            </span>
                                        @else
                                            {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }} VND
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group">
                        <label for="order_date">Ngày Đặt Hàng</label>
                        <input type="date" name="order_date" id="order_date" value="{{ old('order_date', now()->format('Y-m-d')) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa Chỉ Giao Hàng</label>
                        <textarea name="address" id="address" required>{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="notes">Ghi Chú</label>
                        <textarea name="notes" id="notes">{{ old('notes') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Phương Thức Thanh Toán</label>
                        <select name="payment_method" id="payment_method" required>
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
                            {{ number_format($cartItems->sum(function($item) {
                                return $item->product->promotion_price ? $item->product->promotion_price * $item->quantity : $item->product->price * $item->quantity;
                            }), 0, ',', '.') }} VND
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-success mt-3" onclick="return confirmOrder()">
                        <i class="fas fa-check-circle"></i> Đặt Hàng
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-danger mt-3">
                        <i class="fas fa-arrow-left"></i> Quay lại giỏ hàng
                    </a>
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
