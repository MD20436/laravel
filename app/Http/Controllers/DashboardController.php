<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->roles()->exists()) {
            $role = Role::where('name', 'Klient')->first();
            $user->roles()->attach($role);
        }

        if ($user->roles->contains('name', 'Administrator')) {
            return view('dashboard.admin');
        } elseif ($user->roles->contains('name', 'Pracownik')) {
            $restaurant = Restaurant::where('id', $user->nr_restaurant)->first();
    
            if (!$restaurant) {
                return redirect()->route('dashboard')->with('error', 'Nie przypisano Cię do żadnej restauracji.');
            }
    
            $orders = \App\Models\Order::where('restaurant_id', $restaurant->id)
                ->with('menuItems', 'user')
                ->get();
    
            return view('dashboard.worker', compact('orders', 'restaurant'));
        } elseif ($user->roles->contains('name', 'Klient')) {
            
            $restaurants = Restaurant::with('reviews')->get();

            foreach ($restaurants as $restaurant) {
                $restaurant->average_stars = $restaurant->reviews->avg('stars') ?? 0; // Średnia liczba gwiazdek
            }

            return view('dashboard.client', compact('restaurants'));
        } else {
            return redirect('/');
        }
    }
}