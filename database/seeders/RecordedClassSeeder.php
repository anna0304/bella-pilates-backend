<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordedClassSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recorded_classes')->insert([
            [
                'class_id' => 1,
                'title' => 'Pilates Reformer para Core',
                'description' => 'Entrenamiento enfocado en abdomen, postura y estabilidad.',
                'video_url' => 'https://youtu.be/example1',
                'thumbnail' => 'recorded/reformer-core.jpg',
                'duration' => 35,
                'level' => 'intermediate',
                'featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 2,
                'title' => 'Pilates Mat para Principiantes',
                'description' => 'Clase ideal para comenzar pilates desde cero.',
                'video_url' => 'https://youtu.be/example2',
                'thumbnail' => 'recorded/mat-beginner.jpg',
                'duration' => 25,
                'level' => 'beginner',
                'featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 3,
                'title' => 'Pilates Flow Energizante',
                'description' => 'Rutina dinámica para activar cuerpo y coordinación.',
                'video_url' => 'https://youtu.be/example3',
                'thumbnail' => 'recorded/flow-energy.jpg',
                'duration' => 40,
                'level' => 'intermediate',
                'featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 4,
                'title' => 'Yoga Balance y Respiración',
                'description' => 'Sesión enfocada en relajación, equilibrio y respiración.',
                'video_url' => 'https://youtu.be/example4',
                'thumbnail' => 'recorded/yoga-balance.jpg',
                'duration' => 30,
                'level' => 'beginner',
                'featured' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 5,
                'title' => 'Stretching Recovery Completo',
                'description' => 'Rutina suave para recuperación muscular y movilidad.',
                'video_url' => 'https://youtu.be/example5',
                'thumbnail' => 'recorded/stretching-recovery.jpg',
                'duration' => 20,
                'level' => 'beginner',
                'featured' => false,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}