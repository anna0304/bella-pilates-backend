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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // Información del remitente
            $table->string('name');
            $table->string('email');
            $table->string('phone')
                ->nullable();

            // Asunto y mensaje
            $table->string('subject');
            $table->text('message');

            // Estado del mensaje
            $table->enum('status', [
                'unread',
                'read',
                'archived',
            ])->default('unread');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
