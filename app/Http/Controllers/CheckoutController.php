<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $cartItems->sum(fn($item) => $item->product->promotion_price ?? $item->product->price * $item->quantity),
            'status' => 'pending',
            'ship_address' => $request->address,
            'order_date' => now(),
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.success');
    }
}

