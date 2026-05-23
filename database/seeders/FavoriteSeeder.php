<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('favorites')->insert([
            [
                'user_id' => 2,
                'recorded_class_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 2,
                'recorded_class_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'recorded_class_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 4,
                'recorded_class_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}