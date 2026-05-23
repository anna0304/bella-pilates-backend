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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Datos personales
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Seguridad
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Roles y estado
            $table->enum('role', ['admin', 'user'])
                ->default('user');

            $table->enum('status', ['active', 'inactive'])
                ->default('active');

            // Cambio obligatorio de contraseña
            $table->boolean('must_change_password')
                ->default(false);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
