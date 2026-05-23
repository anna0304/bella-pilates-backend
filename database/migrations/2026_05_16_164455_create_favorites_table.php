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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

            // Usuario que guarda el favorito
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Clase grabada favorita
            $table->foreignId('recorded_class_id')
                ->constrained('recorded_classes')
                ->cascadeOnDelete();

            $table->timestamps();

            // Evita favoritos duplicados
            $table->unique([
                'user_id',
                'recorded_class_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
