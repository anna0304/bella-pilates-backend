<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            UserSeeder::class,
            ClassSeeder::class,
            ScheduleSeeder::class,
            ReservationSeeder::class,
            RecordedClassSeeder::class,
            FavoriteSeeder::class,
            PlanSeeder::class,
            PaymentSeeder::class,
            MessageSeeder::class,
            SettingSeeder::class,
        ]);
    }
}