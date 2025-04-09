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
    /* Basic Container Styles */
    .order-detail-container {
        margin: 40px auto;
        font-family: 'Arial', sans-serif;
        max-width: 1000px;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 36px;
        color: #6b46c1;
        font-weight: bold;
    }

    .order-detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-detail-table th, .order-detail-table td {
        padding: 12px 20px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 16px;
    }

    .order-detail-table th {
        background-color: #6b46c1;
        color: #fff;
        text-transform: uppercase;
    }

    .order-detail-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .order-detail-table tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Styling for Price */
    .original-price {
        text-decoration: line-through;
        color: red;
        margin-right: 10px;
    }

    .discounted-price {
        color: green;
        font-weight: bold;
    }

    /* Styling for table hover effect */
    .order-detail-table tr:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .order-detail-container {
            padding: 20px;
        }

        .order-detail-table th, .order-detail-table td {
            padding: 10px 15px;
            font-size: 14px;
        }

        h1 {
            font-size: 28px;
        }
    }
</style>
