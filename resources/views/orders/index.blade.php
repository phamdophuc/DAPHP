@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order List</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>
    <table class="table table-bordered">
        <thead>
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
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->ship_address }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
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
