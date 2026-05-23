<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Laura',
            'surname' => 'García',
            'email' => 'laura@email.com',
            'phone' => '600111111',
            'password' => Hash::make('Laura123!'),
            'role' => 'user',
            'status' => 'active',
            'must_change_password' => false,
        ]);

        User::create([
            'name' => 'Anna',
            'surname' => 'Martínez',
            'email' => 'anna@email.com',
            'phone' => '600222222',
            'password' => Hash::make('Anna123!'),
            'role' => 'user',
            'status' => 'active',
            'must_change_password' => false,
        ]);

        User::create([
            'name' => 'Marta',
            'surname' => 'López',
            'email' => 'marta@email.com',
            'phone' => '600333333',
            'password' => Hash::make('Marta123!'),
            'role' => 'user',
            'status' => 'active',
            'must_change_password' => false,
        ]);
    }
}