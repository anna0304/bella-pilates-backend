<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'title' => 'Pilates Reformer',
                'description' => 'Clase enfocada en fuerza, control, postura y precisión utilizando reformer.',
                'category' => 'reformer',
                'level' => 'intermediate',
                'duration' => 60,
                'max_capacity' => 10,
                'image' => 'classes/reformer.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Pilates Mat',
                'description' => 'Trabajo de movilidad, flexibilidad y fuerza sobre colchoneta.',
                'category' => 'mat',
                'level' => 'beginner',
                'duration' => 50,
                'max_capacity' => 12,
                'image' => 'classes/mat.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Pilates Flow',
                'description' => 'Clase dinámica para mejorar energía, coordinación y resistencia.',
                'category' => 'flow',
                'level' => 'intermediate',
                'duration' => 55,
                'max_capacity' => 10,
                'image' => 'classes/flow.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Yoga Balance',
                'description' => 'Sesión enfocada en respiración, equilibrio y relajación corporal.',
                'category' => 'yoga',
                'level' => 'beginner',
                'duration' => 60,
                'max_capacity' => 15,
                'image' => 'classes/yoga.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Stretching Recovery',
                'description' => 'Clase suave para recuperación muscular y mejora de movilidad.',
                'category' => 'stretching',
                'level' => 'beginner',
                'duration' => 45,
                'max_capacity' => 15,
                'image' => 'classes/stretching.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}