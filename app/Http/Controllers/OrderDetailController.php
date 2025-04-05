<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    public function index()
    {
        if (Gate::allows('admin')) {
            $orderDetails = OrderDetail::with(['order', 'product', 'order.user'])->get();
        } else {
            $orderDetails = OrderDetail::with(['order', 'product', 'order.user'])
                ->whereHas('order', function ($query) {
                    $query->where('user_id', Auth::id()); 
                })
                ->get();
        }

        return view('order_details.index', compact('orderDetails'));
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::with(['order', 'product', 'order.user'])->find($id);

        if (!$orderDetail) {
            return redirect()->route('order_details.index')->with('error', 'Không tìm thấy chi tiết đơn hàng.');
        }

        if (Gate::denies('admin') && $orderDetail->order->user_id != Auth::id()) {
            return redirect()->route('order_details.index')->with('error', 'Bạn không có quyền xem chi tiết đơn hàng này.');
        }

        return view('order_details.show', compact('orderDetail'));
    }
}
