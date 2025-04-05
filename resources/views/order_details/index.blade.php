@extends('layouts.app')

@section('content')
    <div class="order-detail-container">
        <h1>Danh sách chi tiết đơn hàng</h1>
        <table class="order-detail-table">
            <thead>
                <tr>
                @if (Gate::allows('admin'))
                    <th>Mã Đơn Hàng</th>
                    <th>Email Người Dùng</th>
                @endif
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $lastOrderId = null; 
                @endphp
                @foreach($orderDetails as $orderDetail)
                    <tr>
                        @if (Gate::allows('admin'))                  
                        <td>
                            @if ($lastOrderId !== $orderDetail->order->id)
                                {{ $orderDetail->order->id }}
                                @php
                                    $lastOrderId = $orderDetail->order->id; // Cập nhật mã đơn hàng đã hiển thị
                                @endphp
                            @else
                                {{-- Nếu mã đơn hàng trùng thì không hiển thị lại --}}
                                &nbsp;
                            @endif
                        </td>
                        <td>{{ $orderDetail->order->user->email }}</td>
                        @endif
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>

                        @php
                            $price = $orderDetail->price;
                            $discountedPrice = $orderDetail->product->promotion_price;
                        @endphp

                        <td>
                            @if ($discountedPrice && $discountedPrice < $price)
                                <span class="original-price">{{ number_format($price, 0, ',', '.') }} VND</span>
                                <span class="discounted-price">{{ number_format($discountedPrice, 0, ',', '.') }} VND</span>
                            @else
                                {{ number_format($price, 0, ',', '.') }} VND
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<style>
    .order-detail-container {
        margin: 20px;
        font-family: Arial, sans-serif;
    }

    .order-detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-detail-table th, .order-detail-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .order-detail-table th {
        background-color: #f4f4f4;
    }

    .order-detail-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .order-detail-table tr:hover {
        background-color: #f1f1f1;
    }

    .original-price {
        text-decoration: line-through;
        color: red;
        margin-right: 10px;
    }

    .discounted-price {
        color: green;
    }
</style>
