<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->roles()->attach(1);

        $worker1 = User::create([
            'name' => 'Worker 1',
            'email' => 'worker1@example.com',
            'password' => Hash::make('password'),
            'nr_restaurant' => 1, // Przypisanie do restauracji nr 1
        ]);
        $worker1->roles()->attach(2);

        $worker2 = User::create([
            'name' => 'Worker 2',
            'email' => 'worker2@example.com',
            'password' => Hash::make('password'),
            'nr_restaurant' => 2, // Przypisanie do restauracji nr 2
        ]);
        $worker2->roles()->attach(2);

        $worker3 = User::create([
            'name' => 'Worker 3',
            'email' => 'worker3@example.com',
            'password' => Hash::make('password'),
            'nr_restaurant' => 3, // Przypisanie do restauracji nr 3
        ]);
        $worker3->roles()->attach(2);

        $client = User::create([
            'name' => 'Client',
            'email' => 'client@example.com',
            'password' => Hash::make('password')
        ]);
        $client->roles()->attach(3);
    }
}