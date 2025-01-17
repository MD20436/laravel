<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $fillable = ['name', 'category', 'image'];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
    // app/Models/Restaurant.php
public function reviews()
{
    return $this->hasMany(Review::class);
}

}
