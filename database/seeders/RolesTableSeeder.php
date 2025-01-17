<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Pracownik']);
        Role::create(['name' => 'Klient']);
    }
}
