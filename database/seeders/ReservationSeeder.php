<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 2,
                'schedule_id' => 1,
                'status' => 'confirmed',
                'notes' => 'Primera clase de prueba.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'schedule_id' => 3,
                'status' => 'completed',
                'notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'schedule_id' => 5,
                'status' => 'cancelled',
                'notes' => 'Canceló por trabajo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}