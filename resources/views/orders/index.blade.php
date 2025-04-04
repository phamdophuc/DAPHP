@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order List</h1>
    @if (Gate::allows('admin'))
        <form action="{{ route('orders.index') }}" method="GET" class="d-flex mb-4 flex-wrap align-items-center">
            <input type="text" name="order_id" class="form-control me-2 mb-2" style="width: 150px;" placeholder="Order ID" value="{{ request('order_id') }}">
            <input type="text" name="user_id" class="form-control me-2 mb-2" style="width: 150px;" placeholder="User ID" value="{{ request('user_id') }}">
            <input type="text" name="email" class="form-control me-2 mb-2" style="width: 200px;" placeholder="Email người dùng" value="{{ request('email') }}">
            
            <button type="submit" class="btn btn-primary me-2 mb-2">Tìm kiếm</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-2">Reset</a>
        </form>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
            @if (Gate::allows('admin'))
                <th>ID</th>
                <th>User Id</th>
            @endif
                <th>UserEmail</th>
                <th>Order Date</th>
                <th>Total Price</th>
                <th>Ship Address</th>
                <th>Notes</th>
                <th>Status</th>
                @if (Gate::allows('admin'))
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>    
                    @if (Gate::allows('admin'))
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->id }}</td>
                    @endif
                    <td>{{ $order->user->email }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->ship_address }}</td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    @if (Gate::allows('admin'))
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
