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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            // Información principal
            $table->string('title');
            $table->text('description')->nullable();

            // Tipo de clase
            $table->enum('category', [
                'reformer',
                'mat',
                'flow',
                'yoga',
                'stretching'
            ]);

            // Nivel
            $table->enum('level', [
                'beginner',
                'intermediate',
                'advanced'
            ])->default('beginner');

            // Duración en minutos
            $table->integer('duration');

            // Capacidad máxima de alumnos
            $table->integer('max_capacity')
                ->default(10);

            // Imagen portada
            $table->string('image')->nullable();

            // Clase activa o no
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
        Schema::dropIfExists('classes');
    }
};
