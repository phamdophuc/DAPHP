@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order List</h1>

    {{-- Hiển thị thông báo thành công --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Ship Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                    <td>{{ $order->ship_address }}</td>
                    <td>
                        <span class="badge 
                            {{ $order->status == 'pending' ? 'badge-warning' : '' }}
                            {{ $order->status == 'completed' ? 'badge-success' : '' }}
                            {{ $order->status == 'canceled' ? 'badge-danger' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;" 
                              onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
