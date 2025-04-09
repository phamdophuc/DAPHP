@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<style>
    .container {
        max-width: 1100px;
        margin: 60px auto;
        padding: 40px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    h2 {
        text-align: center;
        font-size: 30px;
        color: #6b46c1;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table th, .table td {
        padding: 16px;
        border: 1px solid #eee;
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        background: #f2f2f2;
        color: #444;
    }

    .btn {
        padding: 10px 16px;
        font-size: 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.2s;
    }

    .btn-primary {
        background-color: #6b46c1;
        color: white;
    }

    .btn-primary:hover {
        background-color: #5532a2;
    }

    .btn-danger {
        background-color: #e3342f;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    p {
        text-align: center;
        font-size: 18px;
        color: #777;
    }
    .table td:first-child {
    text-align: left;
}

</style>


<div class="container">
    <h2>Giỏ hàng</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Giỏ hàng của bạn đang trống.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @if($item->product->promotion_price)
                                <span style="color: red; text-decoration: line-through;">
                                    {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND
                                </span><br>
                                <span>
                                    {{ number_format($item->product->promotion_price * $item->quantity, 0, ',', '.') }} VND
                                </span>
                            @else
                                {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }} VND
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4" style="display: flex; justify-content: space-between;">
            <a href="{{ route('checkout.index') }}" class="btn btn-primary"><i class="fas fa-credit-card"></i> Thanh toán</a>
            <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fas fa-store"></i> Tiếp tục mua</a>
        </div>
    @endif
</div>
@endsection
