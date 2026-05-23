<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'user_id' => 2,
                'plan_id' => 2,
                'amount' => 79.99,
                'payment_method' => 'card',
                'status' => 'paid',
                'transaction_id' => null,
                'starts_at' => now()->toDateString(),
                'expires_at' => now()->addMonth()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'plan_id' => 1,
                'amount' => 39.99,
                'payment_method' => 'cash',
                'status' => 'paid',
                'transaction_id' => null,
                'starts_at' => now()->toDateString(),
                'expires_at' => now()->addMonth()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 4,
                'plan_id' => 3,
                'amount' => 99.99,
                'payment_method' => 'bizum',
                'status' => 'pending',
                'transaction_id' => 'BIZUM-2026-001',
                'starts_at' => now()->toDateString(),
                'expires_at' => now()->addMonth()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}