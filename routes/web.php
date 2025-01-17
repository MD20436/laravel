<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ActiveOrderController;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'allUsers'])->name('admin.users');
    Route::get('/admin/workers', [AdminController::class, 'workers'])->name('admin.workers');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/workers/{worker}', [AdminController::class, 'deleteWorker'])->name('admin.workers.delete');
    Route::get('/admin/reviews', [AdminController::class, 'allReviews'])->name('admin.reviews');
    Route::delete('/admin/reviews/{review}', [AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
    Route::get('/admin/restaurants', [AdminController::class, 'restaurants'])->name('admin.restaurants');
    Route::get('/admin/restaurants/{id}', [AdminController::class, 'restaurantDetails'])->name('admin.restaurants.details');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::post('/orders/add/{menuItem}', [OrderController::class, 'add'])->name('orders.add');
    Route::get('/orders', [OrderController::class, 'currentOrders'])->name('orders.current');
    Route::patch('/orders/{order}/update/{menuItem}', [OrderController::class, 'updateItem'])->name('orders.update');
    Route::delete('/orders/{order}/remove/{menuItem}', [OrderController::class, 'removeItem'])->name('orders.remove');
    Route::get('/active_orders/{order}/create', [ActiveOrderController::class, 'create'])->name('active_orders.create');
    Route::post('/active_orders/{order}', [ActiveOrderController::class, 'store'])->name('active_orders.store');
    Route::get('/active-orders/thanks', function () {
        return view('active_orders.thanks');
    })->name('active_orders.thanks');
    
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/restaurants/{restaurant}/reviews', [RestaurantController::class, 'reviews'])->name('restaurants.reviews');
    Route::get('/orders/{order}/review', [OrderController::class, 'reviewForm'])->name('orders.review');
    Route::post('/orders/{order}/review', [OrderController::class, 'submitReview'])->name('orders.submitReview');
    
});
Route::get('/restaurants/{id}/reviews', [RestaurantController::class, 'showReviews'])->name('restaurants.reviews');

// Trasa do zaakceptowania zamówienia
Route::patch('/orders/{order}/accept', [OrderController::class, 'acceptOrder'])->name('orders.accept');

// Trasa do oznaczenia zamówienia jako dostarczone
Route::patch('/orders/{order}/deliver', [OrderController::class, 'deliverOrder'])->name('orders.deliver');
Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/restaurants/{restaurant}/reviews/{review}/comments', [CommentController::class, 'store'])->name('restaurants.comments.store');
Route::patch('/restaurants/{restaurant}/comments/{comment}', [CommentController::class, 'update'])->name('restaurants.comments.update');
Route::delete('/restaurants/{restaurant}/comments/{comment}', [CommentController::class, 'destroy'])->name('restaurants.comments.destroy');


require __DIR__.'/auth.php';
