<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Restaurant;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            for ($i = 0; $i < rand(3, 7); $i++) {
                Review::create([
                    'restaurant_id' => $restaurant->id,
                    'description' => 'Sample review for ' . $restaurant->name,
                    'stars' => rand(1, 5),
                ]);
            }
        }
    }
}
