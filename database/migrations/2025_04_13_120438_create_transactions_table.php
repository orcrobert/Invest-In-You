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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('payment_intent_id')->nullable();
            $table->string('status');  // 'completed', 'refunded', 'failed'
            $table->string('type');    // 'deposit', 'refund', 'task_reward'
            $table->unsignedBigInteger('related_transaction_id')->nullable(); // For refunds
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
