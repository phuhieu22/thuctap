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
        Schema::create('laptop_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laptop_id')->constrained('laptops')->onDelete('cascade');
            // $table->foreignId('laptop_id')->constrained();
            $table->string('variant_name');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->text('specifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptop_variants');
    }
};
