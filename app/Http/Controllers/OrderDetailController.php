<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

class OrderDetailController extends Controller
{

    public function index()
    {
        return view('order_details.index', compact('orderDetails'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order_details.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        OrderDetail::create($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được tạo.');
    }

    public function edit($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();

        return view('order_details.edit', compact('orderDetail', 'orders', 'products'));
    }

    public function update(Request $request, $id)
    {

        $orderDetail = OrderDetail::findOrFail($id);

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được cập nhật.');
    }

    public function destroy($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được xóa.');
    }
}
