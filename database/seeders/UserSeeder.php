<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Cuci',
            'email' => 'admin@cuci.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Cuci',
            'email' => 'kasir@cuci.com',
            'password' => Hash::make('kasir123'),
            'role' => 'kasir',
        ]);
    }
}
