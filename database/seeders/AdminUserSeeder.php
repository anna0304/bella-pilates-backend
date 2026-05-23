<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'surname' => 'Bella Pilates',
            'email' => 'admin@bellapilates.com',
            'phone' => '600123456',
            'password' => Hash::make('Admin1234!'),
            'role' => 'admin',
            'status' => 'active',
            'must_change_password' => false,
        ]);
    }
}