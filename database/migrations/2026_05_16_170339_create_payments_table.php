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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Usuario que paga
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Plan adquirido
            $table->foreignId('plan_id')
                ->constrained('plans')
                ->cascadeOnDelete();

            // Monto pagado
            $table->decimal('amount', 8, 2);

            // Método de pago
            $table->enum('payment_method', [
                'cash',
                'card',
                'bizum',
                'bank_transfer',
            ]);

            // Estado del pago
            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'refunded',
            ])->default('pending');

            // Referencia externa (Stripe, PayPal...)
            $table->string('transaction_id')
                ->nullable();

            // Inicio y fin del plan
            $table->date('starts_at');
            $table->date('expires_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
