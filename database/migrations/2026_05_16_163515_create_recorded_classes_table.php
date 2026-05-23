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
        Schema::create('recorded_classes', function (Blueprint $table) {
            $table->id();

            // Clase relacionada
            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            // Título del video
            $table->string('title');

            // Descripción
            $table->text('description')
                ->nullable();

            // URL del video
            $table->string('video_url');

            // Imagen miniatura
            $table->string('thumbnail')
                ->nullable();

            // Duración en minutos
            $table->integer('duration');

            // Nivel de dificultad
            $table->enum('level', [
                'beginner',
                'intermediate',
                'advanced',
            ]);

            // Clase destacada
            $table->boolean('featured')
                ->default(false);

            // Disponible o no
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
        Schema::dropIfExists('recorded_classes');
    }
};
