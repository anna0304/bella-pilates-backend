<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'business_name',
                'value' => 'Bella Pilates',
                'description' => 'Nombre del negocio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'phone',
                'value' => '+34 600 123 456',
                'description' => 'Teléfono principal',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'email',
                'value' => 'info@bellapilates.com',
                'description' => 'Correo de contacto',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'instagram',
                'value' => '@bellapilates',
                'description' => 'Instagram del negocio',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'address',
                'value' => 'Alicante, España',
                'description' => 'Dirección del centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'opening_hours',
                'value' => 'Lunes a Viernes 08:00 - 21:00',
                'description' => 'Horario del centro',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'footer_text',
                'value' => 'Transforma tu cuerpo y mente con Bella Pilates.',
                'description' => 'Texto footer web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}