<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('schedules')->insert([
            [
                'class_id' => 1,
                'day_of_week' => 'monday',
                'start_time' => '18:00:00',
                'end_time' => '19:00:00',
                'instructor_name' => 'Laura Martínez',
                'room' => 'Sala Reformer',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 1,
                'day_of_week' => 'thursday',
                'start_time' => '19:00:00',
                'end_time' => '20:00:00',
                'instructor_name' => 'Laura Martínez',
                'room' => 'Sala Reformer',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 2,
                'day_of_week' => 'tuesday',
                'start_time' => '10:00:00',
                'end_time' => '10:50:00',
                'instructor_name' => 'Ana García',
                'room' => 'Sala Principal',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 3,
                'day_of_week' => 'wednesday',
                'start_time' => '17:00:00',
                'end_time' => '17:55:00',
                'instructor_name' => 'María López',
                'room' => 'Sala Principal',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 4,
                'day_of_week' => 'friday',
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'instructor_name' => 'Sofía Ruiz',
                'room' => 'Sala Zen',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'class_id' => 5,
                'day_of_week' => 'saturday',
                'start_time' => '11:00:00',
                'end_time' => '11:45:00',
                'instructor_name' => 'Carlos Medina',
                'room' => 'Sala Recovery',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}