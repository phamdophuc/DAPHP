<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

class OrderDetailController extends Controller
{
    // Danh sách chi tiết đơn hàng
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'product'])->get();
        return view('order_details.index', compact('orderDetails'));
    }

    // Form tạo chi tiết đơn hàng
    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order_details.create', compact('orders', 'products'));
    }

    // Lưu chi tiết đơn hàng
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

    // Chỉnh sửa chi tiết đơn hàng
    public function edit($id)
    {
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        $orders = Order::all();
        $products = Product::all();

        return view('order_details.edit', compact('orderDetail', 'orders', 'products'));
    }

    // Cập nhật chi tiết đơn hàng
    public function update(Request $request, $id)
    {
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được cập nhật.');
    }

    // Xóa chi tiết đơn hàng
    public function destroy($id)
    {
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được xóa.');
    }
}
