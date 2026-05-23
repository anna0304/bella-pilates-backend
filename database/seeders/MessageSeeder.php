<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'name' => 'Laura García',
                'email' => 'laura@email.com',
                'phone' => '600111111',
                'subject' => 'Información sobre Pilates Reformer',
                'message' => 'Hola, me gustaría saber si las clases de Pilates Reformer son aptas para principiantes.',
                'status' => 'unread',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Anna Martínez',
                'email' => 'anna@email.com',
                'phone' => '600222222',
                'subject' => 'Consulta sobre horarios',
                'message' => 'Buenas tardes, quisiera saber si tienen clases después de las 19:00.',
                'status' => 'read',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Marta López',
                'email' => 'marta@email.com',
                'phone' => '600333333',
                'subject' => 'Problema con reserva',
                'message' => 'Intenté reservar una clase pero no me aparece disponibilidad.',
                'status' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}