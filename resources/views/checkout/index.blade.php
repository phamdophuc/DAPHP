@extends('layouts.app')

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
                        <label for="address">Địa Chỉ Giao Hàng</label>
                        <textarea name="address" id="address" class="form-control" required></textarea>
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

                    <button type="submit" class="btn btn-success btn-lg btn-block">Đặt Hàng</button>
                </div>
            </div>
        </form>
    @else
        <p>Giỏ hàng của bạn hiện đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi tiếp tục thanh toán.</p>
    @endif
</div>
@endsection
