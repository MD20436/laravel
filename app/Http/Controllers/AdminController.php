<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allUsers()
    {
        // Sprawdzenie roli użytkownika
        if (!auth()->user()->roles->contains('name', 'Administrator')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Klient');
        })->get();

        return view('admin.users', compact('users'));
    }

    public function workers()
    {
        // Sprawdzenie roli użytkownika
        if (!auth()->user()->roles->contains('name', 'Administrator')) {
            abort(403, 'Unauthorized action.');
        }

        $workers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Pracownik');
        })->get();

        return view('admin.workers', compact('workers'));
    }
    public function allReviews()
    {
        if (!auth()->user()->roles->contains('name', 'Administrator')) {
            abort(403, 'Unauthorized action.');
        }

        $reviews = Review::with(['comments', 'restaurant', 'user'])->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview(Review $review)
    {
        if (!auth()->user()->roles->contains('name', 'Administrator')) {
            abort(403, 'Unauthorized action.');
        }

        $review->comments()->delete(); // Usuń powiązane komentarze
        $review->delete(); // Usuń recenzję

        return redirect()->route('admin.reviews')->with('success', 'Recenzja została usunięta.');
    }
    public function restaurants()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants', compact('restaurants'));
    }
    public function restaurantDetails($id)
    {
        $restaurant = Restaurant::with('menuItems')->findOrFail($id); // Pobierz restaurację z powiązanymi pozycjami menu
        return view('admin.restaurant-details', compact('restaurant'));
    }
}
