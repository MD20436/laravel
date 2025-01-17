<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('menuItems')->findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }
    public function reviews(Restaurant $restaurant)
{
    $reviews = $restaurant->reviews()->latest()->get();
    return view('restaurants.reviews', compact('restaurant', 'reviews'));
}

}