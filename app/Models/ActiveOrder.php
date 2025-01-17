<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'order_id',
        'delivery_method',
        'address',
        'city',
        'postal_code',
        'phone',
        'payment_method',
        'status',
    ];
    


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     *
     * @return bool
     */
    public function isDelivery()
    {
        return $this->delivery_method === 'delivery';
    }

    /**
     *
     * @return bool
     */
    public function isPickup()
    {
        return $this->delivery_method === 'pickup';
    }
}
