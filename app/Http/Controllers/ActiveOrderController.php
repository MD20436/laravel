<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActiveOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ActiveOrderController extends Controller
{
    public function create(Order $order)
    {
        $user = Auth::user();
       if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('active_orders.create', compact('order', 'user'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'delivery_method' => 'required|in:pickup,delivery',
            'address' => 'required_if:delivery_method,delivery|max:255',
            'city' => 'required_if:delivery_method,delivery|max:100',
            'postal_code' => 'required_if:delivery_method,delivery|max:20',
            'phone' => 'required_if:delivery_method,delivery|max:20',
            'payment_method' => 'required|in:cash,card,online',
        ]);
    
        ActiveOrder::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $order->restaurant_id,
            'order_id' => $order->id,
            'delivery_method' => $request->input('delivery_method'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'phone' => $request->input('phone'),
            'payment_method' => $request->input('payment_method'),
            'status' => 'in_progress',
        ]);
    
        $order->update(['status' => 'oczekiwanie']);

    
        return redirect()->route('active_orders.thanks');
    }
    
}
