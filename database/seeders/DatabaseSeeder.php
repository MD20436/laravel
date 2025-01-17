<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uruchomienie seedów dla ról i użytkowników
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            RestaurantSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}