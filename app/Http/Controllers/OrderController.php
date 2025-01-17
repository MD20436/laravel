<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class OrderController extends Controller
{
    public function add(Request $request, MenuItem $menuItem)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)
            ->where('restaurant_id', $menuItem->restaurant_id)
            ->where('status', 'open')
            ->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => $user->id,
                'restaurant_id' => $menuItem->restaurant_id,
                'status' => 'open',
            ]);
        }

       $existingItem = $order->menuItems()->where('menu_item_id', $menuItem->id)->first();

        if ($existingItem) {

            $order->menuItems()->updateExistingPivot($menuItem->id, [
                'quantity' => $existingItem->pivot->quantity + $request->input('quantity', 1),
            ]);
        } else {

            $order->menuItems()->attach($menuItem->id, [
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('orders.current')->with('success', 'Item added to your order.');
    }

    public function currentOrders()
    {
        $user = Auth::user();
        $orders = Order::with('menuItems')
            ->where('user_id', $user->id)
            ->where('status', 'open')
            ->get();
    
$orders = $orders->filter(function ($order) {
            return $order->menuItems->isNotEmpty();
        })->values();
    
        return view('orders.current', compact('orders'));
    }
    
    
    

    public function updateItem(Request $request, Order $order, MenuItem $menuItem)
    {
        $action = $request->input('action');

        $pivot = $order->menuItems()->where('menu_item_id', $menuItem->id)->first()->pivot;

        if ($action === 'increase') {
            $pivot->quantity += 1;
        } elseif ($action === 'decrease' && $pivot->quantity > 1) {
            $pivot->quantity -= 1;
        }

        $pivot->save();

        return redirect()->route('orders.current')->with('success', 'Order item updated.');
    }

    public function removeItem(Order $order, MenuItem $menuItem)
    {
        $order->menuItems()->detach($menuItem->id);

        return redirect()->route('orders.current')->with('success', 'Order item removed.');
    }
    public function history()
    {
        $user = Auth::user();
        $completedOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['completed', 'dostarczone', 'oczekiwanie', 'przyjęte'])
            ->with('menuItems')
            ->get();
    
        return view('orders.history', compact('completedOrders'));
    }
    
    
public function reviewForm(Order $order)
{
    if ($order->review) {
        return redirect()->route('orders.history')->with('error', 'You have already written a review for this order.');
    }

    return view('orders.review', compact('order'));
}


public function submitReview(Request $request, Order $order)
{
    if ($order->review) {
        return redirect()->route('orders.history')->with('error', 'You have already written a review for this order.');
    }

    $request->validate([
        'description' => 'required|string|max:1000',
        'stars' => 'required|integer|min:1|max:5',
    ]);

    Review::create([
        'restaurant_id' => $order->restaurant_id,
        'order_id' => $order->id,
        'description' => $request->input('description'),
        'stars' => $request->input('stars'),
    ]);

    return redirect()->route('orders.history')->with('success', 'Your review has been submitted.');
}
public function acceptOrder(Order $order)
{
    $order->update(['status' => 'przyjęte']);
    return redirect()->route('dashboard')->with('success', 'Zamówienie zostało przyjęte.');
}


public function deliverOrder(Order $order)
{
    $order->update(['status' => 'dostarczone']);
    return redirect()->route('dashboard')->with('success', 'Zamówienie zostało oznaczone jako dostarczone.');
}


}
