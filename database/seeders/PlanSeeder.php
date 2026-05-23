<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Plan Básico',
                'description' => 'Ideal para comenzar. Incluye acceso a 4 clases al mes.',
                'price' => 39.99,
                'classes_per_month' => 4,
                'duration_days' => 30,
                'is_featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Plan Premium',
                'description' => 'Perfecto para mantener una rutina constante. Incluye 12 clases al mes.',
                'price' => 79.99,
                'classes_per_month' => 12,
                'duration_days' => 30,
                'is_featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Plan Unlimited',
                'description' => 'Acceso ilimitado a clases presenciales y contenido exclusivo.',
                'price' => 99.99,
                'classes_per_month' => null,
                'duration_days' => 30,
                'is_featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}