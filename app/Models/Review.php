<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'order_id',
        'description',
        'stars',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
