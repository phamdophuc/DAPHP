<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderDetailController extends Controller
{
    // Danh sách chi tiết đơn hàng
    public function index()
    {
        $orderDetails = OrderDetail::with(['order', 'product'])->get();
        return view('order_details.index', compact('orderDetails'));
    }

    protected function checkAdmin()
    {
        if (Gate::denies('admin')) {
            redirect()->route('access.denied')->send();
        }
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
            'order_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);
        OrderDetail::create($request->all());
        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được tạo.');
    }

    // Chỉnh sửa chi tiết đơn hàng
    public function edit($id)
    {
        $this->checkAdmin();
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
        $this->checkAdmin();
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'order_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
            'image_url' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được cập nhật.');
    }

    // Xóa chi tiết đơn hàng
    public function destroy($id)
    {
        $this->checkAdmin();
        $orderDetail = OrderDetail::find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Chi tiết đơn hàng đã được xóa.');
    }
}
