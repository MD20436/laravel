<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = ['user_id', 'restaurant_id', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(MenuItem::class)->withPivot('quantity')->withTimestamps();
    }
    public function review()
{
    return $this->hasOne(Review::class);
}
public function getTotalPriceAttribute()
{
    return $this->menuItems->sum(function ($item) {
        return $item->pivot->quantity * $item->price;
    });
}

}
