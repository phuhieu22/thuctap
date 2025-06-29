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
             $table->foreignId('order_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->useCurrent();
            $table->enum('status', ['unpaid', 'paid', 'failed', 'refunded'])->default('unpaid');
            $table->string('payment_method');
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
