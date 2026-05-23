<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // Clase asociada
            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            // Día de la semana
            $table->enum('day_of_week', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday',
            ]);

            // Hora de inicio y fin
            $table->time('start_time');
            $table->time('end_time');

            // Instructor
            $table->string('instructor_name');

            // Sala (por si crece el estudio)
            $table->string('room')->nullable();

            // Horario activo o no
            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
